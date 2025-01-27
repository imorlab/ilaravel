<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Notas de trabajo
        $workNotes = [
            [
                'title' => 'Planificación Sprint Q1',
                'content' => 'Objetivos principales:\n- Implementar autenticación\n- Diseñar dashboard\n- Desarrollar sistema de notas\n- Testing y documentación',
                'category' => 'trabajo',
                'is_favorite' => true
            ],
            [
                'title' => 'Reunión con el equipo de diseño',
                'content' => 'Puntos a tratar:\n- Revisión de mockups\n- Paleta de colores\n- Sistema de componentes\n- Timeline del proyecto',
                'category' => 'trabajo',
                'is_favorite' => false
            ],
            [
                'title' => 'Optimización de base de datos',
                'content' => 'Tareas pendientes:\n- Revisar índices\n- Optimizar consultas\n- Implementar caché\n- Monitorear rendimiento',
                'category' => 'trabajo',
                'is_favorite' => false
            ],
            [
                'title' => 'Code Review Guidelines',
                'content' => 'Estándares:\n- PSR-12 para PHP\n- Documentación clara\n- Tests unitarios\n- No código duplicado',
                'category' => 'trabajo',
                'is_favorite' => false
            ],
            [
                'title' => 'Deployment Checklist',
                'content' => 'Pre-deploy:\n- Backup de DB\n- Tests en staging\n- Revisión de logs\n- Notificación al equipo',
                'category' => 'trabajo',
                'is_favorite' => false
            ]
        ];

        // Notas personales
        $personalNotes = [
            [
                'title' => 'Lista de compras semanal',
                'content' => 'Necesario:\n- Frutas y verduras\n- Productos de limpieza\n- Artículos de oficina\n- Snacks saludables',
                'category' => 'personal',
                'is_favorite' => true
            ],
            [
                'title' => 'Rutina de ejercicios',
                'content' => 'Plan semanal:\n- Lunes: Cardio\n- Miércoles: Fuerza\n- Viernes: Yoga\n- Fines de semana: Caminata',
                'category' => 'personal',
                'is_favorite' => false
            ],
            [
                'title' => 'Películas pendientes',
                'content' => 'Por ver:\n- Inception\n- The Matrix\n- Interstellar\n- The Dark Knight',
                'category' => 'personal',
                'is_favorite' => false
            ],
            [
                'title' => 'Metas mensuales',
                'content' => 'Objetivos:\n- Leer 2 libros\n- Meditar 15 min/día\n- Aprender algo nuevo\n- Organizar el espacio',
                'category' => 'personal',
                'is_favorite' => false
            ],
            [
                'title' => 'Recetas favoritas',
                'content' => 'Colección:\n- Pasta al pesto\n- Ensalada césar\n- Smoothie verde\n- Galletas de avena',
                'category' => 'personal',
                'is_favorite' => false
            ]
        ];

        // Notas de ideas
        $ideaNotes = [
            [
                'title' => 'App de productividad',
                'content' => 'Características:\n- Gestión de tiempo\n- Lista de tareas\n- Recordatorios\n- Sincronización en la nube',
                'category' => 'ideas',
                'is_favorite' => true
            ],
            [
                'title' => 'Blog técnico',
                'content' => 'Temas:\n- Laravel tips\n- Vue.js patterns\n- DevOps prácticas\n- Clean code',
                'category' => 'ideas',
                'is_favorite' => false
            ],
            [
                'title' => 'Sistema IoT para casa',
                'content' => 'Componentes:\n- Sensores de temperatura\n- Control de luces\n- Cámaras de seguridad\n- Dashboard central',
                'category' => 'ideas',
                'is_favorite' => false
            ],
            [
                'title' => 'Extensión para VS Code',
                'content' => 'Funcionalidades:\n- Snippets personalizados\n- Temas de color\n- Atajos de teclado\n- Integración con APIs',
                'category' => 'ideas',
                'is_favorite' => false
            ],
            [
                'title' => 'Red social para devs',
                'content' => 'Features:\n- Compartir código\n- Code reviews\n- Mentorías\n- Eventos virtuales',
                'category' => 'ideas',
                'is_favorite' => false
            ]
        ];

        // Crear todas las notas
        foreach (array_merge($workNotes, $personalNotes, $ideaNotes) as $note) {
            Note::create($note);
        }
    }
}
