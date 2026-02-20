<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Editar Tornaguia') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <form method="POST" action="{{ route('tornaguias.update', $tornaguia->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="text-sm text-slate-500">Edicion de registro</div>
                        <div class="text-lg font-semibold text-slate-900 mb-6">COOPERATIVA MINERA "PACOCOLLO" R.L. - TORNAGUIA {{ $tornaguia->id }}</div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Fecha</label>
                                    <input type="date" name="fecha" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('fecha', $tornaguia->fecha) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Departamento</label>
                                    <input type="text" name="departamento" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('departamento', $tornaguia->departamento) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Centro Minero</label>
                                    <input type="text" name="centro_minero" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('centro_minero', $tornaguia->centro_minero) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Yacimiento</label>
                                    <input type="text" name="yacimiento" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('yacimiento', $tornaguia->yacimiento) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Tranca de Salida</label>
                                    <input type="text" name="tranca_de_salida" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('tranca_de_salida', $tornaguia->tranca_de_salida) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Placa del Vehiculo</label>
                                    <select id="placa" name="placa" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                                        <option value="">Selecciona una placa</option>
                                        @foreach($vehicles as $vehicle)
                                            <option
                                                value="{{ $vehicle->placa }}"
                                                data-medio="{{ $vehicle->medio_transporte }}"
                                                data-marca="{{ $vehicle->marca }}"
                                                data-color="{{ $vehicle->color }}"
                                                @selected(old('placa', optional($tornaguia->vehicle)->placa) === $vehicle->placa)
                                            >
                                                {{ $vehicle->placa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Medio de Transporte</label>
                                    <input type="text" id="medio_transporte" class="w-full px-3 py-2 border border-slate-300 rounded-md bg-slate-100" value="{{ old('medio_transporte', optional($tornaguia->vehicle)->medio_transporte) }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Marca</label>
                                    <input type="text" id="marca" class="w-full px-3 py-2 border border-slate-300 rounded-md bg-slate-100" value="{{ old('marca', optional($tornaguia->vehicle)->marca) }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Color</label>
                                    <input type="text" id="color" class="w-full px-3 py-2 border border-slate-300 rounded-md bg-slate-100" value="{{ old('color', optional($tornaguia->vehicle)->color) }}" readonly>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Licencia del Conductor</label>
                                    <select id="licencia_conductor" name="licencia_conductor" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                                        <option value="">Selecciona una licencia</option>
                                        @foreach($drivers as $driver)
                                            <option
                                                value="{{ $driver->licencia }}"
                                                data-nombre="{{ $driver->nombre }}"
                                                data-ci="{{ $driver->ci }}"
                                                @selected(old('licencia_conductor', optional($tornaguia->driver)->licencia) === $driver->licencia)
                                            >
                                                {{ $driver->licencia }} - {{ $driver->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Nombre del Chofer</label>
                                    <input type="text" id="nombre_chofer" class="w-full px-3 py-2 border border-slate-300 rounded-md bg-slate-100" value="{{ old('nombre_chofer', optional($tornaguia->driver)->nombre) }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">C.I.</label>
                                    <input type="text" id="ci_chofer" class="w-full px-3 py-2 border border-slate-300 rounded-md bg-slate-100" value="{{ old('ci_chofer', optional($tornaguia->driver)->ci) }}" readonly>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Propietario del Mineral</label>
                                    <input type="text" name="propietario_mineral" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('propietario_mineral', $tornaguia->propietario_mineral) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Empresa/Cooperativa</label>
                                    <input type="text" name="empresa_cooperativa" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('empresa_cooperativa', $tornaguia->empresa_cooperativa) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Comprador</label>
                                    <input type="text" name="comprador" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('comprador', $tornaguia->comprador) }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Destino</label>
                                    <input type="text" name="destino" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('destino', $tornaguia->destino) }}">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                            <div>
                                <label class="block text-sm font-medium mb-1">Tipo de Mineral</label>
                                <input type="text" name="tipo_de_mineral" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('tipo_de_mineral', $tornaguia->tipo_de_mineral) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Minerales</label>
                                <input type="text" name="minerales" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('minerales', $tornaguia->minerales) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Peso (Kg)</label>
                                <input type="number" step="0.01" name="peso_kg" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('peso_kg', $tornaguia->peso_kg) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Cantidad</label>
                                <input type="number" name="cantidad" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('cantidad', $tornaguia->cantidad) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Nro Lote</label>
                                <input type="text" name="nro_lote" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('nro_lote', $tornaguia->nro_lote) }}">
                            </div>
                        </div>

                        <div class="flex justify-end gap-4 mt-6">
                            <a href="{{ route('tornaguias.index') }}" class="px-4 py-2 bg-slate-200 text-slate-900 rounded-md hover:bg-slate-300">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md hover:bg-slate-800">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const placaSelect = document.getElementById('placa');
        const licSelect = document.getElementById('licencia_conductor');

        function aplicarVehiculo() {
            const opt = placaSelect.options[placaSelect.selectedIndex];
            document.getElementById('medio_transporte').value = opt?.dataset?.medio || '';
            document.getElementById('marca').value = opt?.dataset?.marca || '';
            document.getElementById('color').value = opt?.dataset?.color || '';
        }

        function aplicarChofer() {
            const opt = licSelect.options[licSelect.selectedIndex];
            document.getElementById('nombre_chofer').value = opt?.dataset?.nombre || '';
            document.getElementById('ci_chofer').value = opt?.dataset?.ci || '';
        }

        placaSelect.addEventListener('change', aplicarVehiculo);
        licSelect.addEventListener('change', aplicarChofer);

        aplicarVehiculo();
        aplicarChofer();
    </script>
</x-app-layout>
