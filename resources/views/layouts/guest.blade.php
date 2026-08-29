<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PeakPack</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/peakpack/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sand">
<main class="grid min-h-screen lg:grid-cols-2">
    <!-- Sisi kiri -->
    <section class="hidden bg-primary p-16 text-cream lg:flex lg:flex-col lg:justify-between">
        <!-- Logo diperbesar menggunakan text-5xl -->
        <a href="/" class="text-5xl font-black">
            ▲ PeakPack
        </a>

        <div>
            <p class="mb-4 text-secondary uppercase font-bold tracking-widest text-xs">
                SIAPKAN PERJALANAN, NIKMATI PETUALANGAN
            </p>

            <h1 class="max-w-lg text-5xl font-black leading-tight">
                Petualangan Besar
                Dimulai dari 
                Persiapan
            </h1>

            <p class="mt-5 max-w-md text-cream/75">
               Temukan gunung pilihan, siapkan perlengkapan, dan wujudkan perjalananmu dengan lebih percaya diri
            </p>
        </div>

        <p class="text-sm text-cream/60">
            Teman perjalananmu menuju puncak
        </p>
    </section>

    <!-- Sisi kanan -->
    <section class="flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            <!-- Logo versi mobile juga diperbesar ke text-3xl -->
            <a href="/" class="mb-10 block text-3xl font-black text-primary lg:hidden">
                ▲ PeakPack
            </a>

            {{ $slot }}
        </div>
    </section>
</main>
</body>
</html>