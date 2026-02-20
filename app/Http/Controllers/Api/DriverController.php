<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;

class DriverController extends Controller
{
    public function show($licencia)
    {
        $d = Driver::where('licencia', $licencia)->first();
        if(!$d) return response()->json(null, 404);
        return response()->json($d);
    }
}
