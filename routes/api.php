<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitasMedicasController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


/**
 * API Routes
 */

//Crear el usuario
Route::post('/addUser', [AuthController::class, 'crearUsuario']);
//Login
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    //Especialidades Routes
    Route::get("/listarEspecialidades", [EspecialidadesController::class, 'index'])->middleware('rol:admin');
    Route::post("/AgregarEspecialidad", [EspecialidadesController::class, 'store'])->middleware('rol:admin');
    Route::get("/especialidade/{id}", [EspecialidadesController::class, 'show'])->middleware('rol:admin');
    Route::put("/AcualizarEspecialidad/{id}", [EspecialidadesController::class, 'update'])->middleware('rol:admin');
    Route::delete("/DeliminarEspecialidad/{id}", [EspecialidadesController::class, 'destroy'])->middleware('rol:admin');

    //Doctores Routes
    Route::get("/listarDoctores", [DoctoresController::class, 'index'])->middleware('rol:admin');
    Route::post("/AgregarDoctor", [DoctoresController::class, 'store'])->middleware('rol:admin');
    Route::get("/doctor/{id}", [DoctoresController::class, 'show'])->middleware('rol:admin');
    Route::put("/ActualizarDoctor/{id}", [DoctoresController::class, 'update'])->middleware('rol:admin');
    Route::delete("/EliminarDoctor/{id}", [DoctoresController::class, 'destroy'])->middleware('rol:admin');
    Route::get("/doctoresActivos", [DoctoresController::class, 'doctoresActivos'])->middleware('rol:admin');
    Route::get("/doctoresFemeninos", [DoctoresController::class, 'doctoresFemeninos'])->middleware('rol:admin');

    //Pacientes Routes
    Route::get("/listarPacientes", [PacientesController::class, 'index'])->middleware('rol:admin');
    Route::post("/AgregarPaciente", [PacientesController::class, 'store'])->middleware('rol:admin');
    Route::get("/paciente/{id}", [PacientesController::class, 'show'])->middleware('rol:admin');
    Route::put("/ActualizarPaciente/{id}", [PacientesController::class, 'update'])->middleware('rol:admin');
    Route::delete("/EliminarPaciente/{id}", [PacientesController::class, 'destroy'])->middleware('rol:admin');
    Route::get("/pacientesMasculinos", [PacientesController::class, 'pacientesMasculinos'])->middleware('rol:admin');

    //Citas Médicas Routes
    Route::get("/listarCitasMedicas", [CitasMedicasController::class, 'index'])->middleware('rol:admin');
    Route::post("/AgregarCitaMedica", [CitasMedicasController::class, 'store'])->middleware('rol:admin');
    Route::get("/citaMedica/{id}", [CitasMedicasController::class, 'show'])->middleware('rol:admin');
    Route::put("/ActualizarCitaMedica/{id}", [CitasMedicasController::class, 'update'])->middleware('rol:admin');
    Route::delete("/EliminarCitaMedica/{id}", [CitasMedicasController::class, 'destroy'])->middleware('rol:admin');
    Route::get("/citasPorPaciente/{pacienteId}", [CitasMedicasController::class, 'citasPorPaciente'])->middleware('rol:admin');
    Route::get("/citasPorDoctor/{doctorId}", [CitasMedicasController::class, 'citasPorDoctor'])->middleware('rol:admin');
    Route::get("/citasCompletadas", [CitasMedicasController::class, 'citasCompletadas'])->middleware('rol:admin');

    // Consultorios Routes
    Route::get('/consultorios',                [ConsultoriosController::class, 'index'])->middleware('rol:admin');
    Route::post('/consultorios',                [ConsultoriosController::class, 'store'])->middleware('rol:admin');
    Route::get('/consultorios/{consultorio}',  [ConsultoriosController::class, 'show'])->middleware('rol:admin');
    Route::put('/consultorios/{consultorio}',  [ConsultoriosController::class, 'update'])->middleware('rol:admin');
    Route::delete('/consultorios/{consultorio}',  [ConsultoriosController::class, 'destroy'])->middleware('rol:admin');
});
