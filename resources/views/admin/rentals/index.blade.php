@extends('layouts.admin')

@section('content')

<div class="mb-7">
    <p class="eyebrow">OPERATIONS</p>

<h2 class="text-3xl font-black">
    Rental orders
</h2>

</div>

<form class="card mb-6 flex gap-3 p-4">
    <input
        class="input"
        name="search"
        placeholder="Rental code"
        value="{{ request('search') }}"
    >

<select class="input" name="status">
    <option value="">
        All statuses
    </option>

    @foreach(['Pending', 'On Rent', 'Completed'] as $s)
        <option
            @selected(request('status') === $s)
        >
            {{ $s }}
        </option>
    @endforeach
</select>

<button class="btn-secondary">
    Filter
</button>

</form>

<div class="card overflow-x-auto">
    <table class="w-full min-w-[600px] text-left text-sm">
        <thead>
            <tr>
                <th>Code</th>
                <th>Customer</th>
                <th>Dates</th>
                <th>Status</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>

    <tbody>
        @forelse($items as $rental)
            <tr>
                <td class="font-bold">
                    {{ $rental->rental_code }}
                </td>

                <td>
                    {{ $rental->user->name }}
                </td>

                <td>
                    {{ $rental->rental_date->format('d M') }}
                    –
                    {{ $rental->due_date->format('d M Y') }}
                </td>

                <td>
                    <span class="badge">
                        {{ $rental->status }}
                    </span>
                </td>

                <td>
                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                </td>

                <td>
                    <a
                        class="link"
                        href="{{ route('admin.rentals.show', $rental) }}"
                    >
                        View
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">
                    @include('components.empty', [
                        'message' => 'No rental orders found.'
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
