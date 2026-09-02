@extends('layouts.app')

@section('content')

<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">BASECAMP PETUALANGAN</p>
        <h2 class="text-3xl font-black text-forest">Selamat Datang, {{ $user->name }}! </h2>
        <p class="text-sm text-primary/70 mt-1">Siapkan pendakianmu dengan perlengkapan terbaik dan jelajahi berbagai puncak di Indonesia.</p>
    </div>

    <div class="flex flex-wrap gap-3">
        <a class="btn-primary" href="{{ route('gear.catalog') }}">
            ⚙️ Sewa Peralatan
        </a>
        <a class="btn-secondary" href="{{ route('mountains.catalog') }}">
            ⛰️ Daftar Gunung
        </a>
    </div>
</div>

<!-- User & Rental Summary Row -->
<div class="grid gap-5 md:grid-cols-4 mb-8">
    <div class="card p-5 bg-primary text-cream md:col-span-1 flex flex-col justify-between">
        <div>
            <p class="text-secondary eyebrow">INFORMASI PROFIL</p>
            <h3 class="text-xl font-black text-cream mt-1">{{ $user->name }}</h3>
            <p class="text-xs text-cream/70 mt-0.5">{{ $user->email }}</p>
        </div>
        <div class="mt-4 pt-3 border-t border-white/10 flex justify-between items-center text-xs">
        </div>
    </div>

    <div class="card p-5">
        <p class="eyebrow">TOTAL SEWA YANG DILAKUKAN</p>
        <p class="mt-2 text-3xl font-black text-forest">{{ $user->rentals()->count() }}</p>
        <small class="text-xs text-primary/60">Penyewaan keseluruhan</small>
    </div>

    <div class="card p-5 bg-secondary/30">
        <p class="text-xs font-bold text-primary">PENDING & ON RENT</p>
        <p class="mt-2 text-3xl font-black text-forest">
            {{ $user->rentals()->whereIn('status', ['Pending', 'On Rent'])->count() }}
        </p>
        <small class="text-xs text-primary/60">Dalam proses sewa</small>
    </div>

    <div class="card p-5">
        <p class="eyebrow">COMPLETED</p>
        <p class="mt-2 text-3xl font-black text-forest">
            {{ $user->rentals()->where('status', 'Completed')->count() }}
        </p>
        <small class="text-xs text-primary/60">Selesai dikembalikan</small>
    </div>
</div>

<!-- Recent Rentals & Catalogs Row -->
<div class="grid gap-6 md:grid-cols-2 mb-8">

    <!-- Recent Rentals -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-black text-lg text-forest">Penyewaan Terbaru Saya</h3>
            <a href="{{ route('rentals.index') }}" class="text-xs font-bold text-primary hover:underline">Lihat Semua →</a>
        </div>

        <div class="space-y-3">
            @forelse($rentals as $r)
                <a class="flex justify-between items-center rounded-xl bg-secondary/20 p-4 hover:bg-secondary/40 transition" href="{{ route('rentals.show', $r) }}">
                    <div>
                        <b class="text-primary block text-sm">{{ $r->rental_code }}</b>
                        <small class="text-xs text-primary/60">
                            Tgl: {{ $r->rental_date ? $r->rental_date->format('d M Y') : '-' }} — Jatuh Tempo: {{ $r->due_date ? $r->due_date->format('d M Y') : '-' }}
                        </small>
                    </div>
                    <span class="badge">
                        {{ $r->status }}
                    </span>
                </a>
            @empty
                @include('components.empty', [
                    'message' => 'Belum ada riwayat penyewaan.'
                ])
            @endforelse
        </div>
    </div>

    <!-- Available Gear Quick View -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-black text-lg text-forest">Perlengkapan Siap Sewa</h3>
            <a href="{{ route('gear.catalog') }}" class="text-xs font-bold text-primary hover:underline">Katalog Gear →</a>
        </div>

        <div class="space-y-3">
            @forelse($availableGear as $g)
                <div class="flex justify-between items-center p-3.5 rounded-xl border border-primary/10">
                    <div>
                        <b class="text-sm text-primary block">{{ $g->name }}</b>
                        <span class="text-xs text-primary/60">Rp {{ number_format($g->rental_price, 0, ',', '.') }}/hari</span>
                    </div>
                    <a href="{{ route('rentals.create', ['gear_id' => $g->id]) }}" class="btn-secondary text-xs">
                        Sewa
                    </a>
                </div>
            @empty
                @include('components.empty', [
                    'message' => 'Tidak ada perlengkapan yang tersedia.'
                ])
            @endforelse
        </div>
    </div>

</div>

<!-- Mountain Recommendation Shortcut -->
<div class="mb-4 flex items-center justify-between">
    <h3 class="text-xl font-black text-forest">Rekomendasi Destinasi Pendakian</h3>
    <a href="{{ route('mountains.catalog') }}" class="text-xs font-bold text-primary hover:underline">Jelajahi Gunung →</a>
</div>

<div class="grid gap-4 md:grid-cols-3">
    @foreach($mountains as $m)
        <a class="card p-5 hover:-translate-y-1 transition" href="{{ route('mountains.catalog') }}">
            <div class="flex justify-between items-center mb-3">
                <span class="badge">
                    {{ $m->difficulty }}
                </span>
                <span class="text-xs font-bold text-primary/60">{{ number_format($m->elevation) }} mdpl</span>
            </div>

            <h4 class="text-lg font-bold text-forest">
                {{ $m->name }}
            </h4>

            <p class="text-xs text-primary/60 mt-1">
                📍 {{ $m->location }}, {{ $m->province }}
            </p>
        </a>
    @endforeach
</div>

@endsection
