<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::orderBy('table_number')->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'table_number' => ['required', 'string', 'max:20', 'unique:tables,table_number'],
            'capacity'     => ['required', 'integer', 'min:1', 'max:50'],
            'location'     => ['required', 'in:indoor,outdoor'],
            'status'       => ['required', 'in:active,inactive'],
        ]);

        RestaurantTable::create($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function edit(RestaurantTable $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    public function update(Request $request, RestaurantTable $table)
    {
        $validated = $request->validate([
            'table_number' => ['required', 'string', 'max:20', 'unique:tables,table_number,' . $table->id],
            'capacity'     => ['required', 'integer', 'min:1', 'max:50'],
            'location'     => ['required', 'in:indoor,outdoor'],
            'status'       => ['required', 'in:active,inactive'],
        ]);

        $table->update($validated);

        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(RestaurantTable $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Meja berhasil dihapus.');
    }
}