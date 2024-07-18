<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cita;

use App\Models\Pago;
use App\Models\Vista;
use App\Models\Consulta;
use App\Models\Antecedente;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use App\Models\DetalleTratamiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EstadisticaReporteController extends Controller
{
    public function index()
    {
        $year = Carbon::now()->year;
        $payments = Pago::selectRaw('EXTRACT(MONTH FROM fecha) as month, SUM(monto) as total')
            ->whereYear('fecha', $year)
            ->where('estado', 'Pagado')
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($payments) {
            return [$month => $payments->get($month, 0)];
        });
        $vista = Vista::where('nombre_vista','estadisticareporte.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'estadisticareporte.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        $demandasServicios = $this->obtenerDatosDemandasServicios($year,'7');
        $months = $this->obtenerDatosIngresosAnio($year);
        return view('estadisticareporte.index', compact('months', 'year','vista','demandasServicios'));
    }
    public function events()
    {
        $citas = Cita::all();
        $events = [];

        foreach ($citas as $cita) {
            $events[] = [
                'title' => $cita->tipo,
                'start' => $cita->fecha . 'T' . $cita->hora,
                'end' => $cita->fecha . 'T' . $cita->horafin,
                'description' => $cita->notas,
            ];
        }

        return response()->json($events);
    }
    public function generar(Request $request)
    {
        $mes = $request->input('mes');
        $year = $request->input('year');

        // Obtener los datos para el mes y año seleccionados
        $demandasServicios = $this->obtenerDatosDemandasServicios($year, $mes);
        $months = $this->obtenerDatosIngresosAnio($year);
        $vista = Vista::where('nombre_vista','estadisticareporte.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'estadisticareporte.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('estadisticareporte.index', compact('demandasServicios', 'year','months','vista'));
    }
    
    private function obtenerDatosIngresosAnio($year)
    {
        $payments = Pago::selectRaw('EXTRACT(MONTH FROM fecha) as month, SUM(monto) as total')
            ->whereYear('fecha', $year)
            ->where('estado', 'Pagado')
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12))->mapWithKeys(function ($month) use ($payments) {
            return [$month => $payments->get($month, 0)];
        });
        return $months;
    }
    private function obtenerDatosDemandasServicios($year, $mes = null)
    {
        $query = DetalleTratamiento::join('tratamientos', 'detalle_tratamiento.id_tratamiento', '=', 'tratamientos.id')
            ->join('servicios', 'detalle_tratamiento.id_servicio', '=', 'servicios.id')
            ->select(
                'servicios.nombre as nombre_servicio',
                DB::raw('COUNT(*) as cantidad')
            )
            ->whereYear('tratamientos.fecha', $year);

        if ($mes) {
            $query->whereMonth('tratamientos.fecha', $mes);
        }

        $demandasServicios = $query->groupBy('nombre_servicio')
            ->get();

        return $demandasServicios;
    }
}
