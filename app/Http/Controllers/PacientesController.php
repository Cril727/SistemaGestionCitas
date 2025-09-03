<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Schema(
 *   schema="Paciente",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=12),
 *   @OA\Property(property="documento", type="string", example="1012345678"),
 *   @OA\Property(property="nombre", type="string", example="María"),
 *   @OA\Property(property="apellido", type="string", example="Gómez"),
 *   @OA\Property(property="email", type="string", format="email", example="maria@example.com"),
 *   @OA\Property(property="telefono", type="string", nullable=true, example="3001234567"),
 *   @OA\Property(property="genero", type="string", nullable=true, enum={"M","F","O"}, example="F")
 * )
 */
class PacientesController extends Controller
{
        /**
     * @OA\Get(
     *   path="/api/listarPacientes",
     *   tags={"Pacientes"},
     *   summary="Listar pacientes",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Paciente"))
     *   ),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function index()
    {
        $pacientes = Pacientes::all();
        return response()->json($pacientes);
    }


     /**
     * @OA\Post(
     *   path="/api/AgregarPaciente",
     *   tags={"Pacientes"},
 *   summary="Crear paciente",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"documento","nombre","apellido","email"},
     *       @OA\Property(property="documento", type="string", example="1012345678"),
     *       @OA\Property(property="nombre", type="string", example="María"),
     *       @OA\Property(property="apellido", type="string", example="Gómez"),
     *       @OA\Property(property="email", type="string", format="email", example="maria@example.com"),
     *       @OA\Property(property="telefono", type="string", nullable=true, example="3001234567"),
     *       @OA\Property(property="genero", type="string", nullable=true, enum={"M","F","O"}, example="F")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Creado", @OA\JsonContent(ref="#/components/schemas/Paciente")),
     *   @OA\Response(response=422, description="Errores de validación"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
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

        /**
     * @OA\Get(
     *   path="/api/paciente/{id}",
     *   tags={"Pacientes"},
     *   summary="Obtener paciente por ID",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Paciente")),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function show(string $id)
    {
        $paciente = Pacientes::find($id);
        if (!$paciente) {   
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
        return response()->json($paciente);
    }


        /**
     * @OA\Put(
     *   path="/api/ActualizarPaciente/{id}",
     *   tags={"Pacientes"},
     *   summary="Actualizar paciente",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="documento", type="string", example="1012345678"),
     *       @OA\Property(property="nombre", type="string", example="María"),
     *       @OA\Property(property="apellido", type="string", example="Gómez"),
     *       @OA\Property(property="email", type="string", format="email", example="maria@example.com"),
     *       @OA\Property(property="telefono", type="string", nullable=true, example="3001234567"),
     *       @OA\Property(property="genero", type="string", nullable=true, enum={"M","F","O"}, example="F")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Actualizado", @OA\JsonContent(ref="#/components/schemas/Paciente")),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=422, description="Errores de validación"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
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


        /**
     * @OA\Delete(
     *   path="/api/EliminarPaciente/{id}",
     *   tags={"Pacientes"},
     *   summary="Eliminar paciente",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(
     *     response=200,
     *     description="Eliminado",
     *     @OA\JsonContent(type="object", @OA\Property(property="message", type="string", example="Paciente eliminado correctamente"))
     *   ),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function destroy(string $id)
    {
        $paciente = Pacientes::find($id);
        if (!$paciente) {
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();
        return response()->json(['message' => 'Paciente eliminado correctamente']);
    }

     /**
     * @OA\Get(
     *   path="/api/pacientesMasculinos",
     *   tags={"Pacientes"},
     *   summary="Listar pacientes masculinos",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Paciente"))
     *   ),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function pacientesMasculinos(){
        $pacientes = Pacientes::where('genero', 'M')->get();
        return response()->json($pacientes);
    }

    
}
