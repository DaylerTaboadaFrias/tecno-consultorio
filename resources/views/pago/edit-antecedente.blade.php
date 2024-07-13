<x-app-layout>
    <x-slot name="header">
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">
            Registro de la informacion adicional antecedentes
        </h2>
        
        <br><br>
        <h2 class="{{ $esDeDia ? 'font-semibold text-xl text-gray-800 leading-tight' : 'font-semibold text-xl text-white leading-tight' }}">Esta vista ha sido visitada {{ $vista->contador }} veces.</h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <form action="{{ route('consulta-antecente.update', $form->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Antecedentes patologicos:") }}</h2>
                            <br>
                            @php
                                $antecedentes_patologicos = explode(',', $form->antecedentes_patologicos);
                            @endphp
                            <div class="grid grid-cols-5 gap-4 mb-4">
                                <div class="flex items-center">
                                    <input {{ in_array('Cardiopatia', $antecedentes_patologicos) ? 'checked' : '' }} id="cardiopatia" type="checkbox" name="antecedentes_patologicos[]" value="Cardiopatia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="cardiopatia" value="Alt.Coagulacion" {{ in_array('Alt.Coagulacion', $antecedentes_patologicos) ? 'checked' : '' }} class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cardiopatía</label>
                                </div>
                                <div class="flex items-center">
                                    <input  {{ in_array('Alt.Coagulacion', $antecedentes_patologicos) ? 'checked' : '' }} id="alt-coagulacion" type="checkbox" name="antecedentes_patologicos[]" value="Alt.Coagulacion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="alt-coagulacion" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alteraciones de Coagulación</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Hipertension', $antecedentes_patologicos) ? 'checked' : '' }} id="hipertension" type="checkbox" name="antecedentes_patologicos[]" value="Hipertension" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="hipertension" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hipertensión</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Hipertension', $antecedentes_patologicos) ? 'checked' : '' }} id="anemia" type="checkbox" name="antecedentes_patologicos[]" value="Anemia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="anemia" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Anemia</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Diabetes', $antecedentes_patologicos) ? 'checked' : '' }} id="diabetes" type="checkbox" name="antecedentes_patologicos[]" value="Diabetes" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="diabetes" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Diabetes</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('HipertensÚlcera Gástricaion', $antecedentes_patologicos) ? 'checked' : '' }} id="ulcera-gastrica" type="checkbox" name="antecedentes_patologicos[]" value="Ulcera Gastrica" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="ulcera-gastrica" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Úlcera Gástrica</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Hepatitis', $antecedentes_patologicos) ? 'checked' : '' }} id="hepatitis" type="checkbox" name="antecedentes_patologicos[]" value="Hepatitis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="hepatitis" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Hepatitis</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Alergia', $antecedentes_patologicos) ? 'checked' : '' }} id="alergia" type="checkbox" name="antecedentes_patologicos[]" value="Alergia" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="alergia" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Alergia</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Asma', $antecedentes_patologicos) ? 'checked' : '' }} id="asma" type="checkbox" name="antecedentes_patologicos[]" value="Asma" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="asma" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Asma</label>
                                </div>
                                <div class="flex items-center">
                                    <input {{ in_array('Tuberculosis', $antecedentes_patologicos) ? 'checked' : '' }} id="tuberculosis" type="checkbox" name="antecedentes_patologicos[]" value="Tuberculosis" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="tuberculosis" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tuberculosis</label>
                                </div>
                            </div>
                            <br>
                            <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">{{ __("Observaciones :") }}</h2>
                            <br>
                            <div>
                                <textarea rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 white:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="observaciones" id="observaciones">
                                    {{ $form->observaciones }}
                                </textarea>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="col-span-1">
                                    <div>
                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Está en tratamiento médico?</label>
                                        <div class="flex items-center">
                                            <input value="si" {{ $form->tratamiento_medico == 'si' ? 'checked' : '' }} id="cepillado-sangrado-si" type="radio" name="tratamiento_medico" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="cepillado-sangrado-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input value="no" {{ $form->tratamiento_medico == 'no' ? 'checked' : '' }} id="cepillado-sangrado-no" type="radio" name="tratamiento_medico" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="cepillado-sangrado-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div>
                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Está embarazada?</label>
                                        <div class="flex items-center">
                                            <input value="si" {{ $form->embarazo == 'si' ? 'checked' : '' }} id="embarazo-si" type="radio" name="embarazo" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="embarazo-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input value="no" {{ $form->embarazo == 'no' ? 'checked' : '' }} id="embarazo-no" type="radio" name="embarazo" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="embarazo-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div>
                                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">¿Ha tenido hemorragia post exodoncia?</label>
                                        <div class="flex items-center">
                                            <input value="si" {{ $form->hemorragia_post_exodoncia == 'si' ? 'checked' : '' }} id="hemorragia_post_exodoncia-si" type="radio" name="hemorragia_post_exodoncia" value="Sí" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="hemorragia_post_exodoncia-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input value="no" {{ $form->hemorragia_post_exodoncia == 'no' ? 'checked' : '' }} id="hemorragia_post_exodoncia-no" type="radio" name="hemorragia_post_exodoncia" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="hemorragia_post_exodoncia-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                        </div>
                                    </div>
                                </div>

                            <div>
                                <label for="medicacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medicación:</label>
                                <input value="{{ $form->medicacion }}" type="text" name="medicacion" id="medicacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div>
                                <label for="tiempo_gestacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tiempo de gestación:</label>
                                <input  value="{{ $form->tiempo_gestacion }}" type="text" name="tiempo_gestacion" id="tiempo_gestacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div>
                                <label for="inmediata" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Inmediata?</label>
                                <input  {{ $form->inmediata ? 'checked' : '' }} type="checkbox" name="inmediata" id="inmediata" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring
                                -blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>

                            <div>
                                <label for="mediata" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Mediata?</label>
                                <input {{ $form->mediata ? 'checked' : '' }} type="checkbox" name="mediata" id="mediata" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>

                            <!-- Nueva sección agregada -->
                           
                            <div class="mb-4">
                                <div class="mb-2">
                                    <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cuantas veces te cepillas al dia?</label>
                                </div>
                                <div class="grid grid-cols-5 gap-4 mb-4">
                                    
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_veces == 'Una' ? 'checked' : '' }} id="cepillado-una" type="radio" name="cepillado_veces" value="Una" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cepillado-una" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Una</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_veces == 'Dos' ? 'checked' : '' }} id="cepillado-dos" type="radio" name="cepillado_veces" value="Dos" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cepillado-dos" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dos</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_veces == 'Tres' ? 'checked' : '' }} id="cepillado-tres" type="radio" name="cepillado_veces" value="Tres" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cepillado-tres" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tres</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_veces == 'Nunca' ? 'checked' : '' }} id="cepillado-nunca" type="radio" name="cepillado_veces" value="Nunca" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                        <input {{ $form->cepillado_frecuencia == 'Dsp.de comidas' ? 'checked' : '' }} id="cepillado-despues-comidas" type="radio" name="cepillado_frecuencia" value="Dsp.de comidas" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cepillado-despues-comidas" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Después de comidas</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_frecuencia == 'Ocasional' ? 'checked' : '' }} id="cepillado-ocasional" type="radio" name="cepillado_frecuencia" value="Ocasional" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="cepillado-ocasional" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ocasional</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ $form->cepillado_frecuencia == 'Nunca' ? 'checked' : '' }} id="cepillado-nunca-frec" type="radio" name="cepillado_frecuencia" value="Nunca" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                        <input {{ $form->cepillado_sangrado_encias ? 'checked' : '' }} id="cepillado-sangrado-si" type="radio" name="cepillado_sangrado_encias" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label  for="cepillado-sangrado-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ !$form->cepillado_sangrado_encias ? 'checked' : '' }} id="cepillado-sangrado-no" type="radio" name="cepillado_sangrado_encias" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                                        <input {{ $form->uso_hilo_dental ? 'checked' : '' }} id="uso-hilo-dental-si" type="radio" name="uso_hilo_dental" value="Si" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="uso-hilo-dental-si" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sí</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input {{ !$form->uso_hilo_dental ? 'checked' : '' }} id="uso-hilo-dental-no" type="radio" name="uso_hilo_dental" value="No" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="uso-hilo-dental-no" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mb-4">
                                <button type="submit" class=" mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Actualizar antecedentes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
