<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // ESTA ES LA LÓGICA CLAVE
        // Si la petición espera una respuesta JSON (como todas las de nuestra API),
        // no devuelve nada. Esto provoca que Laravel lance una excepción de autenticación
        // que se convierte en un error 401 JSON, que es lo correcto.
        return $request->expectsJson() ? null : route('login');
    }
}