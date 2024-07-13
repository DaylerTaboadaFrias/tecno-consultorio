<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Configuracion') }}
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
                  <form method="POST" action="{{route('configuracion.store')}}" enctype="multipart/form-data"> 
                    @csrf
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Modos") }}</h2>
                      
                        <div class="flex items-center mb-4">
                          <input @if($configuracion->modo === 'Dia') checked @endif id="country-option-1" type="radio" name="modos" value="Dia" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                          <label for="country-option-1" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Modo dia
                          </label>
                        </div>
                        <div class="flex items-center mb-4">
                          <input @if($configuracion->modo === 'Noche') checked @endif id="country-option-2" type="radio" name="modos" value="Noche" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="country-option-2" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Modo noche
                          </label>
                        </div>
                        <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Temas") }}</h2>
                      
                        <div class="flex items-center mb-4">
                          <input @if($configuracion->tema == 'Niños') checked @endif id="country-option-3" type="radio" name="temas" value="Niños" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                          <label for="country-option-3" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Tema niños
                          </label>
                        </div>
                        <div class="flex items-center mb-4">
                          <input @if($configuracion->tema == 'Jovenes') checked @endif id="country-option-4" type="radio" name="temas" value="Jovenes" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" >
                          <label for="country-option-4" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Tema jovenes
                          </label>
                        </div>
                        <div class="flex items-center mb-4">
                          <input @if($configuracion->tema == 'Adultos') checked @endif id="country-option-5" type="radio" name="temas" value="Adultos" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                          <label for="country-option-5" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Tema adultos
                          </label>
                        </div>
                        <div class="relative mb-4">
                            <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">ACTUALIZAR</button>
                        </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
