<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Meja</h2>
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

        .table-card {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 14px;
            padding: 1.25rem;
            position: relative;
            transition: box-shadow .15s ease;
        }
        .table-card:hover { box-shadow: 0 4px 14px rgba(43,33,29,0.06); }
        .table-card.inactive { opacity: 0.55; }

        .bistro-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 3px 9px;
            border-radius: 999px;
            display: inline-block;
        }
        .badge-active { background: #E8F0E4; color: #45592F; }
        .badge-inactive { background: #EDE8E2; color: #6B5F52; }
        .badge-indoor { background: #F3E8DB; color: #6E2A3B; }
        .badge-outdoor { background: #E4EEF2; color: #2C5E70; }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-baseline justify-between flex-wrap gap-3">
                <div>
                    <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">Panel Admin</p>
                    <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">Kelola Meja</h1>
                </div>
                <a href="{{ route('admin.tables.create') }}" class="bistro-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Tambah Meja
                </a>
            </div>

            @if (session('success'))
                <div class="p-4 rounded-lg bistro-font-body text-sm" style="background:#E8F0E4; color:#45592F; border:1px solid #C9DBC0;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($tables as $table)
                    <div class="table-card {{ $table->status === 'inactive' ? 'inactive' : '' }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-lg flex items-center justify-center" style="background:#F3E8DB;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.6">
                                        <rect x="3" y="7" width="18" height="11" rx="2"/>
                                        <path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="bistro-font-mono text-[10px] uppercase tracking-widest" style="color:#B08D5A;">Meja</p>
                                    <p class="bistro-font-display text-xl" style="color:#2B211D;">{{ $table->table_number }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-4">
                            <span class="bistro-badge {{ $table->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ $table->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span class="bistro-badge {{ $table->location === 'indoor' ? 'badge-indoor' : 'badge-outdoor' }}">
                                {{ ucfirst($table->location) }}
                            </span>
                        </div>

                        <div class="flex items-center gap-1.5 mb-4 bistro-font-body text-sm" style="color:#5C4E42;">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#8A7B6C" stroke-width="1.8">
                                <circle cx="9" cy="8" r="3.2"/>
                                <path d="M3.5 19c0-3.5 2.5-5.5 5.5-5.5s5.5 2 5.5 5.5"/>
                                <circle cx="17" cy="9" r="2.4"/>
                                <path d="M15.5 13.2c2.2.2 3.8 2 3.8 4.6"/>
                            </svg>
                            Kapasitas {{ $table->capacity }} orang
                        </div>

                        <div class="flex items-center gap-4 pt-3 bistro-font-body text-sm" style="border-top: 1px dashed #E8DFD1;">
                            <a href="{{ route('admin.tables.edit', $table) }}" style="color:#6E2A3B;" class="font-medium hover:underline">Edit</a>
                            <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" onsubmit="return confirm('Yakin hapus meja ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#8C332B;" class="font-medium hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5" class="mx-auto mb-3">
                            <rect x="3" y="7" width="18" height="11" rx="2"/>
                            <path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/>
                        </svg>
                        <p class="bistro-font-body text-sm" style="color:#B0A28F;">Belum ada data meja.</p>
                    </div>
                @endforelse
            </div>

            <div class="bistro-font-body">{{ $tables->links() }}</div>

        </div>
    </div>
</x-app-layout>