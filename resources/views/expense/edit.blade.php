<x-app-layout>

    <div class="expense-edit-page">

        <x-table-edit
            title="Gasto"
            :elementEdit="$expense"
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
                        {{ old('tipo_gasto', $expense->type) == 'Nota Fiscal' ? 'selected' : '' }}>
                        Nota Fiscal
                    </option>

                    <option
                        value="Cupom Fiscal"
                        {{ old('tipo_gasto', $expense->type) == 'Cupom Fiscal' ? 'selected' : '' }}>
                        Cupom Fiscal
                    </option>

                    <option
                        value="Recibo"
                        {{ old('tipo_gasto', $expense->type) == 'Recibo' ? 'selected' : '' }}>
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
                    x-init="initFlatpickr"
                    autocomplete="off"
                    value="{{ old('date_of_emission', $expense->date_of_emission) }}"
                    class="w-full dark:text-gray-400 date dateInput expense-field"
                    required
                    placeholder="Ex: 01/01/2001" />

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
                        autocomplete="off"
                        value="{{ old('fiscal_number', $expense->fiscal_number) }}"
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
                        Número do Cupom Fiscal:
                    </label>

                    <x-form.input
                        id="cupom"
                        type="text"
                        name="cupom_number"
                        autocomplete="off"
                        value="{{ old('cupom_number', $expense->cupom_number) }}"
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
                        value="{{ old('description', $expense->description) }}"
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
                    value="{{ old('enterprise', $expense->enterprise) }}"
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
                    value="{{ old('price', 'R$ ' . number_format($expense->price, 2, ',', '.')) }}"
                    class="w-full dark:text-gray-400 expense-field"
                    required
                    placeholder="Ex: 49,99"
                    oninput="mascaraMoeda(event)" />

                @error('price')
                    <span class="expense-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </x-table-edit>

    </div>


    <style>
        /* =========================================================
           CONTROLE DE GASTOS - EDIÇÃO
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .expense-edit-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .expense-edit-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .expense-edit-page .border-gray-200,
        .expense-edit-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .expense-edit-page .shadow,
        .expense-edit-page .shadow-sm,
        .expense-edit-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           TÍTULOS
           ========================================================= */

        .expense-edit-page h1,
        .expense-edit-page h2,
        .expense-edit-page h3 {
            color: #102A43 !important;
        }


        /* =========================================================
           LABELS
           ========================================================= */

        .expense-edit-page .expense-label {
            display: block;
            margin-top: 0.75rem;
            margin-bottom: 0.55rem;
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .expense-edit-page .expense-required {
            color: #B42318 !important;
            font-weight: 600;
        }

        .expense-edit-page .expense-optional {
            color: #8091A5 !important;
            font-size: 0.82rem;
            font-weight: 400;
        }


        /* =========================================================
           INPUTS / SELECT
           ========================================================= */

        .expense-edit-page input,
        .expense-edit-page textarea,
        .expense-edit-page select,
        .expense-edit-page .expense-field {
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

        .expense-edit-page input::placeholder,
        .expense-edit-page textarea::placeholder,
        .expense-edit-page select::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }


        /* Foco */

        .expense-edit-page input:focus,
        .expense-edit-page textarea:focus,
        .expense-edit-page select:focus,
        .expense-edit-page .expense-field:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }


        /* =========================================================
           CAMPOS CONDICIONAIS
           ========================================================= */

        .expense-edit-page #campo_nota_fiscal,
        .expense-edit-page #campo_cupom_fiscal,
        .expense-edit-page #campo_recibo {
            transition:
                opacity 0.18s ease,
                max-height 0.2s ease;
        }


        /* =========================================================
           MENSAGEM DE DATA
           ========================================================= */

        .expense-edit-page .expense-date-error {
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

        .expense-edit-page .expense-validation-error {
            display: block;
            margin-top: 0.35rem;
            color: #B42318 !important;
            font-size: 0.82rem;
        }


        /* =========================================================
           BOTÕES DO x-table-edit -> VERDE SIAPAE
           ========================================================= */

        .expense-edit-page .bg-blue-500,
        .expense-edit-page .bg-blue-600,
        .expense-edit-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .expense-edit-page .bg-blue-500:hover,
        .expense-edit-page .bg-blue-600:hover,
        .expense-edit-page .bg-blue-700:hover,
        .expense-edit-page .hover\:bg-blue-600:hover,
        .expense-edit-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           LINKS E BOTÕES
           ========================================================= */

        .expense-edit-page button,
        .expense-edit-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           TEXTOS
           ========================================================= */

        .expense-edit-page .text-gray-500,
        .expense-edit-page .text-gray-600 {
            color: #66788A !important;
        }

        .expense-edit-page .text-gray-700,
        .expense-edit-page .text-gray-800 {
            color: #334E68 !important;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .expense-edit-page {
                padding-bottom: 1rem;
            }

            .expense-edit-page .expense-label {
                font-size: 0.88rem;
            }
        }
    </style>

</x-app-layout>