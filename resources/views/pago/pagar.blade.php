<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Registrar pago
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
                    <form method="POST" action="/consumirServicio" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white overflow-  shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Escribe tu pago') }}
                            </h2>
                            <div   class="relative mb-4">
                                <label for="tcRazonSocial"
                                    class="leading-7 text-sm text-gray-600">{{ __('Razon social') }}</label>
                                <input type="text" required id="tcRazonSocial" name="tcRazonSocial" value="{{ $usuario->nombre.' '.$usuario->apellido  }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('tcRazonSocial')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div   class="relative mb-4">
                                <label for="tcCiNit"
                                    class="leading-7 text-sm text-gray-600">{{ __('Carnet de identidad') }}</label>
                                <input type="text" required id="tcCiNit" name="tcCiNit" value="{{ $usuario->cedula }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('tcCiNit')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div   class="relative mb-4">
                                <label for="tnTelefono"
                                    class="leading-7 text-sm text-gray-600">{{ __('Telefono') }}</label>
                                <input type="text" required id="tnTelefono" name="tnTelefono" value="{{ $usuario->telefono }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('tnTelefono')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div   class="relative mb-4">
                                <label for="tcCorreo"
                                    class="leading-7 text-sm text-gray-600">{{ __('Correo') }}</label>
                                <input type="text" required id="tcCorreo" name="tcCorreo" value="{{ $usuario->email }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('tcCorreo')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div   class="relative mb-4">
                                <label for="tnMonto"
                                    class="leading-7 text-sm text-gray-600">{{ __('Monto') }}</label>
                                <input type="text" required id="tnMonto" name="tnMonto"  value="{{ $pago->monto }}" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('tnMonto')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="tnTipoServicio"
                                    class="leading-7 text-sm text-gray-600">{{ __('Tipo de servicio') }}</label>
                                <select id="tnTipoServicio" name="tnTipoServicio"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="1">Servicio Qr</option>    
                                    <option value="2">Tipo money</option>
                                </select>
                                @error('tnTipoServicio')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Fila 1 -->
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Serial]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Serial') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Serial]" name="taPedidoDetalle[0][Serial]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Producto]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Producto') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Producto]" value="{{ $pago->notas }}" name="taPedidoDetalle[0][Producto]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Cantidad]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Cantidad') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Cantidad]" value="1" name="taPedidoDetalle[0][Cantidad]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                
                                <!-- Fila 2 -->
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Precio]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Precio') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Precio]" value="{{ $pago->monto }}" name="taPedidoDetalle[0][Precio]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Descuento]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Descuento') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Descuento]" value="0" name="taPedidoDetalle[0][Descuento]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                <div class="bg-gray-200 p-4">
                                    <label for="taPedidoDetalle[0][Total]"
                                    class="leading-7 text-sm text-gray-600">{{ __('Total') }}</label>
                                    <input type="text" required id="taPedidoDetalle[0][Total]" value="{{ $pago->monto }}" name="taPedidoDetalle[0][Total]" 
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                            </div>
                            
                            <div class="relative mb-4">
                                
                                <button type="submit"
                                    class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Crear
                                    Generar qr</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 py-5">
                        <div class="row d-flex justify-content-center">
                            <iframe name="QrImage" style="width: 100%; height: 495px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
