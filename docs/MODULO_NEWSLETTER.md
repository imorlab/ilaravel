# Documentación del Módulo Newsletter

## Descripción General
El Módulo Newsletter es un editor dinámico de plantillas de correo electrónico construido con Laravel, Livewire y Bootstrap. Permite a los usuarios crear y personalizar boletines de correo electrónico con vista previa en tiempo real.

## Características
- Edición dinámica de bloques de contenido
- Actualizaciones de vista previa en tiempo real
- Guardado y descarga de plantillas
- Diseño responsive
- Persistencia en base de datos

## Stack Tecnológico
- **Backend:** Laravel 10.x
- **Frontend:** 
  - Livewire 3.x
  - Bootstrap 5.x
- **Base de datos:** MySQL

## Instalación

1. Asegúrate de tener las tablas necesarias en la base de datos:
```sql
php artisan migrate
```

Esto creará la tabla `cerberus_templates` con la siguiente estructura:
- `id` (bigint, auto-incremento)
- `name` (cadena)
- `blocks` (json)
- `is_active` (booleano)

## Uso

### Acceso al Editor
Navega a `/newsletter/editor` para acceder a la interfaz del editor de newsletters.

### Bloques de Contenido
El editor admite los siguientes bloques de contenido:

1. **Bloque de Cabecera**
   - URL del logotipo
   - Texto alternativo

2. **Bloque Hero**
   - URL de la imagen
   - Texto alternativo
   - Ancho de la imagen (por defecto: 600px)
   - Alineación (izquierda, centro, derecha)

3. **Bloque de Contenido**
   - Título
   - Texto
   - Texto del botón
   - URL del botón

4. **Bloque de Dos Columnas**
   - Columna Izquierda
     - URL de la imagen
     - Texto
   - Columna Derecha
     - URL de la imagen
     - Texto

5. **Bloque de Pie de Página**
   - Nombre de la empresa
   - Dirección
   - Teléfono

### Edición de Contenido
1. Cada bloque puede activarse/desactivarse mediante el interruptor
2. Todos los cambios se guardan automáticamente
3. La vista previa se actualiza en tiempo real
4. Utiliza el botón "Descargar Plantilla" para exportar el HTML

## Estructura de Componentes

### Archivos Principales
- `app/Livewire/CerberusEditor.php`: Lógica principal del componente
- `resources/views/livewire/cerberus-editor.blade.php`: Interfaz del editor
- `resources/views/emails/template.blade.php`: Plantilla de correo
- `app/Models/CerberusTemplate.php`: Modelo de plantilla

### Flujo de Datos
1. Las entradas del usuario se capturan usando `wire:model.live`
2. Los cambios se sincronizan automáticamente con el componente Livewire
3. La vista previa se actualiza cada 5 segundos usando `wire:poll`
4. Las plantillas se guardan automáticamente en la base de datos

## Buenas Prácticas

### Pautas de Contenido
- Utiliza imágenes de alta calidad con dimensiones apropiadas
- Mantén el contenido de texto conciso y atractivo
- Asegúrate de que todos los enlaces sean válidos y seguros (https)
- Prueba las plantillas en diferentes clientes de correo

### Consideraciones de Rendimiento
- Las imágenes deben estar optimizadas para correo electrónico
- Evita el uso excesivo de imágenes grandes
- Mantén la estructura HTML limpia y simple

## Solución de Problemas

### Problemas Comunes

1. **La Vista Previa No Se Actualiza**
   - Comprueba la consola del navegador en busca de errores
   - Asegúrate de que Livewire esté correctamente inicializado
   - Verifica la conexión a la base de datos

2. **Las Imágenes No Cargan**
   - Verifica que las URLs de las imágenes sean accesibles
   - Comprueba la compatibilidad del formato de imagen
   - Asegúrate de que la codificación de URL sea correcta

3. **La Plantilla No Se Guarda**
   - Comprueba la conexión a la base de datos
   - Verifica los permisos adecuados
   - Revisa los registros de errores

## Mejoras Futuras
- [ ] Añadir capacidad de subida de imágenes
- [ ] Implementar versionado de plantillas
- [ ] Añadir más tipos de bloques
- [ ] Mejorar la vista previa móvil
- [ ] Integración de pruebas de cliente de correo

## Soporte
Para soporte técnico o solicitudes de funcionalidades, por favor crea una incidencia en el repositorio del proyecto o contacta con el equipo de desarrollo.

## Licencia
Este módulo es parte de la aplicación principal y sigue sus términos de licencia.
