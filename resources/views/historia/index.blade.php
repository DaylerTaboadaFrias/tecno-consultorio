<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Consultar historia clinica del paciente') }}
        </h2>
        <br>
        <br>
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
            <form method="GET" action="{{route('historia.index')}}"> 
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Escribe tu cliente") }}</h2>
                    <div class="relative mb-4">
                        <label for="campo" class="leading-7 text-sm text-gray-600">{{ __("Campo") }}</label>
                        <input type="text" id="campo" required name="campo" value="{{ old("campo") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          @error('campo')
                              <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                          @enderror
                    </div>
                    <div class="relative mb-4">
                        <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buscar referencias</button>
                    </div>
                    
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-12">
 <!-- Modal toggle -->
    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nombre del Cliente
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cedula
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clientes as $cliente)
                            <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">

                                        {{-- <img class="w-50 h-50 rounded-full" src="{{ $cliente->imagen_movil }}"  alt="image description"> --}}
                                    <td class="py-4 px-6">
                                        {{$cliente->nombre .' '.$cliente->apellido }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$cliente->cedula }}
                                    </td>
                                    
                                    <td class="py-4 px-6">
                                            <a href="{{ route("historia.show", [$cliente->id]) }}">
                                                <button  class="text-white bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#2557D6]/50 mr-2 mb-2">
                                                  Ver historia clinica
                                                </button>
                                            </a>
                                    </td>
                                    
                                </tr>
                                
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><td class="py-4 px-6">No hay registros</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    

</x-app-layout>
