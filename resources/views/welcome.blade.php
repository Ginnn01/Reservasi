<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagi Malam</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Work+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Work Sans', sans-serif; background-color: #FBF8F3; }
        .font-display { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .font-mono { font-family: 'IBM Plex Mono', monospace; }

        .hero-section {
            background: radial-gradient(circle at 20% 20%, rgba(110,42,59,0.06), transparent 45%),
                        radial-gradient(circle at 80% 70%, rgba(201,147,46,0.08), transparent 40%);
        }

        .btn-primary {
            background-color: #6E2A3B;
            color: #FBF8F3;
            padding: 0.85rem 1.9rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color .15s ease;
        }
        .btn-primary:hover { background-color: #59212F; }

        .btn-secondary {
            background-color: transparent;
            color: #2B211D;
            border: 1.5px solid #2B211D;
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-secondary:hover { background-color: #2B211D; color: #FBF8F3; }

        .feature-card {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 14px;
            padding: 1.75rem;
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #B08D5A;
        }
    </style>
</head>
<body class="antialiased">

    <nav class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.8">
                <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
            </svg>
            <span class="font-display text-xl" style="color:#2B211D;">Pagi Malam</span>
        </div>

        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-primary text-sm">Ke Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold" style="color:#2B211D;">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary text-sm">Daftar</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <section class="hero-section">
        <div class="max-w-6xl mx-auto px-6 py-20 sm:py-28 text-center">
            <p class="eyebrow mb-4">Reservasi Meja Online</p>
            <h1 class="font-display text-4xl sm:text-6xl leading-tight mb-6" style="color:#2B211D;">
                Pesan meja favoritmu,<br>tanpa antre lagi.
            </h1>
            <p class="text-base sm:text-lg max-w-xl mx-auto mb-10" style="color:#5C4E42;">
                Pilih tanggal, jam, dan jumlah tamu — kami siapkan mejanya. Konfirmasi cepat, tanpa ribet telepon ke restoran.
            </p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                @auth
                    <a href="{{ route('reservations.create') }}" class="btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Buat Reservasi
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Mulai Reservasi
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary">Saya sudah punya akun</a>
                @endauth
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16 sm:py-20">
        <div class="text-center mb-12">
            <p class="eyebrow mb-2">Kenapa reservasi online</p>
            <h2 class="font-display text-3xl" style="color:#2B211D;">Lebih tenang, lebih pasti</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="feature-card">
                <div class="w-11 h-11 rounded-lg flex items-center justify-center mb-4" style="background:#F3E8DB;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.6">
                        <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                    </svg>
                </div>
                <h3 class="font-display text-lg mb-2" style="color:#2B211D;">Pilih Jam Sendiri</h3>
                <p class="text-sm" style="color:#8A7B6C;">Tentukan tanggal dan jam kedatanganmu, sistem otomatis mengecek ketersediaan meja secara real-time.</p>
            </div>

            <div class="feature-card">
                <div class="w-11 h-11 rounded-lg flex items-center justify-center mb-4" style="background:#FBF0DC;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9932E" stroke-width="1.6">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>
                <h3 class="font-display text-lg mb-2" style="color:#2B211D;">Konfirmasi Cepat</h3>
                <p class="text-sm" style="color:#8A7B6C;">Tim kami mengonfirmasi reservasimu secepat mungkin, statusnya bisa kamu pantau kapan saja.</p>
            </div>

            <div class="feature-card">
                <div class="w-11 h-11 rounded-lg flex items-center justify-center mb-4" style="background:#E8F0E4;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5B7553" stroke-width="1.6">
                        <circle cx="9" cy="8" r="3.2"/>
                        <path d="M3.5 19c0-3.5 2.5-5.5 5.5-5.5s5.5 2 5.5 5.5"/>
                        <circle cx="17" cy="9" r="2.4"/>
                        <path d="M15.5 13.2c2.2.2 3.8 2 3.8 4.6"/>
                    </svg>
                </div>
                <h3 class="font-display text-lg mb-2" style="color:#2B211D;">Untuk Rombongan</h3>
                <p class="text-sm" style="color:#8A7B6C;">Dari makan berdua sampai acara keluarga besar, kami sesuaikan meja dengan jumlah tamumu.</p>
            </div>
        </div>
    </section>

    <footer class="border-t" style="border-color:#E8DFD1;">
        <div class="max-w-6xl mx-auto px-6 py-8 text-center">
            <p class="font-mono text-xs" style="color:#B0A28F;">&copy; {{ date('Y') }} Pagi Malam — Sistem Reservasi Restoran</p>
        </div>
    </footer>

</body>
</html>