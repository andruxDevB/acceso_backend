<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Acceso;
use App\Models\AccesoDetalle;
use App\Http\Requests\AccesoStoreRequest;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    public function store(AccesoStoreRequest $request)
    {
        $req = Acceso::create([
            'numero_requerimiento'  => $request->numero_requerimiento,
            'area_id'               => $request->area_id,
            'responsable_id'        => $request->responsable_id,
            'area_responsable'      => $request->area_responsable,
            'check_in'              => now(),
            'estado'                => 'ACTIVO'
        ]);

        foreach ($request->persona as $persona) {
            AccesoDetalle::create([
                'requerimiento_id'  => $req->id,
                'nombre_persona'    => $persona['nombre'],
                'apellido_persona'  => $persona['apellido'],
                'cedula_persona'    => $persona['cedula'],
                'empresa'           => $persona['empresa']
            ]);
        }

        return response()->json($req->load('detalles'));      
    }

    public function index()
    {
        return Acceso::with('detalles')->get();
    }

    public function show($id)
    {
        return Acceso::with('detalles')->findOrFail($id);
    }
}
