@extends('layouts.admin')

@section('content')

<h2 class="text-3xl font-black">
    Update {{ $rental->rental_code }}
</h2>

<p class="mt-2 text-primary/60">
    Use the rental detail screen to change status.
</p>

<a
href="{{ route('admin.rentals.show', $rental) }}"
class="btn-primary mt-5"

>

Open rental

</a>

@endsection
