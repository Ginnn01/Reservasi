<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReservationsExport;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    private function getFilteredReservations(Request $request)
    {
        $query = Reservation::with(['user', 'table'])
            ->orderBy('reservation_date')
            ->orderBy('start_time');

        if ($request->filled('date_from')) {
            $query->whereDate('reservation_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('reservation_date', '<=', $request->date_to);
        }

        return $query->get();
    }

    public function exportPdf(Request $request)
    {
        $reservations = $this->getFilteredReservations($request);

        $pdf = Pdf::loadView('admin.reports.reservations-pdf', compact('reservations'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-reservasi-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $reservations = $this->getFilteredReservations($request);

        return Excel::download(
            new ReservationsExport($reservations),
            'laporan-reservasi-' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}