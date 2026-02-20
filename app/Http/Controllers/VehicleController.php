<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::orderBy('placa')->paginate(20);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'placa' => 'required|string|unique:vehicles,placa',
            'medio_transporte' => 'nullable|string',
            'marca' => 'nullable|string',
            'color' => 'nullable|string',
            'modelo' => 'nullable|string',
        ]);

        Vehicle::create($data);

        return redirect()->route('vehicles.index');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'placa' => 'required|string|unique:vehicles,placa,' . $vehicle->id,
            'medio_transporte' => 'nullable|string',
            'marca' => 'nullable|string',
            'color' => 'nullable|string',
            'modelo' => 'nullable|string',
        ]);

        $vehicle->update($data);

        return redirect()->route('vehicles.index');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles.index');
    }
}
