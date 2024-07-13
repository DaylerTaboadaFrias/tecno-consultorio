<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\Cuenta;

use App\Models\Plataforma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::with('plataforma')->paginate(10);
        $vista = Vista::where('nombre_vista','cuenta.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'cuenta.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('cuenta.index', ['cuentas' => $cuentas,'vista' => $vista]);
    }
    public function create()
    {
        $plataformas = Plataforma::all();
        $vista = Vista::where('nombre_vista','cuenta.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'cuenta.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('cuenta.create', ['plataformas' => $plataformas,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|min:5|max:30',
            'fecha_compra' => 'required',
            'fecha_vencimiento' => 'required',
            'clave' => 'required|string|min:5|max:15',
            'id_plataforma' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cuenta = new Cuenta();
        $cuenta->correo = $request->input('correo');
        $cuenta->fecha_compra = $request->input('fecha_compra');
        $cuenta->fecha_vencimiento = $request->input('fecha_vencimiento');
        $cuenta->clave = $request->input('clave');
        $cuenta->estado = 'Activo';
        $cuenta->id_plataforma = $request->input('id_plataforma');
        $cuenta->save();
        return redirect()->route('cuenta.index');
    }
    public function edit($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $plataformas = Plataforma::all();
        $vista = Vista::where('nombre_vista','cuenta.edit')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'cuenta.edit';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('cuenta.edit', ['cuenta' => $cuenta, 'plataformas' => $plataformas,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'correo' => 'required|string|min:5|max:30',
            'fecha_compra' => 'required',
            'fecha_vencimiento' => 'required',
            'clave' => 'required|string|min:5|max:15',
            'id_plataforma' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cuenta = cuenta::findOrFail($id);
        $cuenta->correo = $request->input('correo');
        $cuenta->fecha_compra = $request->input('fecha_compra');
        $cuenta->fecha_vencimiento = $request->input('fecha_vencimiento');
        $cuenta->clave = $request->input('clave');
        $cuenta->estado = 'Activo';
        $cuenta->id_plataforma = $request->input('id_plataforma');
        $cuenta->save();
        return redirect()->route('cuenta.index');
    }

    public function destroy($id)
    {
        $cuenta = Cuenta::findOrFail($id);
        $cuenta->delete();
        return redirect()->route('cuenta.index');
    }

}
