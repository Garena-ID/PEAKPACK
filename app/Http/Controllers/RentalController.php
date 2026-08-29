<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalRequest;
use App\Models\Gear;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with('user', 'rentalItems.gear')
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->search, fn ($q, $s) => $q->where('rental_code', 'like', "%{$s}%"));

        if (!auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $items = $query->latest()->paginate(10)->withQueryString();

        return view(auth()->user()->isAdmin() ? 'admin.rentals.index' : 'rentals.index', compact('items'));
    }

    public function create()
    {
        $gear = Gear::where('stock', '>', 0)->orderBy('name')->get();
        return view('rentals.form', ['gear' => $gear, 'rental' => new Rental()]);
    }

    public function store(RentalRequest $request)
    {
        $data = $request->validated();

        // 1. Agregasi TOTAL kuantitas yang diajukan per gear_id dalam request ini
        $aggregatedQuantities = [];
        foreach ($data['items'] as $line) {
            $gearId = (int) $line['gear_id'];
            $qty = (int) $line['qty'];
            if (!isset($aggregatedQuantities[$gearId])) {
                $aggregatedQuantities[$gearId] = 0;
            }
            $aggregatedQuantities[$gearId] += $qty;
        }

        // 2. Eksekusi DB Transaction untuk konsistensi stok & rental
        $rental = DB::transaction(function () use ($data, $aggregatedQuantities) {
            // Cek stok untuk setiap gear yang diajukan dengan lockForUpdate
            $gearsToProcess = [];
            foreach ($aggregatedQuantities as $gearId => $totalRequestedQty) {
                $gear = Gear::lockForUpdate()->find($gearId);

                if (!$gear) {
                    throw ValidationException::withMessages([
                        'items' => 'Perlengkapan yang dipilih tidak ditemukan dalam database.',
                    ]);
                }

                if ($gear->stock < $totalRequestedQty) {
                    throw ValidationException::withMessages([
                        'items' => "Stok {$gear->name} hanya tersedia {$gear->stock} unit.",
                    ]);
                }

                $gearsToProcess[$gearId] = [
                    'model' => $gear,
                    'totalQty' => $totalRequestedQty,
                ];
            }

            // Buat header transaksi rental
            $rental = Rental::create([
                'user_id'     => auth()->id(),
                'rental_code' => 'PP-' . now()->format('ymd') . '-' . Str::upper(Str::random(5)),
                'rental_date' => $data['rental_date'],
                'due_date'    => $data['due_date'],
                'status'      => 'Pending',
                'total_price' => 0,
            ]);

            $totalPrice = 0;

            // Simpan rental_items & kurangi stok gear
            foreach ($gearsToProcess as $gearId => $info) {
                /** @var Gear $gear */
                $gear = $info['model'];
                $qty = $info['totalQty'];

                $subtotal = $gear->rental_price * $qty;

                $rental->rentalItems()->create([
                    'gear_id'  => $gear->id,
                    'qty'      => $qty,
                    'price'    => $gear->rental_price,
                    'subtotal' => $subtotal,
                ]);

                // Kurangi stok gear
                $gear->decrement('stock', $qty);

                $totalPrice += $subtotal;
            }

            $rental->update(['total_price' => $totalPrice]);

            return $rental;
        });

        return to_route('rentals.show', $rental)->with('success', 'Pengajuan penyewaan berhasil dibuat.');
    }

    public function show(Rental $rental)
    {
        $this->authorizeRental($rental);
        $rental->load('user', 'rentalItems.gear');

        return view(auth()->user()->isAdmin() ? 'admin.rentals.show' : 'rentals.show', compact('rental'));
    }

    public function edit(Rental $rental)
    {
        $rental->load('user', 'rentalItems.gear');
        return view('admin.rentals.form', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        $data = $request->validate([
            'status' => ['required', 'in:Pending,On Rent,Completed'],
        ], [
            'status.required' => 'Status rental wajib dipilih.',
            'status.in'       => 'Status rental tidak valid.',
        ]);

        if ($rental->status === 'Completed' && $data['status'] !== 'Completed') {
            return back()->withErrors(['status' => 'Transaksi yang sudah Completed tidak dapat diubah kembali.']);
        }

        DB::transaction(function () use ($rental, $data) {
            // Jika status diubah menjadi Completed, stok dikembalikan ke inventaris
            if ($data['status'] === 'Completed' && $rental->status !== 'Completed') {
                foreach ($rental->rentalItems as $item) {
                    $item->gear()->increment('stock', $item->qty);
                }

                if (!$rental->return_date) {
                    $data['return_date'] = now()->toDateString();
                }
            }

            $rental->update($data);
        });

        return to_route('admin.rentals.show', $rental)->with('success', 'Status penyewaan berhasil diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        DB::transaction(function () use ($rental) {
            // Kembalikan stok jika rental belum Completed saat dihapus
            if ($rental->status !== 'Completed') {
                foreach ($rental->rentalItems as $item) {
                    $item->gear()->increment('stock', $item->qty);
                }
            }

            $rental->delete();
        });

        return to_route('admin.rentals.index')->with('success', 'Transaksi penyewaan berhasil dihapus dan stok dikembalikan.');
    }

    private function authorizeRental(Rental $rental)
    {
        abort_unless(auth()->user()->isAdmin() || $rental->user_id === auth()->id(), 403);
    }
}
