<x-app-layout>
    <x-slot name="header">
        
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Gestionar pagos') }}
        </h2>
        <br>
        <br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    ID
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Cliente
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Diagnostico
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Monto total
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Monto Pagado
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Monto a cobrar
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Detalle
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tratamientos as $tratamiento)
                            <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->consulta->cliente->nombre }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->descripcion }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->montototal }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->montopagado }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $tratamiento->montoacobrar }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('pago.index', [$tratamiento->id]) }}"
                                            class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Detalle</a>
                                        <br><br>
                                    </td>
                                    
                                </tr>
                                
                            @empty
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-4 px-6">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $tratamientos->links() }}
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
