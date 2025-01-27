<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todos = [
            [
                'task' => 'Completar documentación del proyecto',
                'status' => 'open',
                'order' => 1,
                'group' => 1,
                'time_spent' => 0,
                'is_paused' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Revisar correos pendientes',
                'status' => 'doing',
                'order' => 2,
                'group' => 1,
                'time_spent' => 30,
                'is_paused' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Preparar presentación para el cliente',
                'status' => 'done',
                'order' => 3,
                'group' => 1,
                'time_spent' => 120,
                'is_paused' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Hacer ejercicio',
                'status' => 'doing',
                'order' => 4,
                'group' => 2,
                'time_spent' => 45,
                'is_paused' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Leer libro pendiente',
                'status' => 'open',
                'order' => 5,
                'group' => 2,
                'time_spent' => 0,
                'is_paused' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Tarea antigua cancelada',
                'status' => 'trash',
                'order' => 6,
                'group' => 2,
                'time_spent' => 15,
                'is_paused' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($todos as $todo) {
            \App\Models\Todo::create($todo);
        }
    }
}
