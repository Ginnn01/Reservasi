<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
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
        .bistro-ticket-top { height: 5px; }

        .bistro-btn {
            font-family: 'Work Sans', sans-serif;
            font-weight: 600;
            background-color: #6E2A3B;
            color: #FBF8F3;
            padding: 0.65rem 1.4rem;
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

        .stat-pill {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 12px;
            padding: 1.25rem;
        }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div>
                <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">
                    Halo, {{ explode(' ', auth()->user()->name)[0] }}
                </h1>
            </div>

            @if ($upcomingReservation)
                <div class="bistro-ticket shadow-sm">
                    <div class="bistro-ticket-top" style="background-color:#6E2A3B;"></div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <p class="bistro-font-mono text-[11px] tracking-widest uppercase" style="color:#8A7B6C;">Reservasi Terdekat</p>
                            <span class="bistro-badge {{ $upcomingReservation->status === 'pending' ? 'badge-pending' : 'badge-confirmed' }}">
                                {{ $upcomingReservation->status === 'pending' ? 'Menunggu' : 'Dikonfirmasi' }}
                            </span>
                        </div>

                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-lg flex flex-col items-center justify-center shrink-0" style="background:#F3E8DB;">
                                <span class="bistro-font-mono text-[10px] uppercase" style="color:#B08D5A;">Meja</span>
                                <span class="bistro-font-mono text-xl font-semibold" style="color:#6E2A3B;">{{ $upcomingReservation->table->table_number }}</span>
                            </div>
                            <div>
                                <p class="bistro-font-display text-xl" style="color:#2B211D;">
                                    {{ $upcomingReservation->reservation_date->translatedFormat('l, d F Y') }}
                                </p>
                                <p class="bistro-font-mono text-sm mt-1" style="color:#8A7B6C;">
                                    {{ substr($upcomingReservation->start_time, 0, 5) }} &ndash; {{ substr($upcomingReservation->end_time, 0, 5) }}
                                    &middot; {{ $upcomingReservation->guest_count }} orang
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bistro-ticket shadow-sm">
                    <div class="bistro-ticket-top" style="background-color:#C9932E;"></div>
                    <div class="p-6 text-center">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5" class="mx-auto mb-3">
                            <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                        </svg>
                        <p class="bistro-font-body text-sm mb-4" style="color:#8A7B6C;">Kamu belum punya reservasi mendatang.</p>
                        <a href="{{ route('reservations.create') }}" class="bistro-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 5v14M5 12h14"/>
                            </svg>
                            Buat Reservasi
                        </a>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div class="stat-pill">
                    <p class="bistro-font-body text-sm mb-1" style="color:#5C4E42;">Total Reservasi</p>
                    <p class="bistro-font-mono text-3xl font-semibold" style="color:#6E2A3B;">
                        {{ str_pad($totalReservations, 2, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
                <div class="stat-pill">
                    <p class="bistro-font-body text-sm mb-1" style="color:#5C4E42;">Kunjungan Selesai</p>
                    <p class="bistro-font-mono text-3xl font-semibold" style="color:#5B7553;">
                        {{ str_pad($completedReservations, 2, '0', STR_PAD_LEFT) }}
                    </p>
                </div>
            </div>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('reservations.create') }}" class="bistro-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    Buat Reservasi Baru
                </a>
                <a href="{{ route('reservations.index') }}" class="bistro-font-body text-sm font-semibold flex items-center" style="color:#6E2A3B;">
                    Lihat semua riwayat reservasi &rarr;
                </a>
            </div>

        </div>
    </div>
</x-app-layout>