<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Services\AreaService;
use Illuminate\Http\JsonResponse;

class AreaController extends BaseController
{
    public function __construct(private readonly AreaService $service) {}

    public function index(): JsonResponse
    {
        $areas = $this->service->getAll();
        return $this->sendResponse(
            AreaResource::collection($areas),
            'Áreas recuperadas exitosamente.'
        );
    }

    public function store(StoreAreaRequest $request): JsonResponse
    {
        $area = $this->service->create($request);
        return $this->sendResponse(
            new AreaResource($area),
            'Área creada exitosamente.',
            201
        );
    }

    public function show(Area $area): JsonResponse
    {
        return $this->sendResponse(
            new AreaResource($area),
            'Área recuperada exitosamente.'
        );
    }

    public function update(UpdateAreaRequest $request, Area $area): JsonResponse
    {
        $area = $this->service->update($request, $area);
        return $this->sendResponse(
            new AreaResource($area),
            'Área actualizada exitosamente.'
        );
    }

    public function destroy(Area $area): JsonResponse
    {
        $this->service->delete($area);
        return $this->sendResponse([], 'Área eliminada exitosamente.');
    }
}