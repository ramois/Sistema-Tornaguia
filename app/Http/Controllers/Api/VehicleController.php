<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function show($placa)
    {
        $v = Vehicle::where('placa', $placa)->first();
        if(!$v) return response()->json(null, 404);
        return response()->json($v);
    }
}
