<x-app-layout>

    <div class="scfv-create-page">

    <x-table-create 
        title="SCFV" 
        onlyHead 
        actionRoute="scfv">

        <span id="errorMessage" style="color: red; display: none;" class="my-2">
            Data inválida. Insira uma data entre 1960 e 2200.
        </span>

        {{-- TEMA --}}
        <div class="mb-4">

            <label for="theme" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Tema(s) Tratado(s): <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea
                id="theme"
                name="theme"
                class="w-full dark:text-gray-400"
                sizeFont="base"
                placeholder="Dê um enter (quebra de linha) após cada frase
Ex: 1-  Confraternização Natalina ...
2- Avaliação dos grupos ..."
                required
                height="lg">

                {{old('theme')}}

            </x-form.textarea>

            @error('theme')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror

        </div>


        {{-- PRIMEIRA QUINZENA --}}
        <div class="scfv-section-divider">

            <hr class="flex-grow border-t">

            <span>
                Primeira Quinzena:
            </span>

            <hr class="flex-grow border-t">

        </div>


        <div class="mb-3 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">

            {{-- OBJETIVO --}}
            <div>

                <label for="1Q_objective" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Objetivo(s): <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="1Q_objective"
                    name="1Q_objective"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Fortalecer vínculos ...."
                    required
                    height="base">

                    {{old('1Q_objective')}}

                </x-form.textarea>

                @error('1Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>


            {{-- ATIVIDADE --}}
            <div>

                <label for="1Q_activity" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Ação / Atividade: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="1Q_activity"
                    name="1Q_activity"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Festa Natalina..."
                    required
                    height="base">

                    {{old('1Q_activity')}}

                </x-form.textarea>

                @error('1Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- DESCRIÇÃO --}}
        <div class="mb-3">

            <label for="1Q_description" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Descrição da Atividade: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea
                id="1Q_description"
                name="1Q_description"
                class="w-full dark:text-gray-400"
                sizeFont="base"
                placeholder="Ex: O momento foi realizado com ..."
                required
                height="lg">

                {{old('1Q_description')}}

            </x-form.textarea>

            @error('1Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror

        </div>


        {{-- RECURSOS E RESPONSÁVEIS --}}
        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">

            <div>

                <label for="1Q_resource" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Recursos Necessários: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="1Q_resource"
                    name="1Q_resource"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Declarações Natalinas ...."
                    required
                    height="base">

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

                <x-form.textarea
                    id="1Q_partner"
                    name="1Q_partner"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Disk Pão, Glaucia ..."
                    required
                    height="base">

                    {{old('1Q_partner')}}

                </x-form.textarea>

                @error('1Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- LOCAL E DATA --}}
        <div class="mb-4 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">

            <div class="col-span-1 sm:col-span-3">

                <label for="1Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 1ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input
                    id="1Q_place"
                    type="text"
                    name="1Q_place"
                    value="{{ old('1Q_place') }}"
                    class="w-full dark:text-gray-400"
                    placeholder="Ex: Sede da Apae Russas"
                    required />

                @error('1Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>


            <div class="col-span-1">

                <label for="1Q_date" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Data 1ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input
                    id="1Q_date"
                    type="text"
                    name="1Q_date"
                    autocomplete="off"
                    value="{{ old('1Q_date') }}"
                    class="w-full dark:text-gray-400 date dateInput"
                    x-init="initFlatpickr"
                    placeholder="Ex: 01/11/2001"
                    required />

                @error('1Q_date')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- SEGUNDA QUINZENA --}}
        <div class="scfv-section-divider">

            <hr class="flex-grow border-t">

            <span>
                Segunda Quinzena
            </span>

            <hr class="flex-grow border-t">

        </div>


        <div class="mb-3 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">

            {{-- OBJETIVO --}}
            <div>

                <label for="2Q_objective" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Objetivo(s): <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="2Q_objective"
                    name="2Q_objective"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Fortalecer vínculos ...."
                    required
                    height="base">

                    {{old('2Q_objective')}}

                </x-form.textarea>

                @error('2Q_objective')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>


            {{-- ATIVIDADE --}}
            <div>

                <label for="2Q_activity" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Ação / Atividade: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="2Q_activity"
                    name="2Q_activity"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Festa Natalina..."
                    required
                    height="base">

                    {{old('2Q_activity')}}

                </x-form.textarea>

                @error('2Q_activity')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- DESCRIÇÃO --}}
        <div class="mb-3">

            <label for="2Q_description" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Descrição da Atividade: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea
                id="2Q_description"
                name="2Q_description"
                class="w-full dark:text-gray-400"
                sizeFont="base"
                placeholder="Ex: O momento foi realizado com ..."
                required
                height="lg">

                {{old('2Q_description')}}

            </x-form.textarea>

            @error('2Q_description')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror

        </div>


        {{-- RECURSOS E RESPONSÁVEIS --}}
        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3">

            <div>

                <label for="2Q_resource" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Recursos Necessários: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.textarea
                    id="2Q_resource"
                    name="2Q_resource"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Declarações Natalinas ...."
                    required
                    height="base">

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

                <x-form.textarea
                    id="2Q_partner"
                    name="2Q_partner"
                    class="w-full dark:text-gray-400"
                    sizeFont="base"
                    placeholder="Ex: Disk Pão, Glaucia ..."
                    required
                    height="base">

                    {{old('2Q_partner')}}

                </x-form.textarea>

                @error('2Q_partner')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- LOCAL E DATA --}}
        <div class="mb-3 mt-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">

            <div class="col-span-1 sm:col-span-3">

                <label for="2Q_place" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Local 2ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input
                    id="2Q_place"
                    type="text"
                    name="2Q_place"
                    value="{{ old('2Q_place') }}"
                    class="w-full dark:text-gray-400"
                    placeholder="Ex: Sede da Apae Russas"
                    required />

                @error('2Q_place')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>


            <div class="col-span-1">

                <label for="2Q_date" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Data 2ª Quinzena: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.input
                    id="2Q_date"
                    type="text"
                    name="2Q_date"
                    autocomplete="off"
                    value="{{ old('2Q_date') }}"
                    class="w-full dark:text-gray-400 date dateInput"
                    x-init="initFlatpickr"
                    placeholder="Ex: 01/11/2001"
                    required />

                @error('2Q_date')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


        {{-- DIVISÓRIA --}}
        <div class="scfv-simple-divider">
            <hr>
        </div>


        {{-- ASSISTIDOS --}}
        <div class="mb-3">

            <label for="students_frequency" class="block text-gray-700 dark:text-gray-300 font-normal mt-3 mb-2">
                Assistidos Presentes para a Frequência das Quinzenas: <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <x-form.textarea
                id="students_frequency"
                name="students_frequency"
                class="w-full dark:text-gray-400"
                sizeFont="base"
                placeholder="Dê enter para cada estudante novo
Ex: João Henrique...
Pedro Fernandes ..."
                required
                height="lg">

                {{old('students_frequency')}}

            </x-form.textarea>

            @error('students_frequency')
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror

        </div>


        {{-- PROFESSOR E DATA --}}
        <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">

            <div class="col-span-1 sm:col-span-3">

                <label for="signature_id" class="block text-gray-700 dark:text-gray-300 font-normal mb-2">
                    Assinatura do Professor Responsável: <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <x-form.select
                    idSelect="signature_id"
                    valueName="signature_id"
                    full>

                    <option value="">
                        Selecione um Professor
                    </option>

                    @foreach ($professors as $professor)

                        <option
                            value="{{ $professor->id }}"
                            {{ old('signature_id', Auth::user()->id ) == $professor->id ? 'selected' : '' }}>

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

                <x-form.input
                    id="date_scfv"
                    type="text"
                    name="date_scfv"
                    autocomplete="off"
                    value="{{ old('date_scfv', \Carbon\Carbon::now()->format('d/m/Y')) }}"
                    class="w-full dark:text-gray-400 date dateInput"
                    x-init="initFlatpickr"
                    placeholder="Ex: 01/11/2001"
                    required />

                @error('date_scfv')
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror

            </div>

        </div>


    </x-table-create>

    </div>

</x-app-layout>


<style>

    /* =========================================================
       PADRÃO VISUAL SIAPAE
       CADASTRO SCFV
       ========================================================= */

    .scfv-create-page {

        --siapae-green: #3B7D5A;
        --siapae-green-dark: #2F684A;
        --siapae-green-soft: #EDF5F0;

        --siapae-text: #102A43;
        --siapae-secondary: #66788A;

        --siapae-border: #E1E7EC;
        --siapae-input-border: #D7DEE5;

    }


    /* =========================================================
       FUNDO
       ========================================================= */

    body {

        background-color: #F4F6F8 !important;

    }


    /* =========================================================
       CARD
       ========================================================= */

    .scfv-create-page .bg-white {

        background-color: #FFFFFF !important;

    }


    .scfv-create-page .border-gray-200,
    .scfv-create-page .border-gray-300,
    .scfv-create-page .border-gray-400 {

        border-color: var(--siapae-border) !important;

    }


    .scfv-create-page .shadow,
    .scfv-create-page .shadow-sm,
    .scfv-create-page .shadow-md {

        box-shadow:
            0 8px 24px rgba(39, 67, 54, 0.06) !important;

    }


    .scfv-create-page .rounded-md,
    .scfv-create-page .rounded-lg,
    .scfv-create-page .rounded-xl,
    .scfv-create-page .rounded-2xl {

        border-radius: 10px !important;

    }


    /* =========================================================
       TÍTULOS E TEXTOS
       ========================================================= */

    .scfv-create-page h1,
    .scfv-create-page h2,
    .scfv-create-page h3 {

        color: var(--siapae-text) !important;

    }


    .scfv-create-page label,
    .scfv-create-page .text-gray-700,
    .scfv-create-page .text-gray-800 {

        color: #334E68 !important;

    }


    /* =========================================================
       CAMPOS
       ========================================================= */

    .scfv-create-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]),
    .scfv-create-page select,
    .scfv-create-page textarea {

        background-color: #FFFFFF !important;

        color: var(--siapae-text) !important;

        border: 1px solid var(--siapae-input-border) !important;

        border-radius: 9px !important;

        box-shadow: none !important;

        outline: none !important;

        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background-color .18s ease;

    }


    /* Hover */

    .scfv-create-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]):hover,
    .scfv-create-page select:hover,
    .scfv-create-page textarea:hover {

        border-color: #C8D5CD !important;

    }


    /* Focus */

    .scfv-create-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]):focus,
    .scfv-create-page select:focus,
    .scfv-create-page textarea:focus {

        border-color: var(--siapae-green) !important;

        box-shadow:
            0 0 0 3px rgba(59, 125, 90, 0.10) !important;

        outline: none !important;

    }


    /* Placeholder */

    .scfv-create-page input::placeholder,
    .scfv-create-page textarea::placeholder {

        color: #8091A5 !important;

        opacity: 1 !important;

    }


    /* =========================================================
       DIVISÓRIA DAS QUINZENAS
       ========================================================= */

    .scfv-section-divider {

        display: flex;

        align-items: center;

        gap: 0;

        margin-top: 22px;

        margin-bottom: 18px;

    }


    .scfv-section-divider hr {

        border-color: #DDE6E0 !important;

        margin: 0;

    }


    .scfv-section-divider span {

        color: var(--siapae-text) !important;

        background-color: #FFFFFF;

        padding: 0 14px;

        font-weight: 600;

        font-size: 0.95rem;

        white-space: nowrap;

    }


    /* =========================================================
       DIVISÓRIA SIMPLES
       ========================================================= */

    .scfv-simple-divider {

        margin-top: 24px;

        margin-bottom: 14px;

    }


    .scfv-simple-divider hr {

        border-color: #E1E7EC !important;

    }


    /* =========================================================
       MENSAGEM DE ERRO
       ========================================================= */

    .scfv-create-page #errorMessage {

        color: #A55225 !important;

        background-color: #FFF7EF !important;

        border: 1px solid #F1D3BC !important;

        border-radius: 9px !important;

        padding: 8px 12px !important;

        display: none;

    }


    .scfv-create-page .text-red-600,
    .scfv-create-page .text-red-400 {

        color: #BA4D38 !important;

    }


    /* =========================================================
       CORES ANTIGAS AZUIS
       ========================================================= */

    .scfv-create-page .text-blue-500,
    .scfv-create-page .text-blue-600,
    .scfv-create-page .text-blue-700 {

        color: var(--siapae-green) !important;

    }


    .scfv-create-page .border-blue-500,
    .scfv-create-page .border-blue-600,
    .scfv-create-page .border-blue-700 {

        border-color: var(--siapae-green) !important;

    }


    .scfv-create-page .bg-blue-500,
    .scfv-create-page .bg-blue-600,
    .scfv-create-page .bg-blue-700 {

        background-color: var(--siapae-green) !important;

        background-image: none !important;

        border-color: var(--siapae-green) !important;

        color: #FFFFFF !important;

    }


    .scfv-create-page .bg-blue-500:hover,
    .scfv-create-page .bg-blue-600:hover,
    .scfv-create-page .bg-blue-700:hover {

        background-color: var(--siapae-green-dark) !important;

        border-color: var(--siapae-green-dark) !important;

    }


    /* =========================================================
       RESPONSIVIDADE
       ========================================================= */

    @media (max-width: 640px) {

        .scfv-create-page input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]),
        .scfv-create-page select,
        .scfv-create-page textarea {

            min-height: 40px !important;

        }


        .scfv-section-divider span {

            font-size: 0.88rem;

            padding: 0 9px;

        }

    }

</style>