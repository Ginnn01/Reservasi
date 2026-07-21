<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $table = 'tables';

    protected $fillable = [
        'table_number',
        'capacity',
        'location',
        'status',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }

    public function isAvailable(string $date, string $startTime, string $endTime, ?int $excludeReservationId = null): bool
{
    $query = $this->reservations()
    ->whereDate('reservation_date', $date)
    ->whereIn('status', ['pending', 'confirmed'])
    ->where('start_time', '<', $endTime)
    ->where('end_time', '>', $startTime);

    if ($excludeReservationId) {
        $query->where('id', '!=', $excludeReservationId);
    }

    return $query->doesntExist();
}
}