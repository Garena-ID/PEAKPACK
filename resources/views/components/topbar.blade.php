<header class="flex h-20 items-center justify-between border-b border-primary/10 bg-cream px-5 lg:px-10">
    <button @click="sidebar = !sidebar" class="btn-ghost lg:hidden">☰</button>
    <div>
        <p class="text-xs font-bold uppercase tracking-widest text-primary/60">
            {{ auth()->user()->role === 'admin' ? 'Admin workspace' : 'Outdoor rental platform' }}
        </p>
        <h1 class="text-lg font-bold">Hello, {{ auth()->user()->name }}</h1>
    </div>
    <div class="hidden rounded-full bg-secondary/50 px-4 py-2 text-sm font-semibold sm:block">
        {{ auth()->user()->email }}
    </div>
</header>
