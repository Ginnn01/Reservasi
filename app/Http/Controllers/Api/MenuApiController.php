<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;

class MenuApiController extends Controller
{
    public function index()
    {
        $menus = Menu::where('is_available', true)->get();
        return MenuResource::collection($menus);
    }
}