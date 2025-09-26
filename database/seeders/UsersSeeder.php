<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin users
        $admins = [
            ['name' => 'Carlos Rodríguez', 'email' => 'carlos.admin@hospital.com', 'rol' => 'admin'],
            ['name' => 'María González', 'email' => 'maria.admin@hospital.com', 'rol' => 'admin'],
            ['name' => 'Luis Fernández', 'email' => 'luis.admin@hospital.com', 'rol' => 'admin'],
            ['name' => 'Ana Martínez', 'email' => 'ana.admin@hospital.com', 'rol' => 'admin'],
            ['name' => 'Jorge López', 'email' => 'jorge.admin@hospital.com', 'rol' => 'admin'],
        ];

        // Doctor users
        $doctors = [
            ['name' => 'Dr. Roberto Silva', 'email' => 'roberto.doctor@hospital.com', 'rol' => 'doctor'],
            ['name' => 'Dra. Carmen Ruiz', 'email' => 'carmen.doctor@hospital.com', 'rol' => 'doctor'],
            ['name' => 'Dr. Miguel Torres', 'email' => 'miguel.doctor@hospital.com', 'rol' => 'doctor'],
            ['name' => 'Dra. Patricia Díaz', 'email' => 'patricia.doctor@hospital.com', 'rol' => 'doctor'],
            ['name' => 'Dr. Fernando Morales', 'email' => 'fernando.doctor@hospital.com', 'rol' => 'doctor'],
        ];

        // Patient users
        $patients = [
            ['name' => 'Sofía Hernández', 'email' => 'sofia.paciente@hospital.com', 'rol' => 'paciente'],
            ['name' => 'Diego Sánchez', 'email' => 'diego.paciente@hospital.com', 'rol' => 'paciente'],
            ['name' => 'Valentina Jiménez', 'email' => 'valentina.paciente@hospital.com', 'rol' => 'paciente'],
            ['name' => 'Mateo Castro', 'email' => 'mateo.paciente@hospital.com', 'rol' => 'paciente'],
            ['name' => 'Isabella Ortega', 'email' => 'isabella.paciente@hospital.com', 'rol' => 'paciente'],
        ];

        $allUsers = array_merge($admins, $doctors, $patients);

        foreach ($allUsers as $userData) {
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password123'),
                'rol' => $userData['rol']
            ]);
        }
    }
}