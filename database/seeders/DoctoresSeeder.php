<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctores;

class DoctoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctores = [
            [
                'nombre' => 'Roberto',
                'apellido' => 'Silva',
                'email' => 'roberto.silva@hospital.com',
                'telefono' => '3001234567',
                'genero' => 'M',
                'estado' => 'activo',
                'especialidad_id' => 1
            ],
            [
                'nombre' => 'Carmen',
                'apellido' => 'Ruiz',
                'email' => 'carmen.ruiz@hospital.com',
                'telefono' => '3002345678',
                'genero' => 'F',
                'estado' => 'activo',
                'especialidad_id' => 2
            ],
            [
                'nombre' => 'Miguel',
                'apellido' => 'Torres',
                'email' => 'miguel.torres@hospital.com',
                'telefono' => '3003456789',
                'genero' => 'M',
                'estado' => 'activo',
                'especialidad_id' => 3
            ],
            [
                'nombre' => 'Patricia',
                'apellido' => 'Díaz',
                'email' => 'patricia.diaz@hospital.com',
                'telefono' => '3004567890',
                'genero' => 'F',
                'estado' => 'activo',
                'especialidad_id' => 4
            ],
            [
                'nombre' => 'Fernando',
                'apellido' => 'Morales',
                'email' => 'fernando.morales@hospital.com',
                'telefono' => '3005678901',
                'genero' => 'M',
                'estado' => 'activo',
                'especialidad_id' => 5
            ],
            [
                'nombre' => 'Lucía',
                'apellido' => 'García',
                'email' => 'lucia.garcia@hospital.com',
                'telefono' => '3006789012',
                'genero' => 'F',
                'estado' => 'activo',
                'especialidad_id' => 6
            ],
            [
                'nombre' => 'Alejandro',
                'apellido' => 'Pérez',
                'email' => 'alejandro.perez@hospital.com',
                'telefono' => '3007890123',
                'genero' => 'M',
                'estado' => 'activo',
                'especialidad_id' => 7
            ],
            [
                'nombre' => 'Mónica',
                'apellido' => 'Vargas',
                'email' => 'monica.vargas@hospital.com',
                'telefono' => '3008901234',
                'genero' => 'F',
                'estado' => 'activo',
                'especialidad_id' => 8
            ],
            [
                'nombre' => 'David',
                'apellido' => 'Ramírez',
                'email' => 'david.ramirez@hospital.com',
                'telefono' => '3009012345',
                'genero' => 'M',
                'estado' => 'inactivo',
                'especialidad_id' => 9
            ],
            [
                'nombre' => 'Carolina',
                'apellido' => 'Herrera',
                'email' => 'carolina.herrera@hospital.com',
                'telefono' => '3010123456',
                'genero' => 'F',
                'estado' => 'activo',
                'especialidad_id' => 10
            ]
        ];

        foreach ($doctores as $doctor) {
            Doctores::create($doctor);
        }
    }
}