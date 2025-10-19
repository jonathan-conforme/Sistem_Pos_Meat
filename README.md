# Proyecto Carnicería - Laravel

Sistema de gestión para carnicería desarrollado en Laravel.

## Características
- Gestión de productos y categorías
- Sistema de ventas POS
- Control de inventario
- Gestión de usuarios y permisos

## Instalación
1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. Configurar base de datos en .env
5. `php artisan migrate --seed`
## Migrar los seeders
1.  `php artisan db:seed`
## En Tinker:
1. `php artisan tinker`
2. `$user = User::find(1);`
3. `$user->assignRole('administrador');`
// Verificar
4. `$user->getRoleNames();`
