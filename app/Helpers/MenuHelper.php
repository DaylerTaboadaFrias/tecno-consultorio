<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Grupo;
use App\Models\Modulo;
use App\Models\Permiso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MenuHelper
{
    public static function getUserModules()
    {
        $usuario = Auth::user();
        $now = Carbon::now()->toDateString();

        // Obtener permisos válidos del usuario con los módulos vigentes
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
                    ->get();
                $modulosPermitidos = $modulosPermitidos->merge($modulos);
            }
        }
        return $modulosPermitidos;
    }
}
