<x-app-layout>
    <x-slot name="header">
        
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Gestionar detallesReceta') }}
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
                                    Medicamaneto
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Hora frecuencia
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Marca
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Tipo
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($detallesReceta as $detalleReceta)
                            <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{ $detalleReceta->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleReceta->medicamento->nombre }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleReceta->horafrecuencia }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleReceta->medicamento->marca }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleReceta->medicamento->tipo }}
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
                    {{ $detallesReceta->links() }}
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
