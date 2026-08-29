@extends('layouts.admin')

@section('content')

<div class="mb-7 flex flex-wrap items-end justify-between gap-4">
    <div>
        <p class="eyebrow">MANAGE</p>

    <h2 class="text-3xl font-black">
        {{ $title }}
    </h2>
</div>

<a
    class="btn-primary"
    href="{{ route('admin.' . $resource . '.create') }}"
>
    + Add new
</a>

</div>

<form class="card mb-6 grid gap-3 p-4 sm:grid-cols-3">
    <input
        class="input"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search {{ strtolower($title) }}"
    >

<select class="input" name="difficulty">
    <option value="">
        All difficulties
    </option>

    @foreach(['Easy', 'Medium', 'Hard'] as $level)
        <option
            @selected(request('difficulty') === $level)
        >
            {{ $level }}
        </option>
    @endforeach
</select>

<button class="btn-secondary">
    Filter
</button>

</form>

<div class="card overflow-x-auto">
    <table class="w-full min-w-[650px] text-left text-sm">

    <thead>
        <tr class="border-b border-primary/10 text-primary/60">

            @if($resource === 'mountains')
                <th>Name</th>
                <th>Province</th>
                <th>Elevation</th>
                <th>Difficulty</th>

            @elseif($resource === 'gear-categories')
                <th>Name</th>
                <th>Items</th>

            @elseif($resource === 'gear')
                <th>Gear</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Daily rate</th>

            @elseif($resource === 'recommendations')
                <th>Mountain</th>
                <th>Recommended gear</th>
            @endif

            <th class="text-right">
                Actions
            </th>

        </tr>
    </thead>

    <tbody>

        @forelse($items as $item)

            <tr class="border-b border-primary/5 last:border-0">

                @if($resource === 'mountains')

                    <td class="font-bold">
                        {{ $item->name }}

                        <small class="block font-normal text-primary/60">
                            {{ $item->location }}
                        </small>
                    </td>

                    <td>
                        {{ $item->province }}
                    </td>

                    <td>
                        {{ number_format($item->elevation) }} m
                    </td>

                    <td>
                        <span class="badge">
                            {{ $item->difficulty }}
                        </span>
                    </td>

                @elseif($resource === 'gear-categories')

                    <td class="font-bold">
                        {{ $item->name }}
                    </td>

                    <td>
                        {{ $item->gears_count }}
                    </td>

                @elseif($resource === 'gear')

                    <td class="font-bold">
                        {{ $item->name }}
                    </td>

                    <td>
                        {{ $item->category->name }}
                    </td>

                    <td>
                        {{ $item->stock }}
                    </td>

                    <td>
                        Rp {{ number_format($item->rental_price, 0, ',', '.') }}
                    </td>

                @elseif($resource === 'recommendations')

                    <td class="font-bold">
                        {{ $item->mountain->name }}
                    </td>

                    <td>
                        {{ $item->gear->name }}
                    </td>

                @endif

                <td>
                    <div class="flex justify-end gap-2">

                        <a
                            class="btn-ghost"
                            href="{{ route('admin.' . $resource . '.edit', $item) }}"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.' . $resource . '.destroy', $item) }}"
                            data-confirm="Delete this item?"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="btn-danger">
                                Delete
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6">
                    @include('components.empty', [
                        'message' => 'No ' . strtolower($title) . ' yet.'
                    ])
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</div>

<div class="mt-5">
    {{ $items->links() }}
</div>

@endsection
