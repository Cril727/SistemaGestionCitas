<?php

namespace App\Http\Controllers;

use App\Models\consultorios;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
/**
 * @OA\Schema(
 *     schema="Consultorio",
 *     type="object",
 *     title="Consultorio",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nombre", type="string"),
 *     @OA\Property(property="ubicacion", type="string", nullable=true),
 *     @OA\Property(property="piso", type="integer")
 * )
 */


class ConsultoriosController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/consultorios",
     *     summary="Lista todos los consultorios",
     *     tags={"Consultorios"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de consultorios",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Consultorio"))
     *     )
     * )
     */
    public function index()
    {
        $consultorios = consultorios::all();
        return response()->json($consultorios);
    }

    /**
     * @OA\Post(
     *     path="/api/consultorios",
     *     summary="Crear un nuevo consultorio",
     *     tags={"Consultorios"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Consultorio")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Consultorio creado correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Consultorio")
     *     ),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/consultorios/{id}",
     *     summary="Muestra un consultorio específico",
     *     tags={"Consultorios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del consultorio",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Datos del consultorio",
     *         @OA\JsonContent(ref="#/components/schemas/Consultorio")
     *     ),
     *     @OA\Response(response=404, description="Consultorio no encontrado")
     * )
     */
    public function show(string $id)
    {
        $consultorio = consultorios::find($id);
        if (!$consultorio) {
            return response()->json(['message' => 'Consultorio no encontrado'], 404);
        }
        return response()->json($consultorio);
    }

    /**
     * @OA\Put(
     *     path="/api/consultorios/{id}",
     *     summary="Actualizar un consultorio existente",
     *     tags={"Consultorios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del consultorio",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Consultorio")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Consultorio actualizado correctamente",
     *         @OA\JsonContent(ref="#/components/schemas/Consultorio")
     *     ),
     *     @OA\Response(response=422, description="Errores de validación"),
     *     @OA\Response(response=404, description="Consultorio no encontrado")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/consultorios/{id}",
     *     summary="Eliminar un consultorio",
     *     tags={"Consultorios"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del consultorio",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Consultorio eliminado con éxito",
     *         @OA\JsonContent(@OA\Property(property="message", type="string"))
     *     ),
     *     @OA\Response(response=404, description="Consultorio no encontrado")
     * )
     */
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
