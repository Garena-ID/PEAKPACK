@extends('layouts.admin')

@section('content')

<div class="mb-7">
    <p class="eyebrow">DATA / CUSTOMERS</p>

    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <h2 class="text-3xl font-black">
                Edit Customer
            </h2>

            <p class="mt-1 text-sm opacity-70">
                Perbarui informasi customer PeakPack.
            </p>
        </div>

        <a
            href="{{ route('admin.customers.show', $customer) }}"
            class="btn-secondary"
        >
            Kembali
        </a>
    </div>
</div>


{{-- Validation Errors --}}
@if ($errors->any())
    <div class="card mb-6 border border-red-300 p-5">
        <p class="mb-2 font-bold text-red-700">
            Terdapat kesalahan:
        </p>

        <ul class="list-inside list-disc text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Edit Form --}}
<div class="card max-w-3xl p-6">

    <form
        method="POST"
        action="{{ route('admin.customers.update', $customer) }}"
        class="space-y-5"
    >
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label
                for="name"
                class="mb-2 block text-sm font-bold"
            >
                Nama
            </label>

            <input
                id="name"
                type="text"
                name="name"
                class="input w-full"
                value="{{ old('name', $customer->name) }}"
                required
                autofocus
            >
        </div>


        {{-- Email --}}
        <div>
            <label
                for="email"
                class="mb-2 block text-sm font-bold"
            >
                Email
            </label>

            <input
                id="email"
                type="email"
                name="email"
                class="input w-full"
                value="{{ old('email', $customer->email) }}"
                required
            >
        </div>


        {{-- Password Notice --}}
        <div class="rounded-xl border border-secondary/50 bg-secondary/20 p-4 text-sm">
            <p class="font-bold">
                Password customer
            </p>

            <p class="mt-1 opacity-70">
                Password tidak dapat dilihat atau diubah melalui halaman admin.
            </p>
        </div>


        {{-- Actions --}}
        <div class="flex flex-col gap-3 pt-2 sm:flex-row">

            <button
                type="submit"
                class="btn-primary"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.customers.show', $customer) }}"
                class="btn-secondary text-center"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection