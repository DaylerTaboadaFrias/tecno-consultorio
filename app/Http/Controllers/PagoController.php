<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Vista;

use GuzzleHttp\Client;
use App\Models\Consulta;
use App\Models\Antecedente;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PagoController extends Controller
{
    public function indexTratamiento()
    {
        $tratamientos = Tratamiento::with('consulta.cliente')->where('estado','!=','Eliminado')->paginate(10);
        $vista = Vista::where('nombre_vista','pago.index-tratamiento')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'pago.index-tratamiento';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('pago.index-tratamiento', ['tratamientos' => $tratamientos,'vista' => $vista]);
    }
    public function indexCliente()
    {
        $clienteId= auth()->user()->id;
        $tratamientos = Tratamiento::whereHas('consulta.cliente', function($query) use ($clienteId) {
            $query->where('id', $clienteId);
        })->where('estado', '!=', 'Eliminado')->with('consulta.cliente')->paginate(10);
        
        $vista = Vista::where('nombre_vista','pago.clienteindex-tratamiento')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'pago.clienteindex-tratamiento';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('pago.clienteindex-tratamiento', ['tratamientos' => $tratamientos,'vista' => $vista]);
    }
    
    public function index($idTratamiento)
    {
        $pagos = Pago::where('id_tratamiento',$idTratamiento)->where('estado','!=','Eliminado')->paginate(10);
        $tratamiento = Tratamiento::findOrFail($idTratamiento);
        $vista = Vista::where('nombre_vista','pago.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'pago.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('pago.index', ['pagos' => $pagos,'vista' => $vista,'tratamiento'=>$tratamiento]);
    }
    public function create($idTratamiento)
    {
        $tratamiento = Tratamiento::findOrFail($idTratamiento);
        $vista = Vista::where('nombre_vista','pago.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'pago.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('pago.create', ['tratamiento' => $tratamiento,'vista' => $vista]);
    }
    public function pagar($id)
    {
        $usuario = auth()->user();
        $pago = Pago::findOrFail($id);
        $vista = Vista::where('nombre_vista','pago.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'pago.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('pago.pagar', ['pago' => $pago,'vista' => $vista,'usuario' => $usuario]);
    }

    public function RecolectarDatos(Request $request)
    {
        try {
            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $request->tnTelefono;
            $lcNombreUsuario       = $request->tcRazonSocial;
            $lnCiNit               = $request->tcCiNit;
            $lcNroPago             = "UAGRM-SC-GRUPO14-900"     ;
            $lnMontoClienteEmpresa = $request->tnMonto;
            $lcCorreo              = $request->tcCorreo;
            $lcUrlCallBack         = "http://localhost:8000/";
            $lcUrlReturn           = "http://localhost:8000/";
            $laPedidoDetalle       = $request->taPedidoDetalle;
            $lcUrl                 = "";
            $loClient = new Client();

            if ($request->tnTipoServicio == 1) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/generarqrv2";
            } elseif ($request->tnTipoServicio == 2) {
                $lcUrl = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/realizarpagotigomoneyv2";
            }

            $laHeader = [
                'Accept' => 'application/json'
            ];

            $laBody   = [
                "tcCommerceID"          => $lcComerceID,
                "tnMoneda"              => $lnMoneda,
                "tnTelefono"            => $lnTelefono,
                'tcNombreUsuario'       => $lcNombreUsuario,
                'tnCiNit'               => $lnCiNit,
                'tcNroPago'             => $lcNroPago,
                "tnMontoClienteEmpresa" => $lnMontoClienteEmpresa,
                "tcCorreo"              => $lcCorreo,
                'tcUrlCallBack'         => $lcUrlCallBack,
                "tcUrlReturn"           => $lcUrlReturn,
                'taPedidoDetalle'       => $laPedidoDetalle
            ];

            $loResponse = $loClient->post($lcUrl, [
                'headers' => $laHeader,
                'json' => $laBody
            ]);

            $laResult = json_decode($loResponse->getBody()->getContents());
            if ($request->tnTipoServicio == 1) {

                $laValues = explode(";", $laResult->values)[1];
           

                $laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tnTipoServicio == 2) {

             
                
                $csrfToken = csrf_token();

                echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
                echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                echo '<script>
                        $(document).ready(function() {
                            function hacerSolicitudAjax(numero) {
                                // Agrega el token CSRF al objeto de datos
                                var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };
                                
                                $.ajax({
                                    url: \'/consultar\',
                                    type: \'POST\',
                                    data: data,
                                    success: function(response) {
                                        var iframe = document.getElementsByName(\'QrImage\')[0];
                                        iframe.contentDocument.open();
                                        iframe.contentDocument.write(response.message);
                                        iframe.contentDocument.close();
                                    },
                                    error: function(error) {
                                        console.error(error);
                                    }
                                });
                            }

                            setInterval(function() {
                                hacerSolicitudAjax(' . $laResult->values . ');
                            }, 7000);
                        });
                    </script>';


            
            }
        } catch (\Throwable $th) {

            return $th->getMessage() . " - " . $th->getLine();
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'monto' => 'required',
            'metodo' => 'required',
            'fecha' => 'required',
            'hora' => 'required',
            'estado' => 'required',
            'id_tratamiento' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pago = new Pago();
        $pago->monto = $request->input('monto');
        $pago->fecha = $request->input('fecha');
        $pago->metodo = $request->input('metodo');
        $pago->notas = $request->input('notas');
        $pago->estado = $request->input('estado');
        $pago->hora = $request->input('hora');
        $pago->id_tratamiento = $request->input('id_tratamiento');
        $pago->save();
        Session::flash('status', 'Registro guardado exitosamente!');
        return redirect()->route('pago.index',[$request->input('id_tratamiento')]);
    }
    
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->estado ='Eliminado';
        $id_tratamiento =  $pago->id_tratamiento;
        $pago->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('pago.index',[$id_tratamiento]);
    }

}
