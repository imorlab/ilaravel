# Personal Productivity Tool Suite

<p align="center">
<img src="public/img/laravel_96.png" width="100" alt="Laravel Logo">
</p>

## Acerca del Proyecto

Este es un sistema de productividad personal desarrollado con Laravel 10, que incluye varias herramientas para mejorar la gestión de tareas diarias y notas personales.

### Características Principales

#### Sistema de Notas
- Creación, edición y eliminación de notas
- Categorización (Trabajo, Personal, Ideas)
- Sistema de favoritos
- Búsqueda en tiempo real
- Interfaz moderna con diseño glassmorphism
- Exportación de notas a PDF
- Sistema de etiquetas dinámicas
- Historial de cambios
- Compartir notas vía enlace

#### Sistema de Tareas
- Gestión de tareas con drag & drop
- Cronómetro por tarea
- Organización por estados
- Seguimiento de tiempo
- Interfaz intuitiva
- Notificaciones de vencimiento
- Subtareas anidadas
- Priorización visual
- Filtros avanzados
- Reportes de productividad

#### Sistema de Newsletters
- Prueba de newsletters antes del envío oficial
- Soporte para contenido HTML
- Vista previa instantánea
- Lista de correos predefinida
- Confirmación visual de envío mediante SweetAlert2
- Validación de correos RFC/DNS
- Interfaz moderna con diseño glassmorphic
- Manejo inteligente de errores
- Feedback visual del estado de envío
- Registro automático de newsletters enviadas
- Plantillas personalizables
- Seguimiento de apertura
- Programación de envíos
- Gestión de listas de suscriptores
- Análisis de engagement

#### Sistema de Plantillas de Email
- Editor visual de plantillas de email con bloques personalizables
- Interfaz moderna con pestañas personalizadas para diferentes tipos de bloques (Headers, Contenido, Footers)
- Vista previa en tiempo real de las plantillas
- Guardado y reutilización de bloques individuales
- Sistema de previsualización de plantillas completas
- Gestión de plantillas activas y archivadas
- Soporte para plantillas responsivas

#### Dashboard
- Vista general de estadísticas
- Gráficos de progreso
- Actividades recientes
- Calendario de actividades
- Monitoreo de tareas y tiempo
- Widgets personalizables
- Métricas de productividad
- Resumen semanal/mensual
- Integración con calendario
- Panel de objetivos

### Tecnologías Utilizadas

- **Framework:** Laravel 10
- **Frontend:** 
  - Blade templates
  - Bootstrap 5
  - Livewire 3
  - Alpine.js
  - Chart.js
  - Drag & Drop API
  - SweetAlert2
- **Base de Datos:** MySQL
- **Email:** Laravel Mail
- **Diseño:** 
  - Glassmorphism UI
  - Responsive design
  - Dark theme

### Requisitos del Sistema

- PHP 8.1 o superior
- Composer
- Node.js y NPM
- MySQL
- Servidor SMTP configurado

### Instalación

1. Clonar el repositorio
```bash
git clone https://github.com/imorlab/ilaravel.git
```

2. Instalar dependencias de PHP
```bash
composer install
```

3. Copiar el archivo de configuración
```bash
cp .env.example .env
```

4. Generar clave de aplicación
```bash
php artisan key:generate
```

5. Configurar la base de datos en el archivo .env

6. Configurar credenciales SMTP en el archivo .env

7. Ejecutar migraciones
```bash
php artisan migrate
```

### Características en Desarrollo

- [ ] Sistema de autenticación de usuarios
- [ ] Exportación/importación de notas
- [ ] Etiquetas personalizadas
- [ ] Integración con calendario
- [ ] API REST
- [ ] Estadísticas avanzadas de tiempo por tarea
- [x] Sistema moderno de newsletters con Livewire
- [ ] Plantillas HTML para newsletters

### Contribución

Las contribuciones son bienvenidas. Por favor, lee las guías de contribución antes de enviar un pull request.

### Licencia

Este proyecto está licenciado bajo la [Licencia MIT](LICENSE).

### Autor

Desarrollado por [Imorlab](https://github.com/imorlab)

---

#Iml2024
