@extends('layouts.admin')

@section('content')

<div class="mb-7">
    <p class="eyebrow">DATA</p>

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-3xl font-black">
                Customers
            </h2>

            <p class="mt-1 text-sm opacity-70">
                Kelola data pelanggan PeakPack.
            </p>
        </div>
    </div>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.customers.index') }}" class="card mb-6 flex flex-col gap-3 p-4 sm:flex-row">

    <input
        type="text"
        name="search"
        class="input flex-1"
        placeholder="Cari nama atau email customer..."
        value="{{ request('search') }}"
    >

    <button type="submit" class="btn-secondary">
        Cari
    </button>

    @if(request('search'))
        <a
            href="{{ route('admin.customers.index') }}"
            class="btn-secondary text-center"
        >
            Reset
        </a>
    @endif

</form>

{{-- Customer Table --}}
<div class="card overflow-x-auto">

    <table class="w-full min-w-[700px] text-left text-sm">

        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($customers as $customer)

                <tr>

                    <td class="font-bold">
                        {{ $customer->name }}
                    </td>

                    <td>
                        {{ $customer->email }}
                    </td>

                    

                    <td>
                        {{ $customer->created_at?->format('d M Y') ?? '-' }}
                    </td>

                    <td>
                        <div class="flex gap-3">

                            <a
                                href="{{ route('admin.customers.show', $customer) }}"
                                class="link"
                            >
                                Lihat
                            </a>

                            <!-- <a
                                href="{{ route('admin.customers.edit', $customer) }}"
                                class="link"
                            >
                                Edit
                            </a> -->

                            <form
                                method="POST"
                                action="{{ route('admin.customers.destroy', $customer) }}"
                                onsubmit="return confirm('Yakin ingin menghapus customer ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="link"
                                >
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="py-8 text-center">

                        @include('components.empty', [
                            'message' => request('search')
                                ? 'Customer tidak ditemukan.'
                                : 'Belum ada customer.'
                        ])

                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- Pagination --}}
@if($customers->hasPages())
    <div class="mt-5">
        {{ $customers->links() }}
    </div>
@endif

@endsection