<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Menu</h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        .bistro-font-display { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .bistro-font-mono { font-family: 'IBM Plex Mono', monospace; }
        .bistro-font-body { font-family: 'Work Sans', sans-serif; }

        .bistro-btn {
            font-family: 'Work Sans', sans-serif;
            font-weight: 600;
            background-color: #6E2A3B;
            color: #FBF8F3;
            padding: 0.6rem 1.25rem;
            border-radius: 8px;
            transition: background-color .15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }
        .bistro-btn:hover { background-color: #59212F; }

        .menu-card {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 14px;
            padding: 1.25rem;
            transition: box-shadow .15s ease;
            border-left-width: 4px;
        }
        .menu-card:hover { box-shadow: 0 4px 14px rgba(43,33,29,0.06); }
        .menu-card.unavailable { opacity: 0.5; }

        .cat-makanan { border-left-color: #6E2A3B; }
        .cat-minuman { border-left-color: #2C5E70; }
        .cat-dessert { border-left-color: #C9932E; }

        .bistro-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 3px 9px;
            border-radius: 999px;
            display: inline-block;
        }
        .badge-makanan { background: #F3E8DB; color: #6E2A3B; }
        .badge-minuman { background: #E4EEF2; color: #2C5E70; }
        .badge-dessert { background: #FBF0DC; color: #92700E; }
        .badge-available { background: #E8F0E4; color: #45592F; }
        .badge-unavailable { background: #EDE8E2; color: #6B5F52; }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-baseline justify-between flex-wrap gap-3">
                <div>
                    <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">Panel Admin</p>
                    <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">Kelola Menu</h1>
                </div>
                <a href="{{ route('admin.menus.create') }}" class="bistro-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Menu
                </a>
            </div>

            @if (session('success'))
                <div class="p-4 rounded-lg bistro-font-body text-sm" style="background:#E8F0E4; color:#45592F; border:1px solid #C9DBC0;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($menus as $menu)
                    @php
                        $catClass = ['makanan' => 'cat-makanan', 'minuman' => 'cat-minuman', 'dessert' => 'cat-dessert'][$menu->category];
                        $catBadge = ['makanan' => 'badge-makanan', 'minuman' => 'badge-minuman', 'dessert' => 'badge-dessert'][$menu->category];
                    @endphp
                    <div class="menu-card {{ $catClass }} {{ !$menu->is_available ? 'unavailable' : '' }}">
                        <div class="flex items-start justify-between mb-2">
                            <span class="bistro-badge {{ $catBadge }}">{{ ucfirst($menu->category) }}</span>
                            <span class="bistro-badge {{ $menu->is_available ? 'badge-available' : 'badge-unavailable' }}">
                                {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>

                        <p class="bistro-font-display text-lg leading-snug mt-2" style="color:#2B211D;">{{ $menu->name }}</p>

                        @if ($menu->description)
                            <p class="bistro-font-body text-sm mt-1 line-clamp-2" style="color:#8A7B6C;">{{ $menu->description }}</p>
                        @endif

                        <p class="bistro-font-mono text-2xl font-semibold mt-3" style="color:#6E2A3B;">
                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                        </p>

                        <div class="flex items-center gap-4 pt-3 mt-3 bistro-font-body text-sm" style="border-top: 1px dashed #E8DFD1;">
                            <a href="{{ route('admin.menus.edit', $menu) }}" style="color:#6E2A3B;" class="font-medium hover:underline">Edit</a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#8C332B;" class="font-medium hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5" class="mx-auto mb-3">
                            <path d="M4 19h16M6 19V9a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v10M10 7V5a2 2 0 0 1 4 0v2"/>
                        </svg>
                        <p class="bistro-font-body text-sm" style="color:#B0A28F;">Belum ada data menu.</p>
                    </div>
                @endforelse
            </div>

            <div class="bistro-font-body">{{ $menus->links() }}</div>

        </div>
    </div>
</x-app-layout>