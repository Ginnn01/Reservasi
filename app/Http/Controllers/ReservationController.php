<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('table')
            ->where('user_id', Auth::id())
            ->orderByDesc('reservation_date')
            ->orderByDesc('start_time')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $tables = RestaurantTable::where('status', 'active')->get();
        return view('reservations.create', compact('tables'));
    }

    public function store(StoreReservationRequest $request)
    {
        $endTime = Reservation::calculateEndTime($request->start_time);

        Reservation::create([
            'user_id'          => Auth::id(),
            'table_id'         => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'start_time'       => $request->start_time,
            'end_time'         => $endTime,
            'guest_count'      => $request->guest_count,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservasi berhasil dibuat. Menunggu konfirmasi admin.');
    }

    public function edit(Reservation $reservation)
    {
        $this->authorizeOwner($reservation);

        $tables = RestaurantTable::where('status', 'active')->get();
        return view('reservations.edit', compact('reservation', 'tables'));
    }

    public function update(StoreReservationRequest $request, Reservation $reservation)
    {
        $this->authorizeOwner($reservation);

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Reservasi yang sudah dikonfirmasi tidak bisa diubah.');
        }

        $endTime = Reservation::calculateEndTime($request->start_time);

        $reservation->update([
            'table_id'         => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'start_time'       => $request->start_time,
            'end_time'         => $endTime,
            'guest_count'      => $request->guest_count,
            'notes'            => $request->notes,
        ]);

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservasi berhasil diperbarui.');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorizeOwner($reservation);

        if ($reservation->status === 'confirmed') {
            return back()->with('error', 'Reservasi yang sudah dikonfirmasi tidak bisa dibatalkan sendiri. Hubungi admin.');
        }

        $reservation->delete();

        return redirect()
            ->route('reservations.index')
            ->with('success', 'Reservasi dibatalkan.');
    }

    private function authorizeOwner(Reservation $reservation): void
    {
        abort_unless($reservation->user_id === Auth::id(), 403);
    }
}