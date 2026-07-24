<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Reservasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #2B211D; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        p.subtitle { color: #666; margin-top: 0; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background-color: #6E2A3B; color: #fff; }
        tr:nth-child(even) { background-color: #f7f3ec; }
        .footer { margin-top: 20px; font-size: 10px; color: #888; }
    </style>
</head>
<body>
    <h1>Laporan Reservasi — Pagi Malam</h1>
    <p class="subtitle">Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Pelanggan</th>
                <th>Meja</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tamu</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->table->table_number }}</td>
                    <td>{{ $r->reservation_date->format('d-m-Y') }}</td>
                    <td>{{ substr($r->start_time, 0, 5) }} - {{ substr($r->end_time, 0, 5) }}</td>
                    <td>{{ $r->guest_count }}</td>
                    <td>{{ ucfirst($r->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;">Tidak ada data reservasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Total data: {{ $reservations->count() }} reservasi</p>
</body>
</html>