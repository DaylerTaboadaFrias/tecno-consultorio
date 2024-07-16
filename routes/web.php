<?php

use App\Enums\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\TratamientoController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\EstadisticaReporteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//, 'checkModuleAccess'
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'estadisticareporte'], function () {
        Route::get('/', [EstadisticaReporteController::class, 'index'])->name('estadisticareporte.index');
        Route::get('/generar', [EstadisticaReporteController::class, 'generar'])->name('estadisticareporte.generar');
    });
    Route::group(['prefix' => 'servicio'], function () {
        Route::get('/', [ServicioController::class, 'index'])->name('servicio.index');
        Route::get('/create', [ServicioController::class, 'create'])->name('servicio.create');
        Route::post('/', [ServicioController::class, 'store'])->name('servicio.store');
        Route::get('{id}/edit', [ServicioController::class, 'edit'])->name('servicio.edit');
        Route::put('/{id}', [ServicioController::class, 'update'])->name('servicio.update');
        Route::put('{id}/destroy', [ServicioController::class, 'destroy'])->name('servicio.destroy');
    });
    Route::group(['prefix' => 'usuario'], function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuario.index');
        Route::get('/create', [UsuarioController::class, 'create'])->name('usuario.create');
        Route::post('/', [UsuarioController::class, 'store'])->name('usuario.store');
        Route::get('{id}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
        Route::put('{id}/destroy', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
        Route::put('{id}/permiso/destroy', [UsuarioController::class, 'destroy'])->name('usuario.permiso.destroy');
    });
    Route::group(['prefix' => 'consulta'], function () {
        Route::get('/', [ConsultaController::class, 'index'])->name('consulta.index');
        Route::get('/create', [ConsultaController::class, 'create'])->name('consulta.create');
        Route::get('/edit-antecente/{id}', [ConsultaController::class, 'editAntecedente'])->name('consulta-antecente.edit');
        Route::put('/update-antecente/{id}', [ConsultaController::class, 'updateAntecedente'])->name('consulta-antecente.update');
        Route::post('/', [ConsultaController::class, 'store'])->name('consulta.store');
        Route::get('{id}/edit', [ConsultaController::class, 'edit'])->name('consulta.edit');
        Route::put('/{id}', [ConsultaController::class, 'update'])->name('consulta.update');
        Route::delete('{id}/destroy', [ConsultaController::class, 'destroy'])->name('consulta.destroy');
    });
    Route::group(['prefix' => 'cita'], function () {
        Route::get('/', [CitaController::class, 'index'])->name('cita.index');
        Route::get('/create', [CitaController::class, 'create'])->name('cita.create');
        Route::post('/', [CitaController::class, 'store'])->name('cita.store');
        Route::get('{id}/edit', [CitaController::class, 'edit'])->name('cita.edit');
        Route::put('/{id}', [CitaController::class, 'update'])->name('cita.update');
        Route::put('{id}/destroy', [CitaController::class, 'destroy'])->name('cita.destroy');
    });
    Route::group(['prefix' => 'pago'], function () {
        Route::get('/{idTratamiento}', [PagoController::class, 'index'])->name('pago.index');
        Route::get('/create/{idTratamiento}', [PagoController::class, 'create'])->name('pago.create');
        Route::get('/tratamiento/index', [PagoController::class, 'indexTratamiento'])->name('pago.tratamiento.index');
        Route::get('{id}/clientepagar', [PagoController::class, 'pagar'])->name('pago.clientepagar');
        Route::get('{id}/clientepagarconfirmar', [PagoController::class, 'confirmar'])->name('pago.clientepagarconfirmar');
        Route::post('/', [PagoController::class, 'store'])->name('pago.store');
        Route::put('{id}/destroy', [PagoController::class, 'destroy'])->name('pago.destroy');
    });
    
    Route::post('/consumirServicio', [PagoController::class, 'RecolectarDatos']);
    Route::post('/consultar', [PagoController::class, 'ConsultarEstado']);
    
    Route::get('/clientepago/tratamiento/index', [PagoController::class, 'indexCliente'])->name('clientepago.tratamiento.index');
    Route::group(['prefix' => 'medicamento'], function () {
        Route::get('/', [MedicamentoController::class, 'index'])->name('medicamento.index');
        Route::get('/create', [MedicamentoController::class, 'create'])->name('medicamento.create');
        Route::post('/', [MedicamentoController::class, 'store'])->name('medicamento.store');
        Route::get('{id}/edit', [MedicamentoController::class, 'edit'])->name('medicamento.edit');
        Route::put('/{id}', [MedicamentoController::class, 'update'])->name('medicamento.update');
        Route::put('{id}/destroy', [MedicamentoController::class, 'destroy'])->name('medicamento.destroy');
    });
    
    Route::group(['prefix' => 'tratamiento'], function () {
        Route::get('/', [TratamientoController::class, 'index'])->name('tratamiento.index');
        Route::get('/create', [TratamientoController::class, 'create'])->name('tratamiento.create');
        Route::post('/', [TratamientoController::class, 'store'])->name('tratamiento.store');
        Route::get('/detalle/{idTratamiento}', [TratamientoController::class, 'detalle'])->name('tratamiento.detalle');
        Route::put('/{id}', [TratamientoController::class, 'update'])->name('tratamiento.update');
        Route::delete('{id}/destroy', [TratamientoController::class, 'destroy'])->name('tratamiento.destroy');
    });
    
    Route::group(['prefix' => 'receta'], function () {
        Route::get('/', [RecetaController::class, 'index'])->name('receta.index');
        Route::get('/create', [RecetaController::class, 'create'])->name('receta.create');
        Route::post('/', [RecetaController::class, 'store'])->name('receta.store');
        Route::get('/detalle/{idReceta}', [RecetaController::class, 'detalle'])->name('receta.detalle');
        Route::put('/{id}', [RecetaController::class, 'update'])->name('receta.update');
        Route::put('{id}/destroy', [RecetaController::class, 'destroy'])->name('receta.destroy');
    });
    
    Route::group(['prefix' => 'historia'], function () {
        Route::get('/index', [HistoriaController::class, 'index'])->name('historia.index');
        Route::get('/show/{id}', [HistoriaController::class, 'show'])->name('historia.show');
    });
    Route::group(['prefix' => 'buscador'], function () {
        Route::get('/index', [BuscadorController::class, 'index'])->name('buscador.index');
    });
    
    Route::group(['prefix' => 'configuracion'], function () {
        Route::get('/index', [ConfiguracionController::class, 'index'])->name('configuracion.index');
        Route::post('/', [ConfiguracionController::class, 'store'])->name('configuracion.store');
    });
    
});


require __DIR__ . '/auth.php';
