<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Verificar si el usuario está autenticado y tiene el rol permitido
        if ($user && in_array($user->tipo, $roles)) {
            return $next($request);
        }

        // Redirigir o devolver una respuesta de error según sea necesario
        abort(403, 'Acción no autorizada.');
    }
}
