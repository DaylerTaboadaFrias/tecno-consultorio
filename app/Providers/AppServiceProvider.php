<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Configuracion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Services\AuthenticatedUser;

use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthenticatedUser::class, function ($app) {
            return new AuthenticatedUser();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $esDeDia = false ;
        
        View::composer('*', function ($view) {
            $esDeDia = false ;
            // Obtener el ID del usuario autenticado
            $authenticatedUser = $this->app->make(AuthenticatedUser::class);
            $userId = $authenticatedUser->getUserId();
            
            if($userId){
                $configuracion = Configuracion::where('id_usuario',auth()->user()->id)->where('estado_modo','Activado')->first();
               
                if(!$configuracion){
                    $horaActual = Carbon::now()->hour;
                    $esDeDia = $horaActual >= 6 && $horaActual < 18;
                }else{
                    if ($configuracion->modo == 'Dia') {
                        $esDeDia = true;
                    } else {
                        $esDeDia = false;
                    }
                }
            }
            // Pasar el ID del usuario autenticado a todas las vistas
            $view->with('esDeDia', $esDeDia);
        });
    }
}
