<x-guest-layout>

<div class="mb-8">
    <p class="eyebrow">
        MULAI PETUALANGAN ANDA
    </p>

    <h1 class="text-3xl font-black">
        Buat Akun Anda
    </h1>

    <p class="mt-2 text-primary/65">
        Kami Menyediakan Solusi Untuk Petualangan Anda.
    </p>
</div>

<form
    method="POST"
    action="{{ route('register') }}"
    class="space-y-5"
>
    @csrf

    <label class="field">
        <span>Nama Lengkap</span>

        <input
            name="name"
            value="{{ old('name') }}"
            required
            autofocus
        >
    </label>

    <x-input-error :messages="$errors->get('name')" />

    <label class="field">
        <span>Alamat Email</span>

        <input
            name="email"
            type="email"
            value="{{ old('email') }}"
            required
        >
    </label>

    <x-input-error :messages="$errors->get('email')" />

    <label class="field">
        <span>Kata Sandi</span>

        <input
            name="password"
            type="password"
            required
        >
    </label>

    <x-input-error :messages="$errors->get('password')" />

    <label class="field">
        <span>Konfirmasi Kata Sandi</span>

        <input
            name="password_confirmation"
            type="password"
            required
        >
    </label>

    <button class="btn-primary w-full">
        Buat Akun
    </button>
</form>

<p class="mt-6 text-center text-sm">
    Sudah memiliki akun?

    <a
        class="link"
        href="{{ route('login') }}"
    >
        Masuk
    </a>
</p>

</x-guest-layout>
