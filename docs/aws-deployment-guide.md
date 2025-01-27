# Guía de Despliegue en AWS

## Pasos Realizados

1. Instalación de Herramientas Necesarias
   - Instalación de AWS CLI mediante Homebrew
   - Instalación de AWS Elastic Beanstalk CLI
   ```bash
   brew install aws-elasticbeanstalk
   ```

2. Preparación del Entorno
   - Creación del directorio .aws para las credenciales
   ```bash
   mkdir -p ~/.aws
   ```

## Próximos Pasos

### 1. Crear una Cuenta AWS
- Visitar [https://aws.amazon.com/free/](https://aws.amazon.com/free/)
- Registrarse para una cuenta gratuita

### 2. Crear Usuario IAM

1. Iniciar sesión en la Consola AWS
   - Ir a [AWS Management Console](https://aws.amazon.com/console/)
   - Iniciar sesión con tu cuenta root

2. Buscar el servicio IAM
   - En la barra de búsqueda superior, escribir "IAM"
   - Seleccionar "IAM" de los resultados

3. Crear un nuevo usuario
   - En el panel izquierdo, hacer clic en "Users"
   - Hacer clic en "Create user"
   - Nombre de usuario sugerido: `ilaravel-admin`
   - Marcar la opción "Provide user access to the AWS Management Console"
   - Seleccionar "Quiero crear un usuario IAM"
   - Establecer una contraseña personalizada
   - Desmarcar "User must create a new password at next sign-in" si prefieres mantener la misma contraseña

4. Configurar permisos
   - En la página de permisos, seleccionar "Adjuntar políticas directamente"
   - Buscar y seleccionar las siguientes políticas:
     * `AdministratorAccess-AWSElasticBeanstalk` (Acceso completo a Elastic Beanstalk)
     * `AWSElasticBeanstalkManagedUpdatesCustomerRolePolicy` (Para actualizaciones gestionadas)
     * `AWSElasticBeanstalkEnhancedHealth` (Para monitoreo de salud mejorado)

5. Configurar MFA (Multi-Factor Authentication)
   - Nombre del dispositivo MFA: `ilaravel-mfa-device`
   - Usar una aplicación autenticadora (Google Authenticator, Authy, etc.)
   - Escanear el código QR
   - Ingresar dos códigos consecutivos para verificar

6. Crear Access Key
   - Después de crear el usuario, ir a la pestaña "Security credentials"
   - En la sección "Access keys", hacer clic en "Create access key"
   - Seleccionar "Command Line Interface (CLI)"
   - Aceptar las recomendaciones
   - Crear la Access Key
   - **IMPORTANTE**: Descargar el archivo .csv o copiar y guardar de forma segura:
     * Access Key ID
     * Secret Access Key

7. Guardar información importante
   - URL de inicio de sesión de IAM
   - ID de cuenta de AWS
   - Nombre de usuario
   - Contraseña
   - Access Key ID
   - Secret Access Key

⚠️ **Notas de Seguridad**:
- Nunca compartas tus credenciales
- Guarda el Secret Access Key de forma segura, no podrás verlo nuevamente
- Habilita MFA lo antes posible
- No uses la cuenta root para operaciones diarias

### 3. Configurar Credenciales AWS
Ejecutar el siguiente comando y seguir las instrucciones:
```bash
aws configure
```

Se te pedirá:
- AWS Access Key ID (La clave de acceso que acabas de crear)
- AWS Secret Access Key (La clave secreta que acabas de crear)
- Default region: `eu-central-1` (Frankfurt, Alemania)
- Default output format: `json`

> **Nota**: Se ha seleccionado la región `eu-central-1` (Frankfurt) por:
> - Alta disponibilidad de servicios AWS
> - Buena latencia para accesos desde España
> - Cumplimiento con regulaciones europeas de datos

### 4. Configuración de la Aplicación

#### 4.1 Preparar el Entorno Laravel
1. Asegurarse de que el archivo `.env` está configurado correctamente:
   ```env
   APP_NAME=iLaravel
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=http://tu-dominio-eb.eu-central-1.elasticbeanstalk.com

   LOG_CHANNEL=stack
   LOG_LEVEL=error

   DB_CONNECTION=mysql
   DB_HOST=RDS-endpoint-si-usas-rds
   DB_PORT=3306
   DB_DATABASE=tu_base_de_datos
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

2. Optimizar Laravel para producción:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

#### 4.2 Configurar Elastic Beanstalk
1. Crear archivo de configuración `.ebextensions/01-setup.config`:
   ```yaml
   option_settings:
     aws:elasticbeanstalk:container:php:phpini:
       document_root: /public
       memory_limit: 256M
       zlib.output_compression: "Off"
       allow_url_fopen: "On"
       display_errors: "Off"
       max_execution_time: 60
       composer_options: --optimize-autoloader

   commands:
     01_install_composer:
       command: "curl -sS https://getcomposer.org/installer | php"
       cwd: /usr/local/bin
       test: "[ ! -f /usr/local/bin/composer ]"

   container_commands:
     01_storage_permissions:
       command: |
         chmod -R 775 storage
         chmod -R 775 bootstrap/cache
     02_run_migrations:
       command: "php artisan migrate --force"
       leader_only: true
     03_clear_cache:
       command: |
         php artisan config:clear
         php artisan cache:clear
         php artisan view:clear
     04_optimize:
       command: |
         php artisan config:cache
         php artisan route:cache
         php artisan view:cache
   ```

2. Crear archivo `.platform/nginx/conf.d/elasticbeanstalk/laravel.conf`:
   ```nginx
   location / {
       try_files $uri $uri/ /index.php?$query_string;
   }
   ```

#### 4.3 Configurar Git para el Despliegue
1. Crear archivo `.gitignore` si no existe:
   ```
   /node_modules
   /public/hot
   /public/storage
   /storage/*.key
   /vendor
   .env
   .env.backup
   .phpunit.result.cache
   docker-compose.override.yml
   Homestead.json
   Homestead.yaml
   npm-debug.log
   yarn-error.log
   /.idea
   /.vscode
   ```

2. Crear archivo `.elasticbeanstalk/config.yml`:
   ```yaml
   branch-defaults:
     main:
       environment: ilaravel-env
   environment-defaults:
     ilaravel-env:
       branch: null
       repository: null
   global:
     application_name: ilaravel
     default_ec2_keyname: null
     default_platform: PHP 8.2
     default_region: eu-central-1
     sc: git
   ```

#### 4.4 Preparar Base de Datos (Opcional)
Si planeas usar Amazon RDS:
1. Crear una base de datos RDS en MySQL
2. Configurar el grupo de seguridad para permitir conexiones desde Elastic Beanstalk
3. Actualizar las variables de entorno en la configuración de Elastic Beanstalk

#### 4.5 Variables de Entorno en AWS
Configurar las siguientes variables en la consola de Elastic Beanstalk:
- `APP_KEY`: Tu clave de aplicación Laravel
- `APP_ENV`: production
- `APP_DEBUG`: false
- Otras variables sensibles de tu `.env`

## Notas Importantes
- Asegúrate de nunca compartir tus credenciales de AWS
- Utiliza siempre las mejores prácticas de seguridad
- Mantén un registro de los recursos AWS que creas para evitar cargos inesperados
