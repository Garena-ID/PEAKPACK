<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PeakPack membantu petualang menyiapkan perlengkapan dan merencanakan pendakian.">

    <title>PeakPack - Rental Perlengkapan & Panduan Pendakian</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/peakpack/favicon.svg') }}">

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

<body class="bg-cream text-primary antialiased selection:bg-secondary selection:text-primary" x-data="{ mobileMenu: false, showTopBtn: false }" @scroll.window="showTopBtn = (window.pageYOffset > 350)">

    {{-- ========================= HEADER ========================= --}}
    <header class="sticky top-0 z-40 border-b border-primary/10 bg-cream/90 backdrop-blur transition-all">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4 lg:px-8">

            {{-- LOGO --}}
            <a href="{{ route('welcome') }}" class="group flex items-center gap-3 font-black tracking-tight">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-lg text-cream shadow-sm transition-transform duration-300 group-hover:scale-105">
                    ▲
                </span>
                <span class="text-xl tracking-wider">
                    PEAKPACK
                </span>
            </a>

            {{-- DESKTOP NAVIGATION LINKS --}}
            <nav class="hidden items-center gap-8 text-sm font-bold md:flex">
                <a href="#gunung" class="transition-colors hover:text-primary/70">Destinasi</a>
                <a href="#perlengkapan" class="transition-colors hover:text-primary/70">Perlengkapan</a>
                <a href="#tentang" class="transition-colors hover:text-primary/70">Tentang Kami</a>
                <a href="#kontak" class="transition-colors hover:text-primary/70">Kontak</a>
            </nav>

            {{-- AUTH BUTTONS & MOBILE TOGGLE --}}
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-primary">
                        Ke Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary hidden sm:inline-flex">
                            Daftar
                        </a>
                    @endif
                @endauth

                {{-- MOBILE MENU BUTTON --}}
                <button
                    type="button"
                    @click="mobileMenu = !mobileMenu"
                    class="inline-flex items-center justify-center rounded-xl border border-primary/15 p-2 text-primary hover:bg-secondary/40 focus:outline-none md:hidden"
                    aria-label="Toggle navigation"
                >
                    <svg x-show="!mobileMenu" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenu" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- MOBILE NAVIGATION DROPDOWN --}}
        <div
            x-show="mobileMenu"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="border-b border-primary/10 bg-cream px-6 py-4 shadow-lg md:hidden"
        >
            <nav class="flex flex-col space-y-3 text-base font-bold">
                <a @click="mobileMenu = false" href="#gunung" class="rounded-lg px-3 py-2 transition hover:bg-secondary/40">Destinasi Gunung</a>
                <a @click="mobileMenu = false" href="#perlengkapan" class="rounded-lg px-3 py-2 transition hover:bg-secondary/40">Perlengkapan Pendakian</a>
                <a @click="mobileMenu = false" href="#tentang" class="rounded-lg px-3 py-2 transition hover:bg-secondary/40">Tentang Kami</a>
                <a @click="mobileMenu = false" href="#kontak" class="rounded-lg px-3 py-2 transition hover:bg-secondary/40">Kontak</a>
                @guest
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary mt-2 w-full text-center">Buat Akun Baru</a>
                    @endif
                @endguest
            </nav>
        </div>
    </header>

    {{-- ========================= MAIN ========================= --}}
    <main>

        {{-- ========================= HERO ========================= --}}
        <section class="mx-auto grid max-w-6xl gap-12 px-6 py-16 lg:grid-cols-[1.15fr_.85fr] lg:items-center lg:px-8 lg:py-24">

            {{-- HERO TEXT --}}
            <div>
                <p class="eyebrow">
                    SIAP MENDAKI DENGAN LEBIH TENANG
                </p>

                <h1 class="mt-4 max-w-3xl text-4xl font-black leading-tight tracking-tight sm:text-5xl">
                    Semua persiapan pendakian, dalam satu tempat.
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-primary/70">
                    PeakPack membantu Anda menemukan rekomendasi gunung, melihat perlengkapan yang tersedia, dan mengelola penyewaan sebelum perjalanan dimulai.
                </p>

                {{-- HERO BUTTONS --}}
                <div class="mt-8 flex flex-wrap items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-primary shadow-sm hover:shadow transition-all">
                            Buka Dashboard
                        </a>
                        <a href="#gunung" class="btn-secondary">
                            Jelajahi Destinasi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary shadow-sm hover:shadow transition-all">
                            Masuk untuk Memulai
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-secondary">
                                Buat Akun
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- HERO CARD --}}
            <div class="relative overflow-hidden rounded-3xl bg-primary p-8 text-cream shadow-xl shadow-primary/15 sm:p-10 transition-transform duration-300 hover:shadow-2xl">
                {{-- DECORATIVE CIRCLES --}}
                <div class="pointer-events-none absolute -right-12 -top-12 h-40 w-40 rounded-full bg-secondary/20"></div>
                <div class="pointer-events-none absolute -bottom-20 -left-10 h-44 w-44 rounded-full border-[22px] border-secondary/20"></div>

                <div class="relative">
                    <p class="text-sm font-bold tracking-[.18em] text-secondary">
                        PEAKPACK
                    </p>

                    <p class="mt-6 text-3xl font-black leading-tight">
                        Rencanakan. Siapkan. Jelajahi.
                    </p>

                    <p class="mt-3 text-sm text-cream/80">
                        Solusi terpadu penyewaan alat outdoor & info jalur pendakian terpercaya.
                    </p>

                    {{-- FEATURE CARDS (SAMPING-SAMPINGAN) --}}
                    <div class="mt-8 grid grid-cols-2 gap-3 text-center text-sm">
                        {{-- GUNUNG --}}
                        <a href="#gunung" class="group rounded-2xl bg-white/10 p-4 transition-all duration-300 hover:bg-white/20 hover:-translate-y-0.5">
                            <span class="block text-3xl transition-transform duration-300 group-hover:scale-110">
                                ⛰️
                            </span>
                            <span class="mt-2 block font-bold text-cream">
                                Gunung
                            </span>
                        </a>

                        {{-- PERLENGKAPAN --}}
                        <a href="#perlengkapan" class="group rounded-2xl bg-white/10 p-4 transition-all duration-300 hover:bg-white/20 hover:-translate-y-0.5">
                            <span class="block text-3xl transition-transform duration-300 group-hover:scale-110">
                                ⚙️
                            </span>
                            <span class="mt-2 block font-bold text-cream">
                                Perlengkapan
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        {{-- ========================= GUNUNG ========================= --}}
        <section id="gunung" class="border-y border-primary/10 bg-white/50">
            <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="eyebrow">DESTINASI</p>
                        <h2 class="mt-3 text-3xl font-black text-forest">
                            Gunung Pilihan
                        </h2>
                        <p class="mt-2 max-w-2xl text-primary/65">
                            Temukan berbagai destinasi pendakian favorit yang siap untuk dijelajahi.
                        </p>
                    </div>

                    @auth
                        <a href="{{ route('mountains.catalog') }}" class="btn-secondary text-xs sm:text-sm self-start md:self-auto">
                            Lihat Semua Gunung &rarr;
                        </a>
                    @endauth
                </div>

                {{-- CARD GUNUNG --}}
                <div class="mt-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($mountains as $mountain)
                        <article class="group card flex flex-col justify-between overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div>
                                {{-- FOTO --}}
                                @if($mountain->image)
                                    <div class="relative h-48 w-full overflow-hidden bg-primary/5">
                                        <img
                                            src="{{ asset('storage/' . $mountain->image) }}"
                                            alt="{{ $mountain->name }}"
                                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                            loading="lazy"
                                        >
                                        @if($mountain->difficulty)
                                            <span class="absolute right-3 top-3 rounded-full bg-secondary/90 px-3 py-1 text-xs font-black text-primary shadow-sm backdrop-blur">
                                                {{ $mountain->difficulty }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="relative flex h-48 w-full items-center justify-center bg-primary/5 text-sm font-semibold text-primary/40">
                                        <span>Belum ada foto</span>
                                        @if($mountain->difficulty)
                                            <span class="absolute right-3 top-3 rounded-full bg-secondary px-3 py-1 text-xs font-black text-primary">
                                                {{ $mountain->difficulty }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- INFO --}}
                                <div class="p-6">
                                    <h3 class="text-xl font-black text-forest transition-colors group-hover:text-primary">
                                        {{ $mountain->name }}
                                    </h3>

                                    <p class="mt-1 text-sm text-primary/60">
                                        📍 {{ $mountain->location }}, {{ $mountain->province }}
                                    </p>

                                    @if($mountain->description)
                                        <p class="mt-3 text-sm text-primary/75 line-clamp-2 leading-relaxed">
                                            {{ $mountain->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- FOOTER CARD INFO --}}
                            <div class="flex items-center justify-between border-t border-primary/10 bg-white/40 px-6 py-3 text-xs font-bold text-primary/80">
                                <span>
                                    ⛰️ {{ number_format($mountain->elevation) }} mdpl
                                </span>
                                <span>
                                    ⏱️ {{ $mountain->estimated_duration ?: '1-2 Hari' }}
                                </span>
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
        <section id="perlengkapan" class="border-b border-primary/10" x-data="{ searchGear: '' }">
            <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                    <div>
                        <p class="eyebrow">PERLENGKAPAN</p>
                        <h2 class="mt-3 text-3xl font-black text-forest">
                            Perlengkapan Pendakian
                        </h2>
                        <p class="mt-2 max-w-2xl text-primary/65">
                            Lihat perlengkapan outdoor berkualitas yang siap disewa untuk menemani petualangan Anda.
                        </p>
                    </div>

                    @auth
                        <a href="{{ route('gear.catalog') }}" class="btn-secondary text-xs sm:text-sm self-start md:self-auto">
                            Katalog Lengkap &rarr;
                        </a>
                    @endauth
                </div>

                {{-- INTERACTIVE SEARCH BAR --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="relative w-full sm:max-w-xs">
                        
                        <span class="pointer-events-none absolute left-3 top-3 text-primary/40">
                            
                        </span>
                    </div>

                    <span class="text-xs font-semibold text-primary/60">
                      
                    </span>
                </div>

                {{-- CARD GEAR GRID --}}
                <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @forelse($gears as $gear)
                        @php
                            $catName = $gear->category->name ?? 'Perlengkapan';
                        @endphp
                        <article
                            class="card flex flex-col justify-between p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md"
                            x-show="searchGear === '' || '{{ strtolower(addslashes($gear->name)) }}'.includes(searchGear.toLowerCase()) || '{{ strtolower(addslashes($catName)) }}'.includes(searchGear.toLowerCase())"
                            x-transition
                        >
                            <div>
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary">
                                        {{ $catName }}
                                    </span>

                                    @if($gear->stock > 0)
                                        <span class="text-xs font-semibold text-forest">
                                            ✓ Stok: {{ $gear->stock }}
                                        </span>
                                    @else
                                        <span class="text-xs font-semibold text-red-600">
                                            ✕ Stok Habis
                                        </span>
                                    @endif
                                </div>

                                <h4 class="mt-4 text-xl font-black text-forest">
                                    {{ $gear->name }}
                                </h4>

                                @if($gear->description)
                                    <p class="mt-2 text-sm text-primary/70 line-clamp-2 leading-relaxed">
                                        {{ $gear->description }}
                                    </p>
                                @endif
                            </div>

                            <div class="mt-6 flex items-center justify-between border-t border-primary/10 pt-4">
                                <div>
                                    <p class="text-xs text-primary/60">Biaya Sewa</p>
                                    <p class="text-base font-black text-primary">
                                        Rp {{ number_format($gear->rental_price, 0, ',', '.') }}<span class="text-xs font-normal text-primary/70">/hari</span>
                                    </p>
                                </div>

                                @auth
                                    <a href="{{ route('rentals.create', ['gear_id' => $gear->id]) }}" class="btn-primary text-xs !py-2 !px-3">
                                        Sewa Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-primary text-xs !py-2 !px-3">
                                        Sewa
                                    </a>
                                @endauth
                            </div>
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
        <section id="tentang" class="border-b border-primary/10 bg-white/50">
            <div class="mx-auto max-w-6xl px-6 py-16 lg:px-8">
                <div class="max-w-2xl">
                    <p class="eyebrow">TENTANG KAMI</p>
                    <h2 class="mt-3 text-3xl font-black">
                        Partner praktis untuk perjalanan ke alam.
                    </h2>
                    <p class="mt-4 leading-7 text-primary/70">
                        Kami membuat persiapan pendakian lebih sederhana, supaya Anda dapat fokus menikmati perjalanan dengan perlengkapan yang sesuai dan rencana yang matang.
                    </p>
                </div>

                {{-- ABOUT CARDS --}}
                <div class="mt-10 grid gap-6 md:grid-cols-3">
                    <article class="card p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 text-2xl">🗺️</div>
                        <h3 class="text-lg font-black text-forest">
                            Rekomendasi Gunung
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-primary/65">
                            Cari informasi tujuan, jalur pendakian, dan estimasi waktu untuk menentukan perjalanan yang tepat.
                        </p>
                    </article>

                    <article class="card p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 text-2xl">🎒</div>
                        <h3 class="text-lg font-black text-forest">
                            Katalog Perlengkapan
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-primary/65">
                            Lihat berbagai pilihan peralatan outdoor berspesifikasi tangguh yang siap disewa sebelum berangkat.
                        </p>
                    </article>

                    <article class="card p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 text-2xl">📋</div>
                        <h3 class="text-lg font-black text-forest">
                            Penyewaan Terkelola
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-primary/65">
                            Pantau status transaksi, invoice, dan riwayat penyewaan Anda dalam satu dashboard terintegrasi.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- ========================= CONTACT ========================= --}}
        <section id="kontak" class="mx-auto max-w-6xl px-6 py-16 lg:px-8" x-data="{
            copiedText: '',
            copy(text, label) {
                navigator.clipboard.writeText(text);
                this.copiedText = label;
                setTimeout(() => { this.copiedText = ''; }, 2000);
            }
        }">
            <div class="relative overflow-hidden rounded-3xl bg-secondary p-8 sm:p-12 shadow-xl shadow-secondary/20">
                {{-- DECORATIVE ACCENTS --}}
                <div class="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full bg-primary/5"></div>
                <div class="pointer-events-none absolute -bottom-16 -left-16 h-56 w-56 rounded-full border-[18px] border-primary/5"></div>

                <div class="relative">
                    <div class="max-w-2xl border-b border-primary/15 pb-6">
                        <p class="eyebrow">HUBUNGI KAMI</p>
                        <h2 class="mt-2 text-3xl font-black text-forest sm:text-4xl">
                            Butuh Bantuan Persiapan?
                        </h2>
                        <p class="mt-2 text-primary/75 leading-relaxed text-sm sm:text-base">
                            Tim PeakPack siap membantu pertanyaan seputar ketersediaan perlengkapan, konsultasi rute pendakian, dan solusi perjalanan Anda.
                        </p>
                    </div>

                    {{-- CONTACT CARDS GRID --}}
                    <div class="mt-8 grid gap-6 md:grid-cols-3">
                        {{-- WHATSAPP CARD --}}
                        <div class="group card flex flex-col justify-between p-6 transition-all duration-300 hover:shadow-md hover:bg-white/80 bg-white/60">
                            <div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black tracking-wider text-primary/60 uppercase">
                                        WhatsApp Official
                                    </p>
                                    <button
                                        type="button"
                                        @click="copy('+6285158228465', 'wa')"
                                        class="rounded-lg border border-primary/15 bg-white px-2.5 py-1 text-xs font-semibold text-primary transition hover:bg-secondary/40"
                                        title="Salin Nomor"
                                    >
                                        <span x-show="copiedText !== 'wa'">Salin</span>
                                        <span x-show="copiedText === 'wa'" x-cloak class="text-forest font-bold">✓ Tersalin</span>
                                    </button>
                                </div>

                                <h3 class="mt-3 text-lg font-black text-forest">
                                    +62 851 5822 8465
                                </h3>
                                <p class="mt-1 text-xs text-primary/65 leading-relaxed">
                                    Respon cepat untuk tanya ketersediaan & sewa alat.
                                </p>
                            </div>

                            <div class="mt-6 border-t border-primary/10 pt-4">
                                <a
                                    href="https://wa.me/6285158228465?text=Halo%20PeakPack%2C%20saya%20ingin%20bertanya%20tentang%20penyewaan%20dan%20informasi%20gunung"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                   class="btn-secondary w-full text-center text-xs !py-2.5"
                                >
                                    Buka WhatsApp &rarr;
                                </a>
                            </div>
                        </div>

                        {{-- EMAIL CARD --}}
                        <div class="group card flex flex-col justify-between p-6 transition-all duration-300 hover:shadow-md hover:bg-white/80 bg-white/60">
                            <div>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black tracking-wider text-primary/60 uppercase">
                                        Email Support
                                    </p>
                                    <button
                                        type="button"
                                        @click="copy('dwigunafrega88@gmail.com', 'email')"
                                        class="rounded-lg border border-primary/15 bg-white px-2.5 py-1 text-xs font-semibold text-primary transition hover:bg-secondary/40"
                                        title="Salin Email"
                                    >
                                        <span x-show="copiedText !== 'email'">Salin</span>
                                        <span x-show="copiedText === 'email'" x-cloak class="text-forest font-bold">✓ Tersalin</span>
                                    </button>
                                </div>

                                <h3 class="mt-3 text-base font-black text-forest break-all">
                                    dwigunafrega88@gmail.com
                                </h3>
                                <p class="mt-1 text-xs text-primary/65 leading-relaxed">
                                    Untuk kerjasama resmi, saran, dan pertanyaan umum.
                                </p>
                            </div>

                            <div class="mt-6 border-t border-primary/10 pt-4">
                                <a
                                    href="mailto:dwigunafrega88@gmail.com?subject=Tanya%20PeakPack%20Outdoor"
                                    class="btn-secondary w-full text-center text-xs !py-2.5"
                                >
                                    Kirim Email &rarr;
                                </a>
                            </div>
                        </div>

                        {{-- BASECAMP LOCATION CARD --}}
                        <div class="group card flex flex-col justify-between p-6 transition-all duration-300 hover:shadow-md hover:bg-white/80 bg-white/60">
                            <div>
                                <p class="text-xs font-black tracking-wider text-primary/60 uppercase">
                                    Lokasi Basecamp
                                </p>

                                <h3 class="mt-3 text-base font-black text-forest">
                                    PeakPack Outdoor Station
                                </h3>
                                <p class="mt-1 text-xs text-primary/75 leading-relaxed">
                                    Jl. Rancaloa RT.03 RW.02 Kel. Cipamokolan, Kec. Rancasari, Kota Bandung
                                </p>
                                <p class="mt-2 text-xs font-semibold text-primary/60">
                                    Buka Setiap Hari (08.00 - 20.00 WIB)
                                </p>
                            </div>

                            <div class="mt-6 border-t border-primary/10 pt-4">
                                <a
                                    href="https://www.google.com/maps/search/?api=1&query=Jl.+Rancaloa+Cipamokolan+Rancasari+Bandung"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn-secondary w-full text-center text-xs !py-2.5"
                                >
                                    Buka Google Maps &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    {{-- ========================= BACK TO TOP BUTTON ========================= --}}
    <button
        type="button"
        x-show="showTopBtn"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-6 right-6 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-primary text-cream shadow-lg transition-transform duration-200 hover:scale-110 hover:bg-primary/90 focus:outline-none"
        aria-label="Kembali ke atas"
    >
        ▲
    </button>

    {{-- ========================= FOOTER ========================= --}}
    <footer class="border-t border-primary/10 px-6 py-6 text-center text-sm text-primary/60">
        &copy; {{ date('Y') }} PeakPack By Frega Teguh Dwiguna. Rekan Petualangan Anda.
    </footer>

</body>
</html>