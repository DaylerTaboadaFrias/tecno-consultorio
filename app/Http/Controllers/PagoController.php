<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pago;

use App\Models\Vista;
use GuzzleHttp\Client;
use App\Models\Consulta;
use App\Models\Antecedente;
use App\Models\Transaccion;
use App\Models\Tratamiento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PagoController extends Controller
{
    public function indexTratamiento()
    {
        $tratamientos = Tratamiento::with('consulta.cliente')->where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(10);
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
        })->where('estado', '!=', 'Eliminado')->with('consulta.cliente')->orderBy('id', 'desc')->paginate(10);
        
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
        $pagos = Pago::where('id_tratamiento',$idTratamiento)->where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(10);
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
        $now = Carbon::now();
        $validTransacciones = Transaccion::whereNotNull('fecha_vencimiento')
                                         ->whereNotNull('hora_vencimiento')
                                         ->whereRaw("TO_TIMESTAMP(CONCAT(fecha_vencimiento, ' ', hora_vencimiento), 'YYYY-MM-DD HH24:MI:SS') > ?", [$now])
                                         ->where('estado','!=','Pagado')->first();
        //dd($validTransacciones);                              
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
        return view('pago.pagar', ['pago' => $pago,'validTransacciones'=>$validTransacciones,'vista' => $vista,'usuario' => $usuario]);
    }
    public function confirmar($id)
    {
        $now = Carbon::now();
        $usuario = auth()->user();
        $pago = Pago::findOrFail($id);
        $transaccionQr = Transaccion::where('id_pago',$id)->where('tipo','Qr')->orderBy('created_at', 'desc')->first();
        $transaccionTigo = Transaccion::where('id_pago',$id)->where('tipo','Tigo Money')->orderBy('created_at', 'desc')->first();
        $validTransacciones = Transaccion::whereNotNull('fecha_vencimiento')
                                         ->whereNotNull('hora_vencimiento')
                                         ->whereRaw("TO_TIMESTAMP(CONCAT(fecha_vencimiento, ' ', hora_vencimiento), 'YYYY-MM-DD HH24:MI:SS') > ?", [$now])
                                         ->where('id_pago',$id)->orderBy('id', 'desc')->first();
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
        return view('pago.confirmacion', ['validTransacciones' => $validTransacciones,'pago' => $pago,'transaccionQr' => $transaccionQr,'transaccionTigo' => $transaccionTigo,'vista' => $vista,'usuario' => $usuario]);
    }
    public function RecolectarDatos(Request $request)
    {
        try {
            $lcComerceID           = "d029fa3a95e174a19934857f535eb9427d967218a36ea014b70ad704bc6c8d1c";
            $lnMoneda              = 2;
            $lnTelefono            = $request->tnTelefono;
            $lcNombreUsuario       = $request->tcRazonSocial;
            $lnCiNit               = $request->tcCiNit;
            $lcNroPago             = "UAGRM-SC-GRUPO14-66".$request->taPedidoDetalle[0]["Serial"];
            $lnMontoClienteEmpresa = $request->tnMonto;
            $lcCorreo              = $request->tcCorreo;
            $lcUrlCallBack         = "https://mail.tecnoweb.org.bo/inf513/grupo14sc/tecno-consultorio/public/api/callback";
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
                $imageData = base64_decode(json_decode($laValues)->qrImage);
                $dateTimeArray = explode(' ', json_decode($laValues)->expirationDate);
                $date = $dateTimeArray[0];
                $time = $dateTimeArray[1];
                if ($imageData === false) {
                    return response()->json(['error' => 'Base64 inválido'], 422);
                }
                $fileName = Str::random(10) . '.png';
                $filePath = public_path('images/' . $fileName);
                if (!File::exists(public_path('images'))) {
                    File::makeDirectory(public_path('images'), 0755, true);
                }
                File::put($filePath, $imageData);
                $transaccion = new Transaccion;
                $transaccion->id_pago = $request->taPedidoDetalle[0]["Serial"];
                $transaccion->tipo = "Qr";
                $transaccion->estado = "Pendiente";
                $transaccion->fecha_vencimiento = $date;
                $transaccion->hora_vencimiento = $time;
                $transaccion->id_pedido = "UAGRM-SC-GRUPO14-66".$request->taPedidoDetalle[0]["Serial"];
                $transaccion->id_transaccion = explode(";", $laResult->values)[0];
                $transaccion->imagen = $fileName;
                $transaccion->save();
                
                //$laQrImage = "data:image/png;base64," . json_decode($laValues)->qrImage;
                return redirect()->route('pago.clientepagarconfirmar',[$request->taPedidoDetalle[0]["Serial"]]);
                //echo '<img src="' . $laQrImage . '" alt="Imagen base64">';
            } elseif ($request->tnTipoServicio == 2) {
                $transaccion = new Transaccion;
                $transaccion->id_pago = $request->taPedidoDetalle[0]["Serial"];
                $transaccion->tipo = "Tigo Money";
                $transaccion->estado = "Pendiente";
                $transaccion->id_pedido = "UAGRM-SC-GRUPO14-66".$request->taPedidoDetalle[0]["Serial"];
                $transaccion->id_transaccion = explode(";", $laResult->values)[0];
                $transaccion->save();
                return redirect()->route('pago.clientepagarconfirmar',[$request->taPedidoDetalle[0]["Serial"]]);
                // $csrfToken = csrf_token();
                // echo '<h5 class="text-center mb-4">' . $laResult->message . '</h5>';
                // echo '<p class="blue-text">Transacción Generada: </p><p id="tnTransaccion" class="blue-text">'. $laResult->values . '</p><br>';
                // echo '<iframe name="QrImage" style="width: 100%; height: 300px;"></iframe>';
                // echo '<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>';

                // echo '<script>
                //         $(document).ready(function() {
                //             function hacerSolicitudAjax(numero) {
                //                 // Agrega el token CSRF al objeto de datos
                //                 var data = { _token: "' . $csrfToken . '", tnTransaccion: numero };
                                
                //                 $.ajax({
                //                     url: \'/consultar\',
                //                     type: \'POST\',
                //                     data: data,
                //                     success: function(response) {
                //                         var iframe = document.getElementsByName(\'QrImage\')[0];
                //                         iframe.contentDocument.open();
                //                         iframe.contentDocument.write(response.message);
                //                         iframe.contentDocument.close();
                //                     },
                //                     error: function(error) {
                //                         console.error(error);
                //                     }
                //                 });
                //             }

                //             setInterval(function() {
                //                 hacerSolicitudAjax(' . $laResult->values . ');
                //             }, 7000);
                //         });
                //     </script>';


            
            }
        } catch (\Throwable $th) {

            return $th->getMessage() . " - " . $th->getLine();
        }
    }

    public function ConsultarEstado(Request $request)
    {
        $lnTransaccion = $request->tnTransaccion;
        
        $loClientEstado = new Client();

        $lcUrlEstadoTransaccion = "https://serviciostigomoney.pagofacil.com.bo/api/servicio/consultartransaccion";

        $laHeaderEstadoTransaccion = [
            'Accept' => 'application/json'
        ];

        $laBodyEstadoTransaccion = [
            "TransaccionDePago" => $lnTransaccion
        ];

        $loEstadoTransaccion = $loClientEstado->post($lcUrlEstadoTransaccion, [
            'headers' => $laHeaderEstadoTransaccion,
            'json' => $laBodyEstadoTransaccion
        ]);

        $laResultEstadoTransaccion = json_decode($loEstadoTransaccion->getBody()->getContents());
        $respuestaMensaje = $laResultEstadoTransaccion->values->messageEstado; 
        if (strpos($respuestaMensaje, 'PROCESADO') !== false) {
            $transaccion = Transaccion::where('id_transaccion',$lnTransaccion)->first();
            $transaccion->estado= 'Pagado';
            $transaccion->save();
            $pago = Pago::where('id',$transaccion->id_pago)->first();
            $pago->estado= 'Pagado';
            $pago->save();
            return response()->json(['message' => 'Pagado']);
        } 
        //$texto = '<h5 class="text-center mb-4">Estado Transacción: ' . $laResultEstadoTransaccion->values->messageEstado . '</h5><br>';
        return response()->json(['message' => 'Pendiente']);
    }

    public function urlCallback(Request $request)
    {
        $Venta = $request->input("PedidoID");
        $Fecha = $request->input("Fecha");
        $NuevaFecha = date("Y-m-d", strtotime($Fecha));
        $Hora = $request->input("Hora");
        $MetodoPago = $request->input("MetodoPago");
        $Estado = $request->input("Estado");
        $Ingreso = true;
        $transaccion = Transaccion::where('id_pedido',$Venta)->orderBy('created_at', 'desc')->first();
        $transaccion->estado = 'Pagado';
        $transaccion->fecha = $NuevaFecha;
        $transaccion->hora = $Hora;
        $transaccion->save();
        $pago = Pago::findOrFail($transaccion->id_pago);
        $pago->estado = 'Pagado';
        $pago->save();
        try {
          //  propceso de verificacion y procesando el pago ya en el lado del comercio
            $arreglo = ['error' => 0, 'status' => 1, 'message' => "Pago realizado correctamente.", 'values' => true];
        } catch (\Throwable $th) {
            $arreglo = ['error' => 1, 'status' => 1, 'messageSistema' => "[TRY/CATCH] " . $th->getMessage(), 'message' => "No se pudo realizar el pago, por favor intente de nuevo.", 'values' => false];
        }

        return response()->json($arreglo);
    }

    public function store(Request $request)
    {

        $montoacobrar= Tratamiento::findOrFail($request->id_tratamiento)->montoacobrar;
        $validator = Validator::make($request->all(), [
            'monto' => 'required|numeric|max:'.$montoacobrar,
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
    public function pagarAdmin($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->estado ='Pagado';
        $id_tratamiento =  $pago->id_tratamiento;
        $pago->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('pago.index',[$id_tratamiento]);
    }
}
