<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pagi Malam') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Work Sans', sans-serif; background-color: #FBF8F3; }
        .font-display { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .font-mono { font-family: 'IBM Plex Mono', monospace; }

        .guest-card {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 16px 16px 4px 4px;
            overflow: hidden;
        }
        .guest-card-top { height: 5px; background-color: #6E2A3B; }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10" style="background-color:#FBF8F3;">

        <a href="/" class="flex items-center gap-2 mb-8">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.8">
                <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
            </svg>
            <span class="font-display text-2xl" style="color:#2B211D;">Pagi Malam</span>
        </a>

        <div class="w-full sm:max-w-md guest-card shadow-sm">
            <div class="guest-card-top"></div>
            <div class="p-6 sm:p-8">
                {{ $slot }}
            </div>  
        </div>

        <p class="font-mono text-xs mt-6" style="color:#B0A28F;">&copy; {{ date('Y') }} Pagi Malam</p>
    </div>
</body>
</html>