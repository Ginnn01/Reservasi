<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reservasi Saya</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
            @endif

            <div class="mb-4">
                <a href="{{ route('reservations.create') }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    + Buat Reservasi
                </a>
            </div>

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Meja</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tanggal</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Jam</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Tamu</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($reservations as $r)
                            <tr>
                                <td class="px-4 py-2">{{ $r->table->table_number }}</td>
                                <td class="px-4 py-2">{{ $r->reservation_date->format('d-m-Y') }}</td>
                                <td class="px-4 py-2">{{ substr($r->start_time, 0, 5) }} - {{ substr($r->end_time, 0, 5) }}</td>
                                <td class="px-4 py-2">{{ $r->guest_count }} orang</td>
                                <td class="px-4 py-2">
                                    @php
                                        $badge = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'confirmed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                            'completed' => 'bg-gray-200 text-gray-600',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-xs rounded {{ $badge[$r->status] }}">{{ $r->status }}</span>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    @if ($r->status === 'pending')
                                        <a href="{{ route('reservations.edit', $r) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('reservations.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Yakin batalkan reservasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Batalkan</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada reservasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $reservations->links() }}</div>

        </div>
    </div>
</x-app-layout>