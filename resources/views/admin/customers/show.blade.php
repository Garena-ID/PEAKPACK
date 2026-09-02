@extends('layouts.admin')

@section('content')

<div class="mb-8 flex flex-wrap items-end justify-between gap-4">

    <div>
        <p class="eyebrow">MASTER DATA / CUSTOMERS</p>

        <h2 class="text-3xl font-black text-forest">
            Detail Customer
        </h2>

        <p class="mt-1 text-sm text-primary/60">
            Informasi customer dan riwayat transaksi rental.
        </p>
    </div>

    <div class="flex gap-2">
        <a
            href="{{ route('admin.customers.edit', $customer) }}"
            class="btn-primary"
        >
            Edit
        </a>

        <a
            href="{{ route('admin.customers.index') }}"
            class="btn-ghost"
        >
            Kembali
        </a>
    </div>

</div>


{{-- Informasi Customer --}}
<div class="card mb-6 overflow-hidden">

    <div class="border-b border-primary/10 px-6 py-5">
        <h3 class="text-xl font-black text-primary">
            Informasi Customer
        </h3>

        <p class="mt-1 text-sm text-primary/60">
            Data akun customer PeakPack.
        </p>
    </div>

    <div class="grid gap-6 p-6 sm:grid-cols-2">

        <div>
            <p class="eyebrow">
                Nama Customer
            </p>

            <p class="mt-1 text-base font-bold text-primary">
                {{ $customer->name }}
            </p>
        </div>

        <div>
            <p class="eyebrow">
                Email
            </p>

            <p class="mt-1 text-base font-bold text-primary">
                {{ $customer->email }}
            </p>
        </div>

        <div>
            <p class="eyebrow">
                Terdaftar
            </p>

            <p class="mt-1 text-base font-bold text-primary">
                {{ $customer->created_at?->format('d M Y') ?? '-' }}
            </p>
        </div>

        <div>
            <p class="eyebrow">
                Role
            </p>

            <p class="mt-1">
                <span class="badge">
                    Customer
                </span>
            </p>
        </div>

    </div>

</div>


{{-- Riwayat Rental --}}
<div class="card overflow-hidden">

    <div class="border-b border-primary/10 px-6 py-5">

        <h3 class="text-xl font-black text-primary">
            Riwayat Rental
        </h3>

        <p class="mt-1 text-sm text-primary/60">
            Daftar transaksi rental customer ini.
        </p>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full min-w-[700px] text-left text-sm">

            <thead>

                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-primary/60">

                    <th class="px-6 py-4">
                        Kode Rental
                    </th>

                    <th class="px-6 py-4">
                        Tanggal Rental
                    </th>

                    <th class="px-6 py-4">
                        Jatuh Tempo
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                    <th class="px-6 py-4">
                        Total
                    </th>

                    <th class="px-6 py-4 text-right">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-primary/5">

                @forelse($customer->rentals->sortByDesc('created_at') as $rental)

                    <tr>

                        <td class="px-6 py-4">

                            <span class="font-bold text-primary">
                                {{ $rental->rental_code }}
                            </span>

                        </td>

                        <td class="px-6 py-4 text-primary/80">
                            {{ $rental->rental_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-primary/80">
                            {{ $rental->due_date?->format('d M Y') ?? '-' }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="badge">
                                {{ $rental->status }}
                            </span>

                        </td>

                        <td class="px-6 py-4 font-bold text-primary">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-right">

                            <a
                                href="{{ route('admin.rentals.show', $rental) }}"
                                class="btn-ghost text-xs"
                            >
                                Lihat
                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-6 py-10 text-center text-primary/50"
                        >
                            Belum ada riwayat rental.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection