# PlantillaLaravel

Panel administrativo con Laravel 12 + Livewire 3 + AdminLTE 3.

- Inicio de sesión por **nombre de usuario** (campo `name`)
- Roles y permisos con **Spatie**
- Interfaz **AdminLTE** con assets locales
- Paginación **Bootstrap**

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+ y npm
- Base de datos (PostgreSQL, MySQL, SQLite…)

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio> plantillalaravel
cd plantillalaravel

# 2. Instalar dependencias PHP
composer install

# 3. Copiar y configurar variables de entorno
cp .env.example .env
# Editar .env: DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, etc.
# Para login por usuario: FORTIFY_USERNAME=name (ya está en config/fortify.php)

# 4. Generar clave de aplicación
php artisan key:generate

# 5. Configurar la base de datos y ejecutar migraciones
php artisan migrate

# 6. Poblar roles, permisos y usuarios de prueba
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder

# 7. Instalar dependencias frontend y compilar assets
npm install
npm run build
```

## Usuarios de prueba

| Usuario | Contraseña | Rol |
|---|---|---|
| `admin` | `12345678` | Super Admin |
| `demo` | `12345678` | Usuario (sin permisos especiales) |

## Ejecutar en desarrollo

```bash
# Servidor de desarrollo + Vite
npm run dev
```

En otro terminal:

```bash
php artisan serve
# o, si usas el script del proyecto:
composer run dev
```

Acceder a `http://localhost:8000`.

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/login` | Inicio de sesión |
| `/admin/dashboard` | Panel principal |
| `/admin/usuarios` | CRUD de usuarios |
| `/admin/roles` | CRUD de roles y permisos |
| `/admin/componentes` | Catálogo de componentes AdminLTE |

## Estructura

```
app/
├── Livewire/Admin/
│   ├── User/Index.php       # CRUD usuarios con Livewire
│   ├── Role/Index.php       # CRUD roles y permisos
│   └── Ui/Index.php         # Catálogo de componentes
resources/views/
├── layouts/
│   ├── admin.blade.php      # Layout del panel
│   └── guest.blade.php      # Layout del login
├── livewire/admin/
│   ├── user/index.blade.php
│   ├── role/index.blade.php
│   └── ui/index.blade.php
└── auth/login.blade.php     # Login con estilo AdminLTE
```

## Comandos útiles

```bash
php artisan cache:clear       # Limpiar caché general
php artisan view:clear        # Limpiar caché de Blade
php artisan route:clear       # Limpiar caché de rutas
npm run build                 # Compilar assets para producción
```
