<?php
// Script para forzar la limpieza y caché de Laravel sin acceso SSH

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Inicia el Kernel de Artisan
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Ejecuta los comandos para asegurar que la configuración se lea desde el .env
\Artisan::call('config:clear');
\Artisan::call('route:clear');
\Artisan::call('cache:clear');
\Artisan::call('view:clear');

// Regenera la caché de configuración y rutas con los datos correctos del .env
\Artisan::call('config:cache');
\Artisan::call('route:cache');


echo "¡Cache de Laravel limpiada y regenerada con éxito! La configuración del .env está aplicada.";
?>