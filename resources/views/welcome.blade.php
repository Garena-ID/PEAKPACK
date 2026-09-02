<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cream text-primary antialiased">

    {{-- ========================= HEADER ========================= --}}
    <header class="border-b border-primary/10 bg-cream/95 backdrop-blur">
        <div
            class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4 lg:px-8"
        >
            {{-- Logo --}}
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

            {{-- Navigation --}}
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
            {{-- Hero Text --}}
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

                {{-- Hero Buttons --}}
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


            {{-- Hero Card --}}
            <div
                class="relative overflow-hidden rounded-3xl bg-primary p-8 text-cream shadow-xl shadow-primary/15 sm:p-10"
            >
                {{-- Decorative Circle --}}
                <div
                    class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-secondary/20"
                ></div>

                <div
                    class="absolute -bottom-20 -left-10 h-44 w-44 rounded-full border-[22px] border-secondary/20"
                ></div>

                <div class="relative">
                    <p class="text-sm font-bold tracking-[.18em] text-secondary">
                        PEAKPACK
                    </p>

                    <p class="mt-8 text-3xl font-black leading-tight">
                        Rencanakan. Siapkan. Jelajahi.
                    </p>

                    {{-- Feature Cards --}}
                    <div
                        class="mt-10 grid grid-cols-3 gap-3 text-center text-sm"
                    >
                        <div class="rounded-2xl bg-white/10 p-4">
                            <span class="block text-2xl">
                                ⛰️
                            </span>

                            Gunung
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <span class="block text-2xl">
                                ⚙️
                            </span>

                            Perlengkapan
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4">
                            <span class="block text-2xl">
                                📝
                            </span>

                            Sewa
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- ========================= ABOUT ========================= --}}
        <section class="border-y border-primary/10 bg-white/50">
            <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8">

                <div class="max-w-2xl">
                    <p class="eyebrow">
                        TENTANG KAMI
                    </p>

                    <h2 class="mt-3 text-3xl font-black">
                        Partner praktis untuk perjalanan ke alam.
                    </h2>

                    <p class="mt-4 leading-7 text-primary/70">
                        Kami membuat persiapan pendakian lebih sederhana,
                        supaya Anda dapat fokus menikmati perjalanan dengan
                        perlengkapan yang sesuai dan rencana yang matang.
                    </p>
                </div>


                {{-- About Cards --}}
                <div class="mt-10 grid gap-5 md:grid-cols-3">

                    <article class="card p-6">
                        <h3 class="text-lg font-black">
                            Rekomendasi gunung
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-primary/65">
                            Cari informasi tujuan untuk menentukan perjalanan
                            yang tepat.
                        </p>
                    </article>


                    <article class="card p-6">
                        <h3 class="text-lg font-black">
                            Katalog perlengkapan
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-primary/65">
                            Lihat pilihan peralatan yang dibutuhkan sebelum
                            berangkat.
                        </p>
                    </article>


                    <article class="card p-6">
                        <h3 class="text-lg font-black">
                            Penyewaan terkelola
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-primary/65">
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
            <div class="rounded-3xl bg-secondary p-8 sm:p-10">

                <p class="eyebrow">
                    KONTAK
                </p>

                <div class="mt-5 grid gap-8 md:grid-cols-2">

                    {{-- Contact Description --}}
                    <div>
                        <h2 class="text-3xl font-black">
                            Butuh bantuan persiapan?
                        </h2>

                        <p class="mt-3 max-w-xl leading-7 text-primary/75">
                            Hubungi tim PeakPack untuk pertanyaan seputar
                            perlengkapan dan penyewaan.
                        </p>
                    </div>


                    {{-- Contact Information --}}
                    <address class="not-italic text-primary/80">

                        <p class="font-bold text-primary">
                            PeakPack Outdoor
                        </p>

                        <p class="mt-2">
                            Jl. Rancaloa RT.03 RW.02 Kel. Cipamokolan,
                            Kec. Rancasari, Bandung
                        </p>

                        {{-- Email --}}
                        <p class="mt-2">
                            <a
                                class="link"
                                href="mailto:dwigunafrega88@gmail.com"
                            >
                                dwigunafrega88@gmail.com
                            </a>
                        </p>

                        {{-- WhatsApp --}}
                        <p class="mt-1">
                            <a
                                class="link"
                                href="https://wa.me/6285158228465?text=Halo%20PeakPack%2C%20saya%20ingin%20bertanya%20tentang%20penyewaan."
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                +62 851 5822 8465
                            </a>
                        </p>

                    </address>
                </div>


                {{-- Contact Buttons --}}
                <div class="mt-8 flex flex-wrap gap-3">

                    {{-- Email --}}
                    <a
                        href="mailto:dwigunafrega88@gmail.com"
                        class="btn-primary"
                    >
                        📧 Kirim Email
                    </a>

                    {{-- WhatsApp --}}
                    <a
                        href="https://wa.me/6285158228465?text=Halo%20PeakPack%2C%20saya%20ingin%20bertanya%20tentang%20penyewaan."
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