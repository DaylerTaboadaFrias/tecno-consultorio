<x-app-layout>
    <x-slot name="header">
        
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Gestionar detallesTratamiento') }}
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
                                    Servicio
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Pieza
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Precio
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($detallesTratamiento as $detalleTratamiento)
                            <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{ $detalleTratamiento->id }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleTratamiento->servicio->nombre }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleTratamiento->pieza }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $detalleTratamiento->servicio->precio }}
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
                    {{ $detallesTratamiento->links() }}
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
