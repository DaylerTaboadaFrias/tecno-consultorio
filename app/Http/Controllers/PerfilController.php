<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\Perfil;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    public function index()
    {
        $perfiles = Perfil::with('cuenta')->paginate(5);
        $vista = Vista::where('nombre_vista','perfil.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'perfil.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('perfil.index', ['perfiles' => $perfiles,'vista' => $vista]);
    }
    public function create()
    {
        $cuentas = Cuenta::all();
        $vista = Vista::where('nombre_vista','perfil.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'perfil.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('perfil.create', ['cuentas' => $cuentas,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required|numeric|min:5|max:30',
            'pin' => 'required',
            'estado' => 'required',
            'id_cuenta' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $perfil = new Perfil();
        $perfil->numero = $request->input('numero');
        $perfil->pin = $request->input('pin');
        $perfil->estado = $request->input('estado');
        $perfil->id_cuenta = $request->input('id_cuenta');
        $perfil->save();
        return redirect()->route('perfil.index');
    }
    public function edit($id)
    {
        $perfil = Perfil::findOrFail($id);
        $cuentas = Cuenta::all();
        $vista = Vista::where('nombre_vista','perfil.edit')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'perfil.edit';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('perfil.edit', ['perfil' => $perfil, 'cuentas' => $cuentas,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required|numeric|min:5|max:30',
            'pin' => 'required',
            'estado' => 'required',
            'id_cuenta' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $perfil = Perfil::findOrFail($id);
        $perfil->numero = $request->input('numero');
        $perfil->pin = $request->input('pin');
        $perfil->estado = $request->input('estado');
        $perfil->id_cuenta = $request->input('id_cuenta');
        $perfil->save();
        return redirect()->route('perfil.index');
    }

    public function destroy($id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->delete();
        return redirect()->route('perfil.index');
    }

}
