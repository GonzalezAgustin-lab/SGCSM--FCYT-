# SGCSM 🛠️  
**Sistema de Gestión y Control de Solicitudes de Mantenimiento**

Este sistema permite administrar solicitudes de mantenimiento, sus estados e históricos.  
Incluye autenticación segura con **Laravel Sanctum**, gestión de usuarios y permisos con **Spatie Laravel Permission**, y un frontend integrado con **Vite** y **Laravel UI**.

---

## 📋 Requerimientos

Antes de instalar el proyecto, asegurate de contar con:

- **PHP** ^8.1  
- **Composer** ^2.x  
- **Node.js** ^18.x (o superior)  
- **NPM** o **Yarn**  
- **MySQL** / **MariaDB**  
- Extensiones PHP:  
  `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`  

> ⚠️ Nota: si usás **XAMPP en Linux**, todos los comandos PHP/Composer se deben correr con la ruta completa:  
> `/opt/lampp/bin/php composer.phar` en lugar de `php composer`.

---

## 🚀 Instalación rápida

1. **Clonar el repositorio**
```bash
git clone https://github.com/usuario/SGCSM.git
cd SGCSM
```

2. **Instalar dependencias PHP**
```bash
composer install
# Con XAMPP en Linux:
# /opt/lampp/bin/php composer.phar install
```

3. **Instalar dependencias Node.js**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
```

**Editar .env y actualizar la configuración de la base de datos segun corresponda:**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgcsm
DB_USERNAME=usuario
DB_PASSWORD=clave

**Editar .env y actualizar la configuración del servidor de correo electronico segun corresponda:**
MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

5. **Generar clave de la aplicación**

```bash
php artisan key:generate
# con XAMPP en Linux:
# /opt/lampp/bin/php artisan key:generate
```

6. **Migrar y poblar la base de datos**

```bash
php artisan migrate --seed
```

7. **Crear enlace a storage**
```bash
php artisan storage:link
```