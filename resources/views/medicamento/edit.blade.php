<x-app-layout>
  <x-slot name="header">
      <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
        Editar medicamento
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
                <form method="POST" action="{{route('medicamento.update',[$medicamento->id])}}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Edita tu medicamento") }}</h2>
                        <div class="relative mb-4">
                            <label for="nombre" class="leading-7 text-sm text-gray-600">{{ __("Nombre") }}</label>
                            <input required type="text" id="nombre" name="nombre" value="{{ old("nombre", $medicamento->nombre) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('nombre')
                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                            @enderror
                        </div>
                        <div class="relative mb-4">
                            <label for="marca" class="leading-7 text-sm text-gray-600">{{ __("Marca") }}</label>
                            <input required type="text" id="marca" name="marca" value="{{ old("marca", $medicamento->marca) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('marca')
                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                            @enderror
                        </div>
                        <div class="relative mb-4">
                            <label for="medida" class="leading-7 text-sm text-gray-600">{{ __("Medida") }}</label>
                            <input required type="text" id="medida" name="medida" value="{{ old("medida", $medicamento->medida) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('medida')
                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                            @enderror
                        </div>
                        
                        <div class="relative mb-4">
                            <label for="tipo" class="leading-7 text-sm text-gray-600">{{ __("Tipo") }}</label>
                            <input required type="text" id="tipo" name="tipo" value="{{ old("tipo", $medicamento->tipo) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            @error('tipo')
                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                            @enderror
                        </div>
                        <div class="relative mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" name="imagen" id="imagen" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                        </div>
                        <div class="relative mb-4">
                            <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar nivel</button>
                        </div>
                        
                    </div>
                </form>
              </div>
          </div>
      </div>
  </div>
  


</x-app-layout>
