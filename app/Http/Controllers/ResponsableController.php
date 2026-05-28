<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResponsableRequest;
use App\Http\Requests\UpdateResponsableRequest;
use App\Http\Resources\ResponsableResource;
use App\Models\Responsable;
use App\Services\ResponsableService;
use Illuminate\Http\JsonResponse;

class ResponsableController extends BaseController
{
    // Inyección por constructor
    public function __construct(private readonly ResponsableService $service) {}

    public function index(): JsonResponse
    {
        $responsables = $this->service->getAll();
        return $this->sendResponse(
            ResponsableResource::collection($responsables),
            'Responsables recuperados con éxito.'
        );
    }

    public function store(StoreResponsableRequest $request): JsonResponse
    {
        $responsable = $this->service->create($request);
        return $this->sendResponse(
            new ResponsableResource($responsible),
            'Responsable creado exitosamente.',
            201 // HTTP 201 Created — más semántico que 200
        );
    }

    public function show(Responsable $responsable): JsonResponse
    {
        return $this->sendResponse(
            new ResponsableResource($responsable),
            'Responsable recuperado con éxito.'
        );
    }

    public function update(UpdateResponsableRequest $request, Responsable $responsable): JsonResponse
    {
        $responsable = $this->service->update($request, $responsable);
        return $this->sendResponse(
            new ResponsableResource($responsable),
            'Responsable actualizado con éxito.'
        );
    }

    public function destroy(Responsable $responsable): JsonResponse
    {
        $this->service->delete($responsable);
        return $this->sendResponse([], 'Responsable eliminado con éxito.');
    }
}