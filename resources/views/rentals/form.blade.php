@extends('layouts.app')

@section('content')

<div class="mb-7">
    <a class="link text-sm" href="{{ route('gear.catalog') }}">
        ← Kembali ke Perlengkapan
    </a>

    <h2 class="mt-2 text-3xl font-black text-forest">
        Form Pengajuan Penyewaan
    </h2>
    <p class="text-sm text-primary/70">Tentukan tanggal sewa dan pilih perlengkapan yang ingin dipinjam.</p>
</div>

<form method="POST" action="{{ route('rentals.store') }}" class="card max-w-4xl p-6" x-data="{ lines: [{ gear_id: '{{ request('gear_id', '') }}', qty: 1 }] }">
    @csrf

    <div class="grid gap-5 sm:grid-cols-2">
        <label class="field">
            <span>Tanggal Pengambilan *</span>
            <input type="date" name="rental_date" min="{{ now()->toDateString() }}" value="{{ old('rental_date', now()->toDateString()) }}" class="input" required>
            @error('rental_date')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <label class="field">
            <span>Tanggal Pengembalian *</span>
            <input type="date" name="due_date" min="{{ now()->toDateString() }}" value="{{ old('due_date', now()->addDays(2)->toDateString()) }}" class="input" required>
            @error('due_date')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </label>
    </div>

    <h3 class="mt-8 font-bold text-lg text-forest pb-2 border-b border-primary/10">
        Item Perlengkapan
    </h3>

    <template x-for="(line, index) in lines" :key="index">
        <div class="mt-4 grid items-end gap-3 rounded-xl bg-secondary/25 p-4 sm:grid-cols-[1fr_120px_auto]">
            <label class="field">
                <span>Perlengkapan *</span>
                <select :name="'items[' + index + '][gear_id]'" x-model="line.gear_id" class="input" required>
                    <option value="">-- Pilih Perlengkapan --</option>
                    @foreach($gear as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name }} — Rp {{ number_format($item->rental_price, 0, ',', '.') }}/hari (Stok: {{ $item->stock }})
                        </option>
                    @endforeach
                </select>
            </label>

            <label class="field">
                <span>Jumlah *</span>
                <input :name="'items[' + index + '][qty]'" x-model="line.qty" type="number" min="1" class="input" required>
            </label>

            <button type="button" class="btn-danger" @click="lines.splice(index, 1)" x-show="lines.length > 1">
                Hapus
            </button>
        </div>
    </template>

    <button type="button" class="btn-secondary mt-4 text-xs font-bold" @click="lines.push({ gear_id: '', qty: 1 })">
        + Tambah Perlengkapan Lain
    </button>

    @if($errors->any())
        <div class="mt-5 p-4 rounded-xl bg-red-50 text-sm text-red-700 font-bold border border-red-200">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mt-8 border-t border-primary/10 pt-5 flex items-center justify-end gap-3">
        <a href="{{ route('gear.catalog') }}" class="btn-ghost">
            Batal
        </a>
        <button type="submit" class="btn-primary">
            Ajukan Penyewaan
        </button>
    </div>
</form>

@endsection
