<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('category')->orderBy('name')->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string', 'max:255'],
            'price'        => ['required', 'numeric', 'min:0'],
            'category'     => ['required', 'in:makanan,minuman,dessert'],
            'is_available' => ['required', 'boolean'],
        ]);

        Menu::create($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:100'],
            'description'  => ['nullable', 'string', 'max:255'],
            'price'        => ['required', 'numeric', 'min:0'],
            'category'     => ['required', 'in:makanan,minuman,dessert'],
            'is_available' => ['required', 'boolean'],
        ]);

        $menu->update($validated);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}