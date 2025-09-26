<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pacientes;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pacientes = [
            [
                'documento' => '1001234567',
                'nombre' => 'Sofía',
                'apellido' => 'Hernández',
                'email' => 'sofia.hernandez@email.com',
                'telefono' => '3101234567',
                'genero' => 'F'
            ],
            [
                'documento' => '1002345678',
                'nombre' => 'Diego',
                'apellido' => 'Sánchez',
                'email' => 'diego.sanchez@email.com',
                'telefono' => '3102345678',
                'genero' => 'M'
            ],
            [
                'documento' => '1003456789',
                'nombre' => 'Valentina',
                'apellido' => 'Jiménez',
                'email' => 'valentina.jimenez@email.com',
                'telefono' => '3103456789',
                'genero' => 'F'
            ],
            [
                'documento' => '1004567890',
                'nombre' => 'Mateo',
                'apellido' => 'Castro',
                'email' => 'mateo.castro@email.com',
                'telefono' => '3104567890',
                'genero' => 'M'
            ],
            [
                'documento' => '1005678901',
                'nombre' => 'Isabella',
                'apellido' => 'Ortega',
                'email' => 'isabella.ortega@email.com',
                'telefono' => '3105678901',
                'genero' => 'F'
            ],
            [
                'documento' => '1006789012',
                'nombre' => 'Sebastián',
                'apellido' => 'Moreno',
                'email' => 'sebastian.moreno@email.com',
                'telefono' => '3106789012',
                'genero' => 'M'
            ],
            [
                'documento' => '1007890123',
                'nombre' => 'Camila',
                'apellido' => 'Rivera',
                'email' => 'camila.rivera@email.com',
                'telefono' => '3107890123',
                'genero' => 'F'
            ],
            [
                'documento' => '1008901234',
                'nombre' => 'Nicolás',
                'apellido' => 'Gutiérrez',
                'email' => 'nicolas.gutierrez@email.com',
                'telefono' => '3108901234',
                'genero' => 'M'
            ],
            [
                'documento' => '1009012345',
                'nombre' => 'Mariana',
                'apellido' => 'Chávez',
                'email' => 'mariana.chavez@email.com',
                'telefono' => '3109012345',
                'genero' => 'F'
            ],
            [
                'documento' => '1010123456',
                'nombre' => 'Emiliano',
                'apellido' => 'Ramos',
                'email' => 'emiliano.ramos@email.com',
                'telefono' => '3110123456',
                'genero' => 'M'
            ]
        ];

        foreach ($pacientes as $paciente) {
            Pacientes::create($paciente);
        }
    }
}