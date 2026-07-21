<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Reservasi</h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        .bistro-font-display { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .bistro-font-mono { font-family: 'IBM Plex Mono', monospace; }
        .bistro-font-body { font-family: 'Work Sans', sans-serif; }

        .bistro-ticket {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 14px 14px 4px 4px;
            overflow: hidden;
        }
        .bistro-ticket-top { height: 5px; background-color: #2B211D; }

        .bistro-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 999px;
            display: inline-block;
        }
        .badge-pending { background: #FBF0DC; color: #92700E; }
        .badge-confirmed { background: #E8F0E4; color: #45592F; }
        .badge-cancelled { background: #F6E3E1; color: #8C332B; }
        .badge-completed { background: #EDE8E2; color: #6B5F52; }

        .bistro-row { transition: background-color .12s ease; }
        .bistro-row:not(:last-child) { border-bottom: 1px solid #F0E7D8; }
        .bistro-row:hover { background-color: #FDF9F2; }

        .bistro-select, .bistro-input {
            font-family: 'Work Sans', sans-serif;
            font-size: 0.875rem;
            border: 1px solid #E8DFD1;
            border-radius: 8px;
            padding: 0.45rem 0.75rem;
            background: #FFFDF9;
            color: #2B211D;
        }
        .bistro-select:focus, .bistro-input:focus {
            outline: none;
            border-color: #6E2A3B;
        }

        .bistro-avatar {
            width: 40px; height: 40px;
            border-radius: 999px;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 15px;
            color: #FBF8F3;
            background: #6E2A3B;
            flex-shrink: 0;
        }

        .bistro-pill-btn {
            font-family: 'Work Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 999px;
            border: 1px solid transparent;
            transition: opacity .12s ease;
            white-space: nowrap;
        }
        .bistro-pill-btn:hover { opacity: 0.8; }
        .pill-confirm { background: #E8F0E4; color: #45592F; border-color: #C9DBC0; }
        .pill-reject { background: #F6E3E1; color: #8C332B; border-color: #E8C3BE; }
        .pill-complete { background: #F3E8DB; color: #6E2A3B; border-color: #E5D2B0; }

        .stat-pill {
            border-radius: 12px;
            padding: 14px 18px;
            flex: 1;
            min-width: 130px;
        }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">Panel Admin</p>
                <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">Kelola Reservasi</h1>
            </div>

            @if (session('success'))
                <div class="p-4 rounded-lg bistro-font-body text-sm" style="background:#E8F0E4; color:#45592F; border:1px solid #C9DBC0;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-wrap gap-3">
                @php
                    $countsByStatus = [
                        'pending' => $reservations->where('status', 'pending')->count(),
                        'confirmed' => $reservations->where('status', 'confirmed')->count(),
                        'cancelled' => $reservations->where('status', 'cancelled')->count(),
                        'completed' => $reservations->where('status', 'completed')->count(),
                    ];
                @endphp
                <div class="stat-pill" style="background:#FBF0DC;">
                    <p class="bistro-font-mono text-[10px] uppercase tracking-widest" style="color:#92700E;">Menunggu</p>
                    <p class="bistro-font-mono text-2xl font-semibold" style="color:#92700E;">{{ $countsByStatus['pending'] }}</p>
                </div>
                <div class="stat-pill" style="background:#E8F0E4;">
                    <p class="bistro-font-mono text-[10px] uppercase tracking-widest" style="color:#45592F;">Dikonfirmasi</p>
                    <p class="bistro-font-mono text-2xl font-semibold" style="color:#45592F;">{{ $countsByStatus['confirmed'] }}</p>
                </div>
                <div class="stat-pill" style="background:#F6E3E1;">
                    <p class="bistro-font-mono text-[10px] uppercase tracking-widest" style="color:#8C332B;">Dibatalkan</p>
                    <p class="bistro-font-mono text-2xl font-semibold" style="color:#8C332B;">{{ $countsByStatus['cancelled'] }}</p>
                </div>
                <div class="stat-pill" style="background:#EDE8E2;">
                    <p class="bistro-font-mono text-[10px] uppercase tracking-widest" style="color:#6B5F52;">Selesai</p>
                    <p class="bistro-font-mono text-2xl font-semibold" style="color:#6B5F52;">{{ $countsByStatus['completed'] }}</p>
                </div>
            </div>

            <form method="GET" class="flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block bistro-font-mono text-[11px] tracking-widest uppercase mb-1" style="color:#8A7B6C;">Status</label>
                    <select name="status" class="bistro-select" onchange="this.form.submit()">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block bistro-font-mono text-[11px] tracking-widest uppercase mb-1" style="color:#8A7B6C;">Tanggal</label>
                    <input type="date" name="date" value="{{ request('date') }}" class="bistro-input" onchange="this.form.submit()">
                </div>
                @if (request('status') || request('date'))
                    <a href="{{ route('admin.reservations.index') }}" class="bistro-font-body text-sm hover:underline" style="color:#8A7B6C;">Reset filter</a>
                @endif
            </form>

            <div class="bistro-ticket shadow-sm">
                <div class="bistro-ticket-top"></div>

                @forelse ($reservations as $r)
                    <div class="bistro-row p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4">

                        <div class="flex items-center gap-4 flex-1 min-w-0">
                            <div class="bistro-avatar">{{ strtoupper(substr($r->user->name, 0, 1)) }}</div>

                            <div class="min-w-0">
                                <p class="bistro-font-body font-semibold truncate" style="color:#2B211D;">
                                    {{ $r->user->name }}
                                </p>
                                <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-0.5">
                                    <span class="bistro-font-mono text-xs px-2 py-0.5 rounded" style="background:#F3E8DB; color:#6E2A3B;">
                                        Meja {{ $r->table->table_number }}
                                    </span>
                                    <span class="bistro-font-mono text-xs" style="color:#8A7B6C;">
                                        {{ $r->reservation_date->format('d M Y') }}
                                    </span>
                                    <span class="bistro-font-mono text-xs" style="color:#8A7B6C;">
                                        {{ substr($r->start_time, 0, 5) }}&ndash;{{ substr($r->end_time, 0, 5) }}
                                    </span>
                                    <span class="bistro-font-mono text-xs" style="color:#8A7B6C;">
                                        {{ $r->guest_count }} orang
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 sm:justify-end shrink-0">
                            @php
                                $badgeClass = [
                                    'pending' => 'badge-pending',
                                    'confirmed' => 'badge-confirmed',
                                    'cancelled' => 'badge-cancelled',
                                    'completed' => 'badge-completed',
                                ][$r->status];
                                $badgeLabel = [
                                    'pending' => 'Menunggu',
                                    'confirmed' => 'Dikonfirmasi',
                                    'cancelled' => 'Dibatalkan',
                                    'completed' => 'Selesai',
                                ][$r->status];
                            @endphp
                            <span class="bistro-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>

                            <div class="flex items-center gap-2">
                                @if ($r->status === 'pending')
                                    <form action="{{ route('admin.reservations.confirm', $r) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bistro-pill-btn pill-confirm">Konfirmasi</button>
                                    </form>
                                    <form action="{{ route('admin.reservations.reject', $r) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bistro-pill-btn pill-reject">Tolak</button>
                                    </form>
                                @elseif ($r->status === 'confirmed')
                                    <form action="{{ route('admin.reservations.complete', $r) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="bistro-pill-btn pill-complete">Tandai Selesai</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5" class="mx-auto mb-3">
                            <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                        </svg>
                        <p class="bistro-font-body text-sm" style="color:#B0A28F;">Tidak ada data reservasi untuk filter ini.</p>
                    </div>
                @endforelse
            </div>

            <div class="bistro-font-body">{{ $reservations->links() }}</div>

        </div>
    </div>
</x-app-layout>