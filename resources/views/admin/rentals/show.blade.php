@extends('layouts.admin')

@section('content')

@include('rentals.details')

<div class="card mt-6 max-w-xl p-6">
    <h3 class="font-bold text-lg text-forest">
        Update Status Transaksi
    </h3>

    <form method="POST" action="{{ route('admin.rentals.update', $rental) }}" class="mt-4 space-y-4">
        @csrf
        @method('PUT')

        <label class="field">
            <span>Status Penyewaan</span>
            <select name="status" class="input">
                @foreach(['Pending', 'On Rent', 'Completed'] as $s)
                    <option value="{{ $s }}" @selected($rental->status === $s)>
                        {{ $s }}
                    </option>
                @endforeach
            </select>
        </label>

        @if($errors->has('status'))
            <p class="text-xs text-red-600 font-bold">{{ $errors->first('status') }}</p>
        @endif

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">
                Update Status
            </button>
        </div>
    </form>

    <div class="mt-6 pt-4 border-t border-primary/10">
        <form method="POST" action="{{ route('admin.rentals.destroy', $rental) }}" onsubmit="return confirm('Hapus transaksi penyewaan ini? Stok barang akan dikembalikan.');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn-danger text-xs">
                Hapus Transaksi (Kembalikan Stok)
            </button>
        </form>
    </div>
</div>

@endsection
