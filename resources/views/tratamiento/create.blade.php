<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Registrar tratamiento
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
                    <form method="POST" action="{{ route('tratamiento.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Escribe tu tratamiento') }}
                            </h2>
                            <div hidden class="form-group">
                                <label for="costo">Costo Base del Tratamiento</label>
                                <input type="number" step="0.01" name="costo" class="form-control"  id="costo_base">
                            </div>
                            <div class="relative mb-4">
                                <label for="descripcion"
                                    class="leading-7 text-sm text-gray-600">{{ __('Descripcion') }}</label>
                                <input type="text" required required id="descripcion" name="descripcion" value="{{ old('descripcion') }}"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @error('descripcion')
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
                                <label for="id_consulta"
                                    class="leading-7 text-sm text-gray-600">{{ __('Consulta') }}</label>
                                <select id="id_consulta" name="id_consulta"
                                    class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    @foreach ($consultas as $consulta)
                                        <option value="{{ $consulta->id }}" data-nombre="{{ $consulta->cliente->nombre }}" data-email="{{ $consulta->cliente->email }}" data-telefono="{{ $consulta->cliente->telefono }}">{{ $consulta->cliente->nombre }} - Consulta #{{$consulta->id }}</option>
                                    @endforeach
                                </select>
                                @error('id_consulta')
                                    <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                @enderror
                            </div>
                            <div id="datos-cliente" style="display: none;">
                                <div class="grid grid-cols-4 gap-4">
                                    <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Datos del cliente') }}
                                    </h2>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="nombre_cliente">Nombre</label>
                                            <input type="text" id="nombre_cliente" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="email_cliente">Email</label>
                                            <input type="email" id="email_cliente" class="form-control" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-span-1">
                                        <div class="form-group">
                                            <label for="telefono_cliente">Teléfono</label>
                                            <input type="text" id="telefono_cliente" class="form-control" readonly>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __('Agrega tus servicios') }}
                            </h2>
                            <br>
                            <div id="servicios-wrapper">
                                <div class="servicio-group">
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">
                                            <label for="servicios[0][id]">Servicio</label>
                                            <select name="servicios[0][id]" onchange="mostrarImagen(this, 0)" class="servicio-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                @foreach ($servicios as $servicio)
                                                    <option value="{{ $servicio->id }}" data-imagen="{{ asset('images/' . $servicio->imagen) }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('servicios[0][id]')
                                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                            @enderror
                                        </div>
                                        <div  class="col-span-1 w-40" >
                                            <label for="">Imagen</label>
                                            <img class="w-50 h-50 rounded-sm" id="servicio-imagen-0" alt="image description">
                                        </div>
                                        <div hidden class="col-span-1">
                                            <label for="servicios[0][cantidad]">Cantidad</label>
                                            <input value="1" name="servicios[0][cantidad]" class="cantidad-input w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </div>
                                        <div class="col-span-1">
                                            <label for="servicios[0][pieza]">Pieza</label>
                                            <input type="text" name="servicios[0][pieza]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            @error('servicios[0][pieza]')
                                                <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">{{ $message }}</span></p>
                                            @enderror
                                        </div>
                                        <div class="col-span-1">
                                            <br>
                                            <button type="button"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"  onclick="eliminarServicio(this)">Eliminar Servicio</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="total">Total del Tratamiento</label>
                                <input diabled type="text" name="total" class="cantidad-input w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" id="total" readonly>
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-service-btn">Agregar Servicio</button>
                            <div class="relative mb-4">
                                
                                <button type="submit"
                                    class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Crear
                                    tratamiento</button>
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
        const wrapper = document.getElementById('servicios-wrapper');
        const index = wrapper.children.length;
    
        const newServiceGroup = document.createElement('div');
        newServiceGroup.classList.add('servicio-group');
    
        newServiceGroup.innerHTML = `
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-1">
                <label for="servicios[${index}][id]">Servicio</label>
                <select onchange="mostrarImagen(this, ${index})" name="servicios[${index}][id]" class="servicio-select w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    @foreach ($servicios as $servicio)
                        <option data-imagen="{{ asset('images/' . $servicio->imagen) }}" value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>
                
            </div>
            <div   class="col-span-1 w-40" >
                <img class="w-50 h-50 rounded-sm" id="servicio-imagen-${index}" alt="image description">
            </div>
            <div hidden class="col-span-1">
                <label for="servicios[${index}][cantidad]">Cantidad</label>
                <input value="1" type="number" name="servicios[${index}][cantidad]" class="cantidad-input w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
    
            <div class="col-span-1">
                <label for="servicios[${index}][pieza]">Pieza</label>
                <input type="text" name="servicios[${index}][pieza]" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
            <div class="col-span-1">
            <br>
                <button type="button" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="eliminarServicio(this)">Eliminar Servicio</button>
            </div>
        </div>
        `;
    
        wrapper.appendChild(newServiceGroup);
        updateTotal();
        attachEventListeners();
    });
    
    function eliminarServicio(button) {
        const servicioGroup = button.closest('.servicio-group');
        servicioGroup.remove();
        updateTotal();
    }
    function mostrarImagen(select, index) {
        const selectedOption = select.options[select.selectedIndex];
        const imagenUrl = selectedOption.getAttribute('data-imagen');
        const imgElement = document.getElementById(`servicio-imagen-${index}`);
        if (imagenUrl) {
            console.log("nadass");
            imgElement.src = imagenUrl;
            imgElement.style.display = 'block';
        } else {
            console.log("nada");
            imgElement.style.display = 'none';
        }
    }
    function updateTotal() {
    let total = parseFloat(document.getElementById('costo_base').value) || 0;
    const serviceGroups = document.querySelectorAll('.servicio-group');
    console.log(total);
    serviceGroups.forEach(group => {
        const servicioSelect = group.querySelector('.servicio-select');
        const cantidadInput = group.querySelector('.cantidad-input');

        const precio = parseFloat(servicioSelect.options[servicioSelect.selectedIndex].getAttribute('data-precio')) || 0;
        const cantidad = parseFloat(cantidadInput.value) || 0;
        
        total += precio * cantidad;
    });

    document.getElementById('total').value = total.toFixed(2);
}

function attachEventListeners() {
    const serviceSelects = document.querySelectorAll('.servicio-select');
    const cantidadInputs = document.querySelectorAll('.cantidad-input');

    serviceSelects.forEach(select => select.addEventListener('change', updateTotal));
    cantidadInputs.forEach(input => input.addEventListener('input', updateTotal));
}

document.addEventListener('DOMContentLoaded', function() {
    attachEventListeners();
    updateTotal();
});
document.getElementById('id_consulta').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const nombre = selectedOption.getAttribute('data-nombre');
    const email = selectedOption.getAttribute('data-email');
    const telefono = selectedOption.getAttribute('data-telefono');

    document.getElementById('nombre_cliente').value = nombre;
    document.getElementById('email_cliente').value = email;
    document.getElementById('telefono_cliente').value = telefono;

    document.getElementById('datos-cliente').style.display = 'block';
});
    </script>