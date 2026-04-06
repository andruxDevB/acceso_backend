<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }

    public function store(Request $request)
    {
        return Area::create($request->all());
    }

    public function show($id)
    {
        return Area::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->all());
        return $area;
    }

    public function destroy($id)
    {
        Area::destroy($id);
        return response()->json(['message' => 'Área eliminada']);
    }
}
