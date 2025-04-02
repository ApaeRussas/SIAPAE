<x-app-layout>

    <x-table-create 
    title="SCFV" 
    onlyHead 
    actionRoute="scfv">
        
    <span id="errorMessage" style="color: red; display: none;" class="my-2">Data inválida. Insira uma data entre 1960 e 2200.</span>

        <div class="mb-4">
            <label for="theme" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Tema(s) Tratado(s): <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea id="theme" name="theme" class="w-full dark:text-gray-400" sizeFont="base" placeholder="Dê um enter (quebra de linha) após cada frase
Ex: 1-  Confraternização Natalina ...
2- Avaliação dos grupos ..." required height="lg">
                {{old('theme')}} 
            </x-form.textarea>

            @error('theme')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="flex items-center">
            <hr class="flex-grow border-t-1 border-gray-200 dark:border-gray-600">
            <span class="px-2 text-gray-800 dark:text-gray-300">
                Primeira Quinzena: 
            </span>
            <hr class="flex-grow border-t-1 border-gray-300 dark:border-gray-600">
        </div>

        <div class="mb-3 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="1Q_objective" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Objetivo(s): <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="1Q_objective" name="1Q_objective" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Fortalecer vínculos ...." required height="base">
                    {{old('1Q_objective')}}
                </x-form.textarea>

                @error('1Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="1Q_activity" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Ação / Atividade: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="1Q_activity" name="1Q_activity" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Festa Natalina..." required height="base">
                    {{old('1Q_activity')}}
                </x-form.textarea>

                @error('1Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="1Q_description" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Descrição da Atividade: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea id="1Q_description" name="1Q_description" class="w-full dark:text-gray-400" sizeFont="base"
                placeholder="Ex: O momento foi realizado com ..." required height="lg">
                {{old('1Q_description')}}
            </x-form.textarea>

            @error('1Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="1Q_resource" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Recursos Necessários: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="1Q_resource" name="1Q_resource" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Declarações Natalinas ...." required height="base">
                    {{old('1Q_resource')}}
                </x-form.textarea>

                @error('1Q_resource')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="1Q_partner" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Responsáveis / Parceiros: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="1Q_partner" name="1Q_partner" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Disk Pão, Glaucia ..." required height="base">
                    {{old('1Q_partner')}}
                </x-form.textarea>

                @error('1Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="cols-span-1 sm:col-span-3">
                <label for="1Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 1ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input id="1Q_place" type="text" name="1Q_place" value="{{ old('1Q_place') }}"
                    class="w-full dark:text-gray-400" placeholder="Ex: Sede da Apae Russas" required />

                @error('1Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="1Q_date" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Data 1ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input id="1Q_date" type="text" name="1Q_date" autocomplete="off" value="{{ old('1Q_date') }}"
                    class="w-full dark:text-gray-400 date dateInput" x-init="initFlatpickr" placeholder="Ex: 01/11/2001"
                    required />

                @error('1Q_date')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="flex items-center">
            <hr class="flex-grow border-t-1 border-gray-200 dark:border-gray-600">
            <span class="px-2 text-gray-800 dark:text-gray-300">
                Segunda Quinzena 
            </span>
            <hr class="flex-grow border-t-1 border-gray-300 dark:border-gray-600">
        </div>

        <div class="mb-3 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="2Q_objective" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Objetivo(s): <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="2Q_objective" name="2Q_objective" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Fortalecer vínculos ...." required height="base">
                    {{old('2Q_objective')}}
                </x-form.textarea>

                @error('2Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="2Q_activity" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Ação / Atividade: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="2Q_activity" name="2Q_activity" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Festa Natalina..." required height="base">
                    {{old('2Q_activity')}}
                </x-form.textarea>

                @error('2Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="2Q_description" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Descrição da Atividade: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea id="2Q_description" name="2Q_description" class="w-full dark:text-gray-400" sizeFont="base"
                placeholder="Ex: O momento foi realizado com ..." required height="lg">
                {{old('2Q_description')}}
            </x-form.textarea>

            @error('2Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="2Q_resource" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Recursos Necessários: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="2Q_resource" name="2Q_resource" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Declarações Natalinas ...." required height="base">
                    {{old('2Q_resource')}}
                </x-form.textarea>

                @error('2Q_resource')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="2Q_partner" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Responsáveis / Parceiros: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea id="2Q_partner" name="2Q_partner" class="w-full dark:text-gray-400" sizeFont="base"
                    placeholder="Ex: Disk Pão, Glaucia ..." required height="base">
                    {{old('2Q_partner')}}
                </x-form.textarea>

                @error('2Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-3">
                <label for="2Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 2ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input id="2Q_place" type="text" name="2Q_place" value="{{ old('2Q_place') }}"
                    class="w-full dark:text-gray-400" placeholder="Ex: Sede da Apae Russas" required />

                @error('2Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="2Q_date" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Data 2ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input id="2Q_date" type="text" name="2Q_date" autocomplete="off" value="{{ old('2Q_date') }}"
                    class="w-full dark:text-gray-400 date dateInput" x-init="initFlatpickr" placeholder="Ex: 01/11/2001"
                    required />

                @error('2Q_date')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <hr class="mt-6 mb-3 border-gray-200 dark:border-gray-600">

        <div class="mb-3">
            <label for="students_frequency" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Assistidos Presentes para a Frequência das Quinzenas: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea id="students_frequency" name="students_frequency" class="w-full dark:text-gray-400" sizeFont="base"
                placeholder="Dê enter para cada estudante novo
Ex: João Henrique...
Pedro Fernandes ..." required height="lg">
                {{old('students_frequency')}}
            </x-form.textarea>

            @error('students_frequency')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-3">
                <label for="signature_id" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Assinatura do Professor Responsável: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.select idSelect="signature_id" valueName="signature_id" full>
                    <option value=""> Selecione um Professor</option>

                    @foreach ($professors as $professor)
                        <option value="{{ $professor->id }}" {{ old('signature_id', Auth::user()->id ) == $professor->id ? 'selected' : '' }}>
                            {{ $professor->name }}
                        </option>
                    @endforeach
                </x-form.select> 

                @error('signature_id')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="date_scfv" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Data do Serviço: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input id="date_scfv" type="text" name="date_scfv" autocomplete="off" value="{{ old('date_scfv', \Carbon\Carbon::now()->format('d/m/Y')) }}"
                    class="w-full dark:text-gray-400 date dateInput" x-init="initFlatpickr" placeholder="Ex: 01/11/2001"
                    required />

                @error('date_scfv')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

    </x-table-create>

</x-app-layout>