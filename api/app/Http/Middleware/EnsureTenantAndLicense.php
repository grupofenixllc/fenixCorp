<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

/**
 * Middleware para resolver el tenant a partir del subdominio y verificar que la licencia esté activa.
 */
class EnsureTenantAndLicense
{
    public function handle(Request $request, Closure $next): Response
    {
        // Resolver tenant por subdominio: subdominio.ejemplo.com → subdominio
        $host = $request->getHost();
        $parts = explode('.', $host);
        $subdomain = $parts[0] ?? null;

        if ($subdomain) {
            // Buscar tenant
            $tenant = DB::table('tenants')->where('domain', $subdomain . '.fenixcorp.com.ar')->first();
            if ($tenant) {
                // Adjuntar tenant ID al request (por ejemplo, a traves del contenedor)
                app()->instance('tenant_id', $tenant->id);
                // Verificar licencia
                $license = DB::table('licenses')
                    ->where('tenant_id', $tenant->id)
                    ->orderBy('id', 'desc')
                    ->first();
                if (!$license || $license->status !== 'active') {
                    abort(403, 'Licencia suspendida o inactiva.');
                }
            }
        }

        return $next($request);
    }
}