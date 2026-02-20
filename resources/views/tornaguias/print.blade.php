<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Tornaguia</title>
    <style>
        @page {
            size: legal;
            margin: 4mm;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }
        .actions {
            margin-bottom: 6mm;
        }
        .btn {
            border: 1px solid #000;
            padding: 6px 10px;
            background: #f5f5f5;
            cursor: pointer;
            text-decoration: none;
            color: #000;
            font-size: 12px;
        }
        .page {
            display: block;
        }
        .copy-label {
            text-align: right;
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 1mm;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 2mm 0;
        }
        .copy {
            min-height: 165mm;
        }
        .sheet {
            border: 1px solid #000;
            padding: 2.5mm;
        }
        .header-block {
            display: grid;
            grid-template-columns: 44px 1fr 44px;
            gap: 3mm;
            align-items: center;
            margin-bottom: 2mm;
        }
        .crest {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }
        .header {
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            line-height: 1.1;
            margin: 0;
        }
        .subheader {
            text-align: center;
            font-size: 9.5px;
            line-height: 1.1;
            margin: 1mm 0 0 0;
        }
        .tornaguia-title {
            text-align: center;
            color: red;
            font-weight: 800;
            font-size: 13px;
            margin-top: 1mm;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2mm;
            margin-bottom: 2mm;
        }
        .block {
            border: 1px solid #000;
            padding: 1.4mm;
        }
        .stack {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1mm;
        }
        .field {
            border: 1px solid #000;
            padding: 1mm;
            min-height: 3.5mm;
        }
        .label {
            font-weight: bold;
        }
        .signatures {
            margin-top: 2mm;
            padding-top: 2mm;
            font-size: 10px;
        }
        .sign-date {
            text-align: right;
            margin-bottom: 14mm;
            font-weight: bold;
        }
        .sign-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6mm;
            align-items: end;
        }
        .sign-col {
            text-align: center;
        }
        .sign-line {
            margin-bottom: 3mm;
            border-top: 1px dotted #000;
        }
        .sign-title {
            font-weight: bold;
            font-size: 9.5px;
            text-transform: uppercase;
        }
        .seals {
            text-align: center;
            margin-top: 2mm;
            font-weight: bold;
            font-size: 10px;
        }
        @media print {
            .actions { display: none; }
        }
    </style>
</head>
<body>

<div class="actions">
    <button class="btn" onclick="window.print()">Imprimir</button>
    <a class="btn" href="{{ route('tornaguias.edit', $tornaguia->id) }}">Editar</a>
    <a class="btn" href="{{ route('tornaguias.index') }}">Volver</a>
</div>

@php
    $fechaFmt = $tornaguia->fecha ? \Carbon\Carbon::parse($tornaguia->fecha)->locale('es')->translatedFormat('d \\d\\e F Y') : '';
@endphp

<div class="page">
    <div class="copy">
        <div class="copy-label">ORIGINAL</div>
        <div class="sheet">
            <div class="header-block">
                <img class="crest" src="{{ asset('img/tornaguia.jpeg') }}" alt="Escudo izquierdo">
                <div>
                    <div class="header">COOPERATIVA MINERA "PACOCOLLO" R.L.</div>
                    <div class="subheader">AFILIADO A LA FEDERACION DPTAL. DE COOP. MINERAS DE ORURO</div>
                    <div class="subheader">PRODUCTORES: PLATA, PLOMO, ZINC, COBRE</div>
                    <div class="subheader">PERSONERIA JURIDICA N° 054/08 NIT: 187472029</div>
                    <div class="subheader">SALINAS - ORURO - BOLIVIA</div>
                    <div class="tornaguia-title">TORNAGUIA N {{ $tornaguia->id }}</div>
                </div>
                <img class="crest" src="{{ asset('img/tornaguia.jpeg') }}" alt="Escudo derecho">
            </div>

            <div class="grid">
                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Fecha:</span> {{ $fechaFmt }}</div>
                        <div class="field"><span class="label">Departamento:</span> {{ $tornaguia->departamento }}</div>
                        <div class="field"><span class="label">Centro Minero:</span> {{ $tornaguia->centro_minero }}</div>
                        <div class="field"><span class="label">Yacimiento:</span> {{ $tornaguia->yacimiento }}</div>
                        <div class="field"><span class="label">Tranca de Salida:</span> {{ $tornaguia->tranca_de_salida }}</div>
                    </div>
                </div>

                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Propietario de Mineral:</span> {{ $tornaguia->propietario_mineral }}</div>
                        <div class="field"><span class="label">Cooperativa Minera:</span> {{ $tornaguia->empresa_cooperativa }}</div>
                        <div class="field"><span class="label">Comprador:</span> {{ $tornaguia->comprador }}</div>
                        <div class="field"><span class="label">Destino:</span> {{ $tornaguia->destino }}</div>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div>
                    <div class="block">
                        <div class="stack">
                            <div class="field"><span class="label">Medio de Transporte:</span> {{ optional($tornaguia->vehicle)->medio_transporte }}</div>
                            <div class="field"><span class="label">Marca:</span> {{ optional($tornaguia->vehicle)->marca }}</div>
                            <div class="field"><span class="label">Color:</span> {{ optional($tornaguia->vehicle)->color }}</div>
                            <div class="field"><span class="label">Placa:</span> {{ optional($tornaguia->vehicle)->placa }}</div>
                        </div>
                    </div>
                    <div class="block" style="margin-top: 2mm;">
                        <div class="stack">
                            <div class="field"><span class="label">Nombre de Chofer:</span> {{ optional($tornaguia->driver)->nombre }}</div>
                            <div class="field"><span class="label">C.I.:</span> {{ optional($tornaguia->driver)->ci }}</div>
                            <div class="field"><span class="label">Lic. Conductor:</span> {{ optional($tornaguia->driver)->licencia }}</div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Tipo de Mineral:</span> {{ $tornaguia->tipo_de_mineral }}</div>
                        <div class="field"><span class="label">Minerales:</span> {{ $tornaguia->minerales }}</div>
                        <div class="field"><span class="label">Peso (Kg):</span> {{ $tornaguia->peso_kg }}</div>
                        <div class="field"><span class="label">Cantidad:</span> {{ $tornaguia->cantidad }}</div>
                        <div class="field"><span class="label">Nro Lote:</span> {{ $tornaguia->nro_lote }}</div>
                    </div>
                </div>
            </div>
            <div class="signatures">
                <div class="sign-date">Fecha: {{ $fechaFmt }}</div> 
                <br>
                <div class="sign-row">
                    <div class="sign-col">
                        <div class="sign-line"></div>
                        <div class="sign-title">DIRIGENTE DEL CONSEJO DE ADMINISTRACION</div>
                    </div>
                    <div class="sign-col">
                        <div class="sign-line"></div>
                        <div class="sign-title">DIRIGENTE DEL CONSEJO DE VIGILANCIA QUE AUTORIZA</div>
                    </div>
                </div>
                <div class="seals">SELLOS DE AMBAS INSTITUCIONES</div>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <div class="copy">
        <div class="copy-label">COPIA</div>
        <div class="sheet">
            <div class="header-block">
                <img class="crest" src="{{ asset('img/tornaguia.jpeg') }}" alt="Escudo izquierdo">
                <div>
                    <div class="header">COOPERATIVA MINERA "PACOCOLLO" R.L.</div>
                    <div class="subheader">AFILIADO A LA FEDERACION DPTAL. DE COOP. MINERAS DE ORURO</div>
                    <div class="subheader">PRODUCTORES: PLATA, PLOMO, ZINC, COBRE</div>
                    <div class="subheader">PERSONERIA JURIDICA N° 054/08 NIT: 187472029</div>
                    <div class="subheader">SALINAS - ORURO - BOLIVIA</div>
                    <div class="tornaguia-title">TORNAGUIA N {{ $tornaguia->id }}</div>
                </div>
                <img class="crest" src="{{ asset('img/tornaguia.jpeg') }}" alt="Escudo derecho">
            </div>

            <div class="grid">
                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Fecha:</span> {{ $fechaFmt }}</div>
                        <div class="field"><span class="label">Departamento:</span> {{ $tornaguia->departamento }}</div>
                        <div class="field"><span class="label">Centro Minero:</span> {{ $tornaguia->centro_minero }}</div>
                        <div class="field"><span class="label">Yacimiento:</span> {{ $tornaguia->yacimiento }}</div>
                        <div class="field"><span class="label">Tranca de Salida:</span> {{ $tornaguia->tranca_de_salida }}</div>
                    </div>
                </div>

                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Propietario de Mineral:</span> {{ $tornaguia->propietario_mineral }}</div>
                        <div class="field"><span class="label">Cooperativa Minera:</span> {{ $tornaguia->empresa_cooperativa }}</div>
                        <div class="field"><span class="label">Comprador:</span> {{ $tornaguia->comprador }}</div>
                        <div class="field"><span class="label">Destino:</span> {{ $tornaguia->destino }}</div>
                    </div>
                </div>
            </div>

            <div class="grid">
                <div>
                    <div class="block">
                        <div class="stack">
                            <div class="field"><span class="label">Medio de Transporte:</span> {{ optional($tornaguia->vehicle)->medio_transporte }}</div>
                            <div class="field"><span class="label">Marca:</span> {{ optional($tornaguia->vehicle)->marca }}</div>
                            <div class="field"><span class="label">Color:</span> {{ optional($tornaguia->vehicle)->color }}</div>
                            <div class="field"><span class="label">Placa:</span> {{ optional($tornaguia->vehicle)->placa }}</div>
                        </div>
                    </div>
                    <div class="block" style="margin-top: 2mm;">
                        <div class="stack">
                            <div class="field"><span class="label">Nombre de Chofer:</span> {{ optional($tornaguia->driver)->nombre }}</div>
                            <div class="field"><span class="label">C.I.:</span> {{ optional($tornaguia->driver)->ci }}</div>
                            <div class="field"><span class="label">Lic. Conductor:</span> {{ optional($tornaguia->driver)->licencia }}</div>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <div class="stack">
                        <div class="field"><span class="label">Tipo de Mineral:</span> {{ $tornaguia->tipo_de_mineral }}</div>
                        <div class="field"><span class="label">Minerales:</span> {{ $tornaguia->minerales }}</div>
                        <div class="field"><span class="label">Peso (Kg):</span> {{ $tornaguia->peso_kg }}</div>
                        <div class="field"><span class="label">Cantidad:</span> {{ $tornaguia->cantidad }}</div>
                        <div class="field"><span class="label">Nro Lote:</span> {{ $tornaguia->nro_lote }}</div>
                    </div>
                </div>
            </div>

            <div class="signatures">
                <div class="sign-date">Fecha: {{ $fechaFmt }}</div>
                <br>
                <div class="sign-row">
                    <div class="sign-col">
                        <div class="sign-line"></div>
                        <div class="sign-title">DIRIGENTE DEL CONSEJO DE ADMINISTRACION</div>
                    </div>
                    <div class="sign-col">
                        <div class="sign-line"></div>
                        <div class="sign-title">DIRIGENTE DEL CONSEJO DE VIGILANCIA QUE AUTORIZA</div>
                    </div>
                </div>
                <div class="seals">SELLOS DE AMBAS INSTITUCIONES</div>
            </div>
        </div>
    </div>
</div>

@if(request()->boolean('auto'))
<script>
    window.addEventListener('load', function() {
        window.print();
    });
    window.addEventListener('afterprint', function() {
        if (!@json(request()->boolean('embedded'))) {
            try { window.close(); } catch (e) {}
        }
    });
</script>
@endif

</body>
</html>