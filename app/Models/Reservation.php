<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    public const DEFAULT_DURATION_MINUTES = 120;

    protected $fillable = [
        'user_id',
        'table_id',
        'reservation_date',
        'start_time',
        'end_time',
        'guest_count',
        'notes',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public static function calculateEndTime(string $startTime): string
    {
        return \Carbon\Carbon::createFromFormat('H:i', $startTime)
            ->addMinutes(self::DEFAULT_DURATION_MINUTES)
            ->format('H:i');
    }
}