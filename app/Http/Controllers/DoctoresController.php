<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctoresController extends Controller
{
    //
    public function index()
    {
        $doctores = Doctores::all();
        return response()->json($doctores);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:doctores',
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|in:M,F,O',
            'estado' => 'required|in:activo,inactivo',
            'especialidad_id' => 'required|exists:especialidades,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $doctor = Doctores::create($request->all());
        return response()->json($doctor, 201);
    }

    public function show(string $id)
    {
        $doctor = Doctores::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }
        return response()->json($doctor);
    }

    public function update(Request $request, string $id)
    {
        $doctor = Doctores::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        $validate = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:100',
            'apellido' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|max:150|unique:doctores,email,' . $id,
            'telefono' => 'nullable|string|max:15',
            'genero' => 'nullable|in:M,F,O',
            'estado' => 'sometimes|required|in:activo,inactivo',
            'especialidad_id' => 'sometimes|required|exists:especialidades,id'
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $doctor->update($request->all());
        return response()->json($doctor);
    }

    public function destroy(string $id)
    {
        $doctor = Doctores::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Doctor eliminado correctamente']);
    }

    //Doctores activos
    public function doctoresActivos(){
        $doctores = Doctores::where('estado', 'activo')->get();
        return response()->json($doctores);
    }

    //Doctores Femeninos
    public function doctoresFemeninos(){
        $doctores = Doctores::where('genero', 'F')->get();
        return response()->json($doctores);
    }
}
