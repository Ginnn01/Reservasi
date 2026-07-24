<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TableResource;
use App\Models\RestaurantTable;

class TableApiController extends Controller
{
    public function index()
    {
        $tables = RestaurantTable::where('status', 'active')->get();
        return TableResource::collection($tables);
    }
}