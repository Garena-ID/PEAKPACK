@extends('layouts.app')

@section('content')

<div class="mb-7 flex flex-wrap items-center justify-between gap-4">
    <div>
        <p class="eyebrow">PERLENGKAPAN</p>
        <h2 class="text-3xl font-black text-forest">Perlengkapan Outdoor</h2>
    </div>

    <a href="{{ route('rentals.create') }}" class="btn-primary text-sm">
        + Buat Penyewaan
    </a>
</div>

<form method="GET" action="{{ route('gear.catalog') }}" class="card mb-6 grid gap-3 p-4 sm:grid-cols-3">
    <input class="input" name="search" value="{{ request('search') }}" placeholder="Cari perlengkapan...">

    <select class="input" name="category_id">
        <option value="">Semua kategori</option>
        @foreach($categories as $c)
            <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>
                {{ $c->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn-secondary">
        Cari
    </button>
</form>

<div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
    @forelse($gear as $item)
        <article class="card p-6 flex flex-col justify-between">
            <div>
                <span class="badge">
                    {{ $item->category->name }}
                </span>

                <h3 class="mt-3 text-xl font-black text-forest">
                    {{ $item->name }}
                </h3>

                <p class="mt-2 text-sm text-primary/70 min-h-[48px]">
                    {{ $item->description ?? 'Perlengkapan outdoor berkualitas tinggi untuk keamanan & kenyamanan pendakian.' }}
                </p>
            </div>

            <div>
                <div class="mt-4 flex items-end justify-between pb-4 border-b border-primary/10">
                    <div>
                        <b class="text-lg text-primary">
                            Rp {{ number_format($item->rental_price, 0, ',', '.') }}
                        </b>
                        <small class="block text-xs text-primary/60">
                            per hari
                        </small>
                    </div>

                    <span class="text-xs font-bold text-primary/70 bg-secondary/50 px-2.5 py-1 rounded-full">
                        Stok: {{ $item->stock }}
                    </span>
                </div>

                <div class="mt-4 flex justify-end">
                    <a href="{{ route('rentals.create', ['gear_id' => $item->id]) }}" class="btn-primary w-full text-center text-xs">
                        Sewa Sekarang
                    </a>
                </div>
            </div>
        </article>
    @empty
        <div class="md:col-span-3">
            @include('components.empty', [
                'message' => 'Belum ada perlengkapan yang tersedia.'
            ])
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $gear->links() }}
</div>

@endsection
