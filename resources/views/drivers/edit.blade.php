<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Editar Chofer') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <form method="POST" action="{{ route('drivers.update', $driver->id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium mb-1">Licencia</label>
                            <input type="text" name="licencia" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('licencia', $driver->licencia) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Nombre</label>
                            <input type="text" name="nombre" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('nombre', $driver->nombre) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">C.I.</label>
                            <input type="text" name="ci" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('ci', $driver->ci) }}">
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-4 mt-2">
                            <a href="{{ route('drivers.index') }}" class="px-4 py-2 bg-slate-200 text-slate-900 rounded-md hover:bg-slate-300">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md hover:bg-slate-800">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
