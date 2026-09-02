<aside :class="sidebar ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-72 bg-primary p-6 text-white transition-transform lg:static lg:translate-x-0 flex flex-col justify-between">
    <div>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-2xl font-black">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-secondary text-primary">▲</span>PeakPack
        </a>

        <nav class="mt-8 space-y-1">
            <a class="side-link {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('dashboard') }}">
                Dashboard
            </a>
            <a class="side-link {{ request()->routeIs('mountains.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('mountains.catalog') }}">
                Daftar Gunung
            </a>
            <a class="side-link {{ request()->routeIs('gear.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('gear.catalog') }}">
                Sewa Peralatan
            </a>
            <a class="side-link {{ request()->routeIs('rentals.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('rentals.index') }}">
                Daftar Penyewaan    
            </a>
        </nav>
    </div>

    <div class="pt-6 border-t border-white/10 space-y-1">
        <a class="side-link {{ request()->routeIs('profile.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('profile.edit') }}">
            Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="side-link w-full text-left">
                Logout
            </button>
        </form>
    </div>
</aside>
