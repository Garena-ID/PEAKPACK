@extends('layouts.app')

@section('content')

<div class="mb-7 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">PENYEWAAN SAYA</p>
        <h2 class="text-3xl font-black text-forest">Riwayat & Status Penyewaan</h2>
    </div>

    <a href="{{ route('rentals.create') }}" class="btn-primary">
        + Buat Penyewaan Baru
    </a>
</div>

<div class="card p-6 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-primary/60">
                    <th class="py-3">Kode Rental</th>
                    <th class="py-3">Tanggal Sewa – Jatuh Tempo</th>
                    <th class="py-3">Status</th>
                    <th class="py-3">Total Biaya</th>
                    <th class="py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5">
                @forelse($items as $r)
                    <tr>
                        <td class="py-3 font-bold text-primary">
                            {{ $r->rental_code }}
                        </td>

                        <td class="py-3 text-primary/80">
                            {{ $r->rental_date ? $r->rental_date->format('d M Y') : '-' }} – {{ $r->due_date ? $r->due_date->format('d M Y') : '-' }}
                        </td>

                        <td class="py-3">
                            <span class="badge">
                                {{ $r->status }}
                            </span>
                        </td>

                        <td class="py-3 font-bold text-forest">
                            Rp {{ number_format($r->total_price, 0, ',', '.') }}
                        </td>

                        <td class="py-3 text-right">
                            <a href="{{ route('rentals.show', $r) }}" class="btn-ghost text-xs">
                                Lihat Detail →
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-primary/50">
                            Belum ada penyewaan. Klik tombol di atas untuk mengajukan penyewaan baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="mt-4 pt-4 border-t border-primary/10">
            {{ $items->links() }}
        </div>
    @endif
</div>

@endsection
