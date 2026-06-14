<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccesoRequest;
use App\Http\Resources\AccesoResource;
use App\Models\Acceso;
use App\Services\AccesoService;
use Illuminate\Http\JsonResponse;

class AccesoController extends BaseController
{
    public function __construct(private readonly AccesoService $service) {}

    public function index(): JsonResponse
    {
        $accesos = $this->service->getAll();
        return $this->sendResponse(
            AccesoResource::collection($accesos),
            'Accesos recuperados exitosamente.'
        );
    }

    public function store(StoreAccesoRequest $request): JsonResponse
    {
        $acceso = $this->service->create($request);
        return $this->sendResponse(
            new AccesoResource($acceso),
            'Acceso registrado exitosamente.',
            201
        );
    }

    public function show(Acceso $acceso): JsonResponse
    {
        $acceso->load(['area', 'responsable', 'personas']);
        return $this->sendResponse(
            new AccesoResource($acceso),
            'Acceso recuperado exitosamente.'
        );
    }

    // Endpoint dedicado para check_out — semántica clara
    public function checkOut(Acceso $acceso): JsonResponse
    {
        $acceso = $this->service->checkOut($acceso);
        return $this->sendResponse(
            new AccesoResource($acceso),
            'Salida registrada exitosamente.'
        );
    }

    public function destroy(Acceso $acceso): JsonResponse
    {
        $this->service->delete($acceso);
        return $this->sendResponse([], 'Acceso eliminado exitosamente.');
    }
}