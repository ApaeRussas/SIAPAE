<x-app-layout>

    <x-table-create
        title="Registro de Atendimento"
        onlyHead
        actionRoute="attendance"
    >

        {{-- ERROS DE VALIDAÇÃO --}}
        <div class="mt-2 mb-4">
            <x-auth-validation-errors :errors="$errors" />
        </div>


        {{-- CAMPOS OCULTOS USADOS PELO CALENDÁRIO --}}
        <input type="hidden" name="year" id="year">
        <input type="hidden" name="faixaSemana" id="faixaSemana">


        {{-- =====================================================
             IDENTIFICAÇÃO
             ===================================================== --}}

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4 my-3">

            {{-- ALUNO --}}
            <div>

                <label
                    for="student_id"
                    class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
                >
                    Nome do aluno:
                    <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <select
                    id="student_id"
                    name="student_id"
                    required
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
                >
                    <option value="">
                        Selecione um aluno
                    </option>

                    @foreach ($students as $student)

                        <option
                            value="{{ $student->id }}"
                            {{ old('student_id', $student_id) == $student->id ? 'selected' : '' }}
                        >
                            {{ $student->name }}
                        </option>

                    @endforeach

                </select>

                @error('student_id')
                    <span class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- DATA --}}
            <div>

                <label
                    for="date"
                    class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
                >
                    Data do Atendimento:
                    <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="date"
                    name="date"
                    value="{{ old('date', $date) }}"
                    placeholder="dd/mm/aaaa"
                    autocomplete="off"
                    maxlength="10"
                    inputmode="numeric"
                    pattern="\d{2}/\d{2}/\d{4}"
                    x-init="initFlatpickr"
                    required
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
                    oninput="formatarData(this)"
                >

                @error('date')
                    <span class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror

            </div>

        </div>


        {{-- =====================================================
             PROFESSOR
             ===================================================== --}}

        <div class="my-4">

            <label
                for="signature_id"
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Assinatura do Professor Responsável:
                <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <select
                id="signature_id"
                name="signature_id"
                required
                class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >

                <option value="">
                    Selecione um Professor
                </option>

                @foreach ($professors as $professor)

                    <option
                        value="{{ $professor->id }}"
                        {{ old('signature_id', Auth::user()->id) == $professor->id ? 'selected' : '' }}
                    >
                        {{ $professor->name }}
                    </option>

                @endforeach

            </select>

            @error('signature_id')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- =====================================================
             EIXO EDUCACIONAL
             ===================================================== --}}

        <div class="my-4">

            <label
                for="educational_axis"
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Eixo educacional trabalhado:
                <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <textarea
                id="educational_axis"
                name="educational_axis"
                rows="3"
                required
                placeholder="Descreva o eixo educacional trabalhado..."
                class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('educational_axis') }}</textarea>

            @error('educational_axis')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- =====================================================
             DESCRIÇÃO DA ATIVIDADE
             ===================================================== --}}

        <div class="my-5">

            <label
                for="activity_description"
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Descrição da atividade realizada:
                <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <textarea
                name="activity_description"
                id="activity_description"
                rows="5"
                placeholder="Descreva a atividade realizada com o aluno..."
                class="attendance-textarea w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('activity_description') }}</textarea>

            @error('activity_description')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror


            {{-- NÃO REALIZOU --}}
            <div class="mt-3">

                <input
                    type="hidden"
                    name="activity_not_performed"
                    value="0"
                >

                <label
                    for="activity_not_performed"
                    class="inline-flex items-center cursor-pointer"
                >

                    <input
                        type="checkbox"
                        name="activity_not_performed"
                        id="activity_not_performed"
                        value="1"
                        {{ old('activity_not_performed') ? 'checked' : '' }}
                        onchange="toggleActivityDescription()"
                        class="rounded border-gray-300 text-[#3B7D5A] focus:ring-[#3B7D5A]"
                    >

                    <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Não realizou a atividade
                    </span>

                </label>

            </div>

        </div>


        {{-- =====================================================
             AVANÇOS
             ===================================================== --}}

        <div class="my-5">

            <label
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Houve avanços?
                <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <input
                type="hidden"
                name="advances_status"
                id="advances_status"
                value="{{ old('advances_status', 'Não') }}"
            >

            <div class="flex gap-2 mb-3">

                <button
                    type="button"
                    id="advancesYes"
                    onclick="setAdvancesStatus('Sim')"
                    class="attendance-choice"
                >
                    Sim
                </button>

                <button
                    type="button"
                    id="advancesNo"
                    onclick="setAdvancesStatus('Não')"
                    class="attendance-choice"
                >
                    Não
                </button>

            </div>


            <textarea
                name="advances"
                id="advances"
                rows="4"
                placeholder="Descreva os avanços observados..."
                class="attendance-textarea w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('advances') }}</textarea>

            @error('advances')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- =====================================================
             DIFICULDADES
             ===================================================== --}}

        <div class="my-5">

            <label
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Houve dificuldades?
                <span class="text-red-700 dark:text-red-500">*</span>
            </label>

            <input
                type="hidden"
                name="difficulties_status"
                id="difficulties_status"
                value="{{ old('difficulties_status', 'Não') }}"
            >

            <div class="flex gap-2 mb-3">

                <button
                    type="button"
                    id="difficultiesYes"
                    onclick="setDifficultiesStatus('Sim')"
                    class="attendance-choice"
                >
                    Sim
                </button>

                <button
                    type="button"
                    id="difficultiesNo"
                    onclick="setDifficultiesStatus('Não')"
                    class="attendance-choice"
                >
                    Não
                </button>

            </div>


            <textarea
                name="difficulties"
                id="difficulties"
                rows="4"
                placeholder="Descreva as dificuldades observadas..."
                class="attendance-textarea w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('difficulties') }}</textarea>

            @error('difficulties')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


    </x-table-create>

</x-app-layout>


<style>

    /* =========================================================
       CAMPOS
       ========================================================= */

    #student_id,
    #signature_id,
    #date,
    #educational_axis,
    #activity_description,
    #advances,
    #difficulties {
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }


    #student_id:focus,
    #signature_id:focus,
    #date:focus,
    #educational_axis:focus,
    #activity_description:focus,
    #advances:focus,
    #difficulties:focus {
        border-color: #3B7D5A !important;
        box-shadow:
            0 0 0 3px rgba(59, 125, 90, .10) !important;
        outline: none;
    }


    /* =========================================================
       BOTÕES SIM / NÃO
       ========================================================= */

    .attendance-choice {
        min-width: 82px;
        padding: 9px 22px;

        border: 1px solid #D7DEE5;
        border-radius: 8px;

        background: #FFFFFF;
        color: #334E68;

        font-size: 14px;
        font-weight: 600;

        transition:
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease;
    }


    .attendance-choice:hover {
        border-color: #3B7D5A;
        background: #EDF5F0;
        color: #2F684A;
    }


    .attendance-choice.is-selected {
        background: #3B7D5A;
        border-color: #3B7D5A;
        color: #FFFFFF;
    }


    /* =========================================================
       TEXTAREAS DESABILITADAS
       ========================================================= */

    .attendance-textarea:disabled {
        background-color: #F4F6F8 !important;
        color: #829AB1 !important;
        border-color: #E1E7EC !important;
        cursor: not-allowed;
    }

</style>


<script>

    /* =========================================================
       MÁSCARA DA DATA
       ========================================================= */

    function formatarData(input) {

        let valor = input.value.replace(/\D/g, '');

        valor = valor.substring(0, 8);

        if (valor.length > 4) {
            valor =
                valor.substring(0, 2) + '/' +
                valor.substring(2, 4) + '/' +
                valor.substring(4);
        } else if (valor.length > 2) {
            valor =
                valor.substring(0, 2) + '/' +
                valor.substring(2);
        }

        input.value = valor;
    }


    /* =========================================================
       BOTÕES SIM / NÃO - AVANÇOS
       ========================================================= */

    function setAdvancesStatus(status) {

        const statusInput = document.getElementById('advances_status');
        const textarea = document.getElementById('advances');
        const yesButton = document.getElementById('advancesYes');
        const noButton = document.getElementById('advancesNo');

        if (!statusInput || !textarea || !yesButton || !noButton) {
            return;
        }

        statusInput.value = status;

        if (status === 'Sim') {
            textarea.disabled = false;
            textarea.required = true;

            yesButton.classList.add('is-selected');
            noButton.classList.remove('is-selected');
        } else {
            textarea.disabled = true;
            textarea.required = false;
            textarea.value = '';

            noButton.classList.add('is-selected');
            yesButton.classList.remove('is-selected');
        }
    }


    /* =========================================================
       BOTÕES SIM / NÃO - DIFICULDADES
       ========================================================= */

    function setDifficultiesStatus(status) {

        const statusInput = document.getElementById('difficulties_status');
        const textarea = document.getElementById('difficulties');
        const yesButton = document.getElementById('difficultiesYes');
        const noButton = document.getElementById('difficultiesNo');

        if (!statusInput || !textarea || !yesButton || !noButton) {
            return;
        }

        statusInput.value = status;

        if (status === 'Sim') {
            textarea.disabled = false;
            textarea.required = true;

            yesButton.classList.add('is-selected');
            noButton.classList.remove('is-selected');
        } else {
            textarea.disabled = true;
            textarea.required = false;
            textarea.value = '';

            noButton.classList.add('is-selected');
            yesButton.classList.remove('is-selected');
        }
    }


    /* =========================================================
       NÃO REALIZOU A ATIVIDADE
       ========================================================= */

    function toggleActivityDescription() {

        const checkbox = document.getElementById('activity_not_performed');
        const textarea = document.getElementById('activity_description');

        if (!checkbox || !textarea) {
            return;
        }

        if (checkbox.checked) {
            textarea.disabled = true;
            textarea.required = false;
            textarea.value = '';
        } else {
            textarea.disabled = false;
            textarea.required = true;
        }
    }


    /* =========================================================
       INICIALIZAÇÃO
       ========================================================= */

    document.addEventListener('DOMContentLoaded', function () {

        const advancesStatus =
            document.getElementById('advances_status')?.value || 'Não';

        const difficultiesStatus =
            document.getElementById('difficulties_status')?.value || 'Não';

        setAdvancesStatus(advancesStatus);
        setDifficultiesStatus(difficultiesStatus);
        toggleActivityDescription();

        const dateInput = document.getElementById('date');

        if (dateInput && dateInput.value) {
            formatarData(dateInput);
        }
    });

</script>