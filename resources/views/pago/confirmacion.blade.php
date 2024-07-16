<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Confirmacion de pago
        </h2>
        
        <br><br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-  shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full">
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4">
                                <ul>
                                    Tienes algunas validaciones
                                </ul>
                            </div>
                        @endif
                        

                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                                <li class="me-2">
                                    <a href="{{ route('pago.clientepagar',[$pago->id]) }}" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                        <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>1er Paso : Introduce tus datos y tipo de pago
                                    </a>
                                </li>
                                <li class="me-2">
                                    <a href="#" class="inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group">
                                        <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>2do Paso : Confirmacion del Qr o tigo money
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <section class="bg-white dark:bg-gray-900">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16">
                            
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-8 md:p-12">
                                    <a href="#" class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 mb-2">
                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                                            <path d="M17 11h-2.722L8 17.278a5.512 5.512 0 0 1-.9.722H17a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1ZM6 0H1a1 1 0 0 0-1 1v13.5a3.5 3.5 0 1 0 7 0V1a1 1 0 0 0-1-1ZM3.5 15.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2ZM16.132 4.9 12.6 1.368a1 1 0 0 0-1.414 0L9 3.55v9.9l7.132-7.132a1 1 0 0 0 0-1.418Z"/>
                                        </svg>
                                        Informacion del pago
                                    </a>
                                    <h2 class="text-gray-900 dark:text-white text-3xl font-extrabold mb-2">Confirmacion de pago</h2>
                                    
                                    @if ($transaccionQr!=null)
                                        <img class="w-100 h-100 rounded-full" src="/images/{{ $transaccionQr->imagen }}" alt="image description">
                                        @if($validTransacciones!= null && $validTransacciones->estado == 'Pagado')
                                            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            <span class="sr-only">Info</span>
                                            <div>
                                              <span class="font-medium">Success alert!</span> Se ha realizado el pago exitosamente.
                                            </div>
                                          </div>.</p>
                                        @endif
                                    
                                    @else
                                    
                                    @endif
                                    
                                </div>
                                
                            </div>
                        </div>
                    </section>
                    
                        {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
                            <div class="row d-flex justify-content-center">
                                <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
                            </div>
                        </div> --}}
                </div>
            </div>
        </div>
    </div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Variable para almacenar el ID del intervalo
    let intervalo;

    function hacerSolicitudAjax(numero,id_tratamiento) {
        // Agrega el token CSRF al objeto de datos
        var data = { _token: "{{ csrf_token() }}", tnTransaccion: numero };
        
        fetch('/consultar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            if (data.message === 'Pagado') {
                // Detener el intervalo si el estado es 'Pagado'
                clearInterval(intervalo);
                console.log('Transacción pagada. Intervalo detenido.');
                window.location.href = 'http://127.0.0.1:8000/pago/'+id_tratamiento;
                //window.location.href = 'https://mail.tecnoweb.org.bo/inf513/grupo14sc/tecno-consultorio/public/pago/'+numero;
            }
        })
        .catch(error => {
            console.error(error);
        });
    }
    
    var id_transaccion = '@json($pago->id)';
    var id_tratamiento = '@json($pago->id_tratamiento)';
    console.log(id_transaccion);
    // Guardar el ID del intervalo en la variable 'intervalo'
    intervalo = setInterval(function() {
        hacerSolicitudAjax(id_transaccion,id_tratamiento);
    }, 10000);
});
</script>
</x-app-layout>
