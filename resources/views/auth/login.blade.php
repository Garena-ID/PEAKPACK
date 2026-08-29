<x-guest-layout>

<div class="mb-8">
    <p class="eyebrow">
        SELAMAT DATANG 
    </p>

    <h1 class="text-3xl font-black">
        Masuk PeakPack
    </h1>

    <p class="mt-2 text-primary/65">
       Ayo Mulai Petualangan Anda
    </p>
</div>

<x-auth-session-status
    class="mb-4"
    :status="session('status')"
/>

<form
    method="POST"
    action="{{ route('login') }}"
    class="space-y-5"
>
    @csrf

    <label class="field">
        <span>Alamat Email</span>

        <input
            name="email"
            type="email"
            value="{{ old('email') }}"
            required
            autofocus
            autocomplete="username"
        >
    </label>

    <x-input-error :messages="$errors->get('email')" />

    <label class="field">
        <span>Kata Sandi</span>

        <input
            name="password"
            type="password"
            required
            autocomplete="current-password"
        >
    </label>

    <x-input-error :messages="$errors->get('password')" />

    <div class="flex items-center justify-between text-sm">
        <label class="flex gap-2">
            <input
                type="checkbox"
                name="remember"
            >

            Ingat saya
        </label>

        <a
            class="link"
            href="{{ route('password.request') }}"
        >
            Lupa kata sandi?
        </a>
    </div>

    <button class="btn-primary w-full">
        Masuk

        <span class="loading hidden">
            …
        </span>
    </button>
</form>

<p class="mt-6 text-center text-sm">
    Belum punya akun PeakPack?

    <a
        class="link"
        href="{{ route('register') }}"
    >
        Buat akun
    </a>
</p>

</x-guest-layout>
