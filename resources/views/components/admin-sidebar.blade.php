<aside :class="sidebar ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-72 bg-primary p-6 text-white transition-transform lg:static lg:translate-x-0 flex flex-col justify-between overflow-y-auto">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-2xl font-black">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-secondary text-primary">▲</span>PeakPack
        </a>

        <nav class="mt-8 space-y-6">
            <!-- Main -->
            <!-- <div>
                <a class="side-link {{ request()->routeIs('admin.dashboard') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </div> -->

            <!-- Data Group -->
            <div>
                <p class="px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">DATA</p>
                <div class="space-y-1">
                    <a class="side-link {{ request()->routeIs('admin.mountains.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.mountains.index') }}">
                        Mountains
                    </a>
                    <a class="side-link {{ request()->routeIs('admin.gear-categories.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.gear-categories.index') }}">
                        Gear Categories
                    </a>
                    <a class="side-link {{ request()->routeIs('admin.gear.*') && !request()->routeIs('admin.gear-categories.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.gear.index') }}">
                        Gear
                    </a>
                </div>
            </div>

            <!-- Transactions Group -->
            <div>
                <p class="px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">TRANSAKSI</p>
                <div class="space-y-1">
                    <a class="side-link {{ request()->routeIs('admin.rentals.*') || request()->routeIs('admin.rental-items.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.rentals.index') }}">
                        Rentals
                    </a>
                </div>
            </div>

            <!-- Recommendation Group -->
            <div>
                <p class="px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">REKOMENDASI</p>
                <div class="space-y-1">
                    <a class="side-link {{ request()->routeIs('admin.recommendations.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ route('admin.recommendations.index') }}">
                        Mountain Recommendations
                    </a>
                </div>
            </div>

            <!-- Report Group -->
            <div>
                <p class="px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">LAPORAN</p>
                <div class="space-y-1">
                    <a class="side-link {{ request()->routeIs('admin.reports.*') ? 'bg-white/20 text-white font-bold' : '' }}" href="{{ Route::has('admin.reports.index') ? route('admin.reports.index') : '#' }}">
                        Reports
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Account Group -->
    <div class="mt-8 pt-6 border-t border-white/10 space-y-1">
        <p class="px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80 mb-2">ACCOUNT</p>
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
