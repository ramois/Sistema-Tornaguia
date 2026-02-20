<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Tornaguias') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white/80 backdrop-blur border border-slate-200 shadow-sm">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <div class="text-lg font-semibold text-slate-900">Listado de Tornaguias</div>
                            <div class="text-sm text-slate-500">Gestion y seguimiento de registros</div>
                        </div>
                        <a href="{{ route('tornaguias.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800">Nueva Tornaguia</a>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b border-slate-200">
                                    <th class="py-2">ID</th>
                                    <th class="py-2">Fecha</th>
                                    <th class="py-2">Placa</th>
                                    <th class="py-2">Chofer</th>
                                    <th class="py-2">Destino</th>
                                    <th class="py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tornaguias as $t)
                                    <tr class="border-b border-slate-100">
                                        <td class="py-2">{{ $t->id }}</td>
                                        <td class="py-2">{{ $t->fecha }}</td>
                                        <td class="py-2">{{ optional($t->vehicle)->placa }}</td>
                                        <td class="py-2">{{ optional($t->driver)->nombre }}</td>
                                        <td class="py-2">{{ $t->destino }}</td>
                                        <td class="py-2">
                                            <div class="flex flex-wrap gap-2">
                                                <a
                                                    class="text-slate-900 hover:underline js-ver-tornaguia"
                                                    href="{{ route('tornaguias.show', $t->id) }}"
                                                    data-url="{{ route('tornaguias.show', $t->id) }}"
                                                    title="Ver detalles"
                                                >
                                                    Ver
                                                </a>
                                                <a class="text-amber-700 hover:underline" href="{{ route('tornaguias.edit', $t->id) }}">Editar</a>
                                                <form method="POST" action="{{ route('tornaguias.destroy', $t->id) }}" onsubmit="return confirm('Eliminar tornaguia?')">
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
                        {{ $tornaguias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="ver-tornaguia" maxWidth="2xl" focusable>
        <div id="tornaguia-modal-content" class="p-0">
            <div class="p-6 text-center text-slate-500">Cargando...</div>
        </div>
    </x-modal>

    <script>
        (function() {
            if (window._tornaguiaVerHandlerAttached) return;
            window._tornaguiaVerHandlerAttached = true;

            function handleVerClick(e) {
                const a = e.target.closest('a.js-ver-tornaguia');
                if (!a) return;
                if (e.button && e.button !== 0) return;
                if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
                if (e.defaultPrevented) return;

                e.preventDefault();
                const href = a.dataset.url || a.getAttribute('href');
                if (!href) return;

                const fetchUrl = href + (href.includes('?') ? '&' : '?') + 'modal=1';
                fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' }, credentials: 'same-origin' })
                    .then(function(response) {
                        if (!response.ok) {
                            window.location.href = href;
                            throw new Error('HTTP ' + response.status);
                        }
                        return response.text();
                    })
                    .then(function(html) {
                        if (html.indexOf('data-partial="true"') === -1) {
                            window.location.href = href;
                            return;
                        }
                        const container = document.getElementById('tornaguia-modal-content');
                        if (!container) return;
                        container.innerHTML = html;
                        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'ver-tornaguia' }));
                    })
                    .catch(function() {
                        window.location.href = href;
                    });
            }

            document.addEventListener('click', handleVerClick, false);

            window.printTornaguia = function(btn) {
                if (!btn || !btn.dataset) return;
                const baseUrl = btn.dataset.printUrl;
                if (!baseUrl) return;
                const url = baseUrl + (baseUrl.includes('?') ? '&' : '?') + 'auto=1&embedded=1';

                const frame = document.createElement('iframe');
                frame.style.position = 'fixed';
                frame.style.right = '0';
                frame.style.bottom = '0';
                frame.style.width = '0';
                frame.style.height = '0';
                frame.style.border = '0';
                frame.style.opacity = '0';
                frame.setAttribute('aria-hidden', 'true');
                frame.src = url;

                frame.onload = function() {
                    try {
                        frame.contentWindow.focus();
                        frame.contentWindow.print();
                    } catch (e) {
                        const w = window.open(baseUrl, '_blank');
                        if (!w) window.location.href = baseUrl;
                    }
                    setTimeout(function() { frame.remove(); }, 1000);
                };

                document.body.appendChild(frame);
            };
        })();
    </script>
</x-app-layout>
