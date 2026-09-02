<aside
    :class="sidebar ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col justify-between overflow-y-auto bg-primary p-6 text-white transition-transform lg:static lg:translate-x-0"
>
    <div>
        {{-- Logo --}}
        <a
            href="{{ route('admin.dashboard') }}"
            class="flex items-center gap-3 text-2xl font-black"
        >
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-secondary text-primary">
                ▲
            </span>

            PeakPack
        </a>

        <nav class="mt-8 space-y-6">

            {{-- DATA --}}
            <div>
                <p class="mb-2 px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80">
                    DATA
                </p>

                <div class="space-y-1">

                    {{-- Customers --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.customers.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.customers.index') }}"
                    >
                        Customers
                    </a>

                    {{-- Mountains --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.mountains.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.mountains.index') }}"
                    >
                        Mountains
                    </a>

                    {{-- Gear Categories --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.gear-categories.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.gear-categories.index') }}"
                    >
                        Gear Categories
                    </a>

                    {{-- Gear --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.gear.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.gear.index') }}"
                    >
                        Gear
                    </a>

                </div>
            </div>


            {{-- TRANSAKSI --}}
            <div>
                <p class="mb-2 px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80">
                    TRANSAKSI
                </p>

                <div class="space-y-1">

                    {{-- Rentals --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.rentals.*') || request()->routeIs('admin.rental-items.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.rentals.index') }}"
                    >
                        Rentals
                    </a>

                </div>
            </div>


            {{-- REKOMENDASI --}}
            <div>
                <p class="mb-2 px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80">
                    REKOMENDASI
                </p>

                <div class="space-y-1">

                    {{-- Mountain Recommendations --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.recommendations.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.recommendations.index') }}"
                    >
                        Mountain Recommendations
                    </a>

                </div>
            </div>


            {{-- LAPORAN --}}
            <div>
                <p class="mb-2 px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80">
                    LAPORAN
                </p>

                <div class="space-y-1">

                    {{-- Reports --}}
                    <a
                        class="side-link {{ request()->routeIs('admin.reports.*') ? 'bg-white/20 text-white font-bold' : '' }}"
                        href="{{ route('admin.reports.index') }}"
                    >
                        Reports
                    </a>

                </div>
            </div>

        </nav>
    </div>


    {{-- ACCOUNT --}}
    <div class="mt-8 space-y-1 border-t border-white/10 pt-6">

        <p class="mb-2 px-4 text-[10px] font-black uppercase tracking-widest text-secondary/80">
            ACCOUNT
        </p>

        {{-- Profile --}}
        <a
            class="side-link {{ request()->routeIs('profile.*') ? 'bg-white/20 text-white font-bold' : '' }}"
            href="{{ route('profile.edit') }}"
        >
            Profile
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="side-link w-full text-left"
            >
                Logout
            </button>
        </form>

    </div>

</aside>