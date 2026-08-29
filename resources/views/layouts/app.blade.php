<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'PeakPack' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/peakpack/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sand text-forest" x-data="{ sidebar: false }">
<div class="min-h-screen lg:flex">
    <x-sidebar />
    <div class="min-w-0 flex-1">
        <x-topbar />
        <main class="p-5 lg:p-10">
            @include('components.flash')
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
