@extends('layouts.admin')

@section('content')

<div class="mb-7 flex justify-between">
    <div>
        <p class="eyebrow">RENTAL ITEMS</p>

    <h2 class="text-3xl font-black">
        Equipment allocations
    </h2>
</div>

<a
    class="btn-primary"
    href="{{ route('admin.rental-items.create') }}"
>
    + Add item
</a>

</div>

<form class="card mb-6 flex gap-3 p-4">
    <input
        class="input"
        name="search"
        value="{{ request('search') }}"
        placeholder="Rental code or gear"
    >

<button class="btn-secondary">
    Search
</button>

</form>

<div class="card overflow-x-auto">
    <table class="w-full min-w-[650px] text-left text-sm">
        <thead>
            <tr>
                <th>Rental</th>
                <th>Gear</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>

    <tbody>
        @forelse($items as $item)
            <tr>
                <td>
                    <b>{{ $item->rental->rental_code }}</b>

                    <small class="block">
                        {{ $item->rental->user->name }}
                    </small>
                </td>

                <td>
                    {{ $item->gear->name }}
                </td>

                <td>
                    {{ $item->qty }}
                </td>

                <td>
                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                </td>

                <td>
                    <div class="flex gap-2">
                        <a
                            class="btn-ghost"
                            href="{{ route('admin.rental-items.edit', $item) }}"
                        >
                            Edit
                        </a>

                        <form
                            method="POST"
                            action="{{ route('admin.rental-items.destroy', $item) }}"
                            data-confirm="Remove this rental item and restore its stock?"
                        >
                            @csrf
                            @method('DELETE')

                            <button class="btn-danger">
                                Remove
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    @include('components.empty', [
                        'message' => 'No rental items found.'
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
