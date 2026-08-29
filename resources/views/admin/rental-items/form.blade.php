@extends('layouts.admin')

@section('content')

<a class="link text-sm" href="{{ route('admin.rental-items.index') }}">
    ← Back
</a>

<h2 class="mt-2 text-3xl font-black">
    {{ $title }}
</h2>

<form
    method="POST"
    class="card mt-6 max-w-2xl space-y-5 p-6"
    action="{{ $item->exists
        ? route('admin.rental-items.update', $item)
        : route('admin.rental-items.store') }}"
>
    @csrf

@if($item->exists)
    @method('PUT')
@endif

<label class="field">
    <span>Rental</span>

    <select name="rental_id">
        @foreach($rentals as $r)
            <option
                value="{{ $r->id }}"
                @selected(old('rental_id', $item->rental_id) == $r->id)
            >
                {{ $r->rental_code }} — {{ $r->user->name }}
            </option>
        @endforeach
    </select>
</label>

<label class="field">
    <span>Gear</span>

    <select name="gear_id">
        @foreach($gear as $g)
            <option
                value="{{ $g->id }}"
                @selected(old('gear_id', $item->gear_id) == $g->id)
            >
                {{ $g->name }} ({{ $g->stock }} available)
            </option>
        @endforeach
    </select>
</label>

<label class="field">
    <span>Quantity</span>

    <input
        name="qty"
        type="number"
        min="1"
        value="{{ old('qty', $item->qty ?? 1) }}"
    >
</label>

@if($errors->any())
    <p class="text-sm text-red-700">
        {{ $errors->first() }}
    </p>
@endif

<button class="btn-primary">
    Save item
</button>

</form>

@endsection
