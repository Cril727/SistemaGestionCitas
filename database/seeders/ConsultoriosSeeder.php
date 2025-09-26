<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\consultorios;

class ConsultoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultorios = [
            [
                'nombre' => 'Consultorio 101',
                'ubicacion' => 'Piso 1 - Ala Norte',
                'piso' => 1
            ],
            [
                'nombre' => 'Consultorio 102',
                'ubicacion' => 'Piso 1 - Ala Norte',
                'piso' => 1
            ],
            [
                'nombre' => 'Consultorio 201',
                'ubicacion' => 'Piso 2 - Ala Sur',
                'piso' => 2
            ],
            [
                'nombre' => 'Consultorio 202',
                'ubicacion' => 'Piso 2 - Ala Sur',
                'piso' => 2
            ],
            [
                'nombre' => 'Consultorio 203',
                'ubicacion' => 'Piso 2 - Ala Este',
                'piso' => 2
            ],
            [
                'nombre' => 'Consultorio 301',
                'ubicacion' => 'Piso 3 - Ala Oeste',
                'piso' => 3
            ],
            [
                'nombre' => 'Consultorio 302',
                'ubicacion' => 'Piso 3 - Ala Oeste',
                'piso' => 3
            ],
            [
                'nombre' => 'Consultorio 401',
                'ubicacion' => 'Piso 4 - Ala Central',
                'piso' => 4
            ],
            [
                'nombre' => 'Consultorio 402',
                'ubicacion' => 'Piso 4 - Ala Central',
                'piso' => 4
            ],
            [
                'nombre' => 'Consultorio 501',
                'ubicacion' => 'Piso 5 - Área VIP',
                'piso' => 5
            ]
        ];

        foreach ($consultorios as $consultorio) {
            consultorios::create($consultorio);
        }
    }
}