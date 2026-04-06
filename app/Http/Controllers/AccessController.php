<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Acceso;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function checkOut($id)
    {
        $req = Acceso::findOrFail($id);

        $req->update([
            'check_out' => now(),
            'estado'    => 'FINALIZADO'
        ]);

        return response()->json($detail);

    }

    public function activo()
    {
        return Acceso::where('estado','ACTIVO')->get();
    }
}
