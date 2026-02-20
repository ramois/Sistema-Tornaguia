<?php

namespace App\Http\Controllers;

use App\Models\Tornaguia;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TornaguiaController extends Controller
{
    public function index()
    {
        $tornaguias = Tornaguia::with(['vehicle', 'driver'])->latest()->paginate(20);
        return view('tornaguias.index', compact('tornaguias'));
    }

    public function create()
    {
        $vehicles = Vehicle::orderBy('placa')->get(['placa', 'medio_transporte', 'marca', 'color']);
        $drivers = Driver::orderBy('licencia')->get(['licencia', 'nombre', 'ci']);
        return view('tornaguias.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha' => 'nullable|date',
            'departamento' => 'nullable|string',
            'centro_minero' => 'nullable|string',
            'yacimiento' => 'nullable|string',
            'tranca_de_salida' => 'nullable|string',
            'placa' => 'required|string|exists:vehicles,placa',
            'licencia_conductor' => 'required|string|exists:drivers,licencia',
            'propietario_mineral' => 'nullable|string',
            'empresa_cooperativa' => 'nullable|string',
            'comprador' => 'nullable|string',
            'destino' => 'nullable|string',
            'tipo_de_mineral' => 'nullable|string',
            'minerales' => 'nullable|string',
            'peso_kg' => 'nullable|numeric',
            'cantidad' => 'nullable|integer',
            'nro_lote' => 'nullable|string',
        ]);

        $vehicle = Vehicle::where('placa', $data['placa'])->first();
        $driver = Driver::where('licencia', $data['licencia_conductor'])->first();

        if (!$vehicle || !$driver) {
            return back()
                ->withErrors(['placa' => 'Vehículo o chofer no encontrado.'])
                ->withInput();
        }

        $t = Tornaguia::create([
            'fecha' => $data['fecha'] ?? null,
            'departamento' => $data['departamento'] ?? null,
            'centro_minero' => $data['centro_minero'] ?? null,
            'yacimiento' => $data['yacimiento'] ?? null,
            'tranca_de_salida' => $data['tranca_de_salida'] ?? null,
            'propietario_mineral' => $data['propietario_mineral'] ?? null,
            'empresa_cooperativa' => $data['empresa_cooperativa'] ?? null,
            'comprador' => $data['comprador'] ?? null,
            'destino' => $data['destino'] ?? null,
            'tipo_de_mineral' => $data['tipo_de_mineral'] ?? null,
            'minerales' => $data['minerales'] ?? null,
            'peso_kg' => $data['peso_kg'] ?? null,
            'cantidad' => $data['cantidad'] ?? null,
            'nro_lote' => $data['nro_lote'] ?? null,
            'vehicle_id' => $vehicle->id,
            'driver_id' => $driver->id,
        ]);

        return redirect()->route('tornaguias.show', $t->id);
    }

    public function show(Request $request, Tornaguia $tornaguia)
    {
        $tornaguia->load(['vehicle', 'driver']);
        if ($request->boolean('modal')) {
            return view('tornaguias.partials.show-modal', compact('tornaguia'));
        }
        return view('tornaguias.show', compact('tornaguia'));
    }

    public function print(Tornaguia $tornaguia)
    {
        $tornaguia->load(['vehicle', 'driver']);
        return view('tornaguias.print', compact('tornaguia'));
    }

    public function edit(Tornaguia $tornaguia)
    {
        $tornaguia->load(['vehicle', 'driver']);
        $vehicles = Vehicle::orderBy('placa')->get(['placa', 'medio_transporte', 'marca', 'color']);
        $drivers = Driver::orderBy('licencia')->get(['licencia', 'nombre', 'ci']);
        return view('tornaguias.edit', compact('tornaguia', 'vehicles', 'drivers'));
    }

    public function update(Request $request, Tornaguia $tornaguia)
    {
        $data = $request->validate([
            'fecha' => 'nullable|date',
            'departamento' => 'nullable|string',
            'centro_minero' => 'nullable|string',
            'yacimiento' => 'nullable|string',
            'tranca_de_salida' => 'nullable|string',
            'placa' => 'required|string|exists:vehicles,placa',
            'licencia_conductor' => 'required|string|exists:drivers,licencia',
            'propietario_mineral' => 'nullable|string',
            'empresa_cooperativa' => 'nullable|string',
            'comprador' => 'nullable|string',
            'destino' => 'nullable|string',
            'tipo_de_mineral' => 'nullable|string',
            'minerales' => 'nullable|string',
            'peso_kg' => 'nullable|numeric',
            'cantidad' => 'nullable|integer',
            'nro_lote' => 'nullable|string',
        ]);

        $vehicle = Vehicle::where('placa', $data['placa'])->first();
        $driver = Driver::where('licencia', $data['licencia_conductor'])->first();

        if (!$vehicle || !$driver) {
            return back()
                ->withErrors(['placa' => 'Vehículo o chofer no encontrado.'])
                ->withInput();
        }

        $tornaguia->update([
            'fecha' => $data['fecha'] ?? null,
            'departamento' => $data['departamento'] ?? null,
            'centro_minero' => $data['centro_minero'] ?? null,
            'yacimiento' => $data['yacimiento'] ?? null,
            'tranca_de_salida' => $data['tranca_de_salida'] ?? null,
            'propietario_mineral' => $data['propietario_mineral'] ?? null,
            'empresa_cooperativa' => $data['empresa_cooperativa'] ?? null,
            'comprador' => $data['comprador'] ?? null,
            'destino' => $data['destino'] ?? null,
            'tipo_de_mineral' => $data['tipo_de_mineral'] ?? null,
            'minerales' => $data['minerales'] ?? null,
            'peso_kg' => $data['peso_kg'] ?? null,
            'cantidad' => $data['cantidad'] ?? null,
            'nro_lote' => $data['nro_lote'] ?? null,
            'vehicle_id' => $vehicle->id,
            'driver_id' => $driver->id,
        ]);

        return redirect()->route('tornaguias.show', $tornaguia->id);
    }

    public function destroy(Tornaguia $tornaguia)
    {
        $tornaguia->delete();
        return redirect()->route('tornaguias.index');
    }
}
