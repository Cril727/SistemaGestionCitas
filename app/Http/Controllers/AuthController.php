<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT"
 * )
 *
 * @OA\Schema(
 *   schema="AuthRegisterRequest",
 *   type="object",
 *   required={"name","email","password","password_confirmation","rol"},
 *   @OA\Property(property="name", type="string", example="jx"),
 *   @OA\Property(property="email", type="string", format="email", example="julian@dd.d"),
 *   @OA\Property(property="password", type="string", example="12345"),
 *   @OA\Property(property="password_confirmation", type="string", example="12345"),
 *   @OA\Property(property="rol", type="string", example="admin")
 * )
 *
 * @OA\Schema(
 *   schema="AuthRegisterResponse",
 *   type="object",
 *   @OA\Property(property="success", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Usuario agregado correctamente"),
 *   @OA\Property(
 *     property="user",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=10),
 *     @OA\Property(property="name", type="string", example="Juan Pérez"),
 *     @OA\Property(property="email", type="string", example="juan@example.com"),
 *     @OA\Property(property="rol", type="string", example="admin"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 *   )
 * )
 *
 * @OA\Schema(
 *   schema="AuthLoginRequest",
 *   type="object",
 *   required={"email","password"},
 *   @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
 *   @OA\Property(property="password", type="string", example="secret123")
 * )
 *
 * @OA\Schema(
 *   schema="AuthLoginResponse",
 *   type="object",
 *   @OA\Property(property="Success", type="boolean", example=true),
 *   @OA\Property(property="message", type="string", example="Bienvenido"),
 *   @OA\Property(property="Token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
 * )
 */
class AuthController extends Controller
{
        /**
     * @OA\Post(
     *   path="/api/addUser",
     *   tags={"Auth"},
     *   summary="Crear usuario",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/AuthRegisterRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Usuario creado",
     *     @OA\JsonContent(ref="#/components/schemas/AuthRegisterResponse")
     *   ),
     *   @OA\Response(response=422, description="Errores de validación")
     * )
     */
    public function crearUsuario(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:4',
            'rol' => 'required|string'
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol
        ]);

        return response()->json(['success' => true, 'message' => 'Usuario agregado correctamente', 'user' => $user]);
    }


        /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Auth"},
     *   summary="Login y obtención de token JWT",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Login exitoso",
     *     @OA\JsonContent(ref="#/components/schemas/AuthLoginResponse")
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Credenciales inválidas"
     *   ),
     *   @OA\Response(response=422, description="Errores de validación")
     * )
     */
    public function login(Request $request){
        $validated = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ]);

        if($validated->fails()){
            return response()->json(['errors' => $validated->errors()]);
        }

        $credenciales = $request->only('email','password');
        if(!$token = JWTAuth::attempt($credenciales)){
            return response()->json([
                'success' => false,
                'message' => 'Credenciales Invalidas'
            ]);
        }

        return response()->json(['Success' => true, 'message' => 'Bienvenido', 'Token' => $token],200);


    }


    public function me(){
        $user = JWTAuth::user();
        return response()->json($user);
    }

    public function updateProfile(Request $request){
        $user = JWTAuth::user();

        $validated = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'rol' => 'required|string'
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'rol' => $request->rol
        ]);

        return response()->json($user);
    }

    public function listarUsuarios(){
        $users = User::all();
        return response()->json(['success' => true, 'data' => $users]);
    }
}
