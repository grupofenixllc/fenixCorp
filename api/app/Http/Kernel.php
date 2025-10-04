<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * La pila de middleware HTTP global de la aplicación.
     *
     * Estos middleware se ejecutan en cada solicitud al servidor.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\EnsureTenantAndLicense::class,
        // ...otros middleware globales como EncryptCookies, StartSession, etc.  
    ];

    /**
     * Grupos de middleware para rutas web y API.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Middleware web por defecto (por simplificación se omiten aquí)
        ],
        'api' => [
            'throttle:api',
            'bindings',
        ],
    ];
}