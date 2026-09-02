@extends('layouts.app')

@section('content')

<div class="mb-7">
    <p class="eyebrow">DESTINASI</p>
    <h2 class="text-3xl font-black text-forest">Temukan Puncak Berikutnya</h2>
</div>

<form method="GET" action="{{ route('mountains.catalog') }}" class="card mb-6 grid gap-3 p-4 sm:grid-cols-3">
    <input class="input" name="search" value="{{ request('search') }}" placeholder="Cari gunung atau provinsi">

    <select class="input" name="difficulty">
        <option value="">Semua tingkat kesulitan</option>
        @foreach(['Easy', 'Medium', 'Hard'] as $d)
            <option value="{{ $d }}" @selected(request('difficulty') === $d)>
                {{ $d }}
            </option>
        @endforeach
    </select>

    <button class="btn-secondary">
        Cari
    </button>
</form>

<div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
    @forelse($mountains as $m)
        <article class="card p-6 flex flex-col justify-between">
            <div>
                <span class="badge">
                    {{ $m->difficulty }}
                </span>

                <h3 class="mt-4 text-xl font-black text-forest">
                    {{ $m->name }}
                </h3>

                <p class="mt-1 text-sm text-primary/60">
                    {{ $m->location }}, {{ $m->province }}
                </p>

                <p class="mt-4 text-sm text-primary/70">
                    {{ Str::limit($m->description ?? 'Informasi trek gunung siap dijelajahi.', 120) }}
                </p>
            </div>

            <div class="mt-5 flex justify-between border-t border-primary/10 pt-4 text-sm font-semibold">
                <span>
                    {{ number_format($m->elevation) }} m
                </span>

                <span>
                     {{ $m->estimated_duration }}
                </span>
            </div>
        </article>
    @empty
        <div class="md:col-span-3">
            @include('components.empty', [
                'message' => 'Tidak ada gunung yang sesuai dengan pencarian.'
            ])
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $mountains->links() }}
</div>

@endsection
