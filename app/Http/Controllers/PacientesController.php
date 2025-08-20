<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PacientesController extends Controller
{
    //
    public function index()
    {
        $pacientes = Pacientes::all();
        return response()->json($pacientes);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'documento' => 'required|string|max:20|unique:pacientes',
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:pacientes',
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|in:M,F,O'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $paciente = Pacientes::create($request->all());
        return response()->json($paciente, 201);

    }

    public function show(string $id)
    {
        $paciente = Pacientes::find($id);
        if (!$paciente) {   
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
        return response()->json($paciente);
    }


    public function update(Request $request, string $id)
    {
        $paciente = Pacientes::find($id);
        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $validatedData = Validator::make($request->all(), [
            'documento' => 'sometimes|required|string|max:20|unique:pacientes,documento,' . $id,
            'nombre' => 'sometimes|required|string|max:100',
            'apellido' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|max:150|unique:pacientes,email,' . $id,
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|in:M,F,O'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $paciente->update($request->all());
        return response()->json($paciente);
    }


    public function destroy(string $id)
    {
        $paciente = Pacientes::find($id);
        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();
        return response()->json(['message' => 'Paciente eliminado correctamente']);
    }

    //pacientes masculinos
    public function pacientesMasculinos(){
        $pacientes = Pacientes::where('genero', 'M')->get();
        return response()->json($pacientes);
    }

    
}
