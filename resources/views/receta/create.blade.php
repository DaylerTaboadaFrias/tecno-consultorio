<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Registrar receta
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
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form method="POST" action="{{ route('receta.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Escribe tu receta') }}
                            </h2>
                            
                            <div class="relative mb-4">
                                <label for="recomendacion"
                                    class="leading-7 text-sm text-gray-600">{{ __('Recomendacion') }}</label>
                                <input type="text" required required id="recomendacion" name="recomendacion" value="{{ old('recomendacion') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('recomendacion')
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
                                <label for="id_tratamiento"
                                    class="leading-7 text-sm text-gray-600">{{ __('Tratamiento') }}</label>
                                <select id="id_tratamiento" name="id_tratamiento"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($tratamientos as $tratamiento)
                                        <option value="{{ $tratamiento->id }}" data-nombre="{{ $tratamiento->consulta->cliente->nombre }}" data-descripcion="{{ $tratamiento->descripcion }}" data-consulta="{{ $tratamiento->consulta->motivo }}">{{ $tratamiento->consulta->cliente->nombre }} - Tratamiento #{{$tratamiento->id }}</option>
                                    @endforeach
                                </select>
                                @error('id_tratamiento')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div id="datos-cliente" style="display: none;">
                                <div class="grid grid-cols-4 gap-4">
                                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Datos del cliente y tratamiento') }}
                                    </h2>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre</label><br>
                                            <input type="text" id="nombre_cliente" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="email_cliente">Descripcion</label><br>
                                            <input type="email" id="email_cliente" class="form-control" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="telefono_cliente">Motivo</label><br>
                                            <input type="text" id="telefono_cliente" class="form-control" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Agrega tus medicamentos') }}
                            </h2>
                            <br>
                            <div id="medicamentos-wrapper">
                                <div class="medicamento-group">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">
                                            <label for="medicamentos[0][id]">Medicamento</label>
                                            <select name="medicamentos[0][id]" onchange="mostrarImagen(this, 0)" class="medicamento-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @foreach ($medicamentos as $medicamento)
                                                    <option value="{{ $medicamento->id }}" data-imagen="{{ asset('images/' . $medicamento->imagen) }}" >{{ $medicamento->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('medicamentos[0][id]')
                                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                            @enderror
                                        </div>
                                        <div  class="col-span-1 w-40" >
                                            <label for="">Imagen</label>
                                            <img class="w-50 h-50 rounded-sm" id="medicamento-imagen-0" alt="image description">
                                        </div>
                                        
                                        <div class="col-span-1">
                                            <label for="medicamentos[0][horafrecuencia]">Hora frecuencia</label>
                                            <input type="text" name="medicamentos[0][horafrecuencia]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            @error('medicamentos[0][horafrecuencia]')
                                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                            @enderror
                                        </div>
                                        <div class="col-span-1">
                                            <br>
                                            <button type="button"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"  onclick="eliminarServicio(this)">Eliminar Medicamento</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div hidden class="form-group">
                                <label for="total">Total del Tratamiento</label>
                                <input diabled type="text" name="total" class="cantidad-input w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="total" readonly>
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-service-btn">Agregar Medicamento</button>
                            <div class="relative mb-4">
                                
                                <button type="submit"
                                    class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Crear
                                    receta</button>
                            </div>

                        </div>
                    </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
<script>
    document.getElementById('add-service-btn').addEventListener('click', function() {
        const wrapper = document.getElementById('medicamentos-wrapper');
        const index = wrapper.children.length;
    
        const newServiceGroup = document.createElement('div');
        newServiceGroup.classList.add('medicamento-group');
    
        newServiceGroup.innerHTML = `
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1">
                <label for="medicamentos[${index}][id]">Medicamento</label>
                <select onchange="mostrarImagen(this, ${index})" name="medicamentos[${index}][id]" class="medicamento-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @foreach ($medicamentos as $medicamento)
                        <option data-imagen="{{ asset('images/' . $medicamento->imagen) }}" value="{{ $medicamento->id }}" >{{ $medicamento->nombre }}</option>
                    @endforeach
                </select>
                
            </div>
            <div   class="col-span-1 w-40" >
                <img class="w-50 h-50 rounded-sm" id="medicamento-imagen-${index}" alt="image description">
            </div>
            
    
            <div class="col-span-1">
                <label for="medicamentos[${index}][horafrecuencia]">Hora frecuencia</label>
                <input type="text" name="medicamentos[${index}][horafrecuencia]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="col-span-1">
            <br>
                <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="eliminarServicio(this)">Eliminar Medicamento</button>
            </div>
        </div>
        `;
    
        wrapper.appendChild(newServiceGroup);
        updateTotal();
        attachEventListeners();
    });
    
    function eliminarServicio(button) {
        const servicioGroup = button.closest('.medicamento-group');
        servicioGroup.remove();
        updateTotal();
    }
    function mostrarImagen(select, index) {
        const selectedOption = select.options[select.selectedIndex];
        const imagenUrl = selectedOption.getAttribute('data-imagen');
        const imgElement = document.getElementById(`medicamento-imagen-${index}`);
        if (imagenUrl) {
            console.log("nadass");
            imgElement.src = imagenUrl;
            imgElement.style.display = 'block';
        } else {
            console.log("nada");
            imgElement.style.display = 'none';
        }
    }


document.getElementById('id_tratamiento').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const nombre = selectedOption.getAttribute('data-nombre');
    const consulta = selectedOption.getAttribute('data-consulta');
    const descripcion = selectedOption.getAttribute('data-descripcion');

    document.getElementById('nombre_cliente').value = nombre;
    document.getElementById('email_cliente').value = consulta;
    document.getElementById('telefono_cliente').value = descripcion;

    document.getElementById('datos-cliente').style.display = 'block';
});
    </script>