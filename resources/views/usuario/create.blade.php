<x-app-layout>
  <x-slot name="header">
      <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
        Registrar usuario
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
          <form method="POST" action="{{route('usuario.store')}}" enctype="multipart/form-data"> 
              @csrf
              
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                  <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Escribe tu usuario") }}</h2>
                  <div class="relative mb-4">
                      <label for="nombre" class="leading-7 text-sm text-gray-600">{{ __("Nombre") }}</label>
                      <input type="text" id="nombre" required name="nombre" value="{{ old("nombre") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        @error('nombre')
                            <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                        @enderror
                    </div>
                  <div class="relative mb-4">
                    <label for="apellido" class="leading-7 text-sm text-gray-600">{{ __("Apellido") }}</label>
                    <input type="text" required id="apellido" name="apellido" value="{{ old("apellido") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('apellido')
                        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="cedula" class="leading-7 text-sm text-gray-600">{{ __("Cedula") }}</label>
                    <input type="text" required id="cedula" name="cedula" value="{{ old("cedula") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('cedula')
                        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">{{ __("Email") }}</label>
                    <input type="text" required id="email" name="email" value="{{ old("email") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('email')
                        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="telefono" class="leading-7 text-sm text-gray-600">{{ __("Telefono") }}</label>
                    <input type="text" required id="telefono" name="telefono" value="{{ old("telefono") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @error('telefono')
                        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                <div class="relative mb-4">
                    <label for="fecha_nac" class="leading-7 text-sm text-gray-600">{{ __("Fecha nacimiento") }}</label>
                    <input type="date" required id="fecha_nac" name="fecha_nac" value="{{ old("fecha_nac") }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                        <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
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
                        <option value="Ninguno" {{ old('tipo') == 'Ninguno' ? 'selected' : '' }}>Selecciona una opcion</option>
                        <option value="Cliente" {{ old('tipo') == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                        <option value="Administrativo" {{ old('tipo') == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                    </select>
                    @error('tipo')
                        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                    @enderror
                </div>
                
                <div id="grupos-wrapper">
                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Agrega tus grupos') }}
                    </h2>
                    <br>
                    <div class="grupo-group">
                        <div class="grid grid-cols-5 gap-5">
                            <div class="col-span-1">
                                
                                <label class="leading-7 text-sm text-gray-600" for="grupos[0][grup_cod]">Grupo</label>
                                <select name="grupos[0][grup_cod]"  class="grupo-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->grup_cod }}" >{{ $grupo->grup_name }}</option>
                                    @endforeach
                                </select>
                                @error('grupos[0][grup_cod]')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            
                            <div class="col-span-1">
                                <label class="leading-7 text-sm text-gray-600" for="grupos[0][perm_fini]">P. fecha inicio</label>
                                <input type="date" name="grupos[0][perm_fini]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('grupos[0][perm_fini]')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="col-span-1">
                                <label class="leading-7 text-sm text-gray-600" for="grupos[0][perm_ffin]">P. fecha fin</label>
                                <input type="date" name="grupos[0][perm_ffin]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('grupos[0][perm_ffin]')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="col-span-1">
                                <label class="leading-7 text-sm text-gray-600" for="grupos[0][perm_pass]">Password</label>
                                <input type="password" name="grupos[0][perm_pass]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('grupos[0][perm_pass]')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div class="col-span-1">
                                <br>
                                <button type="button"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"  onclick="eliminarServicio(this)">Eliminar Grupo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
                <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="add-service-btn">Agregar Grupo</button>
                <br>
                  <div class="relative mb-4">
                      <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Crear usuario</button>
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
        @if(old('tipo') != 'Ninguno')
            document.getElementById('grupos-wrapper').style.display = 'block';
        @else
            document.getElementById('grupos-wrapper').style.display = 'none';
        @endif
    });
</script>

</x-app-layout>
