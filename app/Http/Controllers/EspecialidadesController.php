<?php

namespace App\Http\Controllers;

use App\Models\Especialidades;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *   schema="Especialidad",
 *   type="object",
 *   @OA\Property(property="id", type="integer", example=3),
 *   @OA\Property(property="nombre", type="string", example="Cardiología")
 * )
 */
class EspecialidadesController extends Controller
{
        /**
     * @OA\Get(
     *   path="/api/listarEspecialidades",
     *   tags={"Especialidades"},
     *   summary="Listar especialidades",
     *   security={{"bearerAuth":{}}},
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Especialidad"))
     *   ),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function index()
    {
        $especialidades = Especialidades::all();
        return response()->json($especialidades);
    }


        /**
     * @OA\Post(
     *   path="/api/AgregarEspecialidad",
     *   tags={"Especialidades"},
     *   summary="Crear especialidad",
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"nombre"},
     *       @OA\Property(property="nombre", type="string", example="Dermatología")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Creado", @OA\JsonContent(ref="#/components/schemas/Especialidad")),
     *   @OA\Response(response=422, description="Errores de validación"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100|unique:especialidades'
        ]);

        $especialidad = Especialidades::create($validatedData);
        return response()->json($especialidad, 201);
    }
    

        /**
     * @OA\Get(
     *   path="/api/especialidade/{id}",
     *   tags={"Especialidades"},
     *   summary="Obtener especialidad por ID",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(response=200, description="OK", @OA\JsonContent(ref="#/components/schemas/Especialidad")),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
    public function show(string $id)
    {
        $especialidad = Especialidades::find($id);
        if (!$especialidad) {
            return response()->json(['message' => 'Especialidad no encontrada'], 404);
        }
        return response()->json($especialidad);
    }


        /**
     * @OA\Put(
     *   path="/api/AcualizarEspecialidad/{id}",
     *   tags={"Especialidades"},
     *   summary="Actualizar especialidad",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="nombre", type="string", example="Neumología")
     *     )
     *   ),
     *   @OA\Response(response=200, description="Actualizado", @OA\JsonContent(ref="#/components/schemas/Especialidad")),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=422, description="Errores de validación"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
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


        /**
     * @OA\Delete(
     *   path="/api/DeliminarEspecialidad/{id}",
     *   tags={"Especialidades"},
     *   summary="Eliminar especialidad",
     *   security={{"bearerAuth":{}}},
     *   @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *   @OA\Response(
     *     response=200,
     *     description="Eliminada",
     *     @OA\JsonContent(type="object", @OA\Property(property="message", type="string", example="Especialidad eliminada con éxito"))
     *   ),
     *   @OA\Response(response=404, description="No encontrado"),
     *   @OA\Response(response=403, description="Prohibido (rol requerido)")
     * )
     */
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
