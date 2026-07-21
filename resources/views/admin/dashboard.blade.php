<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Admin</h2>
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
        .bistro-perforation {
            border-bottom: 2px dashed #D9CBB4;
            margin: 0 24px;
        }
        #chartEmptyState {
            position: absolute;
            inset: 0;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            pointer-events: none;
        }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="flex items-baseline justify-between flex-wrap gap-2">
                <div>
                    <p class="bistro-font-mono text-xs tracking-widest uppercase" style="color:#B08D5A;">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                    <h1 class="bistro-font-display text-3xl mt-1" style="color:#2B211D;">
                        Ringkasan Operasional
                    </h1>
                </div>
                <p class="bistro-font-body text-sm" style="color:#8A7B6C;">
                    Diperbarui setiap kali halaman dimuat
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                <div class="bistro-ticket shadow-sm">
                    <div class="bistro-ticket-top" style="background-color:#6E2A3B;"></div>
                    <div class="px-6 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bistro-font-mono text-[11px] tracking-widest uppercase" style="color:#8A7B6C;">Hari Ini</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6E2A3B" stroke-width="1.6">
                                <path d="M8 2v4M16 2v4M3 9h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                            </svg>
                        </div>
                        <p class="bistro-font-body text-sm mb-1" style="color:#5C4E42;">Reservasi Hari Ini</p>
                        <p class="bistro-font-mono text-4xl font-semibold mb-5" style="color:#6E2A3B;">
                            {{ str_pad($totalReservationsToday, 2, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div class="bistro-perforation"></div>
                    <div class="py-3"></div>
                </div>

                <div class="bistro-ticket shadow-sm">
                    <div class="bistro-ticket-top" style="background-color:#C9932E;"></div>
                    <div class="px-6 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bistro-font-mono text-[11px] tracking-widest uppercase" style="color:#8A7B6C;">Kapasitas</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C9932E" stroke-width="1.6">
                                <rect x="3" y="7" width="18" height="11" rx="2"/>
                                <path d="M7 7V5a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2"/>
                            </svg>
                        </div>
                        <p class="bistro-font-body text-sm mb-1" style="color:#5C4E42;">Meja Aktif</p>
                        <p class="bistro-font-mono text-4xl font-semibold mb-5" style="color:#C9932E;">
                            {{ str_pad($totalActiveTables, 2, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div class="bistro-perforation"></div>
                    <div class="py-3"></div>
                </div>

                <div class="bistro-ticket shadow-sm">
                    <div class="bistro-ticket-top" style="background-color:#5B7553;"></div>
                    <div class="px-6 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bistro-font-mono text-[11px] tracking-widest uppercase" style="color:#8A7B6C;">Terdaftar</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#5B7553" stroke-width="1.6">
                                <circle cx="9" cy="8" r="3.2"/>
                                <path d="M3.5 19c0-3.5 2.5-5.5 5.5-5.5s5.5 2 5.5 5.5"/>
                                <circle cx="17" cy="9" r="2.4"/>
                                <path d="M15.5 13.2c2.2.2 3.8 2 3.8 4.6"/>
                            </svg>
                        </div>
                        <p class="bistro-font-body text-sm mb-1" style="color:#5C4E42;">Total Pelanggan</p>
                        <p class="bistro-font-mono text-4xl font-semibold mb-5" style="color:#5B7553;">
                            {{ str_pad($totalUsers, 2, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div class="bistro-perforation"></div>
                    <div class="py-3"></div>
                </div>

            </div>

            <div class="bistro-ticket shadow-sm">
                <div class="bistro-ticket-top" style="background-color:#2B211D;"></div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="bistro-font-display text-xl" style="color:#2B211D;">Reservasi 7 Hari Terakhir</h3>
                        <span class="bistro-font-mono text-[11px] tracking-widest uppercase px-2 py-1 rounded" style="color:#6E2A3B; background:#F3E8DB;">
                            Total: {{ array_sum($chartData) }}
                        </span>
                    </div>
                    <p class="bistro-font-body text-sm mb-5" style="color:#8A7B6C;">Jumlah reservasi yang masuk per hari</p>

                    <div style="position: relative; min-height: 260px;">
                        <canvas id="reservationChart" height="90"></canvas>
                        <div id="chartEmptyState">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#D9CBB4" stroke-width="1.5">
                                <path d="M3 3v18h18"/>
                                <path d="M7 15l4-4 3 3 5-6"/>
                            </svg>
                            <p class="bistro-font-body text-sm mt-2" style="color:#B0A28F;">Belum ada reservasi pada rentang ini</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <script>
        const canvasEl = document.getElementById('reservationChart');
        const ctx = canvasEl.getContext('2d');
        const chartData = {!! json_encode($chartData) !!};
        const chartLabels = {!! json_encode($chartLabels) !!};

        if (chartData.every(v => v === 0)) {
            document.getElementById('chartEmptyState').style.display = 'flex';
        }

        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, '#6E2A3B');
        gradient.addColorStop(1, '#B08D5A');

        const dataLabelPlugin = {
            id: 'dataLabel',
            afterDatasetsDraw(chart) {
                const { ctx, data } = chart;
                chart.getDatasetMeta(0).data.forEach((bar, index) => {
                    const value = data.datasets[0].data[index];
                    if (value > 0) {
                        ctx.save();
                        ctx.font = "600 12px 'IBM Plex Mono', monospace";
                        ctx.fillStyle = '#2B211D';
                        ctx.textAlign = 'center';
                        ctx.fillText(value, bar.x, bar.y - 8);
                        ctx.restore();
                    }
                });
            }
        };

        new Chart(canvasEl, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Reservasi',
                    data: chartData,
                    backgroundColor: gradient,
                    hoverBackgroundColor: '#C9932E',
                    borderRadius: 8,
                    maxBarThickness: 44,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                layout: { padding: { top: 20 } },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#2B211D',
                        titleFont: { family: 'IBM Plex Mono', size: 11 },
                        bodyFont: { family: 'Work Sans', size: 13 },
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false,
                        callbacks: {
                            label: (item) => `${item.parsed.y} reservasi`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { family: 'IBM Plex Mono', size: 11 }, color: '#8A7B6C' },
                        grid: { color: '#EFE6D8' }
                    },
                    x: {
                        ticks: { font: { family: 'IBM Plex Mono', size: 11 }, color: '#8A7B6C' },
                        grid: { display: false }
                    }
                }
            },
            plugins: [dataLabelPlugin]
        });
    </script>
    @endpush
</x-app-layout>