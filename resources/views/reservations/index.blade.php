<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reservasi Saya</h2>
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

        .bistro-row:not(:last-child) { border-bottom: 1px solid #F0E7D8; }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-baseline justify-between flex-wrap gap-3">
                <div>
                    <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">Riwayat Pemesanan</p>
                    <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">Reservasi Saya</h1>
                </div>
                <a href="{{ route('reservations.create') }}" class="bistro-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Buat Reservasi
                </a>
            </div>

            @if (session('success'))
                <div class="p-4 rounded-lg bistro-font-body text-sm" style="background:#E8F0E4; color:#45592F; border:1px solid #C9DBC0;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 rounded-lg bistro-font-body text-sm" style="background:#F6E3E1; color:#8C332B; border:1px solid #E8C3BE;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bistro-ticket shadow-sm">
                <div class="bistro-ticket-top"></div>

                @forelse ($reservations as $r)
                    <div class="bistro-row p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center gap-4">

                        <div class="flex items-center gap-4 flex-1">
                            <div class="shrink-0 w-14 h-14 rounded-lg flex flex-col items-center justify-center" style="background:#F3E8DB;">
                                <span class="bistro-font-mono text-[10px] uppercase" style="color:#B08D5A;">Meja</span>
                                <span class="bistro-font-mono text-lg font-semibold" style="color:#6E2A3B;">{{ $r->table->table_number }}</span>
                            </div>

                            <div>
                                <p class="bistro-font-body font-semibold" style="color:#2B211D;">
                                    {{ $r->reservation_date->translatedFormat('d M Y') }}
                                </p>
                                <p class="bistro-font-mono text-sm" style="color:#8A7B6C;">
                                    {{ substr($r->start_time, 0, 5) }} &mdash; {{ substr($r->end_time, 0, 5) }} &middot; {{ $r->guest_count }} orang
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 sm:justify-end">
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

                            @if ($r->status === 'pending')
                                <div class="flex items-center gap-3 bistro-font-body text-sm">
                                    <a href="{{ route('reservations.edit', $r) }}" style="color:#6E2A3B;" class="hover:underline font-medium">Edit</a>
                                    <form action="{{ route('reservations.destroy', $r) }}" method="POST" onsubmit="return confirm('Yakin batalkan reservasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="color:#8C332B;" class="hover:underline font-medium">Batalkan</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5" class="mx-auto mb-3">
                            <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                        </svg>
                        <p class="bistro-font-body text-sm" style="color:#B0A28F;">Belum ada reservasi. Yuk pesan meja pertamamu.</p>
                    </div>
                @endforelse
            </div>

            <div class="bistro-font-body">{{ $reservations->links() }}</div>

        </div>
    </div>
</x-app-layout>