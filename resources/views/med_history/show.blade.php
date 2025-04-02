<!-- Alvo para rolagem --> <div class="scroll-target"></div>
<x-app-layout>

    <x-table-show :title="'Anamnese do aluno ' . $medHistory->student->name" :elementShow="$medHistory" onlyHead
        notEditDelete actionRoute="anamnesis">

        <!-- PÁGINA 1 -->

        <div id="step-1" class="form-step">

            <!-- I - Identificação -->

            <div class="my-4">
                <h1 class="text-xl font-bold">
                    I - Identificação
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Nome do Assistido</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->student->name}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Informante</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->informant}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Data da Anamnese</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->date_of_anamnesis}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Data de Nascimento</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm">
                        {{\Carbon\Carbon::createFromFormat('Y-m-d', $medHistory->student->date_of_birth)->format('d/m/Y')}}
                    </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Diagnóstico</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->student->diagnostic}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="appraisal">Laudo/Especialista</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->appraisal}} </x-form.p_show>
                </div>
                <div class="flex">
                    <x-anamnesis.label for="have_caregiver" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_caregiver ? 'checked' : '' }}
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1" disabled>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem Cuidador?</span>
                    </x-anamnesis.label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Escola do Aluno:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->school ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Se não estuda justifique (*opcional)</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->not_study_justify ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Série:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->grade_school ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Nº do SIGE:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->class_school ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Turno:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->turn_school ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <label for="have_AEE" class="inline-flex items-center">
                        <input type="checkbox" class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1"
                            {{$medHistory->have_AEE ? 'checked' : ''}} disabled>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Faz AEE?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->turn_AEE ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Nome da Mãe</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->name_mother}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Data de Nascimento da Mãe</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->date_mother}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>RG da Mãe</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->rg_mother}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Profissão da Mãe</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->profession_mother}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Telefone da Mãe (*opcional)</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->cellphone_mother ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Nome do Pai</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->name_father}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Data de Nascimento do Pai</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->date_father}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="rg_father">RG do Pai</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->rg_father}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="profession_father">Profissão do Pai</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->profession_father}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Telefone do Pai (*opcional)</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->cellphone_father ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Endereço</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->address}} </x-form.p_show>
                </div>
                <div>
                    <label for="have_medication" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_medication ? 'checked' : '' }}
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1" disabled>
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400 text-sm">Usa Medicação?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_medication ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <!-- II - Queixa Inicial -->

            <div class="my-3">
                <h1 class="text-xl font-bold">
                    II - Queixa Inicial
                </h1>
            </div>

            <div>
                <x-anamnesis.label sizeFont="sm" isShow for="compplaint">Queixa Inicial</x-anamnesis.label>
                <x-form.textarea sizeFont="sm" disabled
                    class="disabled:bg-white disabled:text-gray-800 dark:disabled:text-gray-300">
                    {{$medHistory->compplaint ?? '----------'}}
                </x-form.textarea>
            </div>

            <!-- III - Situação Sociofamiliar -->

            <div class="my-4">
                <h1 class="text-xl font-bold">
                    III - Situação Sociofamiliar
                </h1>
            </div>

            <div>
                <x-anamnesis.label sizeFont="sm" isShow>Com quem mora?</x-anamnesis.label>
                <x-form.p_show sizeFont="sm"> {{$medHistory->who_lives ?? '-----'}} </x-form.p_show>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Pais Casados ou Separados?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->state_parents_relation}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Há quanto tempo?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->time_state_relation ?? '-----'}} </x-form.p_show>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="have_kinship_parents" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_kinship_parents ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Existe Parentesco entre os
                            Pais?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_kinship_parents ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="flex">
                    <label for="new_relation_mother" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->new_relation_mother ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Mãe: Novo relacionamento?</span>
                    </label>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Há quanto Tempo?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->time_new_relation_mother ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Moram juntos?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->lives_together_new_relation_mother ?? '-----'}}
                    </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="flex">
                    <label for="new_relation_father" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->new_relation_father ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Pai: Novo relacionamento?</span>
                    </label>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Há quanto Tempo?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->time_new_relation_father ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Moram juntos?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->lives_together_new_relation_father ?? '-----'}}
                    </x-form.p_show>
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
                <h1 class="text-xl font-bold">
                    IV - Gestação / Condições do Nascimento
                </h1>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>A criança foi desejada?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->have_child_desired ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Criança Adotada?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->child_adopted ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Ordem de Gestação</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->gestation_order}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Tempo da Gestação:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->time_gestation}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="history_abort" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->history_abort ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Histórico de Aborto?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->abort_justify ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Fez Pré-natal?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->have_pre_natal}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Nº de Filhos</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->number_children}} </x-form.p_show>
                </div>

                <div>
                    <label for="have_disease_gestation" class="inline-flex items-center">
                        <input type="checkbox" {{  $medHistory->have_disease_gestation ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Doença durante a Gravidez?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_disease_gestation ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Fez Tratamento?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->have_treatment ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Local onde o Assistido Nasceu:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->place_birth}} </x-form.p_show>
                </div>
                <div>
                    <label for="have_discharged_together" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_discharged_together ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Receberam Altas Juntos?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->detail_discharged_together ?? '-----'}}
                    </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="have_problems_birth" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_problems_birth ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Intercorrência no Parto?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_problems_birth ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Tipo de Parto?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->type_childbirth}} </x-form.p_show>
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="flex">
                    <label for="have_neonatal_tests" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_neonatal_tests ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-400">Fez os testes
                            neonatais?</span>
                    </label>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Resultados deram normais?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->result_neonatal_tests ?? '-----'}} </x-form.p_show>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow for="detail_neonatal_tests">Detalhe:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->detail_neonatal_tests ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="have_mother_breastfeed">A Mãe
                        Amamentou?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->have_mother_breastfeed}} </x-form.p_show>
                </div>
                <div>
                    <input type="hidden" name="have_nozzle" value="0">

                    <label for="have_nozzle" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_nozzle ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Faz uso de bicos artificiais?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->have_mother_breastfeed ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <!-- V - Desenvolvimento -->

            <div class="my-4">
                <h1 class="text-xl font-bold">
                    V - Desenvolvimento
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">

                <div class="col-span-1 md:col-span-2">
                    <label for="have_delay_NPM" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_delay_NPM ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Apresentou atraso no Desenv.
                            NPM?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->detail_delay_NPM ?? '-----'}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <input type="hidden" name="have_normal_development" value="0">

                    <label for="have_normal_development" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_normal_development ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Desenv. da Linguagem Normal?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->detail_normal_development ?? '-----'}} </x-form.p_show>
                </div>

                <div>
                    <label for="have_desfrald_yet" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_desfrald_yet ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Desfralde?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->age_desfrald_yet ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <label for="have_sphincters_control" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_sphincters_control ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Controle dos Esfincteres?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->age_sphincters_control ?? '-----'}} </x-form.p_show>
                </div>

                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Rói Unhas?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->bites_nails}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Agride o Corpo?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->hurt_yourself}} </x-form.p_show>
                </div>

                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Sobre o Sono:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->state_sleep}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Dorme em quartos separados?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->sleeps_in_separate}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Horário que Dorme:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->sleep_time}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Tem dificuldade para acordar:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->difficulty_waking_up}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Realiza atividade da vida diária de forma
                        independente?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->independent_daily_activities}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-4">
                    <x-anamnesis.label sizeFont="sm" isShow for="other_difficulty">Outras Dificildades
                        (*opcional):</x-anamnesis.label>
                    <x-form.textarea sizeFont="sm" disabled
                        class="disabled:bg-white disabled:text-gray-800 dark:disabled:text-gray-300">
                        {{$medHistory->other_difficulty ?? '----------'}}
                    </x-form.textarea>
                </div>

            </div>

            <!-- VI - Atitudes Comportamentais -->

            <div class="my-4">
                <h1 class="text-xl font-bold">
                    VI - Atitudes Comportamentais
                </h1>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 2xl:grid-cols-8 gap-x-4 gap-y-2 my-2">
                <div class="col-span-2 md:col-span-3">
                    <x-anamnesis.label sizeFont="sm" isShow>Temperamento da Criança:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->child_temperament ?? '-----'}} </x-form.p_show>
                </div>
                <div class="flex">
                    <label for="stubbornness" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->stubbornness ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Teimosia?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="tantrum" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->tantrum ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Birra?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="lies" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->lies ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Mente?</span>
                    </label>
                </div>
                <div class="col-span-2 md:col-span-3">
                    <label for="inappropriate_behavior" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->inappropriate_behavior ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-400">Comportamento
                            Inapropriado?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->how_manifests_inappropriate_behavior ?? '-----'}}
                    </x-form.p_show>
                </div>
                <div class="flex">
                    <label for="aggressiveness" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->aggressiveness ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Agressiva?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="shyness" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->shyness ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Timidez?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="affectionate" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->affectionate ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Carinhoso?</span>
                    </label>
                </div>
                <div class="col-span-2 md:col-span-3">
                    <label for="sexual_curiosity" class="inline-flex items-center">
                        <input type="checkbox" {{ old('sexual_curiosity', $medHistory->sexual_curiosity) ? 'checked' : '' }} disabled class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-400">Manifesta curiosidade
                            sexual?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->how_manifests_sexual_curiosity ?? '-----'}}
                    </x-form.p_show>
                </div>
                <div class="flex">
                    <label for="tics_manias" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->tics_manias ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tiques, mania ou
                            estereotipia?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="hyperfocus" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->hyperfocus ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Hiperfoco?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="waiting_skill" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->waiting_skill ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem habilidade de Espera?</span>
                    </label>
                </div>
                <div class="col-span-2 md:col-span-3">
                    <label for="sports_activity" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->sports_activity ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Faz alguma atividade
                            esportiva?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_sports_activity ?? '-----'}} </x-form.p_show>
                </div>
                <div class="flex">
                    <label for="tolerates_frustration" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->tolerates_frustration ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tolera Frustações?</span>
                    </label>
                </div>
                <div class="flex">
                    <label for="responds_orders" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->responds_orders ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Atende Ordens Solicitadas?</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="flex">
                    <label for="daily_routine" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->daily_routine ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Segue uma Rotina Diária?</span>
                    </label>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Rigidez na Rotina:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->rigidity_daily_routine ?? '-----'}} </x-form.p_show>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Quais?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_daily_routine ?? '-----'}} </x-form.p_show>
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
                <h1 class="text-xl font-bold">
                    VII - Escolaridade
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Idade que iniciou a vida escolar:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->age_start_school}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Como que foi a adaptação?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->how_school_adaptation}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Realiza reforço escolar?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->school_reinforcement}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Os Pais participam da vida escolar do
                        filho?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->parents_participate_school_life}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Atividade preferida na Escola:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->favorite_activity_school}} </x-form.p_show>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div>
                    <label for="have_difficulty_learning" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_difficulty_learning ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Dificuldade na aprendizagem?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->justify_difficulty_learning ?? '-----'}}
                    </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Relata em casa situações escolares?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->report_situation_school_in_home}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Reclamação por Comportamento?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->complaint_behavior}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Demonstra satisfação sobre a Escola?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->demonstrates_satisfaction_school}} </x-form.p_show>
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
                    <x-anamnesis.label sizeFont="sm" isShow>Sabe pegar no lápis?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->knows_handle_pencil}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Faz leitura de letras?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->reading_letters}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="reading_words">Faz leitura de
                        palavras?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->reading_words}} </x-form.p_show>
                </div>

                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="reading_texts">Faz leitura de
                        textos?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->reading_texts}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Realiza atividades com autonomia?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->do_activities_autonomously}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Participa das atividades coletivas?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->not_participate_collective_activities}}
                    </x-form.p_show>
                </div>

                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Segue rotina e horário da escola?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->follows_school_routine}} </x-form.p_show>
                </div>

                <div class="hidden sm:flex"></div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Atividades são adaptadas?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->adapted_activities}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Nível de Alfabetizazação?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->literacy_level}} </x-form.p_show>
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
                    <label for="have_allergy" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_allergy ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Possui algum tipo de alergia?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_allergy ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Usa óculos?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->wear_glasses}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Us prótese auditiva?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->use_hearing_aid}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Domina Libras?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->know_libras}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-4">
                    <label for="have_therapeutic" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_therapeutic ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Faz acompanhamento
                            terapeutico?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->times_days_therapeutic ?? '-----'}} </x-form.p_show>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="history_disorders_family" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->history_disorders_family ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-400">Histórico de
                            doenças/distúrbios ou transtorno na família?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->what_history_disorders_family ?? '-----'}}
                    </x-form.p_show>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="have_update_vaccines" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_update_vaccines ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Cronograma de Vacinas em dia?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->detail_update_vaccines ?? '-----'}} </x-form.p_show>
                </div>
            </div>

            <!-- X - Ambiente Social e Familiar -->

            <div class="my-4">
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                    X - Ambiente Social e Familiar
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-3">
                    <x-anamnesis.label sizeFont="sm" isShow>Relação entre pais, filhos, irmãos e
                        avós?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->relation_family_members ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>É superprotegido?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->super_protected ?? '-----'}} </x-form.p_show>
                </div>

                <div class="flex">
                    <input type="hidden" name="have_access_cellphone" value="0">

                    <label for="have_access_cellphone" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->have_access_cellphone ? 'checked' : '' }} disabled
                            class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Tem acesso ao celular ou a outras
                            telas?</span>
                    </label>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow>Tempo de Uso:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->time_access_cellphone ?? '-----'}} </x-form.p_show>
                </div>
                <div>
                    <x-anamnesis.label sizeFont="sm" isShow for="accompanies_access_cellphone">Pais acompanham o
                        uso?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->accompanies_access_cellphone ?? '-----'}}
                    </x-form.p_show>
                </div>
            </div>

            <!-- XI - Avaliando o CAEE da APAE Russas -->

            <div class="my-4">
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                    XI - Avaliando o CAEE da APAE Russas
                </h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-x-4 gap-y-2 my-2">
                <div class="col-span-1 md:col-span-2">
                    <input type="hidden" name="already_had_information_institution" value="0">

                    <label for="already_had_information_institution" class="inline-flex items-center">
                        <input type="checkbox" {{ $medHistory->already_had_information_institution ? 'checked' : '' }}
                            disabled class="rounded dark:text-gray-500 focus:border-gray-300 focus:ring dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-dark-eval-1 dark:focus:ring-offset-dark-eval-1">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-400">Já tinha informações da
                            Instituição?</span>
                    </label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->who_recommend_institution ?? '-----'}} </x-form.p_show>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Participará da contribuição voluntária?</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->participate_contribution}} </x-form.p_show>
                </div>
            </div>

            <!-- XII - Observações Gerais -->

            <div class="my-4">
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">
                    XII - Observações Gerais:
                </h1>
            </div>

            <div>
                <x-form.textarea sizeFont="sm" height="lg" disabled
                    class="disabled:bg-white disabled:text-gray-800 dark:disabled:text-gray-300">
                    {{$medHistory->general_observations ?? '----------'}}
                </x-form.textarea>
            </div>

            <!-- Assinatura do Profissional que realizou a Anamnese -->

            <div class="mt-2 grid grid-cols-1 sm:grid-cols-4">
                <div class="col-span-1 sm:col-span-2">
                    <x-anamnesis.label sizeFont="sm" isShow>Assinatura do Profissional que realizou a
                        Anamnese:</x-anamnesis.label>
                    <x-form.p_show sizeFont="sm"> {{$medHistory->user->name}} </x-form.p_show>
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

        <div class="flex items-center justify-between">
            <div>
                <x-button href="{{route('student.show', $medHistory->student->id)}}" variant="blue">
                    <p class="flex dark:text-gray-200 px-2">
                        Ir para Aluno <span class="hidden sm:flex ml-1">{{ \Illuminate\Support\Str::limit($medHistory->student->name, 12)}}</span>
                    </p>
                </x-button>
            </div>

            <div class="flex items-center gap-2">
                <x-button href="{{route('anamnesis.edit', $medHistory->id)}}" class="flex sm:hidden" title="Editar {{ $medHistory->student->name }}" variant="edit" size="sm">
                    <x-icons.edit />
                </x-button>

                <x-button href="{{route('anamnesis.edit', $medHistory->id)}}" class="hidden sm:flex" title="Editar {{ $medHistory->student->name }}" variant="warning" 
                    title="Editar {{$medHistory->student->name}}">
                    <p class="text-gray-900 px-2">
                        {{ __('Editar') }}
                    </p>
                </x-button>
    
                <form method="POST" action="{{ route('anamnesis.destroy', $medHistory->id) }}" accept-charset="UTF-8" class="flex items-center justify-center mt-4">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}

                    <x-button variant="pdf-trash" title="Deletar {{$medHistory->student->name}}" size="sm" class="flex sm:hidden"
                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                        <x-icons.trash />
                    </x-button>
    
                    <x-button type="submit" variant="danger" title="Deletar {{$medHistory->student->name}}" class="hidden sm:flex"
                        onclick="warningConfirm(event, 'Essa ação é irreversível!', 'warning', 'Deletar')">
                        <div class="text-gray-100 dark:text-gray-200 px-2">
                            {{ __('Deletar') }}
                        </div>
                    </x-button>
                </form>
            </div>
        </div>

    </x-table-show>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
                behavior: 'smooth'
            });
        }

        steps.eq(currentStep).show();
        updateStepIndicator();

        $(".next-step").on("click", function () {
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
            updateStepIndicator();
            scrollToSelector();
        });
        $(".prev-step").on("click", function () {
            steps.eq(currentStep).hide();
            currentStep--;
            steps.eq(currentStep).show();
            updateStepIndicator();
            scrollToSelector();
        });


        $('#student_id').change(function () {
            var studentId = $(this).val();
            if (studentId) {
                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',
                    success: function (data) {
                        $('#date_of_birth').val(data.date_of_birth || '------');
                        $('#diagnostic').val(data.diagnostic || '------');
                        $('#school').val(data.school || '------');
                        $('#grade_school').val(data.grade_school || '------');
                        $('#class_school').val(data.class_school || '------');
                        $('#turn_school').val(data.turn_school || '------');
                    }
                });
            } else {
                // Limpa os campos se nenhum estudante estiver selecionado 
                $('#date_of_birth').val('');
                $('#diagnostic').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#class_school').val('');
                $('#turn_school').val('');
            }
        });

    });
</script>