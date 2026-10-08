<x-app-layout>
    <div class="educational-create-page">
        <x-table-create title="Relatório Pedagógico" onlyHead actionRoute="educational">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- ESTUDANTE --}}
            <div>
                <label for="student_id" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Estudante
                </label>

                <select
                    name="student_id"
                    id="student_id"
                    required
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68] focus:border-[#3B7D5A] focus:ring-[#3B7D5A]"
                >
                    <option value="">Selecione o estudante</option>

                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- DATA DE NASCIMENTO --}}
            <div>
                <label for="date_of_birth" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Data de Nascimento
                </label>

                <input
                    type="text"
                    id="date_of_birth"
                    readonly
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- ESCOLA --}}
            <div>
                <label for="school" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Escola
                </label>

                <input
                    type="text"
                    name="school"
                    id="school"
                    required
                    readonly
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- SÉRIE --}}
            <div>
                <label for="grade_school" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Série
                </label>

                <input
                    type="text"
                    name="grade_school"
                    id="grade_school"
                    required
                    readonly
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- TURNO --}}
            <div>
                <label for="turn_school" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Turno
                </label>

                <input
                    type="text"
                    name="turn_school"
                    id="turn_school"
                    required
                    readonly
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- IDADE --}}
            <div>
                <label for="age" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Idade
                </label>

                <input
                    type="text"
                    name="age"
                    id="age"
                    required
                    readonly
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- ANO LETIVO --}}
            <div>
                <label for="school_year" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Ano Letivo
                </label>

                <input
                    type="text"
                    name="school_year"
                    id="school_year"
                    value="{{ old('school_year', date('Y')) }}"
                    required
                    maxlength="20"
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- PERÍODO --}}
            <div>
                <label for="period" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Período
                </label>

                <select
                    name="period"
                    id="period"
                    required
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
                    <option value="">Selecione o período</option>
                    <option value="1º Semestre" {{ old('period') === '1º Semestre' ? 'selected' : '' }}>
                        1º Semestre
                    </option>
                    <option value="2º Semestre" {{ old('period') === '2º Semestre' ? 'selected' : '' }}>
                        2º Semestre
                    </option>
                    <option value="Anual" {{ old('period') === 'Anual' ? 'selected' : '' }}>
                        Anual
                    </option>
                </select>
            </div>

            {{-- DATA DO RELATÓRIO --}}
            <div>
                <label for="date_pedagogical" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Data do Relatório
                </label>

                <input
                    type="text"
                    name="date_pedagogical"
                    id="date_pedagogical"
                    value="{{ old('date_pedagogical', date('d/m/Y')) }}"
                    required
                    maxlength="10"
                    placeholder="dd/mm/aaaa"
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
            </div>

            {{-- PROFESSOR --}}
            <div>
                <label for="signature_id" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Professor Responsável
                </label>

                <select
                    name="signature_id"
                    id="signature_id"
                    required
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-2.5 text-[#334E68]"
                >
                    <option value="">Selecione o professor</option>

                    @foreach ($professors as $professor)
                        <option
                            value="{{ $professor->id }}"
                            data-name="{{ $professor->name }}"
                            {{ old('signature_id') == $professor->id ? 'selected' : '' }}
                        >
                            {{ $professor->name }}
                        </option>
                    @endforeach
                </select>

                <input
                    type="hidden"
                    name="professor_signature"
                    id="professor_signature"
                    value="{{ old('professor_signature') }}"
                >
            </div>

            {{-- RELATÓRIO PEDAGÓGICO --}}
            <div class="md:col-span-2">
                <label for="text" class="block text-sm font-semibold text-[#334E68] mb-2">
                    Relatório Pedagógico
                </label>

                <textarea
                    name="text"
                    id="text"
                    rows="10"
                    required
                    maxlength="10000"
                    placeholder="Descreva o desenvolvimento do estudante, aprendizagem, participação, avanços, dificuldades, observações e demais informações relevantes."
                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-4 py-3 text-[#334E68] resize-y"
                >{{ old('text') }}</textarea>

                <div class="mt-1 text-right text-xs text-[#7A867E]">
                    Máximo de 10.000 caracteres.
                </div>
            </div>

        </div>

    </x-table-create>
</div>

<style>
    .educational-create-page {
        background-color: #EAF3ED;
        min-height: calc(100vh - 64px);
        padding-bottom: 2rem;
    }

    .educational-create-page .bg-white {
        background-color: #FFFFFF !important;
    }

    .educational-create-page input,
    .educational-create-page select,
    .educational-create-page textarea {
        background-color: #FFFFFF !important;
        color: #334E68 !important;
        border-color: #D7DEE5 !important;
    }

    .educational-create-page input:focus,
    .educational-create-page select:focus,
    .educational-create-page textarea:focus {
        border-color: #3B7D5A !important;
        box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        outline: none !important;
    }

    .educational-create-page button[type="submit"] {
        background-color: #3B7D5A !important;
        border-color: #3B7D5A !important;
        color: #FFFFFF !important;
    }

    .educational-create-page button[type="submit"]:hover {
        background-color: #2F684A !important;
        border-color: #2F684A !important;
    }

    .educational-create-page label {
        color: #334E68;
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
                    $('#date_of_birth').val(data.date_of_birth || '------');
                    $('#school').val(data.school || '------');
                    $('#grade_school').val(data.grade_school || '------');
                    $('#turn_school').val(data.turn_school || '------');
                    $('#age').val(data.age || '------');
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

    $('#signature_id').change(function () {
        var professorName = $(this).find('option:selected').data('name') || '';

        $('#professor_signature').val(professorName);
    });

    $('#signature_id').trigger('change');
</script>
</x-app-layout>
