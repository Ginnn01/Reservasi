<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'table' => [
                'id' => $this->table->id,
                'table_number' => $this->table->table_number,
            ],
            'reservation_date' => $this->reservation_date->format('Y-m-d'),
            'start_time' => substr($this->start_time, 0, 5),
            'end_time' => substr($this->end_time, 0, 5),
            'guest_count' => $this->guest_count,
            'status' => $this->status,
            'notes' => $this->notes,
        ];
    }
}