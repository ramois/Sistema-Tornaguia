<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium mb-1">Nombre</label>
                            <input type="text" name="name" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('name', $user->name) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input type="email" name="email" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200" value="{{ old('email', $user->email) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Rol</label>
                            <select name="role" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="admin" @selected(old('role', $user->role) === 'admin')>admin</option>
                                <option value="operador" @selected(old('role', $user->role) === 'operador')>operador</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Password (opcional)</label>
                            <input type="password" name="password" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Confirmar Password</label>
                            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-4 mt-2">
                            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-slate-200 text-slate-900 rounded-md hover:bg-slate-300">Cancelar</a>
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md hover:bg-slate-800">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
