<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="rounded-2xl bg-slate-900 text-white p-6 md:p-8 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-xs uppercase tracking-widest text-amber-200">Sistema de Tornaguías</div>
                                <h3 class="text-2xl md:text-3xl font-semibold mt-2">Bienvenido, {{ Auth::user()->name }}</h3>
                                <p class="text-slate-300 mt-2 max-w-xl">Gestiona tornaguías, vehículos y choferes desde un solo lugar. Mantén los datos ordenados y disponibles para el equipo.</p>
                            </div>
                            <div class="hidden md:block">
                                <div class="h-16 w-16 rounded-2xl bg-amber-200/10 border border-amber-200/30 flex items-center justify-center">
                                    <div class="text-amber-200 text-xl font-bold">PC</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ route('tornaguias.create') }}" class="px-4 py-2 bg-amber-300 text-slate-900 rounded-lg font-semibold hover:bg-amber-200">Nueva Tornaguía</a>
                            <a href="{{ route('tornaguias.index') }}" class="px-4 py-2 bg-white/10 text-white rounded-lg hover:bg-white/20">Ver Tornaguías</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-4">
                            <div class="text-xs text-slate-500">Tornaguías</div>
                            <div class="text-2xl font-semibold text-slate-900 mt-1">{{ $counts['tornaguias'] }}</div>
                            <div class="text-xs text-slate-500 mt-2">Total registradas</div>
                        </div>
                        <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-4">
                            <div class="text-xs text-slate-500">Vehículos</div>
                            <div class="text-2xl font-semibold text-slate-900 mt-1">{{ $counts['vehicles'] }}</div>
                            <div class="text-xs text-slate-500 mt-2">Placas activas</div>
                        </div>
                        <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-4">
                            <div class="text-xs text-slate-500">Choferes</div>
                            <div class="text-2xl font-semibold text-slate-900 mt-1">{{ $counts['drivers'] }}</div>
                            <div class="text-xs text-slate-500 mt-2">Licencias registradas</div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-5">
                        <div class="text-sm font-semibold text-slate-900">Accesos rápidos</div>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('vehicles.index') }}" class="block px-3 py-2 rounded-lg bg-slate-100 text-slate-800 hover:bg-slate-200">Gestionar vehículos</a>
                            <a href="{{ route('drivers.index') }}" class="block px-3 py-2 rounded-lg bg-slate-100 text-slate-800 hover:bg-slate-200">Gestionar choferes</a>
                            <a href="{{ route('tornaguias.index') }}" class="block px-3 py-2 rounded-lg bg-slate-100 text-slate-800 hover:bg-slate-200">Ver tornaguías</a>
                            @if(isset($counts['users']) && $counts['users'] !== null)
                                <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg bg-slate-100 text-slate-800 hover:bg-slate-200">Administrar usuarios</a>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-5">
                        <div class="text-sm font-semibold text-slate-900">Resumen de usuarios</div>
                        <div class="mt-3 text-3xl font-semibold text-slate-900">
                            {{ $counts['users'] ?? '—' }}
                        </div>
                        <div class="text-xs text-slate-500 mt-2">Solo visible para administradores</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 rounded-2xl bg-white/80 backdrop-blur border border-slate-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-slate-900">Navegabilidad rápida</div>
                    </div>
                    <div class="text-xs text-slate-500">Actualizado: {{ now()->format('d/m/Y') }}</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    <a href="{{ route('tornaguias.index') }}" class="rounded-xl border border-slate-200 bg-gradient-to-br from-white to-amber-50 p-4 hover:shadow">
                        <div class="text-sm font-semibold text-slate-900">Tornaguías</div>
                        <div class="text-xs text-slate-500 mt-1">Crear, editar y consultar</div>
                    </a>
                    <a href="{{ route('vehicles.index') }}" class="rounded-xl border border-slate-200 bg-gradient-to-br from-white to-emerald-50 p-4 hover:shadow">
                        <div class="text-sm font-semibold text-slate-900">Vehículos</div>
                        <div class="text-xs text-slate-500 mt-1">Catálogo de placas</div>
                    </a>
                    <a href="{{ route('drivers.index') }}" class="rounded-xl border border-slate-200 bg-gradient-to-br from-white to-sky-50 p-4 hover:shadow">
                        <div class="text-sm font-semibold text-slate-900">Choferes</div>
                        <div class="text-xs text-slate-500 mt-1">Licencias y C.I.</div>
                    </a>
                    @if(isset($counts['users']) && $counts['users'] !== null)
                        <a href="{{ route('users.index') }}" class="rounded-xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-4 hover:shadow">
                            <div class="text-sm font-semibold text-slate-900">Usuarios</div>
                            <div class="text-xs text-slate-500 mt-1">Roles y accesos</div>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
