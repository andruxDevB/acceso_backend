<?php

namespace App\Services;

use App\Http\Requests\StoreResponsableRequest;
use App\Http\Requests\UpdateResponsableRequest;
use App\Models\Responsable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ResponsableService
{
    public function getAll(): LengthAwarePaginator
    {
        return Responsable::paginate(15);
    }

    public function create(StoreResponsableRequest $request): Responsable
    {
        // Un solo método
        return Responsable::create([
            'nombre'        => $request->nombre,
            'apellido'      => $request->apellido,
            'email'         => Str::lower($request->email),
            'usuario_red'   => Str::lower($request->usuario_red), // normalizar a minúsculas

        ]);
    }

    public function update(UpdateResponsableRequest $request, Responsable $responsable): Responsable
    {
        $responsable->update([
            'nombre'        => $request->nombre ?? $responsable->nombre,
            'apellido'      => $request->apellido  ?? $responsable->apellido,
            'email'         => $request->email ? Str::lower($request->email) : $responsable->email,
            'usuario_red'   => $request->usuario_red ? Str::lower($request->usuario_red) : $responsible->usuario_red,

        ]);

        return $responsable->fresh();
    }

    public function delete(Responsable $responsable): void
    {
        $responsable->delete(); // SoftDelete — no se pierde el registro
    }
}