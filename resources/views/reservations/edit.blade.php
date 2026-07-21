<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Reservasi</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Meja</label>
                        <select name="table_id" class="mt-1 block w-full rounded border-gray-300">
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}" {{ old('table_id', $reservation->table_id) == $table->id ? 'selected' : '' }}>
                                    {{ $table->table_number }} — kapasitas {{ $table->capacity }} orang ({{ $table->location }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input type="time" name="start_time" value="{{ old('start_time', substr($reservation->start_time, 0, 5)) }}" class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                        <input type="number" name="guest_count" value="{{ old('guest_count', $reservation->guest_count) }}" min="1" class="mt-1 block w-full rounded border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catatan (opsional)</label>
                        <textarea name="notes" class="mt-1 block w-full rounded border-gray-300">{{ old('notes', $reservation->notes) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Update</button>
                        <a href="{{ route('reservations.index') }}" class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>