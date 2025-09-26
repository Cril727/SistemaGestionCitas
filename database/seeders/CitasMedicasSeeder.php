<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\citas_medicas;
use Carbon\Carbon;

class CitasMedicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $citas = [
            [
                'paciente_id' => 1,
                'doctor_id' => 1,
                'fecha_hora' => Carbon::now()->addDays(1)->setHour(9)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 1
            ],
            [
                'paciente_id' => 2,
                'doctor_id' => 2,
                'fecha_hora' => Carbon::now()->addDays(1)->setHour(10)->setMinute(30)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 2
            ],
            [
                'paciente_id' => 3,
                'doctor_id' => 3,
                'fecha_hora' => Carbon::now()->addDays(2)->setHour(14)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 3
            ],
            [
                'paciente_id' => 4,
                'doctor_id' => 4,
                'fecha_hora' => Carbon::now()->addDays(2)->setHour(15)->setMinute(30)->format('Y-m-d H:i:s'),
                'estado' => 'completada',
                'novedad' => 'Paciente llegó puntual',
                'consultorio_id' => 4
            ],
            [
                'paciente_id' => 5,
                'doctor_id' => 5,
                'fecha_hora' => Carbon::now()->addDays(3)->setHour(8)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 5
            ],
            [
                'paciente_id' => 6,
                'doctor_id' => 6,
                'fecha_hora' => Carbon::now()->addDays(3)->setHour(11)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'cancelada',
                'novedad' => 'Cancelada por el paciente',
                'consultorio_id' => 6
            ],
            [
                'paciente_id' => 7,
                'doctor_id' => 7,
                'fecha_hora' => Carbon::now()->addDays(4)->setHour(9)->setMinute(30)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 7
            ],
            [
                'paciente_id' => 8,
                'doctor_id' => 8,
                'fecha_hora' => Carbon::now()->addDays(4)->setHour(16)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'completada',
                'novedad' => 'Tratamiento exitoso',
                'consultorio_id' => 8
            ],
            [
                'paciente_id' => 9,
                'doctor_id' => 9,
                'fecha_hora' => Carbon::now()->addDays(5)->setHour(10)->setMinute(0)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 9
            ],
            [
                'paciente_id' => 10,
                'doctor_id' => 10,
                'fecha_hora' => Carbon::now()->addDays(5)->setHour(14)->setMinute(30)->format('Y-m-d H:i:s'),
                'estado' => 'programada',
                'novedad' => null,
                'consultorio_id' => 10
            ]
        ];

        foreach ($citas as $cita) {
            citas_medicas::create($cita);
        }
    }
}