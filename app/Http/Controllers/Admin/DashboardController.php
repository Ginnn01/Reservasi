<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik ringkas
        $totalReservationsToday = Reservation::whereDate('reservation_date', Carbon::today())->count();
        $totalActiveTables = RestaurantTable::where('status', 'active')->count();
        $totalUsers = User::where('role', 'user')->count();

        // Data grafik: jumlah reservasi per hari, 7 hari terakhir
        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartLabels[] = $date->translatedFormat('d M');
            $chartData[] = Reservation::whereDate('reservation_date', $date)->count();
        }

        return view('admin.dashboard', compact(
            'totalReservationsToday',
            'totalActiveTables',
            'totalUsers',
            'chartLabels',
            'chartData'
        ));
    }
}