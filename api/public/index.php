<?php

/**
 * Punto de entrada de la aplicación Laravel.
 *
 * Este archivo carga el autoload de Composer y el bootstrap de Laravel.  El
 * código aquí es el estándar de Laravel 11, sin modificaciones de ruta.  En
 * un entorno compartido donde se coloca la aplicación bajo un subdirectorio
 * (por ejemplo, `/public_html/app`), se debe ajustar la ruta de `vendor`
 * y `bootstrap` en relación con la ubicación real del archivo.  Véase la
 * documentación de despliegue para más detalles.
 */

define('LARAVEL_START', microtime(true));

// Carga el autoloader generado por Composer
require __DIR__ . '/../vendor/autoload.php';

// Arranca el framework y obtiene la aplicación
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Maneja la solicitud y devuelve la respuesta al cliente
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);