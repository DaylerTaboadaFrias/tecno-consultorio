<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
          Editar usuario
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
            <form method="POST" action="{{route('usuario.update',[$usuario->id])}}" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Escribe tu usuario") }}</h2>
                    <div class="relative mb-4">
                        <label for="nombre" class="leading-7 text-sm text-gray-600">{{ __("Nombre") }}</label>
                        <input type="text" id="nombre" required name="nombre" value="{{ old("nombre", $usuario->nombre) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          @error('nombre')
                              <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                          @enderror
                      </div>
                    <div class="relative mb-4">
                      <label for="apellido" class="leading-7 text-sm text-gray-600">{{ __("Apellido") }}</label>
                      <input type="text" required id="apellido" name="apellido" value="{{ old("apellido", $usuario->apellido) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @error('apellido')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="cedula" class="leading-7 text-sm text-gray-600">{{ __("Cedula") }}</label>
                      <input type="text" required id="cedula" name="cedula" value="{{ old("cedula", $usuario->cedula) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @error('cedula')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="email" class="leading-7 text-sm text-gray-600">{{ __("Email") }}</label>
                      <input type="text" required id="email" name="email" value="{{ old("email", $usuario->email) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @error('email')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="telefono" class="leading-7 text-sm text-gray-600">{{ __("Telefono") }}</label>
                      <input type="text" required id="telefono" name="telefono" value="{{ old("telefono", $usuario->telefono) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @error('telefono')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="fecha_nac" class="leading-7 text-sm text-gray-600">{{ __("Fecha nacimiento") }}</label>
                      <input type="date" required id="fecha_nac" name="fecha_nac" value="{{ old("fecha_nac", $usuario->fecha_nac) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @error('fecha_nac')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="sexo"
                          class="leading-7 text-sm text-gray-600">{{ __('Sexo') }}</label>
                      <select  id="sexo" name="sexo"
                          class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <option value="">Selecciona una opcion</option>
                          <option value="Masculino" {{ old('sexo', $usuario->sexo) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                          <option value="Femenino" {{ old('sexo', $usuario->sexo) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                      </select>
                      @error('sexo')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  <div class="relative mb-4">
                      <label for="Tipo"
                          class="leading-7 text-sm text-gray-600">{{ __('Tipo') }}</label>
                      <select onchange="mostrarSelect()" id="tipo" name="tipo"
                          class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <option value="Ninguno" {{ old('tipo', $usuario->tipo) == 'Ninguno' ? 'selected' : '' }}>Selecciona una opcion</option>
                          <option value="Cliente" {{ old('tipo', $usuario->tipo) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                          <option value="Administrativo" {{ old('tipo', $usuario->tipo) == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                      </select>
                      @error('tipo')
                          <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                      @enderror
                  </div>
                  
                  <div id="grupos-wrapper">
                    
                      <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Agrega tus grupos') }}
                      </h2>
                      <br>
                      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre grupo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Inicio
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fin
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Eliminar
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usuario->permisos as $permiso)
                            <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">

                                        {{-- <img class="w-50 h-50 rounded-full" src="{{ $permiso->imagen_movil }}"  alt="image description"> --}}
                                    <td class="py-4 px-6">
                                        {{$permiso->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$permiso->grupo->grup_name }}
                                    <td class="py-4 px-6">
                                        {{$permiso->perm_fini }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$permiso->perm_ffin}}
                                    </td>
                                    <td class="py-4 px-6">
                                        <button class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button"  data-modal-target="default-modal{{$permiso->id}}" data-modal-toggle="default-modal{{$permiso->id}}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                        </button>
                                    </td>
                                    <div id="default-modal{{$permiso->id}}"  aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
                                        <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
                                            <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
                                                <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                                                        Eliminar
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="default-modal{{$permiso->id}}">
                                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                                    </button>
                                                </div>
                                                <div class="p-6 space-y-6">
                                                    <p class="text-gray-500 text-base leading-relaxed dark:text-gray-400">
                                                        Esta seguro que desea eliminar este registro?
                                                    </p>
                                                    
                                                </div>
                                                <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <form class="inline" method="POST" action="{{ route("usuario.permiso.destroy", [$permiso->id]) }}">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" class="text-white bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#2557D6]/50 mr-2 mb-2">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                    <button data-modal-toggle="default-modal{{$permiso->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </tr>
                            @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><td class="py-4 px-6">No hay registros</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <br>
                      <div class="grupo-group">
                          
                      </div>
                      <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="add-service-btn">Agregar Grupo</button>
                        <br>
                  </div>
                  <br>
                  
                  <div class="relative mb-4">
                    <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Editar nivel</button>
                </div>
                    
                    
                </div>
                
            </form>
                </div>
            </div>
        </div>
    </div>
    
  <script>
      document.getElementById('add-service-btn').addEventListener('click', function() {
          const wrapper = document.getElementById('grupos-wrapper');
          const index = wrapper.children.length;
      
          const newServiceGroup = document.createElement('div');
          newServiceGroup.classList.add('grupo-group');
      
          newServiceGroup.innerHTML = `
          <div class="grid grid-cols-5 gap-5">
              <div class="col-span-1">
                  <label class="leading-7 text-sm text-gray-600" for="grupos[${index}][grup_cod]">Grupos</label>
                  <select name="grupos[${index}][grup_cod]" class="grupo-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      @foreach ($grupos as $grupo)
                          <option  value="{{ $grupo->grup_cod }}" >{{ $grupo->grup_name }}</option>
                      @endforeach
                  </select>
                  
              </div>
      
              <div class="col-span-1">
                  <label class="leading-7 text-sm text-gray-600" for="grupos[${index}][perm_fini]">Fecha inicio</label>
                  <input type="date" name="grupos[${index}][perm_fini]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
              <div class="col-span-1">
                  <label class="leading-7 text-sm text-gray-600" for="grupos[${index}][perm_ffin]">Fecha fin</label>
                  <input type="date" name="grupos[${index}][perm_ffin]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
              <div class="col-span-1">
                  <label class="leading-7 text-sm text-gray-600" for="grupos[${index}][perm_pass]">Password</label>
                  <input type="text" name="grupos[${index}][perm_pass]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
              </div>
              
              <div class="col-span-1">
              <br>
                  <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="eliminarServicio(this)">Eliminar Grupos</button>
              </div>
          </div>
          `;
      
          wrapper.appendChild(newServiceGroup);
          updateTotal();
          attachEventListeners();
      });
      
      function eliminarServicio(button) {
          const servicioGroup = button.closest('.grupo-group');
          servicioGroup.remove();
          updateTotal();
      }
  
      function mostrarSelect() {
          var tipo = document.getElementById('tipo').value;
          console.log(tipo);
          var divGrupo = document.getElementById('grupos-wrapper');
          if (tipo === 'Ninguno') {
              divGrupo.style.display = 'block';
          } else {
              divGrupo.style.display = 'none';
          }
      }
      document.addEventListener('DOMContentLoaded', function() {
          document.getElementById('grupos-wrapper').style.display = 'none';
          var tipo = ('{{ old('tipo', $usuario->tipo)}}');
          console.log(tipo);
          if(tipo == 'Ninguno'){
            document.getElementById('grupos-wrapper').style.display = 'block';
          }else{
            document.getElementById('grupos-wrapper').style.display = 'none';
          }
      });
  </script>
  
  </x-app-layout>
  