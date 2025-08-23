<?php

namespace App\Http\Controllers;

use App\Models\consultorios;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ConsultoriosController extends Controller
{
    //
    public function index()
    {
        $consultorios = consultorios::all();
        return response()->json($consultorios);
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre'    => 'required|string|max:100',
            'ubicacion' => 'nullable|string|max:255',
            'piso'      => 'required|integer|min:0|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $consultorio = consultorios::create($request->all());
        return response()->json($consultorio, 201);
    }


    public function show(string $id)
    {
        $consultorio = consultorios::find($id);
        if (!$consultorio) {
            return response()->json(['message' => 'Consultorio no encontrado'], 404);
        }
        return response()->json($consultorio);
    }


    public function update(Request $request, string $id)
    {
        $consultorio = consultorios::find($id);
        if (!$consultorio) {
            return response()->json(['message' => 'Consultorio no encontrado'], 404);
        }

        $validate = Validator::make($request->all(), [
            'nombre'    => 'sometimes|required|string|max:100',
            'ubicacion' => 'nullable|string|max:255',
            'piso'      => 'sometimes|required|integer|min:0|max:255',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $consultorio->update($request->all());
        return response()->json($consultorio);
    }

    public function destroy(string $id)
    {
        $consultorio = consultorios::find($id);
        if (!$consultorio) {
            return response()->json(['message' => 'Consultorio no encontrado'], 404);
        }

        $consultorio->delete();
        return response()->json(['message' => 'Consultorio eliminado con éxito']);
    }

    
}
