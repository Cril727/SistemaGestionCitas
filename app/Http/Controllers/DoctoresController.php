<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;


/**
 * @OA\Schema(
 *     schema="Doctor",
 *     type="object",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="nombre", type="string"),
 *     @OA\Property(property="apellido", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="telefono", type="string", nullable=true),
 *     @OA\Property(property="genero", type="string", nullable=true),
 *     @OA\Property(property="estado", type="string", enum={"activo","inactivo"}),
 *     @OA\Property(property="especialidad_id", type="integer")
 * )
 */

class DoctoresController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/listarDoctores",
     *     summary="Lista todos los doctores",
     *     tags={"Doctores"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de doctores",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Doctor")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $doctores = Doctores::all();
        return response()->json($doctores);
    }

    /**
     * @OA\Post(
     *     path="/api/AgregarDoctor",
     *     summary="Crea un nuevo doctor",
     *     tags={"Doctores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Doctor")
     *     ),
     *     @OA\Response(response=201, description="Doctor creado"),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/doctor/{id}",
     *     summary="Obtiene un doctor por ID",
     *     tags={"Doctores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Doctor encontrado", @OA\JsonContent(ref="#/components/schemas/Doctor")),
     *     @OA\Response(response=404, description="Doctor no encontrado")
     * )
     */
    public function show(string $id)
    {
        $doctor = Doctores::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }
        return response()->json($doctor);
    }

    /**
     * @OA\Put(
     *     path="/api/ActualizarDoctor/{id}",
     *     summary="Actualiza un doctor por ID",
     *     tags={"Doctores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Doctor")
     *     ),
     *     @OA\Response(response=200, description="Doctor actualizado"),
     *     @OA\Response(response=404, description="Doctor no encontrado"),
     *     @OA\Response(response=422, description="Errores de validación")
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/EliminarDoctor/{id}",
     *     summary="Elimina un doctor por ID",
     *     tags={"Doctores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Doctor eliminado"),
     *     @OA\Response(response=404, description="Doctor no encontrado")
     * )
     */
    public function destroy(string $id)
    {
        $doctor = Doctores::find($id);
        if (!$doctor) {
            return response()->json(['message' => 'Doctor no encontrado'], 404);
        }

        $doctor->delete();
        return response()->json(['message' => 'Doctor eliminado correctamente']);
    }

    /**
     * @OA\Get(
     *     path="/api/doctoresActivos",
     *     summary="Lista todos los doctores activos",
     *     tags={"Doctores"},
     *     @OA\Response(response=200, description="Lista de doctores activos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Doctor"))
     *     )
     * )
     */
    public function doctoresActivos()
    {
        $doctores = Doctores::where('estado', 'activo')->get();
        return response()->json($doctores);
    }

    /**
     * @OA\Get(
     *     path="/api/doctoresFemeninos",
     *     summary="Lista todos los doctores femeninos",
     *     tags={"Doctores"},
     *     @OA\Response(response=200, description="Lista de doctores femeninos",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Doctor"))
     *     )
     * )
     */
    public function doctoresFemeninos()
    {
        $doctores = Doctores::where('genero', 'F')->get();
        return response()->json($doctores);
    }
}