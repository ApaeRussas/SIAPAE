<x-app-layout>

    <div class="educational-create-page">

        <x-table-create
            title="Relatório Pedagógico"
            onlyHead
            actionRoute="educational">

            {{-- DADOS DO RELATÓRIO --}}
            <div class="my-4 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1 sm:col-span-2">
                    <x-form.label for="student_id">
                        Nome do Estudante para o Relatório
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.select
                        idSelect="student_id"
                        valueName="student_id"
                        full>
                        
                        <option value="">Nome:</option>

                        @foreach ($students as $student)
                            <option
                                value="{{ $student->id }}"
                                {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach

                    </x-form.select>

                    @error('student_id')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-form.label for="date_pedagogical">
                        Data do Relatório
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="date_pedagogical"
                        name="date_pedagogical"
                        class="date dateInput dark:text-gray-400 w-full educational-field"
                        required
                        x-init="initFlatpickr"
                        autocomplete="off"
                        value="{{ old('date_pedagogical', \Carbon\Carbon::now()->format('d/m/Y')) }}"
                        placeholder="Ex: 01/01/2001" />

                    @error('date_pedagogical')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror

                    <span id="errorMessage" class="educational-date-error">
                        Data inválida. Insira uma data entre 1960 e 2200.
                    </span>
                </div>


                <div class="col-span-1">
                    <x-form.label for="period">
                        Semestre do Aluno
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.select
                        idSelect="period"
                        valueName="period"
                        full>

                        <option value="">Semestre:</option>

                        <option
                            value="1º"
                            {{ old('period') == '1º' ? 'selected' : '' }}>
                            1º
                        </option>

                        <option
                            value="2º"
                            {{ old('period') == '2º' ? 'selected' : '' }}>
                            2º
                        </option>

                    </x-form.select>

                    @error('period')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>


            {{-- INFORMAÇÕES ESCOLARES --}}
            <div class="educational-section-divider">
                <span>Informações Escolares</span>
            </div>


            <div class="mb-4 mt-5 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1 sm:col-span-2">
                    <x-form.label for="school">
                        Escola que estuda
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="school"
                        name="school"
                        value="{{ old('school') }}"
                        class="w-full dark:text-gray-400 educational-field"
                        required
                        placeholder="Ex: E.M Tia Benilce" />

                    @error('school')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-form.label for="date_of_birth">
                        Data de Nascimento
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="date_of_birth"
                        name="date_of_birth"
                        readonly
                        class="w-full sm:w-auto dark:text-gray-400 educational-field"
                        placeholder="Data fixa" />

                    @error('date_of_birth')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-form.label for="age">
                        Idade
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="age"
                        name="age"
                        value="{{ old('age') }}"
                        required
                        placeholder="Ex: 15 anos"
                        class="w-full sm:w-48 dark:text-gray-400 educational-field" />

                    @error('age')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>


            <div class="mb-5 grid grid-cols-1 sm:grid-cols-4 gap-x-5 gap-y-4">

                <div class="col-span-1">
                    <x-form.label for="turn_school">
                        Turno
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="turn_school"
                        name="turn_school"
                        value="{{ old('turn_school') }}"
                        required
                        placeholder="Ex: Manhã"
                        class="w-full dark:text-gray-400 educational-field" />

                    @error('turn_school')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-form.label for="grade_school">
                        Série/Ano
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="grade_school"
                        name="grade_school"
                        value="{{ old('grade_school') }}"
                        required
                        placeholder="Ex: 1°"
                        class="w-full dark:text-gray-400 educational-field" />

                    @error('grade_school')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>


                <div class="col-span-1">
                    <x-form.label for="school_year">
                        Ano Letivo
                        <span class="text-red-700 dark:text-red-500">*</span>
                    </x-form.label>

                    <x-form.input
                        id="school_year"
                        name="school_year"
                        value="{{ old('school_year', \Carbon\Carbon::now()->format('Y')) }}"
                        required
                        placeholder="Ex: 2024"
                        class="w-full dark:text-gray-400 educational-field" />

                    @error('school_year')
                        <span class="educational-validation-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

            </div>


            {{-- PROFESSOR CAEE --}}
            <div class="educational-section-divider">
                <span>Profissionais Responsáveis</span>
            </div>


            <div class="mb-5 mt-5 w-full sm:w-1/2">

                <x-form.label for="professor_signature">
                    Professor do CAEE
                    <span class="text-red-700 dark:text-red-500">*</span>
                </x-form.label>

                <x-form.select
                    idSelect="professor_signature"
                    valueName="professor_signature"
                    full>

                    <option value="">Nome:</option>

                    @foreach ($professors as $professor)
                        <option
                            value="{{ $professor->name }}"
                            {{ old('professor_signature') == $professor->name ? 'selected' : '' }}>
                            {{ $professor->name }}
                        </option>
                    @endforeach

                </x-form.select>

                @error('professor_signature')
                    <span class="educational-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- TEXTO PRINCIPAL --}}
            <div class="mb-5">

                <x-form.label for="text">
                    Texto Principal do Relatório
                    <span class="text-red-700 dark:text-red-500">*</span>
                </x-form.label>

                <x-form.textarea
                    id="text"
                    name="text"
                    height="text"
                    sizeFont="base"
                    class="educational-field"
                    required
                    placeholder="Texto .........">
                    {{ old('text') }}
                </x-form.textarea>

                @error('text')
                    <span class="educational-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- ASSINATURA --}}
            <div class="mb-2 w-full sm:w-1/2">

                <x-form.label for="signature_id">
                    Assinatura do Professor Responsável
                    <span class="text-red-700 dark:text-red-500">*</span>
                </x-form.label>

                <x-form.select
                    idSelect="signature_id"
                    valueName="signature_id"
                    full>

                    <option value="">Nome:</option>

                    @foreach ($professors as $professor)
                        <option
                            value="{{ $professor->id }}"
                            {{ old('signature_id', Auth::user()->id) == $professor->id ? 'selected' : '' }}>
                            {{ $professor->name }}
                        </option>
                    @endforeach

                </x-form.select>

                @error('signature_id')
                    <span class="educational-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </x-table-create>

    </div>


    <style>
        /* =========================================================
           RELATÓRIO PEDAGÓGICO - CRIAÇÃO
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .educational-create-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .educational-create-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .educational-create-page .border-gray-200,
        .educational-create-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .educational-create-page .shadow,
        .educational-create-page .shadow-sm,
        .educational-create-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           LABELS
           ========================================================= */

        .educational-create-page label {
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }


        /* =========================================================
           CAMPOS
           ========================================================= */

        .educational-create-page input,
        .educational-create-page textarea,
        .educational-create-page select,
        .educational-create-page .educational-field {
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

        .educational-create-page input::placeholder,
        .educational-create-page textarea::placeholder,
        .educational-create-page select::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }

        .educational-create-page input:focus,
        .educational-create-page textarea:focus,
        .educational-create-page select:focus,
        .educational-create-page .educational-field:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        .educational-create-page input[readonly] {
            background-color: #F8FAF9 !important;
            color: #66788A !important;
            cursor: default;
        }


        /* =========================================================
           DIVISORES DE SEÇÃO
           ========================================================= */

        .educational-create-page .educational-section-divider {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin: 1.5rem 0 1.25rem;
            color: #102A43;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .educational-create-page .educational-section-divider::before,
        .educational-create-page .educational-section-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #E1E7EC;
        }

        .educational-create-page .educational-section-divider span {
            padding: 0 0.35rem;
            white-space: nowrap;
        }


        /* =========================================================
           ERROS
           ========================================================= */

        .educational-create-page .educational-validation-error {
            display: block;
            margin-top: 0.35rem;
            color: #B42318 !important;
            font-size: 0.82rem;
        }

        .educational-create-page .educational-date-error {
            display: none;
            margin-top: 0.35rem;
            padding: 0.6rem 0.8rem;
            border: 1px solid #F2D6A7;
            border-radius: 9px;
            background-color: #FFF8EB;
            color: #9A6700 !important;
            font-size: 0.82rem;
        }


        /* =========================================================
           BOTÕES DO x-table-create
           ========================================================= */

        .educational-create-page .bg-blue-500,
        .educational-create-page .bg-blue-600,
        .educational-create-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-create-page .bg-blue-500:hover,
        .educational-create-page .bg-blue-600:hover,
        .educational-create-page .bg-blue-700:hover,
        .educational-create-page .hover\:bg-blue-600:hover,
        .educational-create-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           TRANSIÇÕES
           ========================================================= */

        .educational-create-page button,
        .educational-create-page a {
            transition:
                background-color 0.18s ease,
                border-color 0.18s ease,
                color 0.18s ease,
                box-shadow 0.18s ease;
        }


        /* =========================================================
           RESPONSIVIDADE
           ========================================================= */

        @media (max-width: 640px) {

            .educational-create-page {
                padding-bottom: 1rem;
            }

            .educational-create-page label {
                font-size: 0.88rem;
            }

            .educational-create-page .educational-section-divider {
                gap: 0.55rem;
                font-size: 0.88rem;
            }
        }
    </style>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#student_id').change(function () {

            var studentId = $(this).val();

            if (studentId) {

                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',

                    success: function (data) {

                        $('#date_of_birth').val(
                            data.date_of_birth || '------'
                        );

                        $('#school').val(
                            data.school || '------'
                        );

                        $('#grade_school').val(
                            data.grade_school || '------'
                        );

                        $('#turn_school').val(
                            data.turn_school || '------'
                        );

                        $('#age').val(
                            data.age || '------'
                        );
                    }
                });

            } else {

                $('#date_of_birth').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#turn_school').val('');
                $('#age').val('');
            }
        });
    </script>

</x-app-layout>