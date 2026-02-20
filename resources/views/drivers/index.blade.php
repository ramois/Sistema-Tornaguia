<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Choferes') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="text-lg font-semibold text-slate-900">Listado de Choferes</div>
                            <div class="text-sm text-slate-500">Registro de licencias</div>
                        </div>
                        <a href="{{ route('drivers.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">Nuevo Chofer</a>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-slate-200">
                                    <th class="py-2">Licencia</th>
                                    <th class="py-2">Nombre</th>
                                    <th class="py-2">C.I.</th>
                                    <th class="py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drivers as $d)
                                    <tr class="border-b border-slate-100">
                                        <td class="py-2">{{ $d->licencia }}</td>
                                        <td class="py-2">{{ $d->nombre }}</td>
                                        <td class="py-2">{{ $d->ci }}</td>
                                        <td class="py-2">
                                            <div class="flex flex-wrap gap-2">
                                                <a class="text-amber-700 hover:underline" href="{{ route('drivers.edit', $d->id) }}">Editar</a>
                                                <form method="POST" action="{{ route('drivers.destroy', $d->id) }}" onsubmit="return confirm('Eliminar chofer?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-red-600 hover:underline" type="submit">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $drivers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
