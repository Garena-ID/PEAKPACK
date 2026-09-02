@extends('layouts.admin')

@section('content')

<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">REKAPITULASI & LAPORAN</p>
        <h2 class="text-3xl font-black text-forest">Laporan Operasional PeakPack</h2>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.reports.export-pdf', request()->query()) }}" target="_blank" class="btn-primary flex items-center gap-2">
             Export PDF (Print)
        </a>
        <a href="{{ route('admin.reports.export-excel', request()->query()) }}" class="btn-secondary flex items-center gap-2">
             Export Excel (CSV)
        </a>
    </div>
</div>

<!-- Summary Metric Cards -->
<div class="grid gap-5 md:grid-cols-4 mb-8">
    <div class="card p-5">
        <p class="eyebrow">TOTAL CUSTOMERS</p>
        <p class="mt-2 text-2xl font-black text-forest">{{ number_format($totalCustomers) }}</p>
        <small class="text-xs text-primary/60">Pelanggan terdaftar</small>
    </div>

    <div class="card p-5">
        <p class="eyebrow">TOTAL MOUNTAINS</p>
        <p class="mt-2 text-2xl font-black text-forest">{{ number_format($totalMountains) }}</p>
        <small class="text-xs text-primary/60">Gunung dalam katalog</small>
    </div>

    <div class="card p-5">
        <p class="eyebrow">TOTAL GEAR</p>
        <p class="mt-2 text-2xl font-black text-forest">{{ number_format($totalGear) }}</p>
        <small class="text-xs text-primary/60">Perlengakapan outdoor</small>
    </div>

    <div class="card p-5 bg-primary text-cream">
        <p class="text-xs font-bold text-secondary">REVENUE (COMPLETED)</p>
        <p class="mt-2 text-2xl font-black text-cream">Rp {{ number_format($filteredRevenue, 0, ',', '.') }}</p>
        <small class="text-xs text-cream/70">Akumulasi sewa selesai</small>
    </div>
</div>

<!-- Status Breakdown Cards -->
<div class="grid gap-4 md:grid-cols-3 mb-8">
    <div class="card p-4 bg-secondary/30">
        <div class="flex justify-between items-center">
            <span class="text-xs font-bold text-primary">RENTAL PENDING</span>
            <span class="badge">{{ $statusCounts['Pending'] }}</span>
        </div>
        <p class="text-xs text-primary/60 mt-1">Perlu konfirmasi & penyiapan</p>
    </div>

    <div class="card p-4 bg-secondary/30">
        <div class="flex justify-between items-center">
            <span class="text-xs font-bold text-primary">RENTAL ON RENT</span>
            <span class="badge">{{ $statusCounts['On Rent'] }}</span>
        </div>
        <p class="text-xs text-primary/60 mt-1">Sedang digunakan pendaki</p>
    </div>

    <div class="card p-4 bg-secondary/30">
        <div class="flex justify-between items-center">
            <span class="text-xs font-bold text-primary">RENTAL COMPLETED</span>
            <span class="badge">{{ $statusCounts['Completed'] }}</span>
        </div>
        <p class="text-xs text-primary/60 mt-1">Selesai & alat dikembalikan</p>
    </div>
</div>

<!-- Date & Status Filter Form -->
<form method="GET" action="{{ route('admin.reports.index') }}" class="card mb-6 grid gap-4 p-5 sm:grid-cols-4 items-end">
    <div>
        <label class="field">
            <span>Tanggal Mulai</span>
            <input type="date" name="start_date" value="{{ $startDate }}" class="input" />
        </label>
    </div>

    <div>
        <label class="field">
            <span>Tanggal Akhir</span>
            <input type="date" name="end_date" value="{{ $endDate }}" class="input" />
        </label>
    </div>

    <div>
        <label class="field">
            <span>Status Rental</span>
            <select name="status" class="input">
                <option value="">Semua Status</option>
                <option value="Pending" @selected($status === 'Pending')>Pending</option>
                <option value="On Rent" @selected($status === 'On Rent')>On Rent</option>
                <option value="Completed" @selected($status === 'Completed')>Completed</option>
            </select>
        </label>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="btn-secondary w-full">
            Filter Laporan
        </button>
        @if($startDate || $endDate || $status)
            <a href="{{ route('admin.reports.index') }}" class="btn-ghost">
                Reset
            </a>
        @endif
    </div>
</form>

<!-- Report Data Table -->
<div class="card p-6 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-primary/60">
                    <th class="py-3">Kode Rental</th>
                    <th class="py-3">Customer</th>
                    <th class="py-3">Tgl Sewa – Tgl Kembali</th>
                    <th class="py-3">Detail Item</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-right">Total Biaya</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5">
                @forelse($rentals as $r)
                    <tr>
                        <td class="py-3 font-bold text-primary">
                            {{ $r->rental_code }}
                        </td>
                        <td class="py-3">
                            <span class="font-semibold block text-primary">{{ $r->user->name ?? '-' }}</span>
                            <span class="text-xs text-primary/60">{{ $r->user->email ?? '' }}</span>
                        </td>
                        <td class="py-3 text-primary/80">
                            {{ $r->rental_date ? $r->rental_date->format('d M Y') : '-' }} <br>
                            <span class="text-xs text-primary/60">s/d {{ $r->due_date ? $r->due_date->format('d M Y') : '-' }}</span>
                        </td>
                        <td class="py-3 text-xs">
                            <ul class="list-disc list-inside space-y-0.5 text-primary/80">
                                @foreach($r->rentalItems as $item)
                                    <li>{{ $item->gear->name ?? 'Gear' }} ({{ $item->qty }}x)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-3">
                            <span class="badge">
                                {{ $r->status }}
                            </span>
                        </td>
                        <td class="py-3 text-right font-bold text-forest">
                            Rp {{ number_format($r->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-primary/50">
                            Tidak ada transaksi penyewaan yang ditemukan untuk kriteria filter ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($rentals->hasPages())
        <div class="mt-4 pt-4 border-t border-primary/10">
            {{ $rentals->links() }}
        </div>
    @endif
</div>

@endsection
