<?php

namespace App\Http\Controllers;

use App\Models\citas_medicas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="CitaMedica",
 *     type="object",
 *     title="Cita Médica",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="paciente_id", type="integer"),
 *     @OA\Property(property="doctor_id", type="integer"),
 *     @OA\Property(property="fecha_hora", type="string", format="date-time"),
 *     @OA\Property(property="estado", type="string", enum={"programada","completada","cancelada"}),
 *     @OA\Property(property="novedad", type="string", nullable=true)
 * )
 *
 * @OA\SecurityRequirement({"bearerAuth":{}})
 */
class CitasMedicasController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/listarCitasMedicas",
     *     summary="Listar todas las citas médicas",
     *     tags={"Citas Médicas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de citas médicas",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CitaMedica")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $citasMedicas = citas_medicas::all();
        return response()->json($citasMedicas);
    }

    /**
     * @OA\Post(
     *     path="/api/AgregarCitaMedica",
     *     summary="Crear una nueva cita médica",
     *     tags={"Citas Médicas"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CitaMedica")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cita médica creada",
     *         @OA\JsonContent(ref="#/components/schemas/CitaMedica")
     *     ),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/citaMedica/{id}",
     *     summary="Obtener una cita médica por ID",
     *     tags={"Citas Médicas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Datos de la cita médica",
     *         @OA\JsonContent(ref="#/components/schemas/CitaMedica")
     *     ),
     *     @OA\Response(response=404, description="Cita médica no encontrada")
     * )
     */
    public function show($id)
    {
        $citaMedica = citas_medicas::find($id);
        if (!$citaMedica) {
            return response()->json(['message' => 'Cita médica no encontrada'], 404);
        }
        return response()->json($citaMedica);
    }

    /**
     * @OA\Put(
     *     path="/api/ActualizarCitaMedica/{id}",
     *     summary="Actualizar una cita médica",
     *     tags={"Citas Médicas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CitaMedica")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cita médica actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/CitaMedica")
     *     ),
     *     @OA\Response(response=404, description="Cita médica no encontrada"),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/EliminarCitaMedica/{id}",
     *     summary="Eliminar una cita médica",
     *     tags={"Citas Médicas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Cita médica eliminada con éxito"),
     *     @OA\Response(response=404, description="Cita médica no encontrada")
     * )
     */
    public function destroy($id)
    {
        $citaMedica = citas_medicas::find($id);
        if (!$citaMedica) {
            return response()->json(['message' => 'Cita médica no encontrada'], 404);
        }

        $citaMedica->delete();
        return response()->json(['message' => 'Cita médica eliminada con éxito']);
    }

    /**
     * @OA\Get(
     *     path="/api/citasPorPaciente/{pacienteId}",
     *     summary="Obtener citas por paciente",
     *     tags={"Citas Médicas"},
     *     @OA\Parameter(
     *         name="pacienteId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de citas del paciente",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitaMedica"))
     *     ),
     *     @OA\Response(response=404, description="No se encontraron citas médicas para este paciente")
     * )
     */
    public function citasPorPaciente($pacienteId)
    {
        $citas = citas_medicas::where('paciente_id', $pacienteId)->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas para este paciente'], 404);
        }
        return response()->json($citas);
    }

    /**
     * @OA\Get(
     *     path="/api/citasPorDoctor/{doctorId}",
     *     summary="Obtener citas por doctor",
     *     tags={"Citas Médicas"},
     *     @OA\Parameter(
     *         name="doctorId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de citas del doctor",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitaMedica"))
     *     ),
     *     @OA\Response(response=404, description="No se encontraron citas médicas para este doctor")
     * )
     */
    public function citasPorDoctor($doctorId)
    {
        $citas = citas_medicas::where('doctor_id', $doctorId)->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas para este doctor'], 404);
        }
        return response()->json($citas);
    }

    /**
     * @OA\Get(
     *     path="/api/citasCompletadas",
     *     summary="Obtener citas completadas",
     *     tags={"Citas Médicas"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de citas completadas",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CitaMedica"))
     *     ),
     *     @OA\Response(response=404, description="No se encontraron citas médicas completadas")
     * )
     */
    public function citasCompletadas()
    {
        $citas = citas_medicas::where('estado', 'completada')->get();
        if ($citas->isEmpty()) {
            return response()->json(['message' => 'No se encontraron citas médicas completadas'], 404);
        }
        return response()->json($citas);
    }
}
