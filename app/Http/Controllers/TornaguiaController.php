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
            'yacimiento' => 'nullable|string',
            'tranca_de_salida' => 'nullable|string',
            'placa' => 'required|string|exists:vehicles,placa',
            'licencia_conductor' => 'required|string|exists:drivers,licencia',
            'propietario_mineral' => 'nullable|string',
            'empresa_cooperativa' => 'nullable|string',
            'comprador' => 'nullable|string',
            'destino' => 'nullable|string',
            'tipo_de_mineral' => 'nullable',
            'minerales' => 'nullable|string',
            'otro_nombre' => 'nullable|string',
            'otro_sigla' => 'nullable|string',
            'peso_kg' => 'nullable|numeric',
            'cantidad' => 'nullable|integer',
            'nro_lote' => 'nullable|string',
        ]);
        $data['departamento'] = 'ORURO';
        $data['centro_minero'] = 'ORURO';
        $data = $this->normalizeMinerales($request, $data);

        $vehicle = Vehicle::where('placa', $data['placa'])->first();
        $driver = Driver::where('licencia', $data['licencia_conductor'])->first();

        if (!$vehicle || !$driver) {
            return back()
                ->withErrors(['placa' => 'Vehículo o chofer no encontrado.'])
                ->withInput();
        }

        $t = Tornaguia::create([
            'fecha' => $data['fecha'] ?? null,
            'departamento' => $data['departamento'],
            'centro_minero' => $data['centro_minero'],
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
            'yacimiento' => 'nullable|string',
            'tranca_de_salida' => 'nullable|string',
            'placa' => 'required|string|exists:vehicles,placa',
            'licencia_conductor' => 'required|string|exists:drivers,licencia',
            'propietario_mineral' => 'nullable|string',
            'empresa_cooperativa' => 'nullable|string',
            'comprador' => 'nullable|string',
            'destino' => 'nullable|string',
            'tipo_de_mineral' => 'nullable',
            'minerales' => 'nullable|string',
            'otro_nombre' => 'nullable|string',
            'otro_sigla' => 'nullable|string',
            'peso_kg' => 'nullable|numeric',
            'cantidad' => 'nullable|integer',
            'nro_lote' => 'nullable|string',
        ]);
        $data['departamento'] = 'ORURO';
        $data['centro_minero'] = 'ORURO';
        $data = $this->normalizeMinerales($request, $data);

        $vehicle = Vehicle::where('placa', $data['placa'])->first();
        $driver = Driver::where('licencia', $data['licencia_conductor'])->first();

        if (!$vehicle || !$driver) {
            return back()
                ->withErrors(['placa' => 'Vehículo o chofer no encontrado.'])
                ->withInput();
        }

        $tornaguia->update([
            'fecha' => $data['fecha'] ?? null,
            'departamento' => $data['departamento'],
            'centro_minero' => $data['centro_minero'],
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

    private function normalizeMinerales(Request $request, array $data): array
    {
        $tipo = $request->input('tipo_de_mineral');
        $tipoList = [];
        if (is_array($tipo)) {
            $tipoList = array_values(array_filter(array_map('trim', $tipo)));
        } elseif (is_string($tipo) && $tipo !== '') {
            $tipoList = array_values(array_filter(array_map('trim', explode(',', $tipo))));
        }

        if ($tipoList) {
            $map = [
                'plata' => 'Ag',
                'zinc' => 'Zn',
                'plomo' => 'Pb',
                'cobre' => 'Cu',
                'bismuto' => 'Bi',
                'estaño' => 'Sn',
                'oro' => 'Au',
                'wolfran' => 'W',
            ];
            $tipoList = array_values(array_filter($tipoList, function ($item) {
                return mb_strtolower($item) !== 'otros';
            }));
            $abbr = [];
            foreach ($tipoList as $item) {
                $key = mb_strtolower($item);
                if (isset($map[$key])) {
                    $abbr[] = $map[$key];
                }
            }
            $otroNombre = trim((string) $request->input('otro_nombre', ''));
            $otroSigla = trim((string) $request->input('otro_sigla', ''));
            if ($otroNombre !== '') {
                $tipoList[] = $otroNombre;
            }
            if ($otroSigla !== '') {
                $abbr[] = $otroSigla;
            }

            $data['tipo_de_mineral'] = $tipoList ? implode(', ', $tipoList) : null;
            $data['minerales'] = $abbr ? implode(', ', $abbr) : null;
        }

        return $data;
    }
}
