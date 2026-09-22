<x-app-layout>

    <div class="expense-create-page">

        <x-table-create
            title="Gasto"
            onlyHead
            actionRoute="expense">

            {{-- =====================================================
                 TIPO DE GASTO
                 ===================================================== --}}

            <div class="mb-5">

                <label for="tipo_gasto" class="expense-label">
                    Tipo de Gasto:
                    <span class="expense-required">*</span>
                </label>

                <x-form.select
                    idSelect="tipo_gasto"
                    valueName="type">

                    <option
                        value="Nota Fiscal"
                        {{ old('tipo_gasto', 'Nota Fiscal') == 'Nota Fiscal' ? 'selected' : '' }}>
                        Nota Fiscal
                    </option>

                    <option
                        value="Cupom Fiscal"
                        {{ old('tipo_gasto') == 'Cupom Fiscal' ? 'selected' : '' }}>
                        Cupom Fiscal
                    </option>

                    <option
                        value="Recibo"
                        {{ old('tipo_gasto') == 'Recibo' ? 'selected' : '' }}>
                        Recibo
                    </option>

                </x-form.select>

                @error('type')
                    <span class="expense-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- =====================================================
                 DATA DE EMISSÃO
                 ===================================================== --}}

            <div class="mb-5">

                <label for="dateInput" class="expense-label">
                    Data de emissão:
                    <span class="expense-required">*</span>
                </label>

                <x-form.input
                    id="dateInput"
                    type="text"
                    name="date_of_emission"
                    value="{{ old('date_of_emission') }}"
                    autocomplete="off"
                    class="w-full dark:text-gray-400 date dateInput expense-field"
                    required
                    placeholder="Ex: 01/01/2001"
                    x-init="initFlatpickr" />

                <span id="errorMessage" class="expense-date-error">
                    Data inválida. Insira uma data entre 1960 e 2200.
                </span>

                @error('date_of_emission')
                    <span class="expense-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- =====================================================
                 NOTA FISCAL
                 ===================================================== --}}

            <div id="campo_nota_fiscal">

                <div class="mb-5">

                    <label for="fiscal" class="expense-label">
                        Número da Nota:
                    </label>

                    <x-form.input
                        id="fiscal"
                        type="text"
                        name="fiscal_number"
                        value="{{ old('fiscal_number') }}"
                        autocomplete="off"
                        class="w-full dark:text-gray-400 expense-field"
                        placeholder="Ex: 392.047.028" />

                    @error('fiscal_number')
                        <span class="expense-validation-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- =====================================================
                 CUPOM FISCAL
                 ===================================================== --}}

            <div id="campo_cupom_fiscal">

                <div class="mb-5">

                    <label for="cupom" class="expense-label">
                        Número do Cupom:
                    </label>

                    <x-form.input
                        id="cupom"
                        type="text"
                        name="cupom_number"
                        value="{{ old('cupom_number') }}"
                        autocomplete="off"
                        class="w-full dark:text-gray-400 expense-field"
                        placeholder="Ex: 999999" />

                    @error('cupom_number')
                        <span class="expense-validation-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- =====================================================
                 RECIBO
                 ===================================================== --}}

            <div id="campo_recibo">

                <div class="mb-5">

                    <label for="description" class="expense-label">
                        Descrição:
                    </label>

                    <x-form.input
                        type="text"
                        id="description"
                        name="description"
                        value="{{ old('description') }}"
                        class="w-full dark:text-gray-400 expense-field"
                        placeholder="Ex: Descrição do Recibo" />

                    @error('description')
                        <span class="expense-validation-error">
                            {{ $message }}
                        </span>
                    @enderror

                </div>

            </div>


            {{-- =====================================================
                 EMPRESA
                 ===================================================== --}}

            <div class="mb-5">

                <label for="enterprise" class="expense-label">
                    Empresa:
                    <span class="expense-optional">(*opcional)</span>
                </label>

                <x-form.input
                    type="text"
                    id="enterprise"
                    name="enterprise"
                    value="{{ old('enterprise') }}"
                    class="w-full dark:text-gray-400 expense-field"
                    placeholder="Ex: Nome da Empresa" />

                @error('enterprise')
                    <span class="expense-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- =====================================================
                 VALOR
                 ===================================================== --}}

            <div class="mb-2">

                <label for="price" class="expense-label">
                    Valor:
                    <span class="expense-required">*</span>
                </label>

                <x-form.input
                    type="text"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    class="w-full dark:text-gray-400 expense-field"
                    required
                    oninput="mascaraMoeda(event)"
                    placeholder="Ex: 49,99" />

                @error('price')
                    <span class="expense-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </x-table-create>

    </div>


    <style>
        /* =========================================================
           CONTROLE DE GASTOS - CRIAÇÃO
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .expense-create-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .expense-create-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .expense-create-page .border-gray-200,
        .expense-create-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .expense-create-page .shadow,
        .expense-create-page .shadow-sm,
        .expense-create-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TÍTULOS
           ========================================================= */

        .expense-create-page h1,
        .expense-create-page h2,
        .expense-create-page h3 {
            color: #102A43 !important;
        }


        /* =========================================================
           LABELS
           ========================================================= */

        .expense-create-page .expense-label {
            display: block;
            margin-top: 0.75rem;
            margin-bottom: 0.55rem;
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .expense-create-page .expense-required {
            color: #B42318 !important;
            font-weight: 600;
        }

        .expense-create-page .expense-optional {
            color: #8091A5 !important;
            font-size: 0.82rem;
            font-weight: 400;
        }


        /* =========================================================
           INPUTS E SELECT
           ========================================================= */

        .expense-create-page input,
        .expense-create-page textarea,
        .expense-create-page select,
        .expense-create-page .expense-field {
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

        .expense-create-page input::placeholder,
        .expense-create-page textarea::placeholder,
        .expense-create-page select::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }


        /* Foco */

        .expense-create-page input:focus,
        .expense-create-page textarea:focus,
        .expense-create-page select:focus,
        .expense-create-page .expense-field:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           MENSAGEM DE ERRO DE DATA
           ========================================================= */

        .expense-create-page .expense-date-error {
            display: none;
            margin-top: 0.4rem;
            padding: 0.65rem 0.8rem;
            border: 1px solid #F2D6A7;
            border-radius: 9px;
            background-color: #FFF8EB;
            color: #9A6700 !important;
            font-size: 0.82rem;
        }


        /* =========================================================
           ERROS DE VALIDAÇÃO
           ========================================================= */

        .expense-create-page .expense-validation-error {
            display: block;
            margin-top: 0.35rem;
            color: #B42318 !important;
            font-size: 0.82rem;
        }


        /* =========================================================
           CAMPOS CONDICIONAIS
           ========================================================= */

        .expense-create-page #campo_nota_fiscal,
        .expense-create-page #campo_cupom_fiscal,
        .expense-create-page #campo_recibo {
            transition:
                opacity 0.18s ease,
                max-height 0.2s ease;
        }


        /* =========================================================
           BOTÕES DO x-table-create
           ========================================================= */

        .expense-create-page .bg-blue-500,
        .expense-create-page .bg-blue-600,
        .expense-create-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .expense-create-page .bg-blue-500:hover,
        .expense-create-page .bg-blue-600:hover,
        .expense-create-page .bg-blue-700:hover,
        .expense-create-page .hover\:bg-blue-600:hover,
        .expense-create-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           LINKS E BOTÕES
           ========================================================= */

        .expense-create-page button,
        .expense-create-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           TEXTOS
           ========================================================= */

        .expense-create-page .text-gray-500,
        .expense-create-page .text-gray-600 {
            color: #66788A !important;
        }

        .expense-create-page .text-gray-700,
        .expense-create-page .text-gray-800 {
            color: #334E68 !important;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .expense-create-page {
                padding-bottom: 1rem;
            }

            .expense-create-page .expense-label {
                font-size: 0.88rem;
            }
        }
    </style>

</x-app-layout>