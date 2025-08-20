<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    //
    public function index()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades'
        ]);

        $especialidad = Especialidades::create($validatedData);
        return response()->json($especialidad, 201);
    }
    
    public function show(string $id)
    {
        $especialidad = Especialidades::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        return response()->json($especialidad);
    }

    public function update(Request $request, string $id)
    {
        $especialidad = Especialidades::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100|unique:especialidades,nombre,' . $id
        ]);

        $especialidad->update($validatedData);
        return response()->json($especialidad);
    }

    public function destroy(string $id)
    {
        $especialidad = Especialidades::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }

        $especialidad->delete();
        return response()->json(['message' => 'Especialidad eliminada con éxito']);
    }
}
