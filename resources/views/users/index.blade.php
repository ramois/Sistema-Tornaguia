<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="text-lg font-semibold text-slate-900">Listado de Usuarios</div>
                            <div class="text-sm text-slate-500">Gestion de accesos</div>
                        </div>
                        <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">Nuevo Usuario</a>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-slate-200">
                                    <th class="py-2">Nombre</th>
                                    <th class="py-2">Email</th>
                                    <th class="py-2">Rol</th>
                                    <th class="py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr class="border-b border-slate-100">
                                        <td class="py-2">{{ $u->name }}</td>
                                        <td class="py-2">{{ $u->email }}</td>
                                        <td class="py-2">{{ $u->role }}</td>
                                        <td class="py-2">
                                            <div class="flex flex-wrap gap-2">
                                                <a class="text-amber-700 hover:underline" href="{{ route('users.edit', $u->id) }}">Editar</a>
                                                <form method="POST" action="{{ route('users.destroy', $u->id) }}" onsubmit="return confirm('Eliminar usuario?')">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
