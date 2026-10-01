<x-app-layout>

    <div class="scfv-edit-page">

        <x-table-edit 
            title="SCFV" 
            :elementEdit="$scfv" 
            actionRoute="scfv"
            onlyHead>

            <span id="errorMessage"
                  class="my-2 scfv-error-message">
                Data inválida. Insira uma data entre 1960 e 2200.
            </span>

            {{-- TEMA --}}
            <div class="mb-6">
                <label for="theme" class="scfv-label">
                    Tema(s) Tratado(s):
                    <span class="scfv-required">*</span>
                </label>

                <x-form.textarea
                    id="theme"
                    name="theme"
                    class="w-full dark:text-gray-400 scfv-field"
                    sizeFont="base"
                    placeholder="Dê um enter (quebra de linha) após cada frase
Ex: 1- Confraternização Natalina ...
2- Avaliação dos grupos ..."
                    required
                    height="lg">
                    {{ old('theme', $scfv->theme) }}
                </x-form.textarea>

                @error('theme')
                    <span class="scfv-validation-error">{{ $message }}</span>
                @enderror
            </div>


            {{-- PRIMEIRA QUINZENA --}}
            <div class="scfv-section-divider">
                <span>Primeira Quinzena</span>
            </div>

            <div class="mb-4 mt-5 grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">

                <div>
                    <label for="1Q_objective" class="scfv-label">
                        Objetivo(s):
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="1Q_objective"
                        name="1Q_objective"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Fortalecer vínculos ...."
                        required
                        height="base">
                        {{ old('1Q_objective', data_get($scfv, '1Q_objective')) }}
                    </x-form.textarea>

                    @error('1Q_objective')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="1Q_activity" class="scfv-label">
                        Ação / Atividade:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="1Q_activity"
                        name="1Q_activity"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Festa Natalina..."
                        required
                        height="base">
                        {{ old('1Q_activity', data_get($scfv, '1Q_activity')) }}
                    </x-form.textarea>

                    @error('1Q_activity')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- DESCRIÇÃO 1ª QUINZENA --}}
            <div class="mb-5">
                <label for="1Q_description" class="scfv-label">
                    Descrição da Atividade:
                    <span class="scfv-required">*</span>
                </label>

                <x-form.textarea
                    id="1Q_description"
                    name="1Q_description"
                    class="w-full dark:text-gray-400 scfv-field"
                    sizeFont="base"
                    placeholder="Ex: O momento foi realizado com ..."
                    required
                    height="lg">
                    {{ old('1Q_description', data_get($scfv, '1Q_description')) }}
                </x-form.textarea>

                @error('1Q_description')
                    <span class="scfv-validation-error">{{ $message }}</span>
                @enderror
            </div>


            {{-- RECURSOS / PARCEIROS --}}
            <div class="mb-5 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">

                <div>
                    <label for="1Q_resource" class="scfv-label">
                        Recursos Necessários:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="1Q_resource"
                        name="1Q_resource"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Declarações Natalinas ...."
                        required
                        height="base">
                        {{ old('1Q_resource', data_get($scfv, '1Q_resource')) }}
                    </x-form.textarea>

                    @error('1Q_resource')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="1Q_partner" class="scfv-label">
                        Responsáveis / Parceiros:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="1Q_partner"
                        name="1Q_partner"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Disk Pão, Glaucia ..."
                        required
                        height="base">
                        {{ old('1Q_partner', data_get($scfv, '1Q_partner')) }}
                    </x-form.textarea>

                    @error('1Q_partner')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- LOCAL / DATA 1ª QUINZENA --}}
            <div class="mb-6 mt-4 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1 sm:col-span-3">
                    <label for="1Q_place" class="scfv-label">
                        Local 1ª Quinzena:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.input
                        id="1Q_place"
                        type="text"
                        name="1Q_place"
                        value="{{ old('1Q_place', data_get($scfv, '1Q_place')) }}"
                        class="w-full dark:text-gray-400 scfv-field"
                        placeholder="Ex: Sede da Apae Russas"
                        required />

                    @error('1Q_place')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-1">
                    <label for="1Q_date" class="scfv-label">
                        Data 1ª Quinzena:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.input
                        id="1Q_date"
                        type="text"
                        name="1Q_date"
                        autocomplete="off"
                        value="{{ old('1Q_date', data_get($scfv, '1Q_date')) }}"
                        class="w-full dark:text-gray-400 scfv-field date dateInput"
                        x-init="initFlatpickr"
                        placeholder="Ex: 01/11/2001"
                        required />

                    @error('1Q_date')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- SEGUNDA QUINZENA --}}
            <div class="scfv-section-divider">
                <span>Segunda Quinzena</span>
            </div>

            <div class="mb-4 mt-5 grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">

                <div>
                    <label for="2Q_objective" class="scfv-label">
                        Objetivo(s):
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="2Q_objective"
                        name="2Q_objective"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Fortalecer vínculos ...."
                        required
                        height="base">
                        {{ old('2Q_objective', data_get($scfv, '2Q_objective')) }}
                    </x-form.textarea>

                    @error('2Q_objective')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="2Q_activity" class="scfv-label">
                        Ação / Atividade:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="2Q_activity"
                        name="2Q_activity"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Festa Natalina..."
                        required
                        height="base">
                        {{ old('2Q_activity', data_get($scfv, '2Q_activity')) }}
                    </x-form.textarea>

                    @error('2Q_activity')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- DESCRIÇÃO 2ª QUINZENA --}}
            <div class="mb-5">
                <label for="2Q_description" class="scfv-label">
                    Descrição da Atividade:
                    <span class="scfv-required">*</span>
                </label>

                <x-form.textarea
                    id="2Q_description"
                    name="2Q_description"
                    class="w-full dark:text-gray-400 scfv-field"
                    sizeFont="base"
                    placeholder="Ex: O momento foi realizado com ..."
                    required
                    height="lg">
                    {{ old('2Q_description', data_get($scfv, '2Q_description')) }}
                </x-form.textarea>

                @error('2Q_description')
                    <span class="scfv-validation-error">{{ $message }}</span>
                @enderror
            </div>


            {{-- RECURSOS / PARCEIROS 2ª QUINZENA --}}
            <div class="mb-5 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4">

                <div>
                    <label for="2Q_resource" class="scfv-label">
                        Recursos Necessários:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="2Q_resource"
                        name="2Q_resource"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Declarações Natalinas ...."
                        required
                        height="base">
                        {{ old('2Q_resource', data_get($scfv, '2Q_resource')) }}
                    </x-form.textarea>

                    @error('2Q_resource')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="2Q_partner" class="scfv-label">
                        Responsáveis / Parceiros:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.textarea
                        id="2Q_partner"
                        name="2Q_partner"
                        class="w-full dark:text-gray-400 scfv-field"
                        sizeFont="base"
                        placeholder="Ex: Disk Pão, Glaucia ..."
                        required
                        height="base">
                        {{ old('2Q_partner', data_get($scfv, '2Q_partner')) }}
                    </x-form.textarea>

                    @error('2Q_partner')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- LOCAL / DATA 2ª QUINZENA --}}
            <div class="mb-6 mt-4 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1 sm:col-span-3">
                    <label for="2Q_place" class="scfv-label">
                        Local 2ª Quinzena:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.input
                        id="2Q_place"
                        type="text"
                        name="2Q_place"
                        value="{{ old('2Q_place', data_get($scfv, '2Q_place')) }}"
                        class="w-full dark:text-gray-400 scfv-field"
                        placeholder="Ex: Sede da Apae Russas"
                        required />

                    @error('2Q_place')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-1">
                    <label for="2Q_date" class="scfv-label">
                        Data 2ª Quinzena:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.input
                        id="2Q_date"
                        type="text"
                        name="2Q_date"
                        autocomplete="off"
                        value="{{ old('2Q_date', data_get($scfv, '2Q_date')) }}"
                        class="w-full dark:text-gray-400 scfv-field date dateInput"
                        x-init="initFlatpickr"
                        placeholder="Ex: 01/11/2001"
                        required />

                    @error('2Q_date')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>


            {{-- FREQUÊNCIA --}}
            <div class="scfv-content-divider"></div>

            <div class="mb-6 mt-5">
                <label for="students_frequency" class="scfv-label">
                    Assistidos Presentes para a Frequência das Quinzenas:
                    <span class="scfv-required">*</span>
                </label>

                <x-form.textarea
                    id="students_frequency"
                    name="students_frequency"
                    class="w-full dark:text-gray-400 scfv-field"
                    sizeFont="base"
                    placeholder="Dê enter para cada estudante novo
Ex: João Henrique...
Pedro Fernandes ..."
                    required
                    height="lg">
                    {{ old('students_frequency', $scfv->students_frequency) }}
                </x-form.textarea>

                @error('students_frequency')
                    <span class="scfv-validation-error">{{ $message }}</span>
                @enderror
            </div>


            {{-- PROFESSOR / DATA DO SERVIÇO --}}
            <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1 sm:col-span-3">
                    <label for="signature_id" class="scfv-label">
                        Assinatura do Professor Responsável:
                        <span class="scfv-required">*</span>
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
                                {{ old('signature_id', $scfv->signature_id) == $professor->id ? 'selected' : '' }}>
                                {{ $professor->name }}
                            </option>
                        @endforeach

                    </x-form.select>

                    @error('signature_id')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-1">
                    <label for="date_scfv" class="scfv-label">
                        Data do Serviço:
                        <span class="scfv-required">*</span>
                    </label>

                    <x-form.input
                        id="date_scfv"
                        type="text"
                        name="date_scfv"
                        autocomplete="off"
                        value="{{ old('date_scfv', \Carbon\Carbon::now()->format('d/m/Y')) }}"
                        class="w-full dark:text-gray-400 scfv-field date dateInput"
                        x-init="initFlatpickr"
                        placeholder="Ex: 01/11/2001"
                        required />

                    @error('date_scfv')
                        <span class="scfv-validation-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

        </x-table-edit>

    </div>


    <style>
        /* =========================================================
           SCFV - IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .scfv-edit-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }

        /* Fundo dos cards */
        .scfv-edit-page .bg-white {
            background-color: #FFFFFF !important;
        }

        /* Bordas */
        .scfv-edit-page .border-gray-200,
        .scfv-edit-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        /* Textos padrão */
        .scfv-edit-page .text-gray-700,
        .scfv-edit-page .text-gray-800 {
            color: #334E68 !important;
        }

        /* Labels */
        .scfv-edit-page .scfv-label {
            display: block;
            margin-bottom: 0.55rem;
            color: #334E68;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }

        /* Asterisco */
        .scfv-edit-page .scfv-required {
            color: #B45309;
            font-weight: 600;
        }

        /* Inputs, selects e textareas */
        .scfv-edit-page input,
        .scfv-edit-page textarea,
        .scfv-edit-page select,
        .scfv-edit-page .scfv-field {
            color: #102A43 !important;
            background-color: #FFFFFF !important;
            border-color: #D7DEE5 !important;
            border-radius: 9px !important;
            box-shadow: none !important;
            transition:
                border-color 0.18s ease,
                box-shadow 0.18s ease,
                background-color 0.18s ease;
        }

        /* Placeholder */
        .scfv-edit-page input::placeholder,
        .scfv-edit-page textarea::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }

        /* Foco */
        .scfv-edit-page input:focus,
        .scfv-edit-page textarea:focus,
        .scfv-edit-page select:focus,
        .scfv-edit-page .scfv-field:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        /* Divisores das quinzenas */
        .scfv-edit-page .scfv-section-divider {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin: 1.4rem 0 1.25rem;
            color: #102A43;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .scfv-edit-page .scfv-section-divider::before,
        .scfv-edit-page .scfv-section-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #E1E7EC;
        }

        .scfv-edit-page .scfv-section-divider span {
            padding: 0 0.35rem;
            white-space: nowrap;
        }

        /* Divisor de conteúdo */
        .scfv-edit-page .scfv-content-divider {
            height: 1px;
            width: 100%;
            margin: 1.5rem 0 0;
            background-color: #E1E7EC;
        }

        /* Mensagem de erro de data */
        .scfv-edit-page .scfv-error-message {
            display: none;
            padding: 0.7rem 0.9rem;
            border: 1px solid #F2D6A7;
            border-radius: 9px;
            background-color: #FFF8EB;
            color: #9A6700 !important;
            font-size: 0.875rem;
        }

        /* Erros de validação */
        .scfv-edit-page .scfv-validation-error {
            display: block;
            margin-top: 0.35rem;
            color: #B42318 !important;
            font-size: 0.82rem;
        }

        /* Aparência do select */
        .scfv-edit-page select {
            min-height: 42px;
        }

        /* Botões azuis herdados do componente -> verde SIAPAE */
        .scfv-edit-page .bg-blue-500,
        .scfv-edit-page .bg-blue-600,
        .scfv-edit-page .bg-blue-700,
        .scfv-edit-page .hover\:bg-blue-600:hover,
        .scfv-edit-page .hover\:bg-blue-700:hover {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .scfv-edit-page .bg-blue-500:hover,
        .scfv-edit-page .bg-blue-600:hover,
        .scfv-edit-page .bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
        }

        /* Botões com borda */
        .scfv-edit-page button,
        .scfv-edit-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }

        /* Card principal */
        .scfv-edit-page .rounded-lg,
        .scfv-edit-page .rounded-xl,
        .scfv-edit-page .rounded-2xl {
            border-color: #E1E7EC;
        }

        /* Sombra suave no conteúdo */
        .scfv-edit-page .shadow,
        .scfv-edit-page .shadow-sm,
        .scfv-edit-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }

        /* Responsividade */
        @media (max-width: 640px) {
            .scfv-edit-page {
                padding-bottom: 1rem;
            }

            .scfv-edit-page .scfv-section-divider {
                gap: 0.55rem;
                font-size: 0.88rem;
            }

            .scfv-edit-page .scfv-label {
                font-size: 0.88rem;
            }
        }
    </style>

</x-app-layout>