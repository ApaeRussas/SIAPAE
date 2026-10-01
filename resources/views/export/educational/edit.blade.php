<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    <div class="educational-edit-page">

        <x-table-edit
            title="Atendimento do Aluno - {{ $pedagogical->student->name }}"
            :elementEdit="$pedagogical"
            onlyHead
            actionRoute="educational">

            {{-- =====================================================
                 DADOS DO RELATÓRIO
                 ===================================================== --}}

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
                                {{ old('student_id', $pedagogical->student_id) == $student->id ? 'selected' : '' }}>
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
                        value="{{ old('date_pedagogical', $pedagogical->date_pedagogical) }}"
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
                            {{ old('period', $pedagogical->period) == '1º' ? 'selected' : '' }}>
                            1º
                        </option>

                        <option
                            value="2º"
                            {{ old('period', $pedagogical->period) == '2º' ? 'selected' : '' }}>
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


            {{-- =====================================================
                 INFORMAÇÕES ESCOLARES
                 ===================================================== --}}

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
                        value="{{ old('school', $pedagogical->school) }}"
                        class="w-full dark:text-gray-400 educational-field"
                        placeholder="Ex: E.M Tia Benilce"
                        required />

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
                        value="{{ old('date_of_birth', \Carbon\Carbon::createFromFormat('Y-m-d', $pedagogical->student->date_of_birth)->format('d/m/Y')) }}"
                        class="w-full sm:w-auto dark:text-gray-400 educational-field"
                        readonly
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
                        value="{{ old('age', $pedagogical->age) }}"
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
                        value="{{ old('turn_school', $pedagogical->turn_school) }}"
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
                        value="{{ old('grade_school', $pedagogical->grade_school) }}"
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
                        value="{{ old('school_year', $pedagogical->school_year) }}"
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


            {{-- =====================================================
                 PROFESSOR DO CAEE
                 ===================================================== --}}

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
                            {{ old('professor_signature', $pedagogical->professor_signature) == $professor->name ? 'selected' : '' }}>
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


            {{-- =====================================================
                 TEXTO DO RELATÓRIO
                 ===================================================== --}}

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
                    placeholder="Texto ........."
                    required>
                    {{ old('text', $pedagogical->text) }}
                </x-form.textarea>

                @error('text')
                    <span class="educational-validation-error">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- =====================================================
                 ASSINATURA
                 ===================================================== --}}

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
                            {{ old('signature_id', $pedagogical->signature_id) == $professor->id ? 'selected' : '' }}>
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

        </x-table-edit>

    </div>


    <style>
        /* =========================================================
           RELATÓRIO PEDAGÓGICO - EDIÇÃO
           IDENTIDADE VISUAL SIAPAE / ANAMNESE
           ========================================================= */

        .educational-edit-page {
            background-color: #F4F6F8;
            min-height: calc(100vh - 64px);
            padding-bottom: 2rem;
        }


        /* =========================================================
           CARD PRINCIPAL
           ========================================================= */

        .educational-edit-page .bg-white {
            background-color: #FFFFFF !important;
        }

        .educational-edit-page .border-gray-200,
        .educational-edit-page .border-gray-300 {
            border-color: #E1E7EC !important;
        }

        .educational-edit-page .shadow,
        .educational-edit-page .shadow-sm,
        .educational-edit-page .shadow-md {
            box-shadow: 0 8px 24px rgba(39, 67, 54, 0.06) !important;
        }


        /* =========================================================
           LABELS
           ========================================================= */

        .educational-edit-page label {
            color: #334E68 !important;
            font-size: 0.92rem;
            font-weight: 500;
            line-height: 1.4;
        }


        /* =========================================================
           CAMPOS
           ========================================================= */

        .educational-edit-page input,
        .educational-edit-page textarea,
        .educational-edit-page select,
        .educational-edit-page .educational-field {
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

        .educational-edit-page input::placeholder,
        .educational-edit-page textarea::placeholder {
            color: #8091A5 !important;
            opacity: 1;
        }

        .educational-edit-page input:focus,
        .educational-edit-page textarea:focus,
        .educational-edit-page select:focus,
        .educational-edit-page .educational-field:focus {
            border-color: #3B7D5A !important;
            box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
            outline: none !important;
        }

        /* Campo somente leitura */
        .educational-edit-page input[readonly] {
            background-color: #F8FAF9 !important;
            color: #66788A !important;
            cursor: default;
        }


        /* =========================================================
           DIVISORES
           ========================================================= */

        .educational-edit-page .educational-section-divider {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            margin: 1.5rem 0 1.25rem;
            color: #102A43;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .educational-edit-page .educational-section-divider::before,
        .educational-edit-page .educational-section-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: #E1E7EC;
        }

        .educational-edit-page .educational-section-divider span {
            padding: 0 0.35rem;
            white-space: nowrap;
        }


        /* =========================================================
           ERROS
           ========================================================= */

        .educational-edit-page .educational-validation-error {
            display: block;
            margin-top: 0.35rem;
            color: #B42318 !important;
            font-size: 0.82rem;
        }

        .educational-edit-page .educational-date-error {
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
           BOTÕES DO x-table-edit
           ========================================================= */

        .educational-edit-page .bg-blue-500,
        .educational-edit-page .bg-blue-600,
        .educational-edit-page .bg-blue-700 {
            background-color: #3B7D5A !important;
            border-color: #3B7D5A !important;
            color: #FFFFFF !important;
        }

        .educational-edit-page .bg-blue-500:hover,
        .educational-edit-page .bg-blue-600:hover,
        .educational-edit-page .bg-blue-700:hover,
        .educational-edit-page .hover\:bg-blue-600:hover,
        .educational-edit-page .hover\:bg-blue-700:hover {
            background-color: #2F684A !important;
            border-color: #2F684A !important;
            color: #FFFFFF !important;
        }


        /* =========================================================
           TRANSIÇÕES
           ========================================================= */

        .educational-edit-page button,
        .educational-edit-page a {
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

            .educational-edit-page {
                padding-bottom: 1rem;
            }

            .educational-edit-page label {
                font-size: 0.88rem;
            }

            .educational-edit-page .educational-section-divider {
                gap: 0.55rem;
                font-size: 0.88rem;
            }
        }
    </style>


    {{-- =========================================================
         AJAX - ATUALIZAÇÃO DOS DADOS DO ESTUDANTE
         ========================================================= --}}

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