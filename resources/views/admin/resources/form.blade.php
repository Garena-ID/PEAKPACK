@extends('layouts.admin')

@section('content')

<div class="mb-7">
    <a
        class="link text-sm"
        href="{{ route('admin.' . $resource . '.index') }}"
    >
        ← Back to list
    </a>

<h2 class="mt-2 text-3xl font-black">
    {{ $title }}
</h2>

</div>

<form
    method="POST"
    class="card max-w-3xl space-y-5 p-6"
    action="{{ $item->exists
        ? route('admin.' . $resource . '.update', $item)
        : route('admin.' . $resource . '.store') }}"
>
    @csrf

@if($item->exists)
    @method('PUT')
@endif

@if($resource === 'mountains')

    <div class="grid gap-5 sm:grid-cols-2">

        <label class="field">
            <span>Name</span>
            <input
                name="name"
                value="{{ old('name', $item->name) }}"
                required
            >
        </label>

        <label class="field">
            <span>Location</span>
            <input
                name="location"
                value="{{ old('location', $item->location) }}"
                required
            >
        </label>

        <label class="field">
            <span>Province</span>
            <input
                name="province"
                value="{{ old('province', $item->province) }}"
                required
            >
        </label>

        <label class="field">
            <span>Elevation (m)</span>
            <input
                name="elevation"
                type="number"
                value="{{ old('elevation', $item->elevation) }}"
                required
            >
        </label>

        <label class="field">
            <span>Difficulty</span>

            <select name="difficulty">
                @foreach(['Easy', 'Medium', 'Hard'] as $d)
                    <option
                        value="{{ $d }}"
                        @selected(old('difficulty', $item->difficulty) === $d)
                    >
                        {{ $d }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="field">
            <span>Estimated duration</span>
            <input
                name="estimated_duration"
                value="{{ old('estimated_duration', $item->estimated_duration) }}"
                required
            >
        </label>

        <label class="field">
            <span>Latitude</span>
            <input
                name="latitude"
                type="number"
                step="any"
                value="{{ old('latitude', $item->latitude) }}"
            >
        </label>

        <label class="field">
            <span>Longitude</span>
            <input
                name="longitude"
                type="number"
                step="any"
                value="{{ old('longitude', $item->longitude) }}"
            >
        </label>

    </div>

    <label class="field">
        <span>Description</span>

        <textarea
            name="description"
            rows="4"
        >{{ old('description', $item->description) }}</textarea>
    </label>

@elseif($resource === 'gear-categories')

    <label class="field">
        <span>Category name</span>

        <input
            name="name"
            value="{{ old('name', $item->name) }}"
            required
        >
    </label>

@elseif($resource === 'gear')

    <div class="grid gap-5 sm:grid-cols-2">

        <label class="field">
            <span>Name</span>

            <input
                name="name"
                value="{{ old('name', $item->name) }}"
                required
            >
        </label>

        <label class="field">
            <span>Category</span>

            <select name="category_id">
                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id', $item->category_id) == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="field">
            <span>Available stock</span>

            <input
                name="stock"
                type="number"
                min="0"
                value="{{ old('stock', $item->stock ?? 0) }}"
                required
            >
        </label>

        <label class="field">
            <span>Daily rate (Rp)</span>

            <input
                name="rental_price"
                type="number"
                min="0"
                value="{{ old('rental_price', $item->rental_price) }}"
                required
            >
        </label>

    </div>

    <label class="field">
        <span>Description</span>

        <textarea
            name="description"
            rows="4"
        >{{ old('description', $item->description) }}</textarea>
    </label>

@elseif($resource === 'recommendations')

    <div class="grid gap-5 sm:grid-cols-2">

        <label class="field">
            <span>Mountain</span>

            <select name="mountain_id">
                @foreach($mountains as $mountain)
                    <option
                        value="{{ $mountain->id }}"
                        @selected(old('mountain_id', $item->mountain_id) == $mountain->id)
                    >
                        {{ $mountain->name }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="field">
            <span>Gear</span>

            <select name="gear_id">
                @foreach($gear as $gearItem)
                    <option
                        value="{{ $gearItem->id }}"
                        @selected(old('gear_id', $item->gear_id) == $gearItem->id)
                    >
                        {{ $gearItem->name }}
                    </option>
                @endforeach
            </select>
        </label>

    </div>

@endif

@if($errors->any())
    <div class="rounded-lg bg-red-50 p-3 text-sm text-red-700">
        {{ $errors->first() }}
    </div>
@endif

<button class="btn-primary">
    Save changes
</button>

</form>

@endsection
