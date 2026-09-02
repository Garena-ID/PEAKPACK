<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Menampilkan daftar customer.
     */
    public function index(Request $request)
    {
        $customers = User::where('role', 'customer')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Menampilkan detail customer.
     */
    public function show(User $customer)
    {
        abort_if($customer->role !== 'customer', 404);

        $customer->load('rentals');

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Menampilkan form edit customer.
     */
    public function edit(User $customer)
    {
        abort_if($customer->role !== 'customer', 404);

        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data customer.
     *
     * Password tidak boleh diubah dari halaman admin.
     */
    public function update(Request $request, User $customer)
    {
        abort_if($customer->role !== 'customer', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $customer->id,
            ],
        ]);

        $customer->update($validated);

        return to_route('admin.customers.index')
            ->with('success', 'Customer berhasil diperbarui.');
    }

    /**
     * Menghapus customer.
     */
        public function destroy(User $customer)
    {
        abort_if($customer->role !== 'customer', 404);

        if ($customer->rentals()->exists()) {
            return to_route('admin.customers.index')
                ->with('error', 'Customer tidak dapat dihapus karena sudah memiliki transaksi rental.');
        }

        $customer->delete();

        return to_route('admin.customers.index')
            ->with('success', 'Customer berhasil dihapus.');
    }
}