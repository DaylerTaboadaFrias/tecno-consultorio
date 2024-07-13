<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            {{ __('Consultar historia clinica del paciente') }}
        </h2>
        <br>
        <br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h3>
    </x-slot>
    
    
    <div class="py-8">
 <!-- Modal toggle -->
    

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto m-4">
                                        
                    <ol class="relative border-s border-gray-200 dark:border-gray-700"> 
                        @foreach ($consultas as $consulta)
                            <li class="mb-6 ms-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-6 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Se realizo la consulta en la fecha de consulta {{ $consulta->fecha }}</time>
                                <div class="pm-4">
                                    <h3 class=" mb-6 text-lg font-semibold text-blue-600">Se realizo la consulta #{{ $consulta->id }}</h3>
                                    <p class="mb-6 text-base font-normal text-gray-500 dark:text-gray-400"><strong>Motivo: </strong> paciente se apersono por {{ $consulta->motivo }}</p>
                                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                                        @if (count($consulta->antecedente)>0)
                                        <form >
                                            @csrf
                                            @method('PUT')
                                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                                                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Antecedentes patologicos:") }}</h2>
                                                <br>
                                                @php
                                                    $antecedentes_patologicos = explode(',', $consulta->antecedente[0]->antecedentes_patologicos);
                                                @endphp
                                                <div class="grid grid-cols-5 gap-4 mb-4">
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Cardiopatia', $antecedentes_patologicos) ? 'checked' : '' }} id="cardiopatia" type="checkbox" name="antecedentes_patologicos[]" value="Cardiopatia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="cardiopatia" value="Alt.Coagulacion" {{ in_array('Alt.Coagulacion', $antecedentes_patologicos) ? 'checked' : '' }} class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cardiopatía</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled  {{ in_array('Alt.Coagulacion', $antecedentes_patologicos) ? 'checked' : '' }} id="alt-coagulacion" type="checkbox" name="antecedentes_patologicos[]" value="Alt.Coagulacion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="alt-coagulacion" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alteraciones de Coagulación</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Hipertension', $antecedentes_patologicos) ? 'checked' : '' }} id="hipertension" type="checkbox" name="antecedentes_patologicos[]" value="Hipertension" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="hipertension" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hipertensión</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Hipertension', $antecedentes_patologicos) ? 'checked' : '' }} id="anemia" type="checkbox" name="antecedentes_patologicos[]" value="Anemia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="anemia" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Anemia</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Diabetes', $antecedentes_patologicos) ? 'checked' : '' }} id="diabetes" type="checkbox" name="antecedentes_patologicos[]" value="Diabetes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="diabetes" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Diabetes</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('HipertensÚlcera Gástricaion', $antecedentes_patologicos) ? 'checked' : '' }} id="ulcera-gastrica" type="checkbox" name="antecedentes_patologicos[]" value="Ulcera Gastrica" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="ulcera-gastrica" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Úlcera Gástrica</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Hepatitis', $antecedentes_patologicos) ? 'checked' : '' }} id="hepatitis" type="checkbox" name="antecedentes_patologicos[]" value="Hepatitis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="hepatitis" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hepatitis</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Alergia', $antecedentes_patologicos) ? 'checked' : '' }} id="alergia" type="checkbox" name="antecedentes_patologicos[]" value="Alergia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="alergia" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alergia</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Asma', $antecedentes_patologicos) ? 'checked' : '' }} id="asma" type="checkbox" name="antecedentes_patologicos[]" value="Asma" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="asma" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asma</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input disabled {{ in_array('Tuberculosis', $antecedentes_patologicos) ? 'checked' : '' }} id="tuberculosis" type="checkbox" name="antecedentes_patologicos[]" value="Tuberculosis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                        <label for="tuberculosis" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tuberculosis</label>
                                                    </div>
                                                </div>
                                                <br>
                                                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Observaciones :") }}</h2>
                                                <br>
                                                <div>
                                                    <textarea disabledrows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="observaciones" id="observaciones">
                                                        {{ $consulta->antecedente[0]->observaciones }}
                                                    </textarea>
                                                </div>
                                                <div class="grid grid-cols-4 gap-4">
                                                    <div class="col-span-1">
                                                        <div>
                                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Está en tratamiento médico?</label>
                                                            <div class="flex items-center">
                                                                <input disabled value="si" {{ $consulta->antecedente[0]->tratamiento_medico == 'si' ? 'checked' : '' }} id="cepillado-sangrado-si" type="radio" name="tratamiento_medico" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="cepillado-sangrado-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input disabled value="no" {{ $consulta->antecedente[0]->tratamiento_medico == 'no' ? 'checked' : '' }} id="cepillado-sangrado-no" type="radio" name="tratamiento_medico" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="cepillado-sangrado-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-1">
                                                        <div>
                                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Está embarazada?</label>
                                                            <div class="flex items-center">
                                                                <input disabled value="si" {{ $consulta->antecedente[0]->embarazo == 'si' ? 'checked' : '' }} id="embarazo-si" type="radio" name="embarazo" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="embarazo-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input disabled value="no" {{ $consulta->antecedente[0]->embarazo == 'no' ? 'checked' : '' }} id="embarazo-no" type="radio" name="embarazo" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="embarazo-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                    <div class="col-span-1">
                                                        <div>
                                                            <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Ha tenido hemorragia post exodoncia?</label>
                                                            <div class="flex items-center">
                                                                <input disabled value="si" {{ $consulta->antecedente[0]->hemorragia_post_exodoncia == 'si' ? 'checked' : '' }} id="hemorragia_post_exodoncia-si" type="radio" name="hemorragia_post_exodoncia" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="hemorragia_post_exodoncia-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input disabled value="no" {{ $consulta->antecedente[0]->hemorragia_post_exodoncia == 'no' ? 'checked' : '' }} id="hemorragia_post_exodoncia-no" type="radio" name="hemorragia_post_exodoncia" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                <label for="hemorragia_post_exodoncia-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                    
                                                <div>
                                                    <label for="medicacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicación:</label>
                                                    <input disabled value="{{ $consulta->antecedente[0]->medicacion }}" type="text" name="medicacion" id="medicacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                    
                                                <div>
                                                    <label for="tiempo_gestacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiempo de gestación:</label>
                                                    <input disabled  value="{{ $consulta->antecedente[0]->tiempo_gestacion }}" type="text" name="tiempo_gestacion" id="tiempo_gestacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                </div>
                    
                                                <div>
                                                    <label for="inmediata" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Inmediata?</label>
                                                    <input disabled  {{ $consulta->antecedente[0]->inmediata ? 'checked' : '' }} type="checkbox" name="inmediata" id="inmediata" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring
                                                    -blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                    
                                                <div>
                                                    <label for="mediata" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Mediata?</label>
                                                    <input disabled {{ $consulta->antecedente[0]->mediata ? 'checked' : '' }} type="checkbox" name="mediata" id="mediata" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                    
                                                <!-- Nueva sección agregada -->
                                               
                                                <div class="mb-4">
                                                    <div class="mb-2">
                                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cuantas veces te cepillas al dia?</label>
                                                    </div>
                                                    <div class="grid grid-cols-5 gap-4 mb-4">
                                                        
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_veces == 'Una' ? 'checked' : '' }} id="cepillado-una" type="radio" name="cepillado_veces" value="Una" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-una" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Una</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_veces == 'Dos' ? 'checked' : '' }} id="cepillado-dos" type="radio" name="cepillado_veces" value="Dos" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-dos" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dos</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_veces == 'Tres' ? 'checked' : '' }} id="cepillado-tres" type="radio" name="cepillado_veces" value="Tres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-tres" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tres</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_veces == 'Nunca' ? 'checked' : '' }} id="cepillado-nunca" type="radio" name="cepillado_veces" value="Nunca" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-nunca" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nunca</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="mb-2">
                                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Frecuencia del cepillado?</label>
                                                    </div>
                                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_frecuencia == 'Dsp.de comidas' ? 'checked' : '' }} id="cepillado-despues-comidas" type="radio" name="cepillado_frecuencia" value="Dsp.de comidas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-despues-comidas" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Después de comidas</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_frecuencia == 'Ocasional' ? 'checked' : '' }} id="cepillado-ocasional" type="radio" name="cepillado_frecuencia" value="Ocasional" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-ocasional" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ocasional</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_frecuencia == 'Nunca' ? 'checked' : '' }} id="cepillado-nunca-frec" type="radio" name="cepillado_frecuencia" value="Nunca" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label  for="cepillado-nunca-frec" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nunca</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="mb-2">
                                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Durante el cepillado sangran las encias?</label>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->cepillado_sangrado_encias ? 'checked' : '' }} id="cepillado-sangrado-si" type="radio" name="cepillado_sangrado_encias" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label  for="cepillado-sangrado-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ !$consulta->antecedente[0]->cepillado_sangrado_encias ? 'checked' : '' }} id="cepillado-sangrado-no" type="radio" name="cepillado_sangrado_encias" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="cepillado-sangrado-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <div class="mb-2">
                                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Utiliza hilo dental?</label>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                                        <div class="flex items-center">
                                                            <input disabled {{ $consulta->antecedente[0]->uso_hilo_dental ? 'checked' : '' }} id="uso-hilo-dental-si" type="radio" name="uso_hilo_dental" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="uso-hilo-dental-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <input disabled {{ !$consulta->antecedente[0]->uso_hilo_dental ? 'checked' : '' }} id="uso-hilo-dental-no" type="radio" name="uso_hilo_dental" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="uso-hilo-dental-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </form>
                                        @endif
                                        
                                    </div>
                                    <p class="mb-6 text-base font-normal text-gray-500 dark:text-gray-400"><strong>Diagnostico: </strong> paciente se le diagnostico {{ $consulta->diagnostico }}</p>
                                    @foreach ($consulta->tratamientos as $tratamiento)
                                        <time class="mb-6 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Se realizo el tratamiento en la fecha  {{ $tratamiento->fecha }}</time>
                                        <div class="pm-4">
                                            <h3 class=" mb-6 text-lg font-semibold text-gray-900 dark:text-white">Se realizo el tratamiento #{{ $tratamiento->id }}</h3>
                                            <p class="mb-6 text-base font-normal text-gray-500 dark:text-gray-400"><strong>Descripcion: </strong> {{ $tratamiento->descripcion }}</p>
                                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            ID
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Imagen
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Nombre
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Pieza
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tratamiento->servicios as $servicio)
                                                        <tr class="bg-white border-b white:bg-gray-800 white:border-gray-700">
                                                                {{-- <img class="w-50 h-50 rounded-full" src="{{ $medicamento->imagen_movil }}"  alt="image description"> --}}
                                                            <td class="py-4 px-6">
                                                                {{$servicio->id }}
                                                            </td>
                                                            <td class="p-4 w-32">
                                                                <img class="w-50 h-50 rounded-full" src="/images/{{ $servicio->imagen }}" alt="image description">
                                                            </td>
                                                            <td class="py-4 px-6">
                                                                {{$servicio->nombre }}
                                                            </td>
                                                            <td class="py-4 px-6">
                                                                {{$servicio->pivot->pieza }}
                                                        </tr>
                                                        
                                                    @empty
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"><td class="py-4 px-6">No hay registros</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            
                                        </div>
                                    @endforeach 
                                </div>
                                
                                
                            </li>  
                        @endforeach                 
                    </ol>
                </div>
            </div>
        </div>
    </div>

    

</x-app-layout>
