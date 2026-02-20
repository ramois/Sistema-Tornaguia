@php
    $role = auth()->user()->role ?? null;
@endphp

<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur border-b border-slate-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="h-9 w-9 rounded-xl bg-slate-900 text-white flex items-center justify-center text-sm font-bold">PC</div>
                    <div class="leading-tight">
                        <div class="text-sm font-semibold text-slate-900">PACOCOLLO</div>
                        <div class="text-xs text-slate-500">Sistema de Tornaguías</div>
                    </div>
                </a>

                <div class="hidden sm:flex items-center gap-1">
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('tornaguias.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tornaguias.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Tornaguías
                    </a>
                    <a href="{{ route('vehicles.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('vehicles.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Vehículos
                    </a>
                    <a href="{{ route('drivers.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('drivers.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Choferes
                    </a>
                    @if($role === 'admin')
                        <a href="{{ route('users.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('users.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                            Usuarios
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-3">
                <div class="text-xs px-3 py-1 rounded-full bg-amber-100 text-amber-800 border border-amber-200">
                    Rol: {{ $role ?? 'usuario' }}
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600 bg-white hover:text-slate-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 focus:text-slate-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Dashboard</a>
            <a href="{{ route('tornaguias.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('tornaguias.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Tornaguías</a>
            <a href="{{ route('vehicles.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('vehicles.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Vehículos</a>
            <a href="{{ route('drivers.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('drivers.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Choferes</a>
            @if($role === 'admin')
                <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('users.*') ? 'bg-slate-900 text-white' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">Usuarios</a>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-slate-200">
            <div class="px-4">
                <div class="font-medium text-base text-slate-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
