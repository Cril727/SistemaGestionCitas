<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidades;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $especialidades = [
            'Medicina General',
            'Cardiología',
            'Dermatología',
            'Ginecología',
            'Pediatría',
            'Oftalmología',
            'Traumatología',
            'Neurología',
            'Psiquiatría',
            'Radiología'
        ];

        foreach ($especialidades as $especialidad) {
            Especialidades::create([
                'nombre' => $especialidad
            ]);
        }
    }
}