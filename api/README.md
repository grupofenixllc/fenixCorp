# FenixCorp Monorepo

Este repositorio contiene el código base del sistema multi‑tenant de punto de venta (POS) e inventario de **FenixCorp**.  La aplicación está pensada para funcionar inicialmente sobre un entorno LAMP compartido (PHP 8.3/8.4 + Apache + MySQL 8) y posteriormente migrar a contenedores en Azure con PostgreSQL.

## Estructura de carpetas

```
fenixcorp/
├── apps/
│   ├── api/      # Backend (Laravel)
│   └── web/      # Frontend (React + Vite + Tailwind)
└── infra/        # Scripts de despliegue y automatización (en blanco por ahora)
```

### `/apps/api`

Código fuente de la API basada en Laravel 11.  Incluye únicamente el `composer.json` y un stub de `public/index.php` para permitir la instalación posterior.  Para obtener un proyecto funcional hay que ejecutar `composer install` (con PHP 8.3+) y generar las migraciones según las especificaciones del proyecto.

### `/apps/web`

Aplicación de interfaz de usuario construida con React, Vite y Tailwind CSS.  Contiene un paquete `package.json` con las dependencias necesarias, el archivo de configuración de Vite y Tailwind, y un prototipo de página de inicio con el logotipo de FenixCorp.  Es compatible con modo claro/oscuro mediante la clase `dark` en `body`.

### `/infra`

Contendrá scripts y configuraciones de despliegue (por ejemplo, para cron, Cloudflare, Docker/Bicep/Terraform) que se desarrollarán en fases posteriores.

## Puesta en marcha (desarrollo)

### Requisitos previos

- PHP ≥ 8.3 con Composer instalado.
- Node.js ≥ 18 con npm.
- MySQL 8 para uso local (en producción se soportará PostgreSQL).

### Backend (Laravel)

1. Entrar en `apps/api` y ejecutar `composer install`.
2. Copiar el archivo `.env.example` a `.env` y configurar las variables de entorno (DB, mail, claves de terceros).
3. Generar la clave de aplicación:

   ```sh
   php artisan key:generate
   ```

4. Ejecutar migraciones y seeders (cuando estén disponibles):

   ```sh
   php artisan migrate --seed
   ```

5. Levantar el servidor de desarrollo:

   ```sh
   php artisan serve
   ```

### Frontend (React)

1. Entrar en `apps/web` y ejecutar:

   ```sh
   npm install
   ```

2. Iniciar el servidor de desarrollo:

   ```sh
   npm run dev
   ```

3. Para producción ejecutar `npm run build`.  Los archivos generados en `apps/web/dist` deberán copiarse al directorio `apps/api/public` para que el backend sirva la SPA.

## Checklist de seguridad (resumen)

- Forzar HTTPS y activar HSTS y Content Security Policy en Apache/Nginx.
- Rotar periódicamente todas las claves y contraseñas almacenadas en `.env`.
- Habilitar MFA/2FA para usuarios con privilegios elevados (SuperAdmin, Admin).
- Aplicar rate‑limit en rutas sensibles como `/login`, `/export` e importaciones masivas.
- Restringir la exportación de datos a usuarios con rol SuperAdmin o Admin.

Para más detalles revisar las especificaciones del proyecto.
