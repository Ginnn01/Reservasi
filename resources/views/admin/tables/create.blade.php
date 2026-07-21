<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Meja</h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Work+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

    <style>
        .bistro-font-display { font-family: 'Fraunces', serif; font-optical-sizing: auto; }
        .bistro-font-mono { font-family: 'IBM Plex Mono', monospace; }
        .bistro-font-body { font-family: 'Work Sans', sans-serif; }

        .bistro-ticket {
            background: #FFFDF9;
            border: 1px solid #E8DFD1;
            border-radius: 14px 14px 4px 4px;
            overflow: hidden;
        }
        .bistro-ticket-top { height: 5px; background-color: #6E2A3B; }

        .bistro-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #8A7B6C;
            display: block;
            margin-bottom: 6px;
        }
        .bistro-field {
            font-family: 'Work Sans', sans-serif;
            width: 100%;
            border: 1px solid #E8DFD1;
            border-radius: 8px;
            padding: 0.65rem 0.9rem;
            background: #FFFFFF;
            color: #2B211D;
        }
        .bistro-field:focus { outline: none; border-color: #6E2A3B; }

        .bistro-btn-primary {
            font-family: 'Work Sans', sans-serif;
            font-weight: 600;
            background-color: #6E2A3B;
            color: #FBF8F3;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
        }
        .bistro-btn-primary:hover { background-color: #59212F; }
        .bistro-btn-secondary {
            font-family: 'Work Sans', sans-serif;
            font-weight: 600;
            background-color: #EDE8E2;
            color: #5C4E42;
            padding: 0.65rem 1.4rem;
            border-radius: 8px;
        }
        .bistro-btn-secondary:hover { background-color: #E2DAD0; }
    </style>

    <div class="py-8" style="background-color: #FBF8F3; min-height: calc(100vh - 65px);">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <p class="bistro-font-mono text-xs tracking-widest uppercase mb-1" style="color:#B08D5A;">Panel Admin</p>
            <h1 class="bistro-font-display text-3xl mb-6" style="color:#2B211D;">Tambah Meja Baru</h1>

            <div class="bistro-ticket shadow-sm">
                <div class="bistro-ticket-top"></div>
                <div class="p-6">
                    <form action="{{ route('admin.tables.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="bistro-label">Nomor Meja</label>
                            <input type="text" name="table_number" value="{{ old('table_number') }}" class="bistro-field" placeholder="Contoh: A1">
                            @error('table_number') <p class="text-sm mt-1" style="color:#8C332B;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="bistro-label">Kapasitas (orang)</label>
                            <input type="number" name="capacity" value="{{ old('capacity') }}" class="bistro-field" placeholder="Contoh: 4">
                            @error('capacity') <p class="text-sm mt-1" style="color:#8C332B;">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="bistro-label">Lokasi</label>
                            <select name="location" class="bistro-field">
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>

                        <div>
                            <label class="bistro-label">Status</label>
                            <select name="status" class="bistro-field">
                                <option value="active">Aktif</option>
                                <option value="inactive">Nonaktif</option>
                            </select>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="bistro-btn-primary">Simpan</button>
                            <a href="{{ route('admin.tables.index') }}" class="bistro-btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>