<?php

namespace App\Http\Controllers;

use Exception;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Vista;
use App\Rules\EmailUnico;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(5);
        $vista = Vista::where('nombre_vista','usuario.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'usuario.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('usuario.index', ['usuarios' => $usuarios,'vista' => $vista]);
    }

    public function create()
    {
        $grupos= Grupo::get();
        $vista = Vista::where('nombre_vista','usuario.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'usuario.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('usuario.create', ['vista' => $vista,'grupos' => $grupos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'cedula' => 'required|string|max:15',
            'email' => ['required', 'email', new EmailUnico],
            'sexo' => ['required', 'in:Masculino,Femenino'],
            'telefono' => 'required|string|max:8',
            'fecha_nac' => 'required|date',
            'tipo' => ['required', 'in:Administrativo,Cliente,Ninguno'],
            'grupos.*.perm_fini' => 'required_if:tipo,Ninguno|nullable|date',
            'grupos.*.perm_ffin' => 'required_if:tipo,Ninguno|nullable|date',
            'grupos.*.perm_pass' => 'required_if:tipo,Ninguno|nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            $usuario = new User();
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->cedula = $request->input('cedula');
            $usuario->email = $request->input('email');
            $usuario->password = Hash::make($request->input('cedula'));
            $usuario->sexo = $request->input('sexo');
            $usuario->telefono = $request->input('telefono');
            $usuario->tipo = $request->input('tipo');
            $usuario->fecha_nac = $request->input('fecha_nac');
            $usuario->save();
            if($request->input('tipo') == 'Ninguno'){
                foreach ($request->input('grupos') as $grupo) {
                    $usuario->grupos()->attach($grupo["grup_cod"], [
                        'perm_pass' => $grupo["perm_pass"],
                        'perm_fini' => $grupo["perm_fini"],
                        'perm_ffin' => $grupo["perm_ffin"],
                        'perm_est' => true
                    ]);
                }
                
            }
            $edad = Carbon::parse($request->input('fecha_nac'))->age;
            $tema = '';
            if ($edad <= 12) {
                $tema = 'Niño';
            } elseif ($edad <= 17) {
                $tema = 'Joven';
            } else {
                $tema = 'Adulto';
            }
            $configuracion = new Configuracion;
            $configuracion->id_usuario= $usuario->id;
            $configuracion->tema= $tema;
            $configuracion->estado_modo= 'Desactivado';
            $configuracion->modo= 'Dia';
            $configuracion->save();
            Session::flash('status', 'Registro editado exitosamente!');
            DB::commit();
            return redirect()->route('usuario.index');
        } catch (Exception $e) {
            Session::flash('status', 'Error del servidor');
            DB::rollBack();
            return redirect()->route('usuario.create');
        }
        
        
        

    }
    public function edit($id)
    {
        $usuario = User::with('permisos.grupo')->find($id);
        $vista = Vista::where('nombre_vista','usuario.edit')->first();
        $grupos= Grupo::get();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'usuario.edit';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('usuario.edit', ['usuario' => $usuario,'grupos' => $grupos,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:150',
            'cedula' => 'required|string|max:150',
            'email' => ['required', 'email', new EmailUnico($id)],
            'sexo' => ['required', 'in:Masculino,Femenino'],
            'telefono' => 'required|string|max:8',
            'tipo' => ['required', 'in:Administrativo,Cliente,Ninguno'],
            'fecha_nac' => 'required|date',
            //'grupos' => ['required_if:tipo,Ninguno|nullable', 'array'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $usuario = User::findOrFail($id);
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->cedula = $request->input('cedula');
        $usuario->email = $request->input('email');
        $usuario->password = Hash::make($request->input('cedula'));
        $usuario->nit = $request->input('nit');
        $usuario->sexo = $request->input('sexo');
        $usuario->telefono = $request->input('telefono');
        $usuario->tipo = $request->input('tipo');
        $usuario->fecha_nac = $request->input('fecha_nac');
        $usuario->update();
        if($request->input('tipo') == 'Ninguno'){
            foreach ($request->input('grupos') as $grupo) {
                $usuario->grupos()->attach($grupo["grup_cod"], [
                    'perm_pass' => $grupo["perm_pass"],
                    'perm_fini' => $grupo["perm_fini"],
                    'perm_ffin' => $grupo["perm_ffin"],
                    'perm_est' => true
                ]);
            }
            
        }
        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('usuario.index');
    }
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado ='Eliminado';
        $usuario->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('usuario.index');
    }

}
