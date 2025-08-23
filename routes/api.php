<?php

use App\Http\Controllers\CitasMedicasController;
use App\Http\Controllers\ConsultoriosController;
use App\Http\Controllers\DoctoresController;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\PacientesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/**
 * API Routes
 */


//Especialidades Routes
Route::get("/listarEspecialidades", [EspecialidadesController::class, 'index']);
Route::post("/AgregarEspecialidad", [EspecialidadesController::class, 'store']);
Route::get("/especialidade/{id}", [EspecialidadesController::class, 'show']);
Route::put("/AcualizarEspecialidad/{id}", [EspecialidadesController::class, 'update']);
Route::delete("/DeliminarEspecialidad/{id}", [EspecialidadesController::class, 'destroy']);

//Doctores Routes
Route::get("/listarDoctores", [DoctoresController::class, 'index']);
Route::post("/AgregarDoctor", [DoctoresController::class, 'store']);
Route::get("/doctor/{id}", [DoctoresController::class, 'show']);
Route::put("/ActualizarDoctor/{id}", [DoctoresController::class, 'update']);
Route::delete("/EliminarDoctor/{id}", [DoctoresController::class, 'destroy']);
Route::get("/doctoresActivos", [DoctoresController::class, 'doctoresActivos']);
Route::get("/doctoresFemeninos", [DoctoresController::class, 'doctoresFemeninos']);

//Pacientes Routes
Route::get("/listarPacientes", [PacientesController::class, 'index']);
Route::post("/AgregarPaciente", [PacientesController::class, 'store']);
Route::get("/paciente/{id}", [PacientesController::class, 'show']);
Route::put("/ActualizarPaciente/{id}", [PacientesController::class, 'update']);
Route::delete("/EliminarPaciente/{id}", [PacientesController::class, 'destroy']);
Route::get("/pacientesMasculinos", [PacientesController::class, 'pacientesMasculinos']);

//Citas Médicas Routes
Route::get("/listarCitasMedicas", [CitasMedicasController::class, 'index']);
Route::post("/AgregarCitaMedica", [CitasMedicasController::class, 'store']);
Route::get("/citaMedica/{id}", [CitasMedicasController::class, 'show']);
Route::put("/ActualizarCitaMedica/{id}", [CitasMedicasController::class, 'update']);
Route::delete("/EliminarCitaMedica/{id}", [CitasMedicasController::class, 'destroy']);
Route::get("/citasPorPaciente/{pacienteId}", [CitasMedicasController::class, 'citasPorPaciente']);
Route::get("/citasPorDoctor/{doctorId}", [CitasMedicasController::class, 'citasPorDoctor']);
Route::get("/citasCompletadas", [CitasMedicasController::class, 'citasCompletadas']);

// Consultorios Routes
Route::get   ('/consultorios',                [ConsultoriosController::class, 'index']);
Route::post  ('/consultorios',                [ConsultoriosController::class, 'store']);
Route::get   ('/consultorios/{consultorio}',  [ConsultoriosController::class, 'show']);
Route::put   ('/consultorios/{consultorio}',  [ConsultoriosController::class, 'update']);
Route::delete('/consultorios/{consultorio}',  [ConsultoriosController::class, 'destroy']);