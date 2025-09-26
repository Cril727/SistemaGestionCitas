<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        \App\Models\Especialidades::truncate();
        \App\Models\User::truncate();
        \App\Models\Pacientes::truncate();
        \App\Models\consultorios::truncate();
        \App\Models\Doctores::truncate();
        \App\Models\citas_medicas::truncate();

        // Re-enable foreign key checks
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Run all seeders to populate the database with sample data
        $this->call([
            EspecialidadesSeeder::class,
            UsersSeeder::class,
            DoctoresSeeder::class,
            PacientesSeeder::class,
            ConsultoriosSeeder::class,
            CitasMedicasSeeder::class,
        ]);
    }
}
