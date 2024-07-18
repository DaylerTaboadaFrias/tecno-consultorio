<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckModuleAccess
{
    public function handle($request, Closure $next,...$roles)
    {
        $usuario = Auth::user();
        $now = Carbon::now()->toDateString();
        $moduleRoute = $request->path();
        // Obtener permisos válidos del usuario con los módulos vigentes
        $tipo = $usuario->tipo;
        if($tipo == 'Ninguno'){
            $permisos = Permiso::where('id_usuario', $usuario->id)
            ->where('perm_est', true)
            ->whereDate('perm_fini', '<=', $now)
            ->whereDate('perm_ffin', '>=', $now)
            ->pluck('grup_cod')
            ->toArray();

            // Obtener los módulos asociados a esos permisos y que estén vigentes
            $modulosPermitidos = collect();
            foreach ($permisos as $grupo_cod) {
                $grupo = Grupo::where('grup_cod', $grupo_cod)->first();
                if ($grupo) {
                    $modulos = Modulo::join('mod_grup', 'modulo.mod_cod', '=', 'mod_grup.mod_cod')
                        ->where('mod_grup.grup_cod', $grupo_cod)
                        ->where('mod_grup.mod_grup_fins', '>=', $now)
                        ->where('modulo.mod_est', true)
                        ->pluck('mod_file')
                        ->toArray();
                    $modulosPermitidos = $modulosPermitidos->merge($modulos);
                }
            }

            // Verificar si el módulo solicitado está en la lista de módulos permitidos
            if (!in_array($moduleRoute, $modulosPermitidos->toArray())) {
                return response('Unauthorized', 401);
            }
            return $next($request);

        }else if(in_array($tipo, $roles)){
            return $next($request);
        }else if(in_array($tipo, $roles)){
            return $next($request);
        }
        return response('Unauthorized', 401);

    }
}
