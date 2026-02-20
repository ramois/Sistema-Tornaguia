<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::orderBy('nombre')->paginate(20);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'licencia' => 'required|string|unique:drivers,licencia',
            'nombre' => 'nullable|string',
            'ci' => 'nullable|string',
        ]);

        Driver::create($data);

        return redirect()->route('drivers.index');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'licencia' => 'required|string|unique:drivers,licencia,' . $driver->id,
            'nombre' => 'nullable|string',
            'ci' => 'nullable|string',
        ]);

        $driver->update($data);

        return redirect()->route('drivers.index');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index');
    }
}
