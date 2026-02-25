<div id="tornaguia-modal" data-partial="true" class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <div class="text-xs text-slate-500">COOPERATIVA MINERA "PACOCOLLO" R.L.</div>
            <div class="text-lg font-semibold text-slate-900">Tornaguia {{ $tornaguia->id }}</div>
            <div class="text-xs text-slate-500 mt-1">Fecha: {{ $tornaguia->fecha }}</div>
        </div>
        <div class="flex flex-wrap gap-2">
            <button
                type="button"
                class="px-4 py-2 bg-slate-900 text-white rounded-md hover:bg-slate-800"
                data-print-url="{{ route('tornaguias.print', $tornaguia->id) }}"
                onclick="window.printTornaguia(this)"
            >
                Imprimir
            </button>
            <a href="{{ route('tornaguias.edit', $tornaguia->id) }}" class="px-4 py-2 bg-amber-200 text-amber-900 rounded-md hover:bg-amber-300">Editar</a>
            <button
                type="button"
                class="px-4 py-2 bg-slate-200 text-slate-900 rounded-md hover:bg-slate-300"
                onclick="window.dispatchEvent(new CustomEvent('close-modal', { detail: 'ver-tornaguia' }))"
            >
                Cerrar
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-900 mb-2">Datos generales</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-slate-700">
                    <div><strong>Departamento:</strong> {{ $tornaguia->departamento ?? 'ORURO' }}</div>
                    <div><strong>Centro Minero:</strong> {{ $tornaguia->centro_minero ?? 'ORURO' }}</div>
                    <div><strong>Yacimiento:</strong> {{ $tornaguia->yacimiento }}</div>
                    <div><strong>Tranca de Salida:</strong> {{ $tornaguia->tranca_de_salida }}</div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-900 mb-2">Operacion</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-slate-700">
                    <div><strong>Propietario:</strong> {{ $tornaguia->propietario_mineral }}</div>
                    <div><strong>Empresa/Cooperativa:</strong> {{ $tornaguia->empresa_cooperativa }}</div>
                    <div><strong>Comprador:</strong> {{ $tornaguia->comprador }}</div>
                    <div><strong>Destino:</strong> {{ $tornaguia->destino }}</div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-900 mb-2">Mineral</div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-slate-700">
                    <div><strong>Tipo de Mineral:</strong> {{ $tornaguia->tipo_de_mineral }}</div>
                    <div><strong>Minerales:</strong> {{ $tornaguia->minerales }}</div>
                    <div><strong>Presentación:</strong> Broza</div>
                    <div><strong>Peso (Kg):</strong> {{ $tornaguia->peso_kg }}</div>
                    <div><strong>Cantidad:</strong> {{ $tornaguia->cantidad }}</div>
                    <div><strong>Nro Lote:</strong> {{ $tornaguia->nro_lote }}</div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-xl border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-900 mb-2">Vehiculo</div>
                <div class="text-sm text-slate-700 space-y-1">
                    <div><strong>Medio:</strong> {{ optional($tornaguia->vehicle)->medio_transporte }}</div>
                    <div><strong>Placa:</strong> {{ optional($tornaguia->vehicle)->placa }}</div>
                    <div><strong>Marca:</strong> {{ optional($tornaguia->vehicle)->marca }}</div>
                    <div><strong>Color:</strong> {{ optional($tornaguia->vehicle)->color }}</div>
                </div>
            </div>

            <div class="rounded-xl border border-slate-200 p-4">
                <div class="text-sm font-semibold text-slate-900 mb-2">Chofer</div>
                <div class="text-sm text-slate-700 space-y-1">
                    <div><strong>Nombre:</strong> {{ optional($tornaguia->driver)->nombre }}</div>
                    <div><strong>C.I.:</strong> {{ optional($tornaguia->driver)->ci }}</div>
                    <div><strong>Licencia:</strong> {{ optional($tornaguia->driver)->licencia }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
