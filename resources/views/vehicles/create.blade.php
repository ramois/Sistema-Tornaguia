<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Nuevo Vehiculo') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <form method="POST" action="{{ route('vehicles.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium mb-1">Placa</label>
                            <input type="text" name="placa" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('placa') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Medio de Transporte</label>
                            <input type="text" name="medio_transporte" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('medio_transporte') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Marca</label>
                            <input type="text" name="marca" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('marca') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Color</label>
                            <input type="text" name="color" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('color') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Modelo</label>
                            <input type="text" name="modelo" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('modelo') }}">
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-4 mt-2">
                            <a href="{{ route('vehicles.index') }}" class="px-4 py-2 bg-slate-200 text-slate-900 rounded-md hover:bg-slate-300">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md hover:bg-slate-800">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
