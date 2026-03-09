<?php

namespace App\Http\Controllers;


use App\Models\Obras;
use App\Models\Partidas;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class PartidasController extends Controller
{
    public function index(Request $request)
    {
        $query = Partidas::with(['responsable','diarios.bienes.producto']);

        // FILTRO POR OBRA
        if ($request->filled('obra_id')) {
            $query->where('obra_id', $request->obra_id);
        }

        // BUSCADOR GENERAL
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('item', 'ilike', '%' . $request->q . '%')
                ->orWhere('descripcion', 'ilike', '%' . $request->q . '%');
            });
        }

        // FILTRO UNIDAD
        if ($request->filled('unidad_medida')) {
            $query->where('unidad_medida', $request->unidad_medida);
        }

        // FILTRO RESPONSABLE
        if ($request->filled('responsable_id')) {
            $query->where('responsable_id', $request->responsable_id);
        }

        // FILTRO ESTADO
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // FILTRO FECHA INICIO
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('created_at', '>=', $request->fecha_inicio);
        }

        // FILTRO FECHA FIN
        if ($request->filled('fecha_fin')) {
            $query->whereDate('created_at', '<=', $request->fecha_fin);
        }

        $perPage = $request->get('per_page', 10);

        $partidas = $query
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        return view('partidas.index', [
            'partidas' => $partidas,
            'responsables' => Usuarios::all(),
            'obras' => Obras::all()
        ]);
    }
}
