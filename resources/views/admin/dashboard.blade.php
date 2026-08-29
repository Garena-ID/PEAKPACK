@extends('layouts.admin')

@section('content')

<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">ADMIN WORKSPACE</p>
        <h2 class="text-3xl font-black text-forest">PeakPack Admin Dashboard</h2>
        <p class="text-sm text-primary/70 mt-1">Ringkasan statistik operasional dan aktivitas transaksi penyewaan realtime.</p>
    </div>

    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.mountains.create') }}" class="btn-primary">
            + Tambah Gunung
        </a>
        <a href="{{ route('admin.gear.create') }}" class="btn-secondary">
            + Tambah Gear
        </a>
    </div>
</div>

<!-- 4 Utama Statistik Realtime -->
<div class="grid gap-5 md:grid-cols-4 mb-8">
    <div class="card p-5 border-l-4 border-l-primary">
        <p class="eyebrow">CUSTOMERS</p>
        <p class="mt-2 text-3xl font-black text-forest">{{ number_format($stats['customers']) }}</p>
        <small class="text-xs text-primary/60">Pelanggan terdaftar</small>
    </div>

    <div class="card p-5 border-l-4 border-l-primary">
        <p class="eyebrow">MOUNTAINS</p>
        <p class="mt-2 text-3xl font-black text-forest">{{ number_format($stats['mountains']) }}</p>
        <small class="text-xs text-primary/60">Gunung dalam database</small>
    </div>

    <div class="card p-5 border-l-4 border-l-primary">
        <p class="eyebrow">GEAR</p>
        <p class="mt-2 text-3xl font-black text-forest">{{ number_format($stats['gear']) }}</p>
        <small class="text-xs text-primary/60">Perlengkapan outdoor</small>
    </div>

    <div class="card p-5 border-l-4 border-l-secondary bg-secondary/20">
        <p class="eyebrow">RENTALS</p>
        <p class="mt-2 text-3xl font-black text-forest">{{ number_format($stats['rentals']) }}</p>
        <small class="text-xs text-primary/60">Total transaksi sewa</small>
    </div>
</div>

<!-- Status Breakdown & Revenue -->
<div class="grid gap-4 md:grid-cols-4 mb-8">
    
    <div class="card p-4 bg-primary text-cream">
        <span class="text-xs font-bold text-secondary block">TOTAL PEMASUKAN</span>
        <p class="text-xl font-black text-cream mt-1">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
    </div>
</div>

<!-- Recent Rental Transactions Table -->
<div class="card p-6 overflow-hidden">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-black text-lg text-forest">Transaksi Penyewaan Terbaru</h3>
        <a href="{{ route('admin.rentals.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua Rentals →</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-primary/60">
                    <th class="py-3">Kode Rental</th>
                    <th class="py-3">Customer</th>
                    <th class="py-3">Tanggal Sewa</th>
                    <th class="py-3">Total Harga</th>
                    <th class="py-3">Status</th>
                    <th class="py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5">
                @forelse($recentRentals as $rental)
                    <tr>
                        <td class="py-3 font-bold text-primary">
                            {{ $rental->rental_code }}
                        </td>
                        <td class="py-3 text-primary">
                            {{ $rental->user->name ?? '-' }}
                        </td>
                        <td class="py-3 text-primary/70">
                            {{ $rental->rental_date ? $rental->rental_date->format('d M Y') : '-' }}
                        </td>
                        <td class="py-3 font-bold text-forest">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>
                        <td class="py-3">
                            <span class="badge">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td class="py-3 text-right">
                            <a href="{{ route('admin.rentals.show', $rental) }}" class="btn-ghost text-xs">
                                Kelola →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-primary/50">
                            Belum ada transaksi penyewaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
