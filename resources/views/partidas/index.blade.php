@extends('plantillas.app')
@section('titulo', 'Partidas - sistema metrados')

@section('contenido')
@php
$q = request('q');
$item = request('item');
$descripcion = request('descripcion');
$unidad = request('unidad_medida');
$creadoPor = request('responsable_id');
$fechaInicio = request('fecha_inicio');
$fechaFin = request('fecha_fin');
$estado = request('estado');
@endphp

<style>
    .page-title {
        font-weight: 700;
    }

    .btn-square {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .table thead th {
        font-weight: 700;
        color: #0f172a;
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
    }

    .table tbody td,
    .table tbody th {
        border-color: #eef2f7;
    }

    .chip {
        border: 1px solid rgba(13, 110, 253, .25);
        background: rgba(13, 110, 253, .06);
        color: #0b5ed7;
        border-radius: 999px;
        padding: .25rem .6rem;
        font-size: .82rem;
    }

    .chip-danger {
        border-color: rgba(220, 53, 69, .25);
        background: rgba(220, 53, 69, .06);
        color: #b02a37;
    }

    .subtle {
        color: #64748b;
    }

</style>

<div class="row gx-3">
    <div class="col-xxl-12">

        {{-- HEADER --}}
        <div class="card mb-3">
            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                    <div>
                        <div class="page-title fs-4">Lista de Partidas</div>
                        <div class="subtle">Gestión de partidas con filtros rápidos y acciones.</div>
                    </div>

                    <div class="d-flex gap-2">
                        {{-- espacio para botones si quieres --}}
                    </div>
                </div>

                {{-- FORM FILTROS --}}
                <form method="GET" action="{{ url()->current() }}" id="filtrosForm">
                    <div class="row g-2 align-items-center">

                        @php
                        $obraUsuarioId = auth()->user()?->obras()->first()?->id;
                        $obraSeleccionadaId = request('obra_id', $obraUsuarioId);
                        @endphp

                        <div class="col-12 col-md-3">
                            <select class="form-select" name="obra_id" onchange="this.form.submit()">
                                @foreach ($obras as $obra)
                                <option value="{{ $obra->id }}" @selected((string)$obraSeleccionadaId===(string)$obra->id)>
                                    {{ $obra->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-9">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div style="max-width: 420px; width:100%;">
                                    <div class="input-group shadow-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>

                                        <input type="text" class="form-control border-start-0" name="q" value="{{ $q }}" placeholder="Buscar por item o descripción…">

                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-search me-1"></i> Buscar
                                        </button>

                                        @if($q)
                                        <a href="{{ url()->current() }}" class="input-group-text bg-white text-danger border-start-0">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-primary btn-sm btn-square" title="Acceso / Seguridad">
                                        <i class="fs-3 bi bi-lock"></i>
                                    </button>

                                    <button type="button" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1" data-bs-toggle="collapse" data-bs-target="#filtrosAvanzados">
                                        <i class="bi bi-funnel"></i>
                                        Filtros
                                    </button>

                                    <a href="#" class="btn btn-success d-flex align-items-center gap-1">
                                        <i class="bi bi-plus-lg"></i>
                                        Nueva Partida
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Filtros avanzados --}}
                        <div class="col-12">
                            <div class="collapse mt-2" id="filtrosAvanzados">
                                <div class="row g-2 p-3 rounded-3" style="background:#f8fafc; border:1px solid #eef2f7;">

                                    <div class="col-12 col-md-2">
                                        <label class="form-label mb-1">Unidad</label>
                                        <select class="form-select" name="unidad_medida">
                                            <option value="">Todas</option>
                                            @php $unidades = ['m','m2','m3','kg','und','mes','glb']; @endphp
                                            @foreach($unidades as $u)
                                            <option value="{{ $u }}" @selected($unidad===$u)>{{ $u }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-label mb-1">Creado por</label>
                                        <select class="form-select" name="responsable_id">
                                            <option value="">Todos</option>
                                            @foreach(($responsables ?? []) as $r)
                                            <option value="{{ $r->id }}" @selected((string)$creadoPor===(string)$r->id)>
                                                {{ $r->nombres }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-label mb-1">Desde</label>
                                        <input type="date" class="form-control" name="fecha_inicio" value="{{ $fechaInicio }}">
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-label mb-1">Hasta</label>
                                        <input type="date" class="form-control" name="fecha_fin" value="{{ $fechaFin }}">
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="form-label mb-1">Estado</label>
                                        <select class="form-select" name="estado">
                                            <option value="">Todos</option>
                                            <option value="1" @selected($estado==="1" )>Activo</option>
                                            <option value="0" @selected($estado==="0" )>Anulado</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-2 d-flex align-items-end justify-content-end gap-2">
                                        <a class="btn btn-outline-secondary" href="{{ url()->current() }}">
                                            <i class="bi bi-x-circle me-1"></i> Limpiar
                                        </a>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-funnel me-1"></i> Aplicar
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </form>

                {{-- Chips filtros activos --}}
                @php
                $chips = [];
                if($q) $chips[] = ['t'=>"Buscar: {$q}", 'c'=>'chip'];
                if($item) $chips[] = ['t'=>"Item: {$item}", 'c'=>'chip'];
                if($descripcion) $chips[] = ['t'=>"Desc: {$descripcion}", 'c'=>'chip'];
                if($unidad) $chips[] = ['t'=>"UM: {$unidad}", 'c'=>'chip'];
                if($creadoPor) {
                $nombreR = optional(($responsables ?? collect())->firstWhere('id', (int)$creadoPor))->nombres;
                $chips[] = ['t'=>"Creado: ".($nombreR ?: $creadoPor), 'c'=>'chip'];
                }
                if($fechaInicio) $chips[] = ['t'=>"Desde: {$fechaInicio}", 'c'=>'chip'];
                if($fechaFin) $chips[] = ['t'=>"Hasta: {$fechaFin}", 'c'=>'chip'];
                if($estado !== null && $estado !== '') {
                $chips[] = ['t'=>"Estado: ".($estado=='1'?'Activo':'Anulado'), 'c'=> $estado=='1' ? 'chip' : 'chip chip-danger'];
                }
                @endphp

                @if(count($chips))
                <div class="mt-3 d-flex flex-wrap gap-2">
                    @foreach($chips as $ch)
                    <span class="{{ $ch['c'] }}">{{ $ch['t'] }}</span>
                    @endforeach
                </div>
                @endif

            </div>
        </div>

        {{-- TABLA --}}
        <div class="card mb-3">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-2">
                    <div class="text-muted">
                        Mostrando <strong>{{ $partidas->firstItem() ?? 0 }}</strong> - <strong>{{ $partidas->lastItem() ?? 0 }}</strong>
                        de <strong>{{ $partidas->total() }}</strong>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <span class="subtle">Por página</span>
                        <select class="form-select form-select-sm" style="width:120px" onchange="const url=new URL(window.location);
                                url.searchParams.set('per_page', this.value);
                                url.searchParams.set('page', 1);
                                window.location=url.toString();">
                            @php $pp = (int)request('per_page', 10); @endphp
                            @foreach([10,20,50,100] as $n)
                            <option value="{{ $n }}" @selected($pp===$n)>{{ $n }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th style="width:140px">Estado</th>
                                <th style="width:120px">Item</th>
                                <th>Descripción</th>
                                <th style="width:110px">Uni.</th>
                                <th style="width:160px">Metrado</th>
                                <th style="width:220px">Creado</th>
                                <th style="width:140px">Bienes</th>
                                <th style="width:160px" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($partidas as $partida)
                            @php
                            $modalId = "bienesModal-{$partida->id}";
                            $tieneBienes = $partida->diarios
                            ->flatMap(fn($d) => $d->bienes)
                            ->count() > 0;
                            @endphp

                            <tr>
                                <td>
                                    @if($partida->estado)
                                    <span class="badge bg-success">Activo</span>
                                    @else
                                    <span class="badge bg-danger">Anulado</span>
                                    @endif
                                </td>

                                <td class="fw-semibold">{{ $partida->item }}</td>

                                <td style="max-width: 520px; white-space: normal; word-break: break-word;">
                                    {{ $partida->descripcion }}
                                </td>

                                <td><span class="badge text-bg-light">{{ $partida->unidad_medida }}</span></td>

                                <td class="fw-semibold">
                                    {{ number_format((float)$partida->metrado_contrato, 3, '.', ',') }}
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ optional($partida->responsable)->nombres ?? '-' }}</div>
                                    <div class="subtle small">{{ optional($partida->created_at)->format('d/m/Y') }}</div>
                                </td>

                                {{-- BIENES (modal por partida) --}}
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        <i class="fs-3 bi bi-card-checklist"></i>
                                    </button>

                                    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Bienes vinculados - Partida {{ $partida->item }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    @if(!$tieneBienes)
                                                    <div class="alert alert-secondary mb-0">
                                                        Esta partida no tiene bienes registrados.
                                                    </div>
                                                    @else
                                                    @foreach($partida->diarios as $diario)
                                                    @if($diario->bienes->count() > 0)
                                                    <div class="mb-3 p-2 rounded" style="background:#f8fafc;border:1px solid #eef2f7;">
                                                        <div class="fw-semibold mb-2">
                                                            Día:
                                                            {{ $diario->fecha ?? $diario->created_at?->format('d/m/Y') ?? '-' }}
                                                        </div>

                                                        <div class="table-responsive">
                                                            <table class="table table-sm align-middle mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Producto</th>
                                                                        <th class="text-end" style="width:120px;">Cantidad</th>
                                                                        <th class="text-end" style="width:120px;">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($diario->bienes as $bien)
                                                                    <tr>
                                                                        <td>{{ $bien->producto->nombre ?? 'Producto' }}</td>
                                                                        <td class="text-end">
                                                                            {{ number_format((float)$bien->cantidad, 3, '.', ',') }}
                                                                        </td>
                                                                        <td class="text-end">
                                                                            {{ number_format((float)$bien->total, 3, '.', ',') }}
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- ACCIONES --}}
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="#" class="btn btn-primary btn-sm" title="Ver">
                                            <i class="fs-4 bi bi-file-earmark-pdf"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fs-4 bi bi-pencil white"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Eliminar esta partida?')">
                                            <i class="fs-4 bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    No se encontraron partidas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINACIÓN --}}
                @if($partidas->lastPage() > 1)
                @php
                $current = $partidas->currentPage();
                $last = $partidas->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
                if ($end - $start < 4) { $start=max(1, $end - 4); $end=min($last, $start + 4); } @endphp <div class="mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="subtle small">
                        Página <strong>{{ $current }}</strong> de <strong>{{ $last }}</strong>
                    </div>

                    <div class="btn-group me-2" role="group" aria-label="Paginación">
                        <a class="btn btn-outline-info @if($partidas->onFirstPage()) disabled @endif" href="{{ $partidas->appends(request()->query())->previousPageUrl() ?? '#' }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>

                        @if($start > 1)
                        <a class="btn btn-outline-info" href="{{ $partidas->appends(request()->query())->url(1) }}">1</a>
                        @if($start > 2)
                        <button type="button" class="btn btn-outline-info disabled">…</button>
                        @endif
                        @endif

                        @for($i=$start; $i<=$end; $i++) <a class="btn @if($i==$current) btn-info @else btn-outline-info @endif" href="{{ $partidas->appends(request()->query())->url($i) }}">
                            {{ $i }}
                            </a>
                            @endfor

                            @if($end < $last) @if($end < $last - 1) <button type="button" class="btn btn-outline-info disabled">…</button>
                                @endif
                                <a class="btn btn-outline-info" href="{{ $partidas->appends(request()->query())->url($last) }}">{{ $last }}</a>
                                @endif

                                <a class="btn btn-outline-info @if(!$partidas->hasMorePages()) disabled @endif" href="{{ $partidas->appends(request()->query())->nextPageUrl() ?? '#' }}">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                    </div>
            </div>
            @endif

        </div>
    </div>
</div>
</div>

{{-- Auto-submit con debounce --}}
<script>
    (function() {
        const form = document.getElementById('filtrosForm');
        if (!form) return;

        let timer = null;

        function debounceSubmit(ms = 500) {
            clearTimeout(timer);
            timer = setTimeout(() => form.submit(), ms);
        }

        const q = form.querySelector('input[name="q"]');
        if (q) {
            q.addEventListener('input', () => debounceSubmit(500));
            q.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.submit();
                }
            });
        }

        form.querySelectorAll('select, input[type="date"]').forEach(el => {
            el.addEventListener('change', () => form.submit());
        });

        form.querySelectorAll('input[name="item"], input[name="descripcion"]').forEach(el => {
            el.addEventListener('input', () => debounceSubmit(700));
        });
    })();

</script>
@endsection
