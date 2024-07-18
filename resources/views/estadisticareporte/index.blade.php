<x-app-layout>
    <x-slot name="header">
        
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Reportes y estadisticas') }}
        </h2>
        <br>
        <br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto p-4">
                    
                    <h1 class="text-gray-900 text-xl mb-1 font-medium title-font">{{ __('Ingresos Mensuales en el año') }} {{ $year }}
                    </h1>
                    <form action="{{ route('estadisticareporte.generar') }}" method="GET" class="mb-8">
                        @csrf
                        <div>
                            <label for="mes" class="block text-sm font-medium text-gray-700">Seleccione el mes:</label>
                            <select name="mes" id="mes" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="1" {{ old('mes', $mes ?? '') == 1 ? 'selected' : '' }}>Enero</option>
                                <option value="2" {{ old('mes', $mes ?? '') == 2 ? 'selected' : '' }}>Febrero</option>
                                <option value="3" {{ old('mes', $mes ?? '') == 3 ? 'selected' : '' }}>Marzo</option>
                                <option value="4" {{ old('mes', $mes ?? '') == 4 ? 'selected' : '' }}>Abril</option>
                                <option value="5" {{ old('mes', $mes ?? '') == 5 ? 'selected' : '' }}>Mayo</option>
                                <option value="6" {{ old('mes', $mes ?? '') == 6 ? 'selected' : '' }}>Junio</option>
                                <option value="7" {{ old('mes', $mes ?? '') == 7 ? 'selected' : '' }}>Julio</option>
                                <option value="8" {{ old('mes', $mes ?? '') == 8 ? 'selected' : '' }}>Agosto</option>
                                <option value="9" {{ old('mes', $mes ?? '') == 9 ? 'selected' : '' }}>Septiembre</option>
                                <option value="10" {{ old('mes', $mes ?? '') == 10 ? 'selected' : '' }}>Octubre</option>
                                <option value="11" {{ old('mes', $mes ?? '') == 11 ? 'selected' : '' }}>Noviembre</option>
                                <option value="12" {{ old('mes', $mes ?? '') == 12 ? 'selected' : '' }}>Diciembre</option>
                            </select>
                        <label for="year">Seleccione el año:</label>
                        <input class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" type="number" name="year" id="year" value="{{ $year }}">
                        <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Generar</button>
                    </form>
                    <canvas id="incomeChart" width="400" height="200"></canvas>
                </div>
            </div>
            
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto p-4">
                    <div id="calendar" class="p-4 bg-white rounded-lg shadow-md"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto p-4">
                    
                    @if(isset($demandasServicios))
                    <canvas id="graficoDemandas" width="400" height="200"></canvas>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('incomeChart').getContext('2d');
            var incomeChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [{
                        label: 'Ingresos',
                        data: @json($months->values()),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false // Esto asegura que el área debajo de la línea no se rellene
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctx = document.getElementById('graficoDemandas').getContext('2d');
            var demandasServicios = @json($demandasServicios);
            
            var nombresServicios = demandasServicios.map(item => item.nombre_servicio);
            var cantidades = demandasServicios.map(item => item.cantidad);
            
            var graficoDemandas = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombresServicios,
                    datasets: [{
                        label: 'Cantidad de Tratamientos',
                        data: cantidades,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: 'citas/events',
                eventRender: function(event, element) {
                    element.qtip({
                        content: event.description
                    });
                    // Personalizar estilo del evento
                    $(element).addClass('bg-blue-500 text-dark'); // Ejemplo de clase de Tailwind
                }
            });
            calendar.render();
        });
        
    </script>
</x-app-layout>
