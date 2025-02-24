<x-app-layout>

    <x-table-show 
        :title="'SCFV ' . $scfv->date_scfv" 
        :elementShow="$scfv" 
        onlyHead
        exportPdf
        actionRoute="scfv">

        <div class="mb-4">
            <label for="theme" class="block text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Tema(s) Tratado(s):
            </label>

            <x-form.textarea id="theme" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="lg">
                {{ $scfv->theme }}
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
                <label for="1Q_objective" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Objetivo(s):
                </label>

                <x-form.textarea id="1Q_objective" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '1Q_objective') }}
                </x-form.textarea>

                @error('1Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="1Q_activity" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Ação / Atividade:
                </label>

                <x-form.textarea id="1Q_activity" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '1Q_activity') }}
                </x-form.textarea>

                @error('1Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="1Q_description" class="block text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Descrição da Atividade:
            </label>

            <x-form.textarea id="1Q_description" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="lg">
                {{ data_get($scfv, '1Q_description') }}
            </x-form.textarea>

            @error('1Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="1Q_resource" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Recursos Necessários:
                </label>

                <x-form.textarea id="1Q_resource" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '1Q_resource') }}
                </x-form.textarea>

                @error('1Q_resource')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="1Q_partner" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Responsáveis / Parceiros:
                </label>

                <x-form.textarea id="1Q_partner" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '1Q_partner') }}
                </x-form.textarea>

                @error('1Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-3">
                <label for="1Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 1ª Quinzena:
                </label>

                <x-form.p_show>
                    {{ data_get($scfv, '1Q_place') }}
                </x-form.p_show>

                @error('1Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="1Q_date" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Data 1ª Quinzena:
                </label>

                <x-form.p_show >
                    {{ data_get($scfv, '1Q_date') }}
                </x-form.p_show>

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
                <label for="2Q_objective" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Objetivo(s):
                </label>

                <x-form.textarea id="2Q_objective" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '2Q_objective') }}
                </x-form.textarea>

                @error('2Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="2Q_activity" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Ação / Atividade:
                </label>

                <x-form.textarea id="2Q_activity" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '2Q_activity') }}
                </x-form.textarea>

                @error('2Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="2Q_description" class="block text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Descrição da Atividade:
            </label>

            <x-form.textarea id="2Q_description" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="lg">
                {{ data_get($scfv, '2Q_description') }}
            </x-form.textarea>

            @error('2Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div>
                <label for="2Q_resource" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Recursos Necessários:
                </label>

                <x-form.textarea id="2Q_resource" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '2Q_resource') }}
                </x-form.textarea>

                @error('2Q_resource')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="2Q_partner" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Responsáveis / Parceiros:
                </label>

                <x-form.textarea id="2Q_partner" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="base">
                    {{ data_get($scfv, '2Q_partner') }}
                </x-form.textarea>

                @error('2Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-3">
                <label for="2Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 2ª Quinzena:
                </label>

                <x-form.p_show >
                    {{ data_get($scfv, '2Q_place') }}
                </x-form.p_show>

                @error('2Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="2Q_date" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Data 2ª Quinzena:
                </label>

                <x-form.p_show >
                    {{ data_get($scfv, '2Q_date') }}
                </x-form.p_show>

                @error('2Q_date')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <hr class="mt-6 mb-3 border-gray-200 dark:border-gray-600">

        <div class="mb-3">
            <label for="students_frequency" class="block text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Alunos Presentes para a Frequência das Quinzenas:
            </label>

            <x-form.textarea id="students_frequency" disabled disabled_normal="null" class="w-full dark:text-gray-400" sizeFont="base" height="lg">
                {{ $scfv->students_frequency }}
            </x-form.textarea>

            @error('students_frequency')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-3">
                <label for="signature_id" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Assinatura do Professor Responsável:
                </label>

                <x-form.p_show >
                    {{ $scfv->professor->name }}
                </x-form.p_show>

                @error('signature_id')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="date_scfv" class="block text-gray-700 dark:text-gray-400 font-normal mb-2">
                    Data do Serviço
                </label>

                <x-form.p_show >
                    {{ $scfv->date_scfv }}
                </x-form.p_show>

                @error('date_scfv')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

    </x-table-show>

</x-app-layout>
