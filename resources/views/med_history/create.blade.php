<!-- Alvo para rolagem --> <div class="scroll-target"></div>

<x-app-layout>

    <x-table-create 
        title="Anamnese" 
        onlyHead 
        actionRoute="anamnesis"
        notButtonAdd>

        <!-- Validation Errors -->
        <div class="mt-2 mb-4">
            <x-auth-validation-errors :errors="$errors" />
            <ul id="errorMessage" style="display: none;"
                class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                Data(s) Inválida(s), Insira datas que respeitem o seu respectivo campo
            </ul>
        </div>


        <!-- PÁGINA 1 -->

        <div id="step-1" class="form-step">

        <!-- I - Identificação -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                I - Identificação
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="student_id">Nome do Assistido <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select full idSelect="student_id" valueName="student_id"
                title="Selecione um Aluno Registrado:">

                @foreach ($students as $student)
                    <option class="text-sm" value="{{ $student->id }}" {{ old('student_id', $student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach  
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="informant">Informante <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="informant" id="informant" value="{{old('informant')}}"
                    placeholder="Nome do Informante" required />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="date_of_anamnesis">Data da Anamnese <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="date_of_anamnesis" id="date_of_anamnesis" placeholder="Data da Anamnese" x-init="initFlatpickr" autocomplete="off"
                    class="date" required value="{{old('date_of_anamnesis', \Carbon\Carbon::now()->format('d/m/Y'))}}" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="date_of_birth">Data de Nascimento <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth')}}" placeholder="Data" readonly />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="diagnostic">Diagnóstico <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input id="diagnostic" name="diagnostic" value="{{old('diagnostic')}}" placeholder="Diagnóstico do Aluno" readonly />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="appraisal">Laudo/Especialista <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="appraisal" id="appraisal" value="{{old('appraisal')}}" placeholder="Avaliação"
                    required />
            </div>
            <div class="flex">
                <input type="hidden" name="have_caregiver" value="0">

                <label for="have_caregiver" class="inline-flex items-center">
                    <input type="checkbox" name="have_caregiver" {{ old('have_caregiver') ? 'checked' : '' }} id="have_caregiver"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem Cuidador?</span>
                </label>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="school">Escola do Aluno: </x-anamnesis.label>
                <x-anamnesis.input id="school" name="school" value="{{old('school')}}" placeholder="Escola que Estuda" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="not_study_justify">Se não estuda, justifique </x-anamnesis.label>
                <x-anamnesis.input name="not_study_justify" id="not_study_justify"
                    value="{{old('not_study_justify')}}" placeholder="Justificação" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="grade_school">Série: </x-anamnesis.label>
                <x-anamnesis.input id="grade_school" name="grade_school" value="{{old('grade_school')}}" placeholder="Série que faz" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="sige">Nº do SIGE: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input id="sige" name="sige" value="{{old('sige')}}" placeholder="Nº do SIGE" required readOnly />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="turn_school">Turno: </x-anamnesis.label>
                <x-anamnesis.input id="turn_school" name="turn_school" value="{{old('turn_school')}}" placeholder="Turno na Escola" />
            </div>
            <div>
                <input type="hidden" name="have_AEE" value="0">

                <label for="have_AEE" class="inline-flex items-center">
                    <input type="checkbox" name="have_AEE" id="have_AEE" {{ old('have_AEE') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="turn_AEE" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Faz AEE?</span>
                </label>
                <x-anamnesis.input class="turn_AEE" name="turn_AEE" id="turn_AEE" value="{{old('turn_AEE')}}" placeholder="Turno da AEE" disabled />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="name_mother">Nome da Mãe <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="name_mother" id="name_mother" value="{{old('name_mother')}}"
                    placeholder="Nome da Mãe" required />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="date_mother">Data de Nascimento da Mãe <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="date_mother" id="date_mother" value="{{old('date_mother')}}" autocomplete="off"
                    class="date dateInput" placeholder="Ex: 01/11/2000" required x-init="initFlatpickr" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="rg_mother">RG da Mãe <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input class="rg" name="rg_mother" id="rg_mother" value="{{old('rg_mother')}}"
                    placeholder="RG da Mãe" required />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="profession_mother">Profissão da Mãe <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="profession_mother" id="profession_mother" value="{{old('profession_mother')}}"
                    placeholder="Profissão da Mãe" required />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="cellphone_mother">Telefone da Mãe (*opcional) </x-anamnesis.label>
                <x-anamnesis.input class="cellphone" name="cellphone_mother" id="cellphone_mother"
                    value="{{old('cellphone_mother')}}" placeholder="Ex: (88) 99312-1231" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="name_father">Nome do Pai (* Informações do Pai Opcionais) </x-anamnesis.label>
                <x-anamnesis.input name="name_father" id="name_father" value="{{old('name_father')}}"
                    placeholder="Nome do Pai" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="date_father">Data de Nascimento do Pai </x-anamnesis.label>
                <x-anamnesis.input class="date dateInput" name="date_father" id="date_father" autocomplete="off"
                    value="{{old('date_father')}}" placeholder="Ex: 01/11/2000" x-init="initFlatpickr" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="rg_father">RG do Pai </x-anamnesis.label>
                <x-anamnesis.input class="rg" name="rg_father" id="rg_father" value="{{old('rg_father')}}"
                    placeholder="RG do Pai" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="profession_father">Profissão do Pai </x-anamnesis.label>
                <x-anamnesis.input name="profession_father" id="profession_father" value="{{old('profession_father')}}"
                    placeholder="Profissão do Pai"  />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="cellphone_father">Telefone do Pai </x-anamnesis.label>
                <x-anamnesis.input class="cellphone" name="cellphone_father" id="cellphone_father"
                    value="{{old('cellphone_father')}}" placeholder="Ex: (88) 99312-1231" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="address">Endereço <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="address" id="address" value="{{old('address')}}"
                    placeholder="Ex: Travessa Joaquim Félix" required />
            </div>
            <div>
                <input type="hidden" name="have_medication" value="0">

                <label for="have_medication" class="inline-flex items-center">
                    <input type="checkbox" name="have_medication" id="have_medication" {{ old('have_medication') ? 'checked' : '' }} 
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_medication" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Usa Medicação?</span>
                </label>
                <x-anamnesis.input class="what_medication" name="what_medication" id="what_medication"
                    value="{{old('what_medication')}}" placeholder="Qual(is)?" disabled />
            </div>
        </div>

        <!-- II - Queixa Inicial -->

        <div class="my-3">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                II - Queixa Inicial
            </h1>
        </div>

        <div>
            <x-anamnesis.label sizeFont="sm" for="compplaint">Queixa Inicial (*opcional) </x-anamnesis.label>
            <x-form.textarea name="compplaint" id="compplaint" class="h-14" placeholder="Ex: O Assistido normalmente ...">
                {{old('compplaint')}}
            </x-form.textarea>
        </div>

        <!-- III - Situação Sociofamiliar -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                III - Situação Sociofamiliar
            </h1>
        </div>

        <div>
            <x-anamnesis.label sizeFont="sm" for="who_lives">Com quem mora? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
            <x-anamnesis.input name="who_lives" id="who_lives" value="{{old('who_lives')}}"
                placeholder="Ex: Pai, Mãe, ..." required />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="state_parents_relation">Pais Casados ou Separados? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="state_parents_relation" selectId="state_parents_relation"
                    title="Relação" full>
                    <option value="Casados" {{ old('state_parents_relation') == 'Casados' ? 'selected' : '' }}>
                        Casados
                    </option>
                    <option value="Separados" {{ old('state_parents_relation') == 'Separados' ? 'selected' : '' }}>
                        Separados
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="time_state_relation">Há quanto tempo? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="time_state_relation" id="time_state_relation"
                    value="{{old('time_state_relation')}}" placeholder="Ex: 30 dias" required />
            </div>
            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="have_kinship_parents" value="0">

                <label for="have_kinship_parents" class="inline-flex items-center">
                    <input type="checkbox" name="have_kinship_parents" id="have_kinship_parents" {{ old('have_kinship_parents') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_kinship_parents" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Existe Parentesco entre os Pais?</span>
                </label>
                <x-anamnesis.input class="what_kinship_parents w-60" notFull name="what_kinship_parents" id="what_kinship_parents"
                    value="{{old('what_kinship_parents')}}" placeholder="Qual?" disabled />
            </div>
        </div>  

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="flex">
                <input type="hidden" name="new_relation_mother" value="0">

                <label for="new_relation_mother" class="inline-flex items-center">
                    <input type="checkbox" name="new_relation_mother" id="new_relation_mother" {{ old('new_relation_mother') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="relation_mother" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Mãe: Novo relacionamento?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="time_new_relation_mother">Há quanto Tempo? </x-anamnesis.label>
                <x-anamnesis.input name="time_new_relation_mother" id="time_new_relation_mother"
                    value="{{old('time_new_relation_mother')}}" placeholder="Ex: 30 dias" class="relation_mother"
                    disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="lives_together_new_relation_mother">Moram juntos? </x-anamnesis.label>
                <x-anamnesis.select valueName="lives_together_new_relation_mother" notRequired
                    selectId="lives_together_new_relation_mother" title="Sim/Não" class="relation_mother" disabled>
                    <option value="Sim" {{ old('lives_together_new_relation_mother') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('lives_together_new_relation_mother') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="flex">
                <label for="new_relation_father" class="inline-flex items-center">
                    <input type="hidden" name="new_relation_father" value="0">

                    <input type="checkbox" name="new_relation_father" id="new_relation_father" {{ old('new_relation_father') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="relation_father" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pai: Novo relacionamento?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="time_new_relation_father">Há quanto Tempo? </x-anamnesis.label>
                <x-anamnesis.input name="time_new_relation_father" id="time_new_relation_father"
                    value="{{old('time_new_relation_father')}}" placeholder="Ex: 30 dias" class="relation_father"
                    disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="lives_together_new_relation_father">Moram juntos? </x-anamnesis.label>
                <x-anamnesis.select valueName="lives_together_new_relation_father" notRequired
                    selectId="lives_together_new_relation_father" title="Sim/Não" class="relation_father" disabled>
                    <option value="Sim" {{ old('lives_together_new_relation_father') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('lives_together_new_relation_father') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>

        <div class="flex items-center justify-center grid grid-cols-4 sm:grid-cols-3 mt-6"> 
            <div class="col-span-1"> 
                
            </div> 
            <div class="col-span-2 sm:col-span-1 step-indicator pt-0 sm:pt-2 text-center text-gray-700 dark:text-gray-300"> 
                Página <span class="current-step"></span> de <span class="total-steps"></span> 
            </div>
            <div class="col-span-1 flex justify-end"> 
                <x-button class="next-step" button> 
                    <i class="fas fa-arrow-right block sm:hidden"></i>
                    <span class="hidden sm:block"> Próximo </span>
                </x-button> 
            </div> 
        </div>
        
        </div>

        <!-- PÁGINA 2 -->

        <div id="step-2" class="form-step hidden">
       
        <!-- IV - Gestação / Condições do Nascimento -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                IV - Gestação / Condições do Nascimento
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="have_child_desired">A criança foi desejada? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="have_child_desired" full
                    selectId="have_child_desired" title="Sim/Não">
                    <option value="Sim" {{ old('have_child_desired') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('have_child_desired') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="child_adopted">Criança Adotada? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="child_adopted" full
                    selectId="child_adopted" title="Sim/Não">
                    <option value="Sim" {{ old('child_adopted') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('child_adopted') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="gestation_order">Ordem de Gestação <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="gestation_order" id="gestation_order" required
                    value="{{old('gestation_order')}}" placeholder="Ex: 2º ou Segundo" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="time_gestation">Tempo da Gestação: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="time_gestation" id="time_gestation" required
                    value="{{old('time_gestation')}}" placeholder="Ex: 8 meses e 2 semanas" />
            </div>

            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="history_abort" value="0">

                <label for="history_abort" class="inline-flex items-center">
                    <input type="checkbox" name="history_abort" id="history_abort" {{ old('history_abort') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="abort_justify" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Histórico de Aborto?</span>
                </label>
                <x-anamnesis.input class="abort_justify" name="abort_justify" id="abort_justify"
                    value="{{old('abort_justify')}}" placeholder="Justifique" disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="have_pre_natal">Fez Pré-natal? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="have_pre_natal" full
                selectId="have_pre_natal" title="Sim/Não">
                <option value="Sim" {{ old('have_pre_natal') == 'Sim' ? 'selected' : '' }}>
                    Sim
                </option>
                <option value="Não" {{ old('have_pre_natal') == 'Não' ? 'selected' : '' }}>
                    Não
                </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="number_children">Nº de Filhos <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="number_children" id="number_children" required
                    value="{{old('number_children')}}" placeholder="ex: 4 filhos" />
            </div>
        
            <div>
                <input type="hidden" name="have_disease_gestation" value="0">

                <label for="have_disease_gestation" class="inline-flex items-center">
                    <input type="checkbox" name="have_disease_gestation" id="have_disease_gestation" {{ old('have_disease_gestation') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="disease" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Doença durante a Gravidez?</span>
                </label>
                <x-anamnesis.input class="disease" name="what_disease_gestation" id="what_disease_gestation"
                    value="{{old('what_disease_gestation')}}" placeholder="Qual(is)?" disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="have_treatment">Fez Tratamento? </x-anamnesis.label>
                <x-anamnesis.select valueName="have_treatment" class="disease mt-1" full notRequired
                selectId="have_treatment" title="Sim/Não">
                <option value="Sim" {{ old('have_treatment') == 'Sim' ? 'selected' : '' }}>
                    Sim
                </option>
                <option value="Não" {{ old('have_treatment') == 'Não' ? 'selected' : '' }}>
                    Não
                </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="place_birth">Local onde o Assistido Nasceu: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="place_birth" id="place_birth" required
                    value="{{old('place_birth')}}" placeholder="Ex: Russas - Hospital ..." />
            </div>
            <div>
                <input type="hidden" name="have_discharged_together" value="0">

                <label for="have_discharged_together" class="inline-flex items-center">
                    <input type="checkbox" name="have_discharged_together" id="have_discharged_together" {{ old('have_discharged_together') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="detail_discharged_together" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Receberam Altas Juntos?</span>
                </label>
                <x-anamnesis.input class="detail_discharged_together" name="detail_discharged_together" id="detail_discharged_together"
                    value="{{old('detail_discharged_together')}}" placeholder="Detalhe:" disabled />
            </div>

            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="have_problems_birth" value="0">

                <label for="have_problems_birth" class="inline-flex items-center">
                    <input type="checkbox" name="have_problems_birth" id="have_problems_birth" {{ old('have_problems_birth') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_problems_birth" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Intercorrência no Parto?</span>
                </label>
                <x-anamnesis.input class="what_problems_birth" name="what_problems_birth" id="what_problems_birth"
                    value="{{old('what_problems_birth')}}" placeholder="Detalhe:" disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="type_childbirth">Tipo de Parto? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="type_childbirth" class="mt-1" full
                selectId="type_childbirth" title="Normal/Cesáreo">
                <option value="Normal" {{ old('type_childbirth') == 'Normal' ? 'selected' : '' }}>
                    Normal
                </option>
                <option value="Cesáreo" {{ old('type_childbirth') == 'Cesáreo' ? 'selected' : '' }}>
                    Cesáreo
                </option>
                </x-anamnesis.select>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="flex">
                <label for="have_neonatal_tests" class="inline-flex items-center">
                    <input type="hidden" name="have_neonatal_tests" value="0">

                    <input type="checkbox" name="have_neonatal_tests" id="have_neonatal_tests" {{ old('have_neonatal_tests') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="neonatal_tests" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Fez os testes neonatais?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="result_neonatal_tests">Resultados deram normais? </x-anamnesis.label>
                <x-anamnesis.select valueName="result_neonatal_tests" notRequired full
                    selectId="result_neonatal_tests" title="Sim/Não" class="neonatal_tests" disabled>
                    <option value="Sim" {{ old('result_neonatal_tests') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('result_neonatal_tests') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="detail_neonatal_tests">Detalhe: </x-anamnesis.label>
                <x-anamnesis.input name="detail_neonatal_tests" id="detail_neonatal_tests"
                    value="{{old('detail_neonatal_tests')}}" placeholder="Ex: A criança teve ..." class="neonatal_tests"
                    disabled />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="have_mother_breastfeed">A Mãe Amamentou? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="have_mother_breastfeed" full
                    selectId="have_mother_breastfeed" title="Sim/Não" >
                    <option value="Sim" {{ old('have_mother_breastfeed') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('have_mother_breastfeed') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <input type="hidden" name="have_nozzle" value="0">

                <label for="have_nozzle" class="inline-flex items-center">
                    <input type="checkbox" name="have_nozzle" id="have_nozzle" {{ old('have_nozzle') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="detail_nozzle" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Faz uso de bicos artificiais?</span>
                </label>
                <x-anamnesis.input class="detail_nozzle" name="detail_nozzle" id="detail_nozzle"
                    value="{{old('detail_nozzle')}}" placeholder="Detalhe:" disabled />
            </div>
        </div>

        <!-- V - Desenvolvimento -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                V - Desenvolvimento
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            
            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="have_delay_NPM" value="0">

                <label for="have_delay_NPM" class="inline-flex items-center">
                    <input type="checkbox" name="have_delay_NPM" id="have_delay_NPM" {{ old('have_delay_NPM') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="detail_delay_NPM" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Apresentou atraso no Desenv. NPM?</span>
                </label>
                <x-anamnesis.input class="detail_delay_NPM" name="detail_delay_NPM" id="detail_delay_NPM"
                    value="{{old('detail_delay_NPM')}}" placeholder="Detalhe:" disabled />
            </div>

            <div class="col-span-1 md:col-span-2">
                <input type="hidden" name="have_normal_development" value="0">

                <label for="have_normal_development" class="inline-flex items-center">
                    <input type="checkbox" name="have_normal_development" id="have_normal_development" {{ old('have_normal_development') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="detail_normal_development" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Desenv. da Linguagem Normal?</span>
                </label>
                <x-anamnesis.input class="detail_normal_development" name="detail_normal_development" id="detail_normal_development" 
                value="{{old('detail_normal_development')}}" placeholder="Detalhe:" disabled />
            </div>

            <div> 
                <input type="hidden" name="have_desfrald_yet" value="0">

                <label for="have_desfrald_yet" class="inline-flex items-center">
                    <input type="checkbox" name="have_desfrald_yet" id="have_desfrald_yet" {{ old('have_desfrald_yet') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="age_desfrald_yet" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Desfralde?</span>
                </label>
                <x-anamnesis.input class="age_desfrald_yet" name="age_desfrald_yet" id="age_desfrald_yet"
                    value="{{old('age_desfrald_yet')}}" placeholder="Idade em que conseguiu:" disabled />
            </div>
            <div>
                <input type="hidden" name="have_sphincters_control" value="0">

                <label for="have_sphincters_control" class="inline-flex items-center">
                    <input type="checkbox" name="have_sphincters_control" id="have_sphincters_control" {{ old('have_sphincters_control') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="age_sphincters_control" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Controle dos Esfincteres?</span>
                </label>
                <x-anamnesis.input class="age_sphincters_control" name="age_sphincters_control" id="age_sphincters_control"
                    value="{{old('age_sphincters_control')}}" placeholder="Idade em que conseguiu:" disabled />
            </div>

            <div>
                <x-anamnesis.label sizeFont="sm" for="bites_nails">Rói Unhas? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="bites_nails" full
                selectId="bites_nails" title="Sim/Não" >
                    <option value="Sim" {{ old('bites_nails') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('bites_nails') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                    <option value="Às vezes" {{ old('bites_nails') == 'Às vezes' ? 'selected' : '' }}>
                        Às vezes
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="hurt_yourself">Agride o Corpo? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="hurt_yourself" full
                selectId="hurt_yourself" title="Sim/Não" >
                    <option value="Sim" {{ old('hurt_yourself') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('hurt_yourself') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                    <option value="Às vezes" {{ old('hurt_yourself') == 'Às vezes' ? 'selected' : '' }}>
                        Às vezes
                    </option>
                </x-anamnesis.select>
            </div>

            <div>
                <x-anamnesis.label sizeFont="sm" for="state_sleep">Sobre o Sono: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="state_sleep" full
                selectId="state_sleep" title="Agitado/Tranquilo" >
                    <option value="Agitado" {{ old('state_sleep') == 'Agitado' ? 'selected' : '' }}>
                        Agitado
                    </option>
                    <option value="Tranquilo" {{ old('state_sleep') == 'Tranquilo' ? 'selected' : '' }}>
                        Tranquilo
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="sleeps_in_separate">Dorme em quartos separados? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="sleeps_in_separate" id="sleeps_in_separate" required
                    value="{{old('sleeps_in_separate')}}" placeholder="Ex: Dorme no quarto do .." />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="sleep_time">Horário que Dorme: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="sleep_time" id="sleep_time"
                    value="{{old('sleep_time')}}" placeholder="Ex: Às 22 horas" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="difficulty_waking_up">Tem dificuldade para acordar: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="difficulty_waking_up" full
                selectId="difficulty_waking_up" title="Sim/Não" >
                    <option value="Sim" {{ old('difficulty_waking_up') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('difficulty_waking_up') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="independent_daily_activities">Realiza atividade da vida diária de forma independente? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="independent_daily_activities" full
                selectId="independent_daily_activities" title="Sim/Não" >
                    <option value="Sim" {{ old('independent_daily_activities') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('independent_daily_activities') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div class="col-span-1 md:col-span-3 lg:col-span-4">
                <x-anamnesis.label sizeFont="sm" for="other_difficulty">Outras Dificildades (*opcional): </x-anamnesis.label>
                <x-form.textarea name="other_difficulty" id="other_difficulty" class="h-14" placeholder="Ex: Além disso, a criança normalmente .....">
                    {{old('other_difficulty')}}
                </x-form.textarea>
            </div>

        </div>

        <!-- VI - Atitudes Comportamentais -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                VI - Atitudes Comportamentais
            </h1>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6  gap-x-4 gap-y-2 my-2">
            <div class="col-span-2 md:col-span-4">
                <x-anamnesis.label sizeFont="sm" for="child_temperament">Temperamento do Assistido: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="child_temperament" id="child_temperament" required
                    value="{{old('child_temperament')}}" placeholder="Ex: Quieta, Tranquila, .." />
            </div>
            <div class="flex">
                <input type="hidden" name="stubbornness" value="0">

                <label for="stubbornness" class="inline-flex items-center">
                    <input type="checkbox" name="stubbornness" {{ old('stubbornness') ? 'checked' : '' }} id="stubbornness"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Teimosia?</span>
                </label>
            </div>
            <div class="flex">
                <input type="hidden" name="tantrum" value="0">

                <label for="tantrum" class="inline-flex items-center">
                    <input type="checkbox" name="tantrum" {{ old('tantrum') ? 'checked' : '' }} id="tantrum"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Birra?</span>
                </label>
            </div>
            <div class="col-span-2 md:col-span-4">
                <input type="hidden" name="inappropriate_behavior" value="0">
                
                <label for="inappropriate_behavior" class="inline-flex items-center">
                    <input type="checkbox" name="inappropriate_behavior" id="inappropriate_behavior" {{ old('inappropriate_behavior') ? 'checked' : '' }}
                    class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="how_manifests_inappropriate_behavior" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Comportamento Inapropriado?</span>
                </label>
                <x-anamnesis.input class="how_manifests_inappropriate_behavior" name="how_manifests_inappropriate_behavior" id="how_manifests_inappropriate_behavior"
                value="{{old('how_manifests_inappropriate_behavior')}}" placeholder="Como se Manifesta:" disabled />
            </div>
            <div class="flex">
                <input type="hidden" name="lies" value="0">

                <label for="lies" class="inline-flex items-center">
                    <input type="checkbox" name="lies" {{ old('lies') ? 'checked' : '' }} id="lies"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Mente?</span>
                </label>
            </div>
            <div class="flex">
                <input type="hidden" name="aggressiveness" value="0">

                <label for="aggressiveness" class="inline-flex items-center">
                    <input type="checkbox" name="aggressiveness" {{ old('aggressiveness') ? 'checked' : '' }} id="aggressiveness"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Agressiva?</span>
                </label>
            </div>
            <div class="col-span-2 md:col-span-4">
                <input type="hidden" name="sexual_curiosity" value="0">

                <label for="sexual_curiosity" class="inline-flex items-center">
                    <input type="checkbox" name="sexual_curiosity" id="sexual_curiosity" {{ old('sexual_curiosity') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="how_manifests_sexual_curiosity" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Manifesta curiosidade sexual?</span>
                </label>
                <x-anamnesis.input class="how_manifests_sexual_curiosity" name="how_manifests_sexual_curiosity" id="how_manifests_sexual_curiosity"
                    value="{{old('how_manifests_sexual_curiosity')}}" placeholder="Como se Manifesta:" disabled />
            </div>
            <div class="flex">
                <input type="hidden" name="shyness" value="0">

                <label for="shyness" class="inline-flex items-center">
                    <input type="checkbox" name="shyness" {{ old('shyness') ? 'checked' : '' }} id="shyness"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Timidez?</span>
                </label>
            </div>
            <div class="flex">
                <input type="hidden" name="affectionate" value="0">

                <label for="affectionate" class="inline-flex items-center">
                    <input type="checkbox" name="affectionate" {{ old('affectionate') ? 'checked' : '' }} id="affectionate"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Carinhoso?</span>
                </label>
            </div> 
            <div class="col-span-2 md:col-span-4">
                <input type="hidden" name="sports_activity" value="0">

                <label for="sports_activity" class="inline-flex items-center">
                    <input type="checkbox" name="sports_activity" id="sports_activity" {{ old('sports_activity') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_sports_activity" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Faz alguma atividade esportiva?</span>
                </label>
                <x-anamnesis.input class="what_sports_activity" name="what_sports_activity" id="what_sports_activity"
                    value="{{old('what_sports_activity')}}" placeholder="Qual(is)?" disabled />
            </div>
            <div class="flex">
                <input type="hidden" name="waiting_skill" value="0">

                <label for="waiting_skill" class="inline-flex items-center">
                    <input type="checkbox" name="waiting_skill" {{ old('waiting_skill') ? 'checked' : '' }} id="waiting_skill"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem habilidade de Espera?</span>
                </label>
            </div>
            <div class="flex">
                <input type="hidden" name="tolerates_frustration" value="0">

                <label for="tolerates_frustration" class="inline-flex items-center">
                    <input type="checkbox" name="tolerates_frustration" {{ old('tolerates_frustration') ? 'checked' : '' }} id="tolerates_frustration"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tolera Frustações?</span>
                </label>
            </div>
            <div class="col-span-2 md:col-span-4">
                <input type="hidden" name="hyperfocus" value="0">

                <label for="hyperfocus" class="inline-flex items-center">
                    <input type="checkbox" name="hyperfocus" id="hyperfocus" {{ old('hyperfocus') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="how_manifests_hyperfocus" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Hiperfoco ?</span>
                </label>
                <x-anamnesis.input class="how_manifests_hyperfocus" name="how_manifests_hyperfocus" id="how_manifests_hyperfocus"
                    value="{{old('how_manifests_hyperfocus')}}" placeholder="Como se Manifesta:" disabled />
            </div>
            <div class="flex">
                <input type="hidden" name="responds_orders" value="0">

                <label for="responds_orders" class="inline-flex items-center">
                    <input type="checkbox" name="responds_orders" {{ old('responds_orders') ? 'checked' : '' }} id="responds_orders"
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Atende Ordens Solicitadas?</span>
                </label>
            </div>
            <div class="col-span-2 md:col-span-4">
                <input type="hidden" name="tics_manias" value="0">

                <label for="tics_manias" class="inline-flex items-center">
                    <input type="checkbox" name="tics_manias" id="tics_manias" {{ old('tics_manias') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_tics_manias" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tiques, mania ou estereotipia?</span>
                </label>
                <x-anamnesis.input class="what_tics_manias" name="what_tics_manias" id="what_tics_manias"
                    value="{{old('what_tics_manias')}}" placeholder="Qual(is)?" disabled />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="flex">
                <label for="daily_routine" class="inline-flex items-center">
                    <input type="hidden" name="daily_routine" value="0">

                    <input type="checkbox" name="daily_routine" id="daily_routine" {{ old('daily_routine') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="routine" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Segue uma Rotina Diária?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="rigidity_daily_routine">Rigidez na Rotina: </x-anamnesis.label>
                <x-anamnesis.input name="rigidity_daily_routine" id="rigidity_daily_routine"
                    value="{{old('rigidity_daily_routine')}}" placeholder="Ex: Difícil, tranquila, etc" class="routine"
                    disabled />
            </div>
            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="what_daily_routine">Quais? </x-anamnesis.label>
                <x-anamnesis.input name="what_daily_routine" id="what_daily_routine"
                    value="{{old('what_daily_routine')}}" placeholder="Ex: 30 dias" class="routine"
                    disabled />
            </div>
        </div>

        <div class="flex items-center justify-center grid grid-cols-4 sm:grid-cols-3 mt-6"> 
            <div class="col-span-1 flex"> 
                <x-button class="prev-step" button> 
                    <i class="fas fa-arrow-left block sm:hidden"></i>
                    <span class="hidden sm:block"> Anterior </span>
                </x-button> 
            </div> 
            <div class="col-span-2 sm:col-span-1 step-indicator pt-0 sm:pt-2 text-center text-gray-700 dark:text-gray-300"> 
                Página <span class="current-step"></span> de <span class="total-steps"></span> 
            </div>
            <div class="col-span-1 flex justify-end"> 
                <x-button class="next-step" button> 
                    <i class="fas fa-arrow-right block sm:hidden"></i>
                    <span class="hidden sm:block"> Próximo </span>
                </x-button> 
            </div> 
        </div>
        
        </div>

        <!-- PÁGINA 3 -->

        <div id="step-3" class="form-step hidden">

        <!-- VII - Escolaridade -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                VII - Escolaridade
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="age_start_school">Idade em que iniciou a escola: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="age_start_school" id="age_start_school"  required
                    value="{{old('age_start_school')}}" placeholder="Ex: Aos 12 anos" />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="how_school_adaptation">Como que foi a adaptação? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="how_school_adaptation" id="how_school_adaptation" required 
                    value="{{old('how_school_adaptation')}}" placeholder="Justificação" />
            </div> 
            <div>
                <x-anamnesis.label sizeFont="sm" for="school_reinforcement">Realiza reforço escolar? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="school_reinforcement" full
                selectId="school_reinforcement" title="Sim/Não" >
                    <option value="Sim" {{ old('school_reinforcement') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('school_reinforcement') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div class="col-span-1 md:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="parents_participate_school_life">Os Pais participam da vida escolar do filho? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="parents_participate_school_life" id="parents_participate_school_life" required
                    value="{{old('parents_participate_school_life')}}" placeholder="Ex: Sim, eles participam no ..." />
            </div> 
            <div>
                <x-anamnesis.label sizeFont="sm" for="favorite_activity_school">Atividade preferida na Escola: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="favorite_activity_school" id="favorite_activity_school" required
                    value="{{old('favorite_activity_school')}}" placeholder="Ex: Brincar, escrever ..." />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div> 
                <input type="hidden" name="have_difficulty_learning" value="0">

                <label for="have_difficulty_learning" class="inline-flex items-center">
                    <input type="checkbox" name="have_difficulty_learning" id="have_difficulty_learning" {{ old('have_difficulty_learning') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="justify_difficulty_learning" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Dificuldade na aprendizagem?</span>
                </label>
                <x-anamnesis.input class="justify_difficulty_learning" name="justify_difficulty_learning" id="justify_difficulty_learning"
                    value="{{old('justify_difficulty_learning')}}" placeholder="Justifique:" disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="report_situation_school_in_home">Relata em casa situações escolares? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="report_situation_school_in_home" full
                selectId="report_situation_school_in_home" title="Sim/Não" >
                    <option value="Sim" {{ old('report_situation_school_in_home') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('report_situation_school_in_home') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="complaint_behavior">Reclamação por Comportamento? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="complaint_behavior" full
                selectId="complaint_behavior" title="Sim/Não" >
                    <option value="Sim" {{ old('complaint_behavior') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('complaint_behavior') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
             <x-anamnesis.label sizeFont="sm" for="demonstrates_satisfaction_school">Demonstra satisfação sobre a Escola? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="demonstrates_satisfaction_school" full
                selectId="demonstrates_satisfaction_school" title="Sim/Não" >
                    <option value="Sim" {{ old('demonstrates_satisfaction_school') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('demonstrates_satisfaction_school') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>

        <!-- VIII - Habilidades Escolares -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                VIII - Habilidades Escolares
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div>
                <x-anamnesis.label sizeFont="sm" for="knows_handle_pencil">Sabe pegar no lápis? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="knows_handle_pencil" full
                selectId="knows_handle_pencil" title="Sim/Não" >
                    <option value="Sim" {{ old('knows_handle_pencil') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('knows_handle_pencil') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="reading_letters">Faz leitura de letras? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="reading_letters" full
                selectId="reading_letters" title="Sim/Não" >
                    <option value="Sim" {{ old('reading_letters') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('reading_letters') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
             <x-anamnesis.label sizeFont="sm" for="reading_words">Faz leitura de palavras? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="reading_words" full
                selectId="reading_words" title="Sim/Não" >
                    <option value="Sim" {{ old('reading_words') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('reading_words') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div>
                <x-anamnesis.label sizeFont="sm" for="reading_texts">Faz leitura de textos? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="reading_texts" full
                selectId="reading_texts" title="Sim/Não" >
                    <option value="Sim" {{ old('reading_texts') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('reading_texts') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="do_activities_autonomously">Realiza atividades com autonomia? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="do_activities_autonomously" full
                selectId="do_activities_autonomously" title="Sim/Não" >
                    <option value="Sim" {{ old('do_activities_autonomously') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('do_activities_autonomously') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
             <x-anamnesis.label sizeFont="sm" for="not_participate_collective_activities">Participa das atividades coletivas? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="not_participate_collective_activities" full
                selectId="not_participate_collective_activities" title="Sim/Não" >
                    <option value="Sim" {{ old('not_participate_collective_activities') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('not_participate_collective_activities') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div>
             <x-anamnesis.label sizeFont="sm" for="follows_school_routine">Segue rotina e horário da escola? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="follows_school_routine" full
                selectId="follows_school_routine" title="Sim/Não" >
                    <option value="Sim" {{ old('follows_school_routine') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('follows_school_routine') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>

            <div class="col-span-1 hidden sm:block"></div>

            <div>
                <x-anamnesis.label sizeFont="sm" for="adapted_activities">Atividades são adaptadas? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="adapted_activities" full
                selectId="adapted_activities" title="Sim/Não" >
                    <option value="Sim" {{ old('adapted_activities') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('adapted_activities') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="literacy_level">Nível de Alfabetizazação? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="literacy_level" full
                selectId="literacy_level" title="Escolha:" >
                    <option value="Pré silábico" {{ old('literacy_level') == 'Pré silábico' ? 'selected' : '' }}>
                        Pré silábico
                    </option>
                    <option value="Silábico" {{ old('literacy_level') == 'Silábico' ? 'selected' : '' }}>
                        Silábico
                    </option>
                    <option value="Silábico alfabético" {{ old('literacy_level') == 'Silábico alfabético' ? 'selected' : '' }}>
                        Silábico alfabético
                    </option>
                    <option value="Alfabético" {{ old('literacy_level') == 'Alfabético' ? 'selected' : '' }}>
                        Alfabético
                    </option>
                </x-anamnesis.select>
            </div>
        </div>

        <!-- IX - Histórico Médico -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                IX - Histórico Médico
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div> 
                <input type="hidden" name="have_allergy" value="0">

                <label for="have_allergy" class="inline-flex items-center">
                    <input type="checkbox" name="have_allergy" id="have_allergy" {{ old('have_allergy') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_allergy" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Possui algum tipo de alergia?</span>
                </label>
                <x-anamnesis.input class="what_allergy" name="what_allergy" id="what_allergy"
                    value="{{old('what_allergy')}}" placeholder="Qual(is)?" disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="wear_glasses">Usa óculos? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="wear_glasses" full
                selectId="wear_glasses" title="Sim/Não" >
                    <option value="Sim" {{ old('wear_glasses') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('wear_glasses') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="use_hearing_aid">Us prótese auditiva? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="use_hearing_aid" full
                selectId="use_hearing_aid" title="Sim/Não" >
                    <option value="Sim" {{ old('use_hearing_aid') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('use_hearing_aid') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="know_libras">Domina Libras? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="know_libras" full
                selectId="know_libras" title="Sim/Não" >
                    <option value="Sim" {{ old('know_libras') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('know_libras') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div> 

            <div class="col-span-1 md:col-span-4"> 
                <input type="hidden" name="have_therapeutic" value="0">

                <label for="have_therapeutic" class="inline-flex items-center">
                    <input type="checkbox" name="have_therapeutic" id="have_therapeutic" {{ old('have_therapeutic') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="times_days_therapeutic" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Faz acompanhamento terapeutico?</span>
                </label>
                <x-anamnesis.input class="times_days_therapeutic" name="times_days_therapeutic" id="times_days_therapeutic"
                    value="{{old('times_days_therapeutic')}}" placeholder="Quais atendimentos e horários?" disabled />
            </div>

            <div class="col-span-1 md:col-span-2"> 
                <input type="hidden" name="history_disorders_family" value="0">

                <label for="history_disorders_family" class="inline-flex items-center">
                    <input type="checkbox" name="history_disorders_family" id="history_disorders_family" {{ old('history_disorders_family') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="what_history_disorders_family" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Histórico de doenças/distúrbios ou transtorno na família?</span>
                </label>
                <x-anamnesis.input class="what_history_disorders_family" name="what_history_disorders_family" id="what_history_disorders_family"
                    value="{{old('what_history_disorders_family')}}" placeholder="Qual(is)?" disabled />
            </div>
            <div class="col-span-1 md:col-span-2"> 
                <input type="hidden" name="have_update_vaccines" value="0">

                <label for="have_update_vaccines" class="inline-flex items-center">
                    <input type="checkbox" name="have_update_vaccines" id="have_update_vaccines" {{ old('have_update_vaccines') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cronograma de Vacinas em dia?</span>
                </label>
                <x-anamnesis.input name="detail_update_vaccines" id="detail_update_vaccines"
                    value="{{old('detail_update_vaccines')}}" placeholder="Detalhe: (*opcional)"/>
            </div>
        </div>

        <!-- X - Ambiente Social e Familiar -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                X - Ambiente Social e Familiar
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1 lg:col-span-3">
                <x-anamnesis.label sizeFont="sm" for="relation_family_members">Relação entre pais, filhos, irmãos e avós? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.input name="relation_family_members" id="relation_family_members" required
                    value="{{old('relation_family_members')}}" placeholder="Ex: É normal e ..." />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="super_protected">É superprotegido? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="super_protected" full
                selectId="super_protected" title="Sim/Não" >
                    <option value="Sim" {{ old('super_protected') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Mais ou Menos" {{ old('super_protected') == 'Mais ou Menos' ? 'selected' : '' }}>
                        Mais ou Menos
                    </option>
                    <option value="Não" {{ old('super_protected') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div> 

            <div class="flex">
                <input type="hidden" name="have_access_cellphone" value="0">

                <label for="have_access_cellphone" class="inline-flex items-center">
                    <input type="checkbox" name="have_access_cellphone" id="have_access_cellphone" {{ old('have_access_cellphone') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="technology_access" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tem acesso ao celular ou a outras telas?</span>
                </label>
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="time_access_cellphone">Tempo de Uso: </x-anamnesis.label>
                <x-anamnesis.input name="time_access_cellphone" id="time_access_cellphone" 
                    value="{{old('time_access_cellphone')}}" placeholder="Ex: 5 horas todos os dias" class="technology_access"
                disabled />
            </div>
            <div>
                <x-anamnesis.label sizeFont="sm" for="accompanies_access_cellphone">Pais acompanham o uso? </x-anamnesis.label>
                <x-anamnesis.select valueName="accompanies_access_cellphone" notRequired full
                    selectId="accompanies_access_cellphone" title="Sim/Não" class="technology_access" disabled>
                    <option value="Sim" {{ old('accompanies_access_cellphone') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('accompanies_access_cellphone') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div>
        </div>    

        <!-- XI - Avaliando o CAEE da APAE Russas -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                XI - Avaliando o CAEE da APAE Russas
            </h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 my-2">
            <div class="col-span-1"> 
                <input type="hidden" name="already_had_information_institution" value="0">

                <label for="already_had_information_institution" class="inline-flex items-center">
                    <input type="checkbox" name="already_had_information_institution" id="already_had_information_institution" {{ old('already_had_information_institution') ? 'checked' : '' }}
                        class="form-checkbox rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1 hover:bg-gray-100 dark:hover:bg-dark-eval-0 dark:checked:border-gray-600 dark:checked:bg-dark-eval-1" value="1" data-target="who_recommend_institution" onchange="toggleInput(this)">
                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Já tinha informações da Instituição?</span>
                </label>
                <x-anamnesis.input name="who_recommend_institution" id="who_recommend_institution" class="who_recommend_institution"
                    value="{{old('who_recommend_institution')}}" placeholder="Quem recomendou?" disabled/>
            </div>
            <div class="col-span-1">
                <x-anamnesis.label sizeFont="sm" for="participate_contribution">Participará da contribuição voluntária? <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="participate_contribution" full class="mt-1"
                    selectId="participate_contribution" title="Sim/Não">
                    <option value="Sim" {{ old('participate_contribution') == 'Sim' ? 'selected' : '' }}>
                        Sim
                    </option>
                    <option value="Não" {{ old('participate_contribution') == 'Não' ? 'selected' : '' }}>
                        Não
                    </option>
                </x-anamnesis.select>
            </div> 
        </div>

        <!-- XII - Observações Gerais -->

        <div class="my-4">
            <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                XII - Observações Gerais:
            </h1>
        </div>
        
        <div>
            <x-form.textarea name="general_observations" id="general_observations" class="h-24" placeholder="Além das informações supracitadas, .....  (*opcional)">
                {{old('general_observations')}}
            </x-form.textarea>
        </div>

        <!-- Assinatura do Profissional que realizou a Anamnese -->

        <div class="mt-2 grid grid-cols-1 sm:grid-cols-4">
            <div class="col-span-1 sm:col-span-2">
                <x-anamnesis.label sizeFont="sm" for="signature_id">Assinatura do Profissional que realizou a Anamnese: <span class="text-red-700 dark:text-red-500">*</span> </x-anamnesis.label>
                <x-anamnesis.select valueName="signature_id" full
                    selectId="signature_id" title="Nome do Profissional:">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}" {{ old('signature_id', Auth::user()->id) == $user->id ? 'selected' : '' }}>
                            {{$user->name}}
                        </option>
                    @endforeach
                </x-anamnesis.select>
            </div>
        </div>

        <div class="flex items-center justify-center grid grid-cols-4 sm:grid-cols-3 mt-6"> 
            <div class="col-span-1 flex"> 
                <x-button class="prev-step" button> 
                    <i class="fas fa-arrow-left block sm:hidden"></i>
                    <span class="hidden sm:block"> Anterior </span>
                </x-button> 
            </div> 
            <div class="col-span-2 sm:col-span-1 step-indicator pt-0 sm:pt-2 text-center text-gray-700 dark:text-gray-300"> 
                Página <span class="current-step"></span> de <span class="total-steps"></span> 
            </div>
            <div class="col-span-1 flex justify-end" > 
            </div> 
        </div>

        </div>

        <div>
            <x-button id="submitButton" variant="blue" class="w-full mt-2 -mb-4" onclick="handleClick()">
                <p class="text-center w-full">Adicionar</p>
                <i id="loadingSpinner" class="fa fa-spinner fa-spin hidden ml-2"></i> 
            </x-button>
        </div>

    </x-table-create>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    function loadStudentData(studentId) {
        if (studentId) {
            $.ajax({
                url: '/studentapi/' + studentId,
                type: 'GET',
                success: function (data) {
                    $('#date_of_birth').val(data.date_of_birth || '------'); 
                    $('#diagnostic').val(data.diagnostic || '------'); 
                    $('#school').val(data.school || '------'); 
                    $('#grade_school').val(data.grade_school || '------'); 
                    $('#sige').val(data.sige || '------');
                    $('#turn_school').val(data.turn_school || '------'); 
                    $('#name_mother').val(data.name_mother || '------');
                }
            });
        } else {
            // Limpa os campos se nenhum estudante estiver selecionado 
            $('#date_of_birth').val('');
            $('#diagnostic').val('');
            $('#school').val('');
            $('#grade_school').val('');
            $('#sige').val('');
            $('#turn_school').val('');
        }
    }

    $(document).ready(function () {

        let currentStep = 0; 
        const steps = $(".form-step"); 

        function updateStepIndicator() { 
            $(".current-step").text(currentStep + 1); 
            $(".total-steps").text(steps.length); 
            $(".prev-step").toggle(currentStep > 0); 
        } 

        function scrollToSelector() { 
            const element = document.querySelector(".scroll-target"); 
            element.scrollIntoView({ 
                behavior: 'smooth',
            }); 
        }

        function validateStep() {
            let isValid = true;
            const elements = steps.eq(currentStep).find('input[required], select[required]'); // Seleciona inputs e selects

            // Validar os elementos na ordem
            elements.each(function() {
                if (!this.checkValidity()) {
                    isValid = false;
                    this.reportValidity();
                    return false; // Parar na primeira ocorrência de um campo inválido
                }
            });
            return isValid;
        }
        
        steps.eq(currentStep).show(); 
        updateStepIndicator(); 

        $(".next-step").on("click", function () { 
            if (validateStep()) {
                steps.eq(currentStep).hide(); 
                currentStep++; 
                steps.eq(currentStep).show(); 
                updateStepIndicator(); 
                scrollToSelector();
            }
        }); 
        $(".prev-step").on("click", function () { 
            if(validateStep()) {
                steps.eq(currentStep).hide(); 
                currentStep--; 
                steps.eq(currentStep).show(); 
                updateStepIndicator();
                scrollToSelector();
            }
        });


        $('#student_id').change(function () {
            var studentId = $(this).val();
            loadStudentData(studentId);
        });

        var initialStudentId = $('#student_id').val();
        if (initialStudentId) {
            loadStudentData(initialStudentId);
        }

    });
</script>