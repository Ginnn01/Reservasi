<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'table']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('reservation_date', $request->date);
        }

        $reservations = $query
            ->orderByDesc('reservation_date')
            ->orderByDesc('start_time')
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function confirm(Reservation $reservation)
    {
        $reservation->update(['status' => 'confirmed']);
        return back()->with('success', 'Reservasi dikonfirmasi.');
    }

    public function reject(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservasi ditolak.');
    }

    public function complete(Reservation $reservation)
    {
        $reservation->update(['status' => 'completed']);
        return back()->with('success', 'Reservasi ditandai selesai.');
    }
}