<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Editar consulta
        </h2>
        <br><br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">

                    @if ($errors->any())
                        <div class="bg-red-500 text-white p-4">
                            <ul>
                                Tienes algunas validaciones
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('consulta.update', [$consulta->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Escribe tu nivel') }}
                            </h2>
                            <div class="relative mb-4">
                                <label for="motivo"
                                    class="leading-7 text-sm text-gray-600">{{ __('Motivo') }}</label>
                                <input type="text" id="motivo" name="motivo"
                                    value="{{ old('motivo', $consulta->motivo) }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('motivo')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="diagnostico"
                                    class="leading-7 text-sm text-gray-600">{{ __('Diagnostico') }}</label>
                                <input type="text" id="diagnostico" name="diagnostico"
                                    value="{{ old('diagnostico', $consulta->diagnostico) }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('diagnostico')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="fecha"
                                    class="leading-7 text-sm text-gray-600">{{ __('Fecha') }}</label>
                                <input type="date" id="fecha" name="fecha"
                                    value="{{ old('fecha', \Carbon\Carbon::parse($consulta->fecha)->format('Y-m-d') ) }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('fecha')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            
                            <div class="relative mb-4">
                                <label for="id_cliente"
                                    class="leading-7 text-sm text-gray-600">{{ __('Cliente') }}</label>
                                <select id="id_cliente" name="id_cliente"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($clientes as $cliente)
                                        <option
                                            {{ (int) old('id_cliente', $consulta->id_cliente) === $cliente->id ? 'selected' : '' }}
                                            value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('id_cliente')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <button type="submit"
                                    class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
