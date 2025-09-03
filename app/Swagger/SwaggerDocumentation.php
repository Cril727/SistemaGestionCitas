<?php
// app/Swagger/SwaggerDocumentation.php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Gestión de Citas Médicas",
 *     description="Documentación de la API",
 *     @OA\Contact(email="contacto@ejemplo.com")
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Servidor local"
 * )
 *
 * @OA\Tag(name="Consultorios", description="Consultorios")
 * @OA\Tag(name="Citas Médicas", description="Citas médicas")
 */

class SwaggerDocumentation
{
}


