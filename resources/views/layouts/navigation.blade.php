<nav x-data="{ open: false }" style="background-color: #FFFDF9; border-bottom: 1px solid #E8DFD1;">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        .nav-brand { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .nav-link {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            color: #8A7B6C;
            padding: 0 2px;
            border-bottom: 2px solid transparent;
            transition: color .15s ease, border-color .15s ease;
        }
        .nav-link:hover { color: #2B211D; }
        .nav-link.active { color: #6E2A3B; border-bottom-color: #6E2A3B; }

        .nav-link-mobile {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.8">
                            <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                        </svg>
                        <span class="nav-brand text-lg" style="color:#2B211D;">Pagi Malam</span>
                    </a>
                </div>

                <div class="hidden space-x-7 sm:ms-10 sm:flex sm:items-center">
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                       class="nav-link {{ (request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) ? 'active' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('reservations.index') }}" class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}">
                        Reservasi
                    </a>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.tables.index') }}" class="nav-link {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}">
                            Kelola Meja
                        </a>
                        <a href="{{ route('admin.menus.index') }}" class="nav-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                            Kelola Menu
                        </a>
                        <a href="{{ route('admin.reservations.index') }}" class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}">
                            Kelola Reservasi
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
                                style="color:#5C4E42; font-family: 'Work Sans', sans-serif;">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color:#8A7B6C;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="border-top: 1px solid #E8DFD1;">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
               class="nav-link-mobile block py-2" style="color: {{ (request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) ? '#6E2A3B' : '#8A7B6C' }};">
                Dashboard
            </a>
            <a href="{{ route('reservations.index') }}" class="nav-link-mobile block py-2" style="color: {{ request()->routeIs('reservations.*') ? '#6E2A3B' : '#8A7B6C' }};">
                Reservasi
            </a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.tables.index') }}" class="nav-link-mobile block py-2" style="color: {{ request()->routeIs('admin.tables.*') ? '#6E2A3B' : '#8A7B6C' }};">
                    Kelola Meja
                </a>
                <a href="{{ route('admin.menus.index') }}" class="nav-link-mobile block py-2" style="color: {{ request()->routeIs('admin.menus.*') ? '#6E2A3B' : '#8A7B6C' }};">
                    Kelola Menu
                </a>
                <a href="{{ route('admin.reservations.index') }}" class="nav-link-mobile block py-2" style="color: {{ request()->routeIs('admin.reservations.*') ? '#6E2A3B' : '#8A7B6C' }};">
                    Kelola Reservasi
                </a>
            @endif
        </div>

        <div class="pt-4 pb-3" style="border-top: 1px solid #E8DFD1;">
            <div class="px-4">
                <div class="font-medium text-base" style="color:#2B211D; font-family:'Work Sans',sans-serif;">{{ Auth::user()->name }}</div>
                <div class="text-sm" style="color:#8A7B6C; font-family:'Work Sans',sans-serif;">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <a href="{{ route('profile.edit') }}" class="block py-1 text-sm" style="color:#5C4E42; font-family:'Work Sans',sans-serif;">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block py-1 text-sm" style="color:#5C4E42; font-family:'Work Sans',sans-serif;">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>