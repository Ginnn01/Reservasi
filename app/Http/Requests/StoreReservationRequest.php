<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'table_id'         => ['required', 'exists:tables,id'],
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time'       => ['required', 'date_format:H:i'],
            'guest_count'      => ['required', 'integer', 'min:1'],
            'notes'            => ['nullable', 'string', 'max:255'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $tableId = $this->input('table_id');
            $date = $this->input('reservation_date');
            $startTime = $this->input('start_time');

            if (!$tableId || !$date || !$startTime) {
                return;
            }

            $table = RestaurantTable::find($tableId);
            if (!$table) {
                return;
            }

            if ($this->input('guest_count') > $table->capacity) {
                $validator->errors()->add(
                    'guest_count',
                    "Jumlah tamu melebihi kapasitas meja ({$table->capacity} orang)."
                );
                return;
            }

            $endTime = Reservation::calculateEndTime($startTime);
            $excludeId = $this->route('reservation')?->id;

            if (!$table->isAvailable($date, $startTime, $endTime, $excludeId)) {
                $validator->errors()->add(
                    'start_time',
                    'Meja sudah dipesan pada rentang jam tersebut. Silakan pilih jam lain atau meja lain.'
                );
            }
        });
    }
}