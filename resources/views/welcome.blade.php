<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="description"
        content="PeakPack membantu petualang menyiapkan perlengkapan dan merencanakan pendakian."
    >

    <title>PeakPack</title>

    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/peakpack/favicon.svg') }}"
    >

    <style>
        html {
            scroll-behavior: smooth;
        }

        section[id] {
            scroll-margin-top: 80px;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream text-primary antialiased">

    {{-- ========================= HEADER ========================= --}}
    <header class="border-b border-primary/10 bg-cream/95 backdrop-blur">

        <div
            class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4 lg:px-8"
        >

            {{-- LOGO --}}
            <a
                href="{{ route('welcome') }}"
                class="flex items-center gap-3 font-black tracking-tight"
            >

                <span
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-lg text-cream"
                >
                    ▲
                </span>

                <span class="text-xl">
                    PEAKPACK
                </span>

            </a>


            {{-- NAVIGATION --}}
            @auth

                <a
                    href="{{ auth()->user()->role === 'admin'
                        ? route('admin.dashboard')
                        : route('dashboard') }}"
                    class="btn-primary"
                >
                    Ke Dashboard
                </a>

            @else

                <a
                    href="{{ route('login') }}"
                    class="btn-primary"
                >
                    Masuk
                </a>

            @endauth

        </div>

    </header>


    {{-- ========================= MAIN ========================= --}}
    <main>

        {{-- ========================= HERO ========================= --}}
        <section
            class="mx-auto grid max-w-6xl gap-12 px-6 py-20 lg:grid-cols-[1.15fr_.85fr] lg:items-center lg:px-8 lg:py-28"
        >

            {{-- HERO TEXT --}}
            <div>

                <p class="eyebrow">
                    SIAP MENDAKI DENGAN LEBIH TENANG
                </p>


                <h1
                    class="mt-4 max-w-3xl text-4xl font-black leading-tight tracking-tight sm:text-5xl"
                >
                    Semua persiapan pendakian, dalam satu tempat.
                </h1>


                <p
                    class="mt-6 max-w-2xl text-lg leading-8 text-primary/70"
                >
                    PeakPack membantu Anda menemukan rekomendasi gunung,
                    melihat perlengkapan yang tersedia, dan mengelola
                    penyewaan sebelum perjalanan dimulai.
                </p>


                {{-- HERO BUTTON --}}
                <div class="mt-8 flex flex-wrap gap-3">

                    @auth

                        <a
                            href="{{ auth()->user()->role === 'admin'
                                ? route('admin.dashboard')
                                : route('dashboard') }}"
                            class="btn-primary"
                        >
                            Buka Dashboard
                        </a>

                    @else

                        <a
                            href="{{ route('login') }}"
                            class="btn-primary"
                        >
                            Masuk untuk memulai
                        </a>


                        @if (Route::has('register'))

                            <a
                                href="{{ route('register') }}"
                                class="btn-secondary"
                            >
                                Buat akun
                            </a>

                        @endif

                    @endauth

                </div>

            </div>


            {{-- HERO CARD --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-primary p-8 text-cream shadow-xl shadow-primary/15 sm:p-10"
            >

                {{-- DECORATIVE CIRCLE --}}
                <div
                    class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-secondary/20"
                ></div>


                <div
                    class="absolute -bottom-20 -left-10 h-44 w-44 rounded-full border-[22px] border-secondary/20"
                ></div>


                <div class="relative">

                    <p
                        class="text-sm font-bold tracking-[.18em] text-secondary"
                    >
                        PEAKPACK
                    </p>


                    <p class="mt-8 text-3xl font-black leading-tight">
                        Rencanakan. Siapkan. Jelajahi.
                    </p>


                    {{-- FEATURE CARDS --}}
                    {{-- TETAP SAMPING-SAMPINGAN --}}
                    <div
                        class="mt-10 grid grid-cols-2 gap-3 text-center text-sm"
                    >

                        {{-- GUNUNG --}}
                        <a
                            href="#gunung"
                            class="rounded-2xl bg-white/10 p-4 transition hover:bg-white/20"
                        >

                            <span class="block text-2xl">
                                ⛰️
                            </span>

                            <span class="mt-2 block font-bold">
                                Gunung
                            </span>

                        </a>


                        {{-- PERLENGKAPAN --}}
                        <a
                            href="#perlengkapan"
                            class="rounded-2xl bg-white/10 p-4 transition hover:bg-white/20"
                        >

                            <span class="block text-2xl">
                                ⚙️
                            </span>

                            <span class="mt-2 block font-bold">
                                Perlengkapan
                            </span>

                        </a>

                    </div>

                </div>

            </div>

        </section>


        {{-- ========================= GUNUNG ========================= --}}
        <section
            id="gunung"
            class="border-y border-primary/10 bg-white/50"
        >

            <div
                class="mx-auto max-w-6xl px-6 py-16 lg:px-8"
            >

                <p class="eyebrow">
                    DESTINASI
                </p>


                <h2 class="mt-3 text-3xl font-black text-forest">
                    Gunung Pilihan
                </h2>


                <p class="mt-3 max-w-2xl text-primary/65">
                    Temukan berbagai destinasi pendakian yang tersedia
                    di PeakPack.
                </p>


                {{-- CARD GUNUNG --}}
                <div
                    class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3"
                >

                    @forelse($mountains as $mountain)

                        <article class="card overflow-hidden">

                            {{-- FOTO --}}
                            @if($mountain->image)

                                <img
                                    src="{{ asset('storage/' . $mountain->image) }}"
                                    alt="{{ $mountain->name }}"
                                    class="h-12 w-full object-cover"
                                >

                            @else

                                <div
                                    class="flex h-32 w-full items-center justify-center bg-primary/5 text-sm font-semibold text-primary/40"
                                >
                                    Belum ada foto
                                </div>

                            @endif


                            {{-- INFO --}}
                            <div class="p-5">

                                <span >
                                    
                                </span>


                                <h3
                                    class="mt-3 text-xl font-black text-forest"
                                >
                                    {{ $mountain->name }}
                                </h3>


                                <p
                                    class="mt-1 text-sm text-primary/60"
                                >
                                    {{ $mountain->location }},
                                    {{ $mountain->province }}
                                </p>

                            </div>

                        </article>

                    @empty

                        <div class="md:col-span-2 xl:col-span-3">

                            @include('components.empty', [
                                'message' => 'Belum ada data gunung.'
                            ])

                        </div>

                    @endforelse

                </div>

            </div>

        </section>


        {{-- ========================= PERLENGKAPAN ========================= --}}
        <section
            id="perlengkapan"
            class="border-b border-primary/10"
        >

            <div
                class="mx-auto max-w-6xl px-6 py-16 lg:px-8"
            >

                <p class="eyebrow">
                    PERLENGKAPAN
                </p>


                <h2 class="mt-3 text-3xl font-black text-forest">
                    Perlengkapan Pendakian
                </h2>


                <p class="mt-3 max-w-2xl text-primary/65">
                    Lihat perlengkapan yang tersedia untuk membantu
                    mempersiapkan perjalanan Anda.
                </p>


                {{-- CARD GEAR --}}
                <div
                    class="mt-10 grid gap-5 md:grid-cols-2 xl:grid-cols-3"
                >

                    @forelse($gears as $gear)

                        <article class="card p-6">

                            <span
                                class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary"
                            >
                                {{ $gear->category->name ?? 'Perlengkapan' }}
                            </span>


                            <h4
                                class="mt-4 text-xl font-black text-forest"
                            >
                                {{ $gear->name }}
                            </h4>


                           
                        </article>

                    @empty

                        <div class="md:col-span-2 xl:col-span-3">

                            @include('components.empty', [
                                'message' => 'Belum ada data perlengkapan.'
                            ])

                        </div>

                    @endforelse

                </div>

            </div>

        </section>


        {{-- ========================= ABOUT ========================= --}}
        <section
            class="border-b border-primary/10 bg-white/50"
        >

            <div
                class="mx-auto max-w-6xl px-6 py-16 lg:px-8"
            >

                <div class="max-w-2xl">

                    <p class="eyebrow">
                        TENTANG KAMI
                    </p>


                    <h2 class="mt-3 text-3xl font-black">
                        Partner praktis untuk perjalanan ke alam.
                    </h2>


                    <p
                        class="mt-4 leading-7 text-primary/70"
                    >
                        Kami membuat persiapan pendakian lebih sederhana,
                        supaya Anda dapat fokus menikmati perjalanan dengan
                        perlengkapan yang sesuai dan rencana yang matang.
                    </p>

                </div>


                {{-- ABOUT CARDS --}}
                <div class="mt-10 grid gap-5 md:grid-cols-3">

                    <article class="card p-6">

                        <h3 class="text-lg font-black">
                            Rekomendasi gunung
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-primary/65"
                        >
                            Cari informasi tujuan untuk menentukan perjalanan
                            yang tepat.
                        </p>

                    </article>


                    <article class="card p-6">

                        <h3 class="text-lg font-black">
                            Katalog perlengkapan
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-primary/65"
                        >
                            Lihat pilihan peralatan yang dibutuhkan sebelum
                            berangkat.
                        </p>

                    </article>


                    <article class="card p-6">

                        <h3 class="text-lg font-black">
                            Penyewaan terkelola
                        </h3>

                        <p
                            class="mt-2 text-sm leading-6 text-primary/65"
                        >
                            Pantau kebutuhan dan status penyewaan Anda dengan
                            mudah.
                        </p>

                    </article>

                </div>

            </div>

        </section>


        {{-- ========================= CONTACT ========================= --}}
        <section
            id="kontak"
            class="mx-auto max-w-6xl px-6 py-16 lg:px-8"
        >

            <div
                class="rounded-3xl bg-secondary p-8 sm:p-10"
            >

                <p class="eyebrow">
                    KONTAK
                </p>


                <div class="mt-5 grid gap-8 md:grid-cols-2">

                    {{-- CONTACT DESCRIPTION --}}
                    <div>

                        <h2 class="text-3xl font-black">
                            Butuh bantuan persiapan?
                        </h2>


                        <p
                            class="mt-3 max-w-xl leading-7 text-primary/75"
                        >
                            Hubungi tim PeakPack untuk pertanyaan seputar
                            perlengkapan dan penyewaan.
                        </p>

                    </div>


                    {{-- CONTACT INFORMATION --}}
                    <address
                        class="not-italic text-primary/80"
                    >

                        <p class="font-bold text-primary">
                            PeakPack Outdoor
                        </p>


                        <p class="mt-2">
                            Jl. Rancaloa RT.03 RW.02 Kel. Cipamokolan,
                            Kec. Rancasari, Bandung
                        </p>


                        <p class="mt-2">

                            <a
                                class="link"
                                href="mailto:dwigunafrega88@gmail.com"
                            >
                                dwigunafrega88@gmail.com
                            </a>

                        </p>


                        <p class="mt-1">

                            <a
                                class="link"
                                href="https://wa.me/6285158228465?text=Halo%20PeakPack%2C%20saya%20ingin%20bertanya%20tentang%20penyewaan"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                +62 851 5822 8465
                            </a>

                        </p>

                    </address>

                </div>


                {{-- CONTACT BUTTONS --}}
                <div class="mt-8 flex flex-wrap gap-3">

                    <a
                        href="mailto:dwigunafrega88@gmail.com"
                        class="btn-primary"
                    >
                        📧 Kirim Email
                    </a>


                    <a
                        href="https://wa.me/6285158228465?text=Halo%20PeakPack%2C%20saya%20ingin%20bertanya%20tentang%20penyewaan"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-primary"
                    >
                        💬 Chat WhatsApp
                    </a>

                </div>

            </div>

        </section>

    </main>


    {{-- ========================= FOOTER ========================= --}}
    <footer
        class="border-t border-primary/10 px-6 py-6 text-center text-sm text-primary/60"
    >

        &copy; {{ date('Y') }} PeakPack By Frega Teguh Dwiguna.
        Rekan Petualangan Anda.

    </footer>

</body>
</html>