<?php

namespace App\Services;

use App\Http\Requests\StoreAccesoRequest;
use App\Models\Acceso;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AccesoService
{
    public function getAll(): LengthAwarePaginator
    {
        return Acceso::with(['area', 'responsable', 'personas'])
                     ->paginate(15);
    }

    public function getActivos(): LengthAwarePaginator
    {
        return Acceso::activo()
                     ->with(['area', 'responsable', 'personas'])
                     ->paginate(15);
    }

    public function create(StoreAccesoRequest $request): Acceso
    {
        // DB::transaction — múltiples modelos (Acceso + PersonaAcceso)
        return DB::transaction(function () use ($request) {
            $acceso = Acceso::create([
                'numero_requerimiento' => $request->numero_requerimiento,
                'area_id'              => $request->area_id,
                'responsable_id'       => $request->responsable_id,
                'estado'               => 'ACTIVO',
                // created_at se asigna automáticamente por Laravel
            ]);

            // Crear todas las personas del acceso
            foreach ($request->personas as $persona) {
                $acceso->personas()->create([
                    'nombre'   => $persona['nombre'],
                    'apellido' => $persona['apellido'],
                    'cedula'   => $persona['cedula'],
                    'empresa'  => $persona['empresa'],
                ]);
            }

            return $acceso->load(['area', 'responsable', 'personas']);
        });
    }

    public function checkOut(Acceso $acceso): Acceso
    {
        // Validar que no esté ya finalizado
        if ($acceso->estado === 'FINALIZADO') {
            throw new \LogicException('Este acceso ya fue finalizado.');
        }

        $acceso->update([
            'estado'    => 'FINALIZADO',
            'check_out' => Carbon::now(),
        ]);

        return $acceso->fresh(['area', 'responsable', 'personas']);
    }

    public function delete(Acceso $acceso): void
    {
        $acceso->delete(); // SoftDelete — personas_acceso se mantienen por auditoría
    }
}