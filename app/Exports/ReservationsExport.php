<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReservationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $reservations;

    public function __construct($reservations)
    {
        $this->reservations = $reservations;
    }

    public function collection()
    {
        return $this->reservations;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'Meja',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Jumlah Tamu',
            'Status',
            'Catatan',
        ];
    }

    public function map($reservation): array
    {
        return [
            $reservation->id,
            $reservation->user->name,
            $reservation->table->table_number,
            $reservation->reservation_date->format('d-m-Y'),
            substr($reservation->start_time, 0, 5),
            substr($reservation->end_time, 0, 5),
            $reservation->guest_count,
            ucfirst($reservation->status),
            $reservation->notes ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}