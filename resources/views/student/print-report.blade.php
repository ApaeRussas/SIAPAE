<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Relatório do estudante - {{ $student->name }}
    </title>

    <style>

        @page {
            size: A4 portrait;
            margin: 12mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
        }

        body {
            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #334E68;
            font-size: 12px;
            line-height: 1.5;
        }

        .report {
            width: 100%;
        }

        .header {
            border-bottom: 2px solid #3B7D5A;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .system {
            color: #3B7D5A;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        h1 {
            margin: 4px 0 2px;
            color: #102A43;
            font-size: 24px;
        }

        .subtitle {
            color: #66788A;
            font-size: 12px;
        }

        .student-header {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 18px;
            align-items: center;

            padding: 16px;
            margin-bottom: 18px;

            border: 1px solid #DCEBE2;
            border-radius: 12px;

            background: #F8FAF9;
        }

        .student-photo {
            width: 80px;
            height: 80px;
            object-fit: cover;

            border-radius: 10px;
            border: 2px solid #DCEBE2;
        }

        .student-name {
            color: #102A43;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .student-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px 20px;
        }

        .meta-label,
        .label {
            color: #66788A;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .meta-value,
        .value {
            color: #102A43;
            font-size: 12px;
            font-weight: 600;
        }

        .section {
            margin-top: 18px;
            border: 1px solid #E1E7EC;
            border-radius: 10px;
            overflow: hidden;

            break-inside: avoid;
            page-break-inside: avoid;
        }

        .section-title {
            padding: 12px 14px;

            background: #EDF5F0;
            border-bottom: 1px solid #DCEBE2;

            color: #2F684A;
            font-size: 15px;
            font-weight: 700;
        }

        .section-content {
            padding: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px 22px;
        }

        .field {
            min-width: 0;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .text {
            white-space: pre-line;
            color: #334E68;
        }

                .diagnostic-record {
            break-inside: auto;
            page-break-inside: auto;
        }

        .diagnostic-group {
            margin-bottom: 12px;
            padding: 10px;
            border: 1px solid #E1E7EC;
            border-radius: 8px;
            background: #FAFCFB;

            break-inside: avoid;
            page-break-inside: avoid;
        }

        .diagnostic-group:last-child {
            margin-bottom: 0;
        }

        .diagnostic-group-title {
            margin-bottom: 7px;
            color: #2F684A;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .diagnostic-item {
            display: grid;
            grid-template-columns: minmax(140px, 35%) 1fr;
            gap: 8px;
            padding: 5px 0;
            border-bottom: 1px solid #EDF0F2;

            break-inside: avoid;
            page-break-inside: avoid;
        }

        .diagnostic-item:last-child {
            border-bottom: 0;
        }

        .diagnostic-item-label {
            color: #66788A;
            font-size: 10px;
            font-weight: 700;
        }

        .diagnostic-item-value {
            color: #334E68;
            font-size: 11px;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .diagnostic-simple-field {
            padding: 8px 10px;
            border: 1px solid #E1E7EC;
            border-radius: 8px;
            background: #FAFCFB;

            break-inside: avoid;
            page-break-inside: avoid;
        }

        .diagnostic-json {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        @media print {

            .diagnostic-record {
                break-inside: auto;
                page-break-inside: auto;
            }

            .diagnostic-group,
            .diagnostic-item,
            .diagnostic-simple-field {
                break-inside: avoid;
                page-break-inside: avoid;
            }

        }

        .record {
            padding: 14px 0;
            border-bottom: 1px solid #E1E7EC;

            break-inside: avoid;
            page-break-inside: avoid;
        }

        .record:first-child {
            padding-top: 0;
        }

        .record:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .record-header {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 10px;
        }

        .record-title {
            color: #102A43;
            font-size: 13px;
            font-weight: 700;
        }

        .record-date {
            color: #3B7D5A;
            font-weight: 700;
        }

        .record-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 18px;
        }

        .indicator-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        .indicator {
            padding: 12px;
            border: 1px solid #DCEBE2;
            border-radius: 8px;
            background: #F8FAF9;
        }

        .indicator-number {
            margin-top: 3px;
            color: #2F684A;
            font-size: 20px;
            font-weight: 700;
        }

        .frequency-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .frequency-box {
            padding: 12px;
            border: 1px solid #E1E7EC;
            border-radius: 8px;
        }

        .frequency-number {
            font-size: 20px;
            font-weight: 700;
            color: #102A43;
        }

        .empty {
            color: #66788A;
            font-style: italic;
        }

        .footer {
            margin-top: 24px;
            padding-top: 10px;
            border-top: 1px solid #E1E7EC;

            display: flex;
            justify-content: space-between;

            color: #66788A;
            font-size: 9px;
        }

        @media print {

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

        }

    </style>

</head>


<body>

<div class="report">

    {{-- =========================================================
         CABEÇALHO
         ========================================================= --}}

    <div class="header">

        <div class="system">
            SIAPAE
        </div>

        <h1>
            Relatório do estudante
        </h1>

        <div class="subtitle">
            Relatório completo de acompanhamento escolar e pedagógico.
        </div>

    </div>


    {{-- =========================================================
         IDENTIFICAÇÃO
         ========================================================= --}}

    <div class="student-header">

        <div>

            @php
                $studentImage = $student->image
                    ? asset('img/student/' . $student->image)
                    : asset('img/student/Foto_Desconhecido.jpg');
            @endphp

            <img
                src="{{ $studentImage }}"
                class="student-photo"
                alt="Foto do estudante"
            >

        </div>


        <div>

            <div class="student-name">
                {{ $student->name }}
            </div>

            <div class="student-meta">

                <div>
                    <div class="meta-label">
                        ID
                    </div>

                    <div class="meta-value">
                        {{ $student->id ?? 'Não informado' }}
                    </div>
                </div>


                <div>
                    <div class="meta-label">
                        SIGE
                    </div>

                    <div class="meta-value">
                        {{ $student->sige ?: 'Não informado' }}
                    </div>
                </div>


                <div>
                    <div class="meta-label">
                        Nascimento
                    </div>

                    <div class="meta-value">
                        {{ $student->date_of_birth
                            ? \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y')
                            : 'Não informado'
                        }}
                    </div>
                </div>


                <div>
                    <div class="meta-label">
                        Idade
                    </div>

                    <div class="meta-value">
                        {{ $studentAge }}
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         1. INFORMAÇÕES PESSOAIS
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            1. Informações pessoais
        </div>

        <div class="section-content">

            <div class="grid">

                <div class="field">
                    <div class="label">Nome completo</div>
                    <div class="value">{{ $student->name }}</div>
                </div>


                <div class="field">
                    <div class="label">Nome social</div>
                    <div class="value">
                        {{ $student->social_name ?: 'Não informado' }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Data de nascimento</div>
                    <div class="value">
                        {{ $student->date_of_birth
                            ? \Carbon\Carbon::parse($student->date_of_birth)->format('d/m/Y')
                            : 'Não informado'
                        }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Idade</div>
                    <div class="value">
                        {{ $studentAge }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">CPF</div>
                    <div class="value">
                        {{ $student->cpf ?: 'Não informado' }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Nome da mãe</div>
                    <div class="value">
                        {{ $student->mother_name ?: 'Não informado' }}
                    </div>
                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         2. SITUAÇÃO ESCOLAR / APAE
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            2. Situação escolar e na APAE
        </div>

        <div class="section-content">

            <div class="grid">

                <div class="field">
                    <div class="label">Situação</div>
                    <div class="value">
                        {{ $student->state_student === 'archived' ? 'Arquivado' : 'Ativo' }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Diagnóstico</div>
                    <div class="value">
                        {{ $student->diagnostic ?: 'Não informado' }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Serviço</div>
                    <div class="value">
                        {{ $student->service ?: 'Não informado' }}
                    </div>
                </div>


                <div class="field">
                    <div class="label">Turno APAE</div>
                    <div class="value">
                        {{ $student->turn_apae ?: 'Não informado' }}
                    </div>
                </div>


                <div class="field field-full">
                    <div class="label">Escola</div>
                    <div class="value">
                        {{ $student->school ?: 'Não informado' }}
                    </div>
                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         3. ATENDIMENTOS
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            3. Atendimentos
        </div>

        <div class="section-content">

            @forelse ($studentAttendances as $attendance)

                <div class="record">

                    <div class="record-header">

                        <div class="record-title">
                            Atendimento
                        </div>

                        <div class="record-date">
                            {{ $attendance->date
                                ? \Carbon\Carbon::parse($attendance->date)->format('d/m/Y')
                                : 'Data não informada'
                            }}
                        </div>

                    </div>


                    <div class="record-grid">

                        <div class="field">
                            <div class="label">
                                Professor / responsável
                            </div>

                            <div class="value">
                                {{ $attendance->professor->name ?? 'Não informado' }}
                            </div>
                        </div>


                        <div class="field">
                            <div class="label">
                                Eixo educacional
                            </div>

                            <div class="value">
                                {{ $attendance->educational_axis ?: 'Não informado' }}
                            </div>
                        </div>


                        @if (!empty($attendance->skills))

                            <div class="field field-full">

                                <div class="label">
                                    Habilidades
                                </div>

                                <div class="text">
                                    {{ $attendance->skills }}
                                </div>

                            </div>

                        @endif


                        @if (!empty($attendance->skills_evolution))

                            <div class="field field-full">

                                <div class="label">
                                    Evolução das habilidades
                                </div>

                                <div class="text">
                                    {{ $attendance->skills_evolution }}
                                </div>

                            </div>

                        @endif


                        @if (!empty($attendance->advances))

                            <div class="field">

                                <div class="label">
                                    Avanços
                                </div>

                                <div class="text">
                                    {{ $attendance->advances }}
                                </div>

                            </div>

                        @endif


                        @if (!empty($attendance->difficulties))

                            <div class="field">

                                <div class="label">
                                    Dificuldades
                                </div>

                                <div class="text">
                                    {{ $attendance->difficulties }}
                                </div>

                            </div>

                        @endif


                        @if (!is_null($attendance->advances_level))

                            <div class="field">

                                <div class="label">
                                    Nível dos avanços
                                </div>

                                <div class="value">
                                    {{ $attendance->advances_level }}
                                </div>

                            </div>

                        @endif


                        @if (!is_null($attendance->difficulties_level))

                            <div class="field">

                                <div class="label">
                                    Nível das dificuldades
                                </div>

                                <div class="value">
                                    {{ $attendance->difficulties_level }}
                                </div>

                            </div>

                        @endif


                        @if (!empty($attendance->activity_description))

                            <div class="field field-full">

                                <div class="label">
                                    Atividade
                                </div>

                                <div class="text">
                                    {{ $attendance->activity_description }}
                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            @empty

                <div class="empty">
                    Nenhum atendimento registrado para este estudante.
                </div>

            @endforelse

        </div>

    </section>


    {{-- =========================================================
         4. FREQUÊNCIA
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            4. Frequência — {{ $frequencyMonthYear }}
        </div>

        <div class="section-content">

            <div class="frequency-summary">

                <div class="frequency-box">

                    <div class="label">
                        Presenças
                    </div>

                    <div class="frequency-number">
                        {{ $frequencyPresent }}
                    </div>

                </div>


                <div class="frequency-box">

                    <div class="label">
                        Faltas
                    </div>

                    <div class="frequency-number">
                        {{ $frequencyAbsent }}
                    </div>

                </div>


                <div class="frequency-box">

                    <div class="label">
                        Sem registro
                    </div>

                    <div class="frequency-number">
                        {{ $frequencyNotRegistered }}
                    </div>

                </div>

            </div>


            @if ($studentFrequency)

                <div style="margin-top: 15px;">

                    <div class="label" style="margin-bottom: 8px;">
                        Registro diário
                    </div>

                    <div class="grid">

                        @for ($day = 1; $day <= $numberDaysInMonth; $day++)

                            @php
                                $currentDate = \Carbon\Carbon::create(
                                    $frequencyYear,
                                    $frequencyMonth,
                                    $day
                                );

                                $dayValue =
                                    $studentFrequency->{$day};

                                if ($dayValue === true) {
                                    $status = '✓ Presente';
                                } elseif ($dayValue === false) {
                                    $status = '× Falta';
                                } else {
                                    $status = '— Sem registro';
                                }
                            @endphp

                            <div class="field">

                                <div class="label">
                                    {{ $currentDate->format('d/m/Y') }}
                                </div>

                                <div class="value">
                                    {{ $status }}
                                </div>

                            </div>

                        @endfor

                    </div>

                </div>

            @else

                <p class="empty" style="margin-top: 14px;">
                    Nenhum registro de frequência encontrado para este mês.
                </p>

            @endif

        </div>

    </section>


       {{-- =========================================================
         5. SONDAGENS
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            5. Sondagens
        </div>

        <div class="section-content">

            @php
                /*
                |--------------------------------------------------------------------------
                | Funções auxiliares para apresentar os dados da sondagem
                | de forma legível no relatório.
                |--------------------------------------------------------------------------
                */

                $diagnosticLabels = [
                    'age' => 'Idade',
                    'series' => 'Série',
                    'school' => 'Escola',
                    'cid' => 'CID',
                    'date' => 'Data',
                    'language' => 'Linguagem',
                    'logical_mathematical' => 'Lógico-matemático',
                    'functional_life' => 'Vida funcional',
                    'body_experience' => 'Experiência corporal',
                    'nature_society' => 'Natureza e sociedade',
                    'educational_informatics' => 'Informática educacional',
                    'cognitive' => 'Cognitivo',
                ];

                $diagnosticItemLabels = [
                    'simple_word' => 'Palavra simples',
                    'writing_level' => 'Nível de escrita',
                    'paragraph_text_interprets' => 'Interpretação de texto',
                    'subtraction' => 'Subtração',
                    'addition' => 'Adição',
                    'multiplication' => 'Multiplicação',
                    'division' => 'Divisão',
                    'circle' => 'Círculo',
                    'square' => 'Quadrado',
                    'triangle' => 'Triângulo',
                    'rectangle' => 'Retângulo',
                    'above_below' => 'Acima / abaixo',
                    'much_little' => 'Muito / pouco',
                    'behind_front' => 'Atrás / frente',
                    'inside_outside' => 'Dentro / fora',
                    'identifies_number_position' => 'Identificação de posição numérica',
                    'identifies_number' => 'Identificação de número',
                    'number_sequence' => 'Sequência numérica',
                    'buckle_close' => 'Fechar fivela',
                    'hygiene_objects' => 'Objetos de higiene',
                    'body_parts' => 'Partes do corpo',
                    'dominant_side' => 'Lado dominante',
                    'drawing_phase' => 'Fase do desenho',
                    'facial_expression' => 'Expressão facial',
                    'traffic_signs' => 'Sinais de trânsito',
                    'left' => 'Esquerda',
                    'school' => 'Escola',
                    'traffic_light_colors' => 'Cores do semáforo',
                    'personal_objects_care' => 'Cuidado com objetos pessoais',
                    'computer' => 'Computador',
                    'story_sequence' => 'Sequência de história',
                    'time_knowledge' => 'Conhecimento de tempo',
                    'day' => 'Dia',
                    'month' => 'Mês',
                    'year' => 'Ano',
                    'sustained_attention' => 'Atenção sustentada',
                ];

                $formatDiagnosticLabel = function ($key) use (
                    $diagnosticLabels,
                    $diagnosticItemLabels
                ) {
                    if (isset($diagnosticLabels[$key])) {
                        return $diagnosticLabels[$key];
                    }

                    if (isset($diagnosticItemLabels[$key])) {
                        return $diagnosticItemLabels[$key];
                    }

                    return ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            (string) $key
                        )
                    );
                };

                $formatDiagnosticValue = function ($value) {
                    if ($value === null || $value === '') {
                        return 'Não informado';
                    }

                    if (is_bool($value)) {
                        return $value ? 'Sim' : 'Não';
                    }

                    return (string) $value;
                };

                $renderDiagnosticData = function (
                    $data,
                    $level = 0
                ) use (
                    &$renderDiagnosticData,
                    $formatDiagnosticLabel,
                    $formatDiagnosticValue
                ) {
                    if (!is_array($data)) {
                        return '';
                    }

                    $html = '';

                    foreach ($data as $key => $value) {

                        $label = $formatDiagnosticLabel($key);

                        if (is_array($value)) {

                            $html .= '<div class="diagnostic-group">';

                            $html .=
                                '<div class="diagnostic-group-title">'
                                . e($label)
                                . '</div>';

                            $html .= $renderDiagnosticData(
                                $value,
                                $level + 1
                            );

                            $html .= '</div>';

                        } else {

                            $html .= '<div class="diagnostic-item">';

                            $html .=
                                '<div class="diagnostic-item-label">'
                                . e($label)
                                . '</div>';

                            $html .=
                                '<div class="diagnostic-item-value">'
                                . e($formatDiagnosticValue($value))
                                . '</div>';

                            $html .= '</div>';
                        }
                    }

                    return $html;
                };
            @endphp


            @forelse ($diagnosticAssessments as $assessment)

                <div class="record diagnostic-record">

                    <div class="record-header">

                        <div class="record-title">
                            Sondagem diagnóstica
                        </div>

                        <div class="record-date">

                            {{ $assessment->date
                                ? \Carbon\Carbon::parse($assessment->date)->format('d/m/Y')
                                : 'Data não informada'
                            }}

                        </div>

                    </div>


                    @php
                        $diagnosticFields = [
                            'id',
                            'student_id',
                            'created_at',
                            'updated_at',
                            'date',
                        ];
                    @endphp


                    <div class="record-grid">

                        @foreach ($assessment->getAttributes() as $field => $value)

                            @if (
                                !in_array($field, $diagnosticFields)
                                && !is_null($value)
                                && $value !== ''
                            )

                                @php
                                    $decodedValue = null;
                                    $isJson = false;

                                    if (is_string($value)) {
                                        $decoded = json_decode(
                                            $value,
                                            true
                                        );

                                        if (
                                            json_last_error() === JSON_ERROR_NONE
                                            && is_array($decoded)
                                        ) {
                                            $decodedValue = $decoded;
                                            $isJson = true;
                                        }
                                    }

                                    $fieldLabel = $formatDiagnosticLabel($field);
                                @endphp


                                @if ($isJson)

                                    <div class="field field-full">

                                        <div class="label" style="margin-bottom: 8px;">
                                            {{ $fieldLabel }}
                                        </div>

                                        <div class="diagnostic-json">

                                            {!! $renderDiagnosticData($decodedValue) !!}

                                        </div>

                                    </div>

                                @else

                                    <div class="diagnostic-simple-field">

                                        <div class="label">
                                            {{ $fieldLabel }}
                                        </div>

                                        <div class="text" style="margin-top: 4px;">
                                            {{ $value }}
                                        </div>

                                    </div>

                                @endif

                            @endif

                        @endforeach

                    </div>

                </div>

            @empty

                <div class="empty">
                    Nenhuma sondagem registrada para este estudante.
                </div>

            @endforelse

        </div>

    </section>

    {{-- =========================================================
         6. EVOLUÇÃO
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            6. Evolução do estudante
        </div>

        <div class="section-content">

            @if ($evolutionTotal > 0)

                <div class="indicator-grid">

                    <div class="indicator">

                        <div class="label">
                            Atendimentos analisados
                        </div>

                        <div class="indicator-number">
                            {{ $evolutionTotal }}
                        </div>

                    </div>


                    <div class="indicator">

                        <div class="label">
                            Registros com avanços
                        </div>

                        <div class="indicator-number">
                            {{ $evolutionWithAdvances }}
                        </div>

                    </div>


                    <div class="indicator">

                        <div class="label">
                            Evolução de habilidades
                        </div>

                        <div class="indicator-number">
                            {{ $evolutionWithSkills }}
                        </div>

                    </div>


                    <div class="indicator">

                        <div class="label">
                            Dificuldades registradas
                        </div>

                        <div class="indicator-number">
                            {{ $evolutionWithDifficulties }}
                        </div>

                    </div>

                </div>


                <div style="margin-top: 16px;">

                    <div class="grid">

                        <div class="field">

                            <div class="label">
                                Primeiro nível de avanços
                            </div>

                            <div class="value">
                                {{ $firstAdvancesLevel ?: 'Não informado' }}
                            </div>

                        </div>


                        <div class="field">

                            <div class="label">
                                Nível atual de avanços
                            </div>

                            <div class="value">
                                {{ $latestAdvancesLevel ?: 'Não informado' }}
                            </div>

                        </div>


                        <div class="field">

                            <div class="label">
                                Primeiro nível de dificuldades
                            </div>

                            <div class="value">
                                {{ $firstDifficultiesLevel ?: 'Não informado' }}
                            </div>

                        </div>


                        <div class="field">

                            <div class="label">
                                Nível atual de dificuldades
                            </div>

                            <div class="value">
                                {{ $latestDifficultiesLevel ?: 'Não informado' }}
                            </div>

                        </div>


                        <div class="field">

                            <div class="label">
                                Atividades realizadas
                            </div>

                            <div class="value">
                                {{ $evolutionActivitiesPerformed }}
                            </div>

                        </div>


                        <div class="field">

                            <div class="label">
                                Atividades não realizadas
                            </div>

                            <div class="value">
                                {{ $evolutionActivitiesNotPerformed }}
                            </div>

                        </div>

                    </div>

                </div>


                @if ($evolutionAxes->count())

                    <div style="margin-top: 16px;">

                        <div class="label" style="margin-bottom: 8px;">
                            Eixos educacionais acompanhados
                        </div>

                        @foreach ($evolutionAxes as $axis => $total)

                            <div class="field" style="margin-bottom: 6px;">

                                <span class="value">
                                    {{ $axis }}
                                </span>

                                <span>
                                    — {{ $total }} registro(s)
                                </span>

                            </div>

                        @endforeach

                    </div>

                @endif


                <div style="margin-top: 18px;">

                    <div class="label" style="margin-bottom: 8px;">
                        Histórico de evolução
                    </div>


                    @foreach ($evolutionAttendances as $attendance)

                        <div class="record">

                            <div class="record-header">

                                <div class="record-title">
                                    {{ $attendance->professor->name ?? 'Professor não informado' }}
                                </div>

                                <div class="record-date">
                                    {{ $attendance->date
                                        ? \Carbon\Carbon::parse($attendance->date)->format('d/m/Y')
                                        : 'Data não informada'
                                    }}
                                </div>

                            </div>


                            @if (!empty($attendance->advances))

                                <div class="field field-full">

                                    <div class="label">
                                        Avanços
                                    </div>

                                    <div class="text">
                                        {{ $attendance->advances }}
                                    </div>

                                </div>

                            @endif


                            @if (!empty($attendance->skills_evolution))

                                <div class="field field-full">

                                    <div class="label">
                                        Evolução das habilidades
                                    </div>

                                    <div class="text">
                                        {{ $attendance->skills_evolution }}
                                    </div>

                                </div>

                            @endif


                            @if (!empty($attendance->difficulties))

                                <div class="field field-full">

                                    <div class="label">
                                        Dificuldades
                                    </div>

                                    <div class="text">
                                        {{ $attendance->difficulties }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty">
                    Ainda não existem atendimentos suficientes para gerar uma análise de evolução.
                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         7. EVOLUÇÕES PEDAGÓGICAS
         ========================================================= --}}

    <section class="section">

        <div class="section-title">
            7. Registros pedagógicos
        </div>

        <div class="section-content">

            @forelse ($pedagogicals as $pedagogical)

                <div class="record">

                    <div class="record-header">

                        <div class="record-title">

                            {{ $pedagogical->professor->name ?? 'Professor não informado' }}

                        </div>

                        <div class="record-date">

                            {{ $pedagogical->date_pedagogical
                                ? \Carbon\Carbon::parse($pedagogical->date_pedagogical)->format('d/m/Y')
                                : 'Data não informada'
                            }}

                        </div>

                    </div>


                    <div class="record-grid">

                        @foreach ($pedagogical->getAttributes() as $field => $value)

                            @if (
                                !in_array(
                                    $field,
                                    [
                                        'id',
                                        'student_id',
                                        'created_at',
                                        'updated_at'
                                    ]
                                )
                                && !is_null($value)
                                && $value !== ''
                            )

                                <div class="field">

                                    <div class="label">
                                        {{ str_replace('_', ' ', $field) }}
                                    </div>

                                    <div class="text">
                                        {{ $value }}
                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>

            @empty

                <div class="empty">
                    Nenhum registro pedagógico encontrado.
                </div>

            @endforelse

        </div>

    </section>


    <div class="footer">

        <span>
            SIAPAE — Relatório do estudante
        </span>

        <span>
            Gerado em {{ now()->format('d/m/Y H:i') }}
        </span>

    </div>

</div>


<script>

    window.onload = function () {

        setTimeout(function () {

            window.print();

        }, 500);

    };

</script>

</body>

</html>