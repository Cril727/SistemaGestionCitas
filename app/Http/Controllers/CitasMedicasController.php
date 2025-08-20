<?php

namespace App\Http\Controllers;

use App\Models\citas_medicas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CitasMedicasController extends Controller
{
    //mostrar todas las citas médicas
    public function index()
    {
        $citasMedicas = citas_medicas::all();
        return response()->json($citasMedicas); 
    }

    //crear una nueva cita médica
    public function store(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'fecha_hora' => 'required|date',
            'estado' => 'required|in:programada,completada,cancelada',
            'novedad' => 'nullable|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $citaMedica = citas_medicas::create($request->all());
        return response()->json($citaMedica, 201);
    }

    //mostrar una cita médica específica
    public function show($id)
    {
        $citaMedica = citas_medicas::find($id);
        if (!$citaMedica) {
            return response()->json(['message' => 'Cita médica no encontrada'], 404);           
        }
        return response()->json($citaMedica);
    }

    //actualizar una cita médica
    public function update(Request $request, $id)
    {
        $citaMedica = citas_medicas::find($id);
        if (!$citaMedica) {
            return response()->json(['message' => 'Cita médica no encontrada'], 404);   
        }

        $validated = Validator::make($request->all(), [
            'paciente_id' => 'sometimes|required|exists:pacientes,id',
            'doctor_id' => 'sometimes|required|exists:doctores,id',
            'fecha_hora' => 'sometimes|required|date',
            'estado' => 'sometimes|required|in:programada,completada,cancelada',
            'novedad' => 'nullable|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $citaMedica->update($request->all());
        return response()->json($citaMedica);
    }
    
    //eliminar una cita médica
    public function destroy($id){
        $citaMedica = citas_medicas::find($id);
        if (!$citaMedica) {
            return response()->json(['message' => 'Cita médica no encontrada'], 404);
        }

        $citaMedica->delete();
        return response()->json(['message' => 'Cita médica eliminada con éxito']);
    }

    //buscar citas médicas por paciente
    public function citasPorPaciente($pacienteId){
        $citas = citas_medicas::where('paciente_id', $pacienteId)->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas para este paciente'], 404);
        }
        return response()->json($citas);
    }

    //buscar citas médicas por doctor
    public function citasPorDoctor($doctorId){
        $citas = citas_medicas::where('doctor_id', $doctorId)->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas para este doctor'], 404);
        }
        return response()->json($citas);
    }

    //buscar citas médicas completadas
    public function citasCompletadas(){
        $citas = citas_medicas::where('estado', 'completada')->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas completadas'], 404);
        }
        return response()->json($citas);
    }
}
