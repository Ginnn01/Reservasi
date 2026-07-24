<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class ReservationApiController extends Controller
{
    // GET /api/reservations — reservasi milik user yang login
    public function index(Request $request)
    {
        $reservations = Reservation::with('table')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('reservation_date')
            ->get();

        return ReservationResource::collection($reservations);
    }

    // POST /api/reservations — buat reservasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required', 'exists:tables,id'],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'guest_count' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $table = RestaurantTable::findOrFail($validated['table_id']);
        $endTime = Reservation::calculateEndTime($validated['start_time']);

        if ($validated['guest_count'] > $table->capacity) {
            return response()->json([
                'message' => "Jumlah tamu melebihi kapasitas meja ({$table->capacity} orang).",
            ], 422);
        }

        if (!$table->isAvailable($validated['reservation_date'], $validated['start_time'], $endTime)) {
            return response()->json([
                'message' => 'Meja sudah dipesan pada rentang jam tersebut.',
            ], 422);
        }

        $reservation = Reservation::create([
            'user_id' => $request->user()->id,
            'table_id' => $validated['table_id'],
            'reservation_date' => $validated['reservation_date'],
            'start_time' => $validated['start_time'],
            'end_time' => $endTime,
            'guest_count' => $validated['guest_count'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return new ReservationResource($reservation->load('table'));
    }

    // GET /api/reservations/{id} — detail satu reservasi
    public function show(Request $request, Reservation $reservation)
    {
        abort_unless($reservation->user_id === $request->user()->id, 403);

        return new ReservationResource($reservation->load('table'));
    }
}