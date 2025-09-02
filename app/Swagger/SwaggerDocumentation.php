<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Gestión de Citas Médicas",
 *     description="Documentación de la API para gestionar citas médicas, doctores, pacientes, especialidades y consultorios.",
 *     @OA\Contact(
 *         email="soporte@tudominio.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor local"
 * )
 * 
 * @OA\Tag(
 *     name="Citas Médicas",
 *     description="Operaciones relacionadas con las citas médicas"
 * )
 * 
 * @OA\Tag(
 *     name="Doctores",
 *     description="Operaciones relacionadas con los doctores"
 * )
 * 
 * @OA\Tag(
 *     name="Pacientes",
 *     description="Operaciones relacionadas con los pacientes"
 * )
 * 
 * @OA\Tag(
 *     name="Especialidades",
 *     description="Operaciones relacionadas con las especialidades médicas"
 * )
 * 
 * @OA\Tag(
 *     name="Consultorios",
 *     description="Operaciones relacionadas con los consultorios"
 * )
 */
class SwaggerDocumentation
{
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
     */
}
