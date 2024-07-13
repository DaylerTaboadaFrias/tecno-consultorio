<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Registrar cita
        </h2>
        
        <br><br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg w-full">
                    <div class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @if ($errors->any())
                            <div class="bg-red-500 text-white p-4">
                                <ul>
                                    Tienes algunas validaciones
                                </ul>
                            </div>
                        @endif
                    <form method="POST" action="{{ route('cita.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Escribe tu cita') }}
                            </h2>
                            <div class="relative mb-4">
                                <label for="notas"
                                    class="leading-7 text-sm text-gray-600">{{ __('Notas') }}</label>
                                <input type="text" required id="notas" name="notas" value="{{ old('notas') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('notas')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="tipo"
                                    class="leading-7 text-sm text-gray-600">{{ __('Tipo de cita') }}</label>
                                <select onchange="mostrarSelect()" id="tipo" name="tipo"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="">Selecciona una opcion</option>
                                    <option value="Tratamiento" {{ old('tipo') == 'Tratamiento' ? 'selected' : '' }}>Tratamiento</option>
                                    <option value="Consulta" {{ old('tipo') == 'Consulta' ? 'selected' : '' }}>Consulta</option>
                                </select>
                                @error('tipo')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div id="tratamiento" class="relative mb-4">
                                <label for="id_tratamiento"
                                    class="leading-7 text-sm text-gray-600">{{ __('Tratamientos') }}</label>
                                <select id="id_tratamiento" name="id_tratamiento"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="">Selecciona una opcion</option>
                                    @foreach ($tratamientos as $tratamiento)
                                        <option value="{{ $tratamiento->id }}" {{ old('id_tratamiento') == $tratamiento->id ? 'selected' : '' }}>{{ '#'.$tratamiento->id.' '.$tratamiento->descripcion }}</option>
                                    @endforeach
                                </select>
                                @error('id_tratamiento')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div id="cliente" class="relative mb-4">
                                <label for="id_cliente"
                                    class="leading-7 text-sm text-gray-600">{{ __('Clientes') }}</label>
                                <select id="id_cliente" name="id_cliente"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value="">Selecciona una opcion</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre.' '.$cliente->apellido  }}</option>
                                    @endforeach
                                </select>
                                @error('id_cliente')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="fecha"
                                    class="leading-7 text-sm text-gray-600">{{ __('Fecha ') }}</label>
                                <input type="date" required id="fecha" name="fecha" value="{{ old('fecha') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('fecha')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="hora"
                                    class="leading-7 text-sm text-gray-600">{{ __('Hora inicio') }}</label>
                                <input type="time" required required id="hora" name="hora" value="{{ old('hora') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('hora')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="horafin"
                                    class="leading-7 text-sm text-gray-600">{{ __('Hora Fin') }}</label>
                                <input type="time" required required id="horafin" name="horafin" value="{{ old('horafin') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('horafin')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            
                            <div class="relative mb-4">
                                
                                <button type="submit"
                                    class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Crear
                                    cita</button>
                            </div>

                        </div>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <script>
        function mostrarSelect() {
            var tipo = document.getElementById('tipo').value;
            console.log(tipo);
            var selectConsulta = document.getElementById('cliente');
            var selectTratamiento = document.getElementById('tratamiento');

            if (tipo === 'Consulta') {
                selectConsulta.style.display = 'block';
                selectTratamiento.style.display = 'none';
            } else if (tipo === 'Tratamiento') {
                selectConsulta.style.display = 'none';
                selectTratamiento.style.display = 'block';
            } else {
                selectConsulta.style.display = 'none';
                selectTratamiento.style.display = 'none';
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('cliente').style.display = 'none';
            document.getElementById('tratamiento').style.display = 'none';
            @if(old('tipo') == 'Consulta')
                document.getElementById('cliente').style.display = 'block';
            @elseif(old('tipo') == 'Tratamiento')
                document.getElementById('tratamiento').style.display = 'block';
            @endif
        });
    </script>
</x-app-layout>
