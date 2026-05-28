<?php

namespace App\Services;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AreaService
{
    public function getAll(): LengthAwarePaginator
    {
        return Area::paginate(15);
    }

    public function getActivas(): LengthAwarePaginator
    {
        return Area::activo()->paginate(15);
    }

    public function create(StoreAreaRequest $request): Area
    {
        return Area::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => $request->estado,
        ]);
    }

    public function update(UpdateAreaRequest $request, Area $area): Area
    {
        $area->update([
            'nombre'      => $request->nombre      ?? $area->nombre,
            'descripcion' => $request->descripcion ?? $area->descripcion,
            'estado'      => $request->estado      ?? $area->estado,
        ]);

        return $area->fresh();
    }

    public function delete(Area $area): void
    {
        $area->delete(); // SoftDelete — no se pierde el registro
    }
}