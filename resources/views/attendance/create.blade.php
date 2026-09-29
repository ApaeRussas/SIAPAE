<x-app-layout>

    <x-table-create
        title="Registro de Atendimento"
        onlyHead
        actionRoute="attendance"
    >

        {{-- =====================================================
             ERROS DE VALIDAÇÃO
             ===================================================== --}}

        <div class="mt-2 mb-4">
            <x-auth-validation-errors :errors="$errors" />
        </div>


        {{-- =====================================================
             CAMPOS OCULTOS USADOS PELO CALENDÁRIO
             ===================================================== --}}

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
             HABILIDADES
             ===================================================== --}}

        <div class="my-5">

            <label
                for="skills"
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Habilidades:
            </label>

            <textarea
                name="skills"
                id="skills"
                rows="4"
                placeholder="Descreva as habilidades trabalhadas ou observadas..."
                class="attendance-textarea w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('skills') }}</textarea>

            @error('skills')
                <span class="text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror

        </div>


        {{-- =====================================================
             EVOLUÇÃO DAS HABILIDADES
             ===================================================== --}}

        <div class="my-5">

            <label
                for="skills_evolution"
                class="block text-gray-700 dark:text-gray-300 font-normal mb-2"
            >
                Evolução das habilidades:
            </label>

            <textarea
                name="skills_evolution"
                id="skills_evolution"
                rows="4"
                placeholder="Descreva como as habilidades do aluno evoluíram..."
                class="attendance-textarea w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
            >{{ old('skills_evolution') }}</textarea>

            @error('skills_evolution')
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


            {{-- CAIXA DE TEXTO DOS AVANÇOS --}}
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


            {{-- NÍVEL DOS AVANÇOS --}}
            <div
                id="advancesLevelContainer"
                class="attendance-level-container mt-4"
            >

                <label
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                >
                    Nível do avanço:
                    <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <input
                    type="hidden"
                    name="advances_level"
                    id="advances_level"
                    value="{{ old('advances_level') }}"
                >

                <div class="attendance-levels">

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="1"
                        onclick="setAdvancesLevel(1)"
                    >
                        <span class="level-number">1</span>
                        <span class="level-label">Quase nada</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="2"
                        onclick="setAdvancesLevel(2)"
                    >
                        <span class="level-number">2</span>
                        <span class="level-label">Muito pouco</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="3"
                        onclick="setAdvancesLevel(3)"
                    >
                        <span class="level-number">3</span>
                        <span class="level-label">Pouco</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="4"
                        onclick="setAdvancesLevel(4)"
                    >
                        <span class="level-number">4</span>
                        <span class="level-label">Bom</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="5"
                        onclick="setAdvancesLevel(5)"
                    >
                        <span class="level-number">5</span>
                        <span class="level-label">Excelente</span>
                    </button>

                </div>

                @error('advances_level')
                    <span class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror

            </div>

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


            {{-- CAIXA DE TEXTO DAS DIFICULDADES --}}
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


            {{-- NÍVEL DAS DIFICULDADES --}}
            <div
                id="difficultiesLevelContainer"
                class="attendance-level-container mt-4"
            >

                <label
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"
                >
                    Nível das dificuldades:
                    <span class="text-red-700 dark:text-red-500">*</span>
                </label>

                <input
                    type="hidden"
                    name="difficulties_level"
                    id="difficulties_level"
                    value="{{ old('difficulties_level') }}"
                >

                <div class="attendance-levels">

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="1"
                        onclick="setDifficultiesLevel(1)"
                    >
                        <span class="level-number">1</span>
                        <span class="level-label">Quase nada</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="2"
                        onclick="setDifficultiesLevel(2)"
                    >
                        <span class="level-number">2</span>
                        <span class="level-label">Muito pouco</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="3"
                        onclick="setDifficultiesLevel(3)"
                    >
                        <span class="level-number">3</span>
                        <span class="level-label">Pouco</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="4"
                        onclick="setDifficultiesLevel(4)"
                    >
                        <span class="level-number">4</span>
                        <span class="level-label">Bom</span>
                    </button>

                    <button
                        type="button"
                        class="attendance-level"
                        data-level="5"
                        onclick="setDifficultiesLevel(5)"
                    >
                        <span class="level-number">5</span>
                        <span class="level-label">Excelente</span>
                    </button>

                </div>

                @error('difficulties_level')
                    <span class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
                @enderror

            </div>

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
    #skills,
    #skills_evolution,
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
    #skills:focus,
    #skills_evolution:focus,
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
       NÍVEIS
       ========================================================= */

    .attendance-level-container {
        display: none;

        padding: 15px;
        border: 1px solid #E1E7EC;
        border-radius: 10px;
        background: #F8FAF9;
    }


    .attendance-levels {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 8px;
    }


    .attendance-level {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        min-height: 72px;
        padding: 8px 6px;

        border: 1px solid #D7DEE5;
        border-radius: 8px;

        background: #FFFFFF;
        color: #334E68;

        cursor: pointer;

        transition:
            background-color .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .15s ease;
    }


    .attendance-level:hover {
        border-color: #3B7D5A;
        background: #EDF5F0;
        color: #2F684A;
        transform: translateY(-1px);
    }


    .attendance-level.is-selected {
        background: #3B7D5A;
        border-color: #3B7D5A;
        color: #FFFFFF;
    }


    .level-number {
        font-size: 18px;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 5px;
    }


    .level-label {
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        line-height: 1.2;
    }


    @media (max-width: 768px) {

        .attendance-levels {
            grid-template-columns: 1fr;
        }

        .attendance-level {
            flex-direction: row;
            justify-content: flex-start;
            gap: 10px;
            min-height: 48px;
            padding: 10px 14px;
        }

        .level-number {
            margin-bottom: 0;
            min-width: 22px;
        }

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

        const statusInput =
            document.getElementById('advances_status');

        const textarea =
            document.getElementById('advances');

        const levelContainer =
            document.getElementById('advancesLevelContainer');

        const levelInput =
            document.getElementById('advances_level');

        const yesButton =
            document.getElementById('advancesYes');

        const noButton =
            document.getElementById('advancesNo');

        if (
            !statusInput ||
            !textarea ||
            !levelContainer ||
            !levelInput ||
            !yesButton ||
            !noButton
        ) {
            return;
        }

        statusInput.value = status;

        if (status === 'Sim') {

            textarea.disabled = false;
            textarea.required = true;

            levelContainer.style.display = 'block';

            yesButton.classList.add('is-selected');
            noButton.classList.remove('is-selected');

        } else {

            textarea.disabled = true;
            textarea.required = false;
            textarea.value = '';

            levelInput.value = '';

            clearLevelSelection('advances');

            levelContainer.style.display = 'none';

            noButton.classList.add('is-selected');
            yesButton.classList.remove('is-selected');

        }
    }


    /* =========================================================
       NÍVEL DOS AVANÇOS
       ========================================================= */

    function setAdvancesLevel(level) {

        const input =
            document.getElementById('advances_level');

        if (!input) {
            return;
        }

        input.value = level;

        document
            .querySelectorAll('#advancesLevelContainer .attendance-level')
            .forEach(button => {

                button.classList.toggle(
                    'is-selected',
                    Number(button.dataset.level) === Number(level)
                );

            });
    }


    /* =========================================================
       BOTÕES SIM / NÃO - DIFICULDADES
       ========================================================= */

    function setDifficultiesStatus(status) {

        const statusInput =
            document.getElementById('difficulties_status');

        const textarea =
            document.getElementById('difficulties');

        const levelContainer =
            document.getElementById('difficultiesLevelContainer');

        const levelInput =
            document.getElementById('difficulties_level');

        const yesButton =
            document.getElementById('difficultiesYes');

        const noButton =
            document.getElementById('difficultiesNo');

        if (
            !statusInput ||
            !textarea ||
            !levelContainer ||
            !levelInput ||
            !yesButton ||
            !noButton
        ) {
            return;
        }

        statusInput.value = status;

        if (status === 'Sim') {

            textarea.disabled = false;
            textarea.required = true;

            levelContainer.style.display = 'block';

            yesButton.classList.add('is-selected');
            noButton.classList.remove('is-selected');

        } else {

            textarea.disabled = true;
            textarea.required = false;
            textarea.value = '';

            levelInput.value = '';

            clearLevelSelection('difficulties');

            levelContainer.style.display = 'none';

            noButton.classList.add('is-selected');
            yesButton.classList.remove('is-selected');

        }
    }


    /* =========================================================
       NÍVEL DAS DIFICULDADES
       ========================================================= */

    function setDifficultiesLevel(level) {

        const input =
            document.getElementById('difficulties_level');

        if (!input) {
            return;
        }

        input.value = level;

        document
            .querySelectorAll('#difficultiesLevelContainer .attendance-level')
            .forEach(button => {

                button.classList.toggle(
                    'is-selected',
                    Number(button.dataset.level) === Number(level)
                );

            });
    }


    /* =========================================================
       LIMPAR SELEÇÃO DE NÍVEL
       ========================================================= */

    function clearLevelSelection(type) {

        const containerId =
            type === 'advances'
                ? 'advancesLevelContainer'
                : 'difficultiesLevelContainer';

        const container =
            document.getElementById(containerId);

        if (!container) {
            return;
        }

        container
            .querySelectorAll('.attendance-level')
            .forEach(button => {
                button.classList.remove('is-selected');
            });
    }


    /* =========================================================
       NÃO REALIZOU A ATIVIDADE
       ========================================================= */

    function toggleActivityDescription() {

        const checkbox =
            document.getElementById('activity_not_performed');

        const textarea =
            document.getElementById('activity_description');

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

        const advancesLevel =
            document.getElementById('advances_level')?.value;

        const difficultiesLevel =
            document.getElementById('difficulties_level')?.value;


        setAdvancesStatus(advancesStatus);

        setDifficultiesStatus(difficultiesStatus);

        toggleActivityDescription();


        if (
            advancesStatus === 'Sim' &&
            advancesLevel
        ) {
            setAdvancesLevel(Number(advancesLevel));
        }


        if (
            difficultiesStatus === 'Sim' &&
            difficultiesLevel
        ) {
            setDifficultiesLevel(Number(difficultiesLevel));
        }


        const dateInput =
            document.getElementById('date');

        if (dateInput && dateInput.value) {
            formatarData(dateInput);
        }

    });

</script>