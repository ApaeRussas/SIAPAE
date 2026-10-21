@php
    $process = $process ?? $development_process ?? null;

    if (!$process) {
        abort(404);
    }

    $student = $process->student;
    $teacher = $process->teacher;
    $responses = is_array($process->responses) ? $process->responses : [];

    $sections = [
        [
            'title' => '1-ASPECTOS SÓCIO-',
            'items' => [
                'INTERAGE DE FORMA POSITIVA NOS MOMENTOS COLETIVOS',
                'CONSEGUE REALIZAR ATIVIDADE SOZINHO',
                'NECESSITA DO AUXÍLIO DA PROFESSORA',
                'PARTICIPA DAS ATIVIDADES SOCIAIS: SEMANA INTERNACIONAL DA PESSOA COM DEFICIÊNCIA INTELECTUAL E MÚLTIPLA, FESTIVAL JUNINO, MOMENTO CÍVICO, CAMPANHAS BENEFICIENTES.',
                'APRESENTA EMPATIA EM SITUAÇÕES ADVERSAS',
                'SABE EXPRESSAR SUAS IDEIAS',
                'SABE SER CRIATIVO QUANDO NECESSÁRIO.',
                'ESTABELECE DIÁLOGO E É SOLÍCITO COM COLEGAS.',
                'POSSUI AUTOCONTROLE EM MOMENTOS DE FRUSTRAÇÕES ESTANDO NO COLETIVO.',
            ],
        ],
        [
            'title' => '1.1.2-ASPECTOS EMOCIONAIS',
            'items' => [
                'SABE EXPRESSAR SEUS SENTIMENTOS',
                'MANIFESTA INSEGURANÇA',
                'APRESENTA TIMIDEZ',
                'ATENDE OS CHAMADOS E AS SOLICITAÇÕES DA PROFESSORA',
                'UTILIZA ATITUDES DE CORTESIA: OBRIGADO/POR FAVOR/DESCULPA/COM LICENÇA/DEMONSTRANDO BOAS MANEIRAS.',
                'APRESENTA MUDANÇA DE COMPORTAMENTO',
                'SEGUE RECOMENDAÇÕES E ORIENTAÇÕES',
                'APRESENTA ALTERAÇÃO DE HUMOR E COMPORTAMENTO',
                'IDENTIFICA E EXPRESSA SEUS SENTIMENTOS',
                'FAZ COMENTÁRIOS OU BRINCADEIRAS INADEQUADAS',
                'FAZ COISAS DE PROPÓSITO PARA ABORRECER OUTRAS PESSOAS',
                'CULPA OS OUTROS POR SEUS ERROS OU MAU COMPORTAMENTO',
                'É FACILMENTE IRRITADO PELOS OUTROS',
                'FICA FACILMENTE ENVERGONHADO OU RESSENTIDO',
                'É RANCOROSO OU VINGATIVO',
            ],
        ],
        [
            'title' => '1.2- ASPECTOS FÍSICOS',
            'items' => [
                'RESPEITA OS LIMITES DA FOLHA',
                'TEM EQUILÍBRIO E AGILIDADE AO SE LOCOMOVER',
                'SE EXPRESSA CORPORALMENTE AO SOM DE CANÇÕES SEGUINDO COMANDOS',
                'PARTICIPA DAS ATIVIDADES PSICOMOTORAS COM INTERESSE',
                'SEGURA CORRETAMENTE O LÁPIS E PINCEL',
                'UTILIZA CORRETAMENTE A TESOURA',
                'APRESENTA DIFICULDADE PARA APANHAR PEQUENOS OBJETOS (MOVIMENTO PINÇA).',
                'CHEGA SONOLENTO AOS ATENDIMENTOS',
                'PARTICIPA DAS ATIVIDADES DE COORDENAÇÃO MOTORA AMPLA COM HABILIDADE.',
                'TEM DIFICULDADE DE ESPERAR SUA VEZ',
                'ESTÁ SEMPRE EM MOVIMENTO OU FREQUENTEMENTE AGE COMO SE ESTIVESSE “LIGADO EM UM MOTOR”',
                'DISTRAI-SE COM OS ESTÍMULOS EXTERNOS',
            ],
        ],
        [
            'title' => '2- COMUNICAÇÃO',
            'items' => [
                'UTILIZA DE QUAL COMUNICAÇÃO',
            ],
        ],
        [
            'title' => '2.1- EIXO DO CONHECIMENTO LINGUÍSTICO',
            'items' => [
                'APRECIA AULAS EM VÍDEOS E EM CANÇÕES',
                'APRECIA AULAS EXPERIMENTAIS',
                'FAZ A LEITURA INTERPRETATIVA DE VÍDEOS, CANÇÕES E CARTAZES, COMPREENDE O SOM DAS LETRAS.',
                'ARTICULA CORRETAMENTE O SOM DAS LETRAS',
                'É CAPAZ DE REPRODUZIR A LETRA ATRAVÉS DO SOM DA LETRA',
                'É CAPAZ DE INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS ASSOCIADOS AO CONCRETO.',
            ],
        ],
        [
            'title' => '2.1.2- PERSPECTIVA DO LETRAMENTO',
            'items' => [
                'TEM LEITURA DE IMAGENS POR MEIO DE: GRAVURAS/RÓTULOS/LOGOMARCAS/PANFLETOS',
                'É CAPAZ DE REPRODUZIR A ESCRITA ESPONTÂNEA ATRAVÉS DA IMAGEM.',
                'REPRESENTA SUAS IDEIAS COM CLAREZA DE ACORDO COM SEU NÍVEL.',
            ],
        ],
        [
            'title' => '3- EIXO DO CONHECIMENTO LÓGICO MATEMÁTICO',
            'items' => [
                'IDENTIFICA OS NÚMEROS',
                'IDENTIFICA AS CLASSES NUMÉRICAS',
                'RELACIONA OS NÚMEROS ÀS QUANTIDADES CORRESPONDENTES',
                'COMPREENDE O QUE É DEZENA E UNIDADE',
                'CONSEGUE QUANTIFICAR',
                'POSSUI NOÇÕES DE QUANTIDADE',
                'CONSEGUE FAZER OPERAÇÕES SIMPLES DE MULTIPLICAÇÃO E DIVISÃO',
            ],
        ],
        [
            'title' => '3.2- SISTEMA MONETÁRIO E OPERAÇÕES MATEMÁTICAS',
            'items' => [
                'RECONHECE CÉDULAS DO SISTEMA MONETÁRIO: 2,00; 5,00; 10,00; 20,00; 50,00; 100,00; 200,00',
                'RECONHECE MOEDAS DO SISTEMA MONETÁRIO: 0,05; 0,10; 0,25; 0,50; 1,00',
                'CONSEGUE DIFERENCIAR VALORES',
                'RECONHECE O MATERIAL DOURADO: CUBINHO, BARRA, PLACA, CUBO',
                'CONSEGUE RESOLVER SITUAÇÕES-PROBLEMA UTILIZANDO O DINHEIRO',
                'POSSUI NOÇÃO DE TROCO A PARTIR DOS VALORES',
            ],
        ],
        [
            'title' => '4- EIXO DO CONHECIMENTO NATUREZA E SOCIEDADE',
            'items' => [
                'ATENDE AO SER CHAMADO PELO NOME PRÓPRIO',
                'É CAPAZ DE REPRESENTAR SEU AUTORRETRATO',
                'É CAPAZ DE SE AUTORRECONHECER',
                'PARTICIPA DAS ATIVIDADES COMEMORATIVAS?',
                'RECONHECE E NOMEIA AS ESTAÇÕES DO ANO? INVERNO, VERÃO, OUTONO, PRIMAVERA',
                'SABE DIZER COMO SE ENCONTRA EMOCIONALMENTE',
                'SABE DIFERENCIAR ANIMAIS OVÍPAROS DOS MAMÍFEROS',
                'IDENTIFICA OS COMPONENTES QUÍMICOS NA SOLUÇÃO ÁGUA E SABÃO?',
                'RECONHECE OS PERSONAGENS DA HISTÓRIA DE JESUS',
                'LEIS DE TRÂNSITO: CONHECE AS SINALIZAÇÕES VERTICAIS EM PLACAS; CONHECE AS SINALIZAÇÕES HORIZONTAIS EM PLACAS; RECONHECE O SEMÁFORO DE PEDESTRE; IDENTIFICA AS CORES E FUNÇÕES DO SEMÁFORO',
            ],
        ],
        [
            'title' => '5- EIXO DO CONHECIMENTO DAS ATIVIDADES DA VIDA DIÁRIA E PRÁTICA (AVD’S E AVP’S)',
            'items' => [
                '5.1- ATIVIDADE DE ALIMENTAÇÃO',
                'SE ALIMENTA SÓ',
                'TEM RESTRIÇÃO ALIMENTAR: DIABETE, HIPERTENSÃO, CELÍACA',
                'POSSUI SELETIVIDADE ALIMENTAR',
                '5.2- ATIVIDADE DE HIGIENE',
                'SABE IDENTIFICAR OBJETOS DE HIGIENE',
                'DEMONSTRA AUTO CUIDADO?',
                'APRESENTA CUIDADOS COM A SAÚDE DO SEU CORPO',
                'COMO SE SENTE QUANDO ESTÁ COM O CORPO SUJO E O CABELO EMBARAÇADO?',
                '5.3- ATIVIDADES DE VESTUÁRIO',
                'IDENTIFICA OS TIPOS DE VESTUÁRIO',
                'VESTE-SE SOZINHO',
                'CONSEGUE RETIRAR A ROUPA SOZINHO',
                'IDENTIFICA OS LUGARES CORRETOS DE GUARDAR AS PEÇAS ÍNTIMAS DO VESTUÁRIO',
                'SABE SE CALÇAR CORRETAMENTE',
                'SABE DIFERENCIAR AS PEÇAS ÍNTIMAS LIMPAS DAS SUJAS?',
                'SABE VESTIR AS MEIAS CORRETAMENTE?',
                'COMO SE SENTE QUANDO ESTÁ COM SUAS VESTES SUJAS?',
                '5.4- VIDA PRÁTICA',
                'POSSUI ORGANIZAÇÃO AMBIENTAL',
                'UTILIZA OS AMBIENTES DE HIGIENE ADEQUADAMENTE',
                'IDENTIFICA E UTILIZA CORRETAMENTE OS OBJETOS DE LIMPEZA',
                'CONSEGUE ANDAR NA RUA COM INDEPENDÊNCIA?',
                'SABE TOMAR BANHO SOZINHO?',
                'DIFERENCIA O XAMPU DO SABONETE',
                'UTILIZA CORRETAMENTE OS PRODUTOS DE HIGIENE DO BANHO',
            ],
        ],
        [
            'title' => '5.5 EIXO DO CONHECIMENTO VIVÊNCIA CORPORAL',
            'items' => [
                'APRESENTA EQUILÍBRIO DO CORPO',
                'É CAPAZ DE REALIZAR ATIVIDADES QUE ENVOLVAM A COORDENAÇÃO MOTORA?',
                'RECONHECE AS PARTES DO CORPO',
                'MOSTROU INTERESSE PELOS JOGOS COLETIVOS: TÊNIS, FUTEBOL, VÔLEI, BASQUETE, DAMA/XADREZ',
            ],
        ],
        [
            'title' => '5.6- ASPECTOS PSICOMOTORES',
            'items' => [
                'APRESENTA EQUILÍBRIO DE MARCHA ATRAVÉS DOS COMANDOS PULAR, SALTITAR EM PERCURSOS',
                'POSSUI HABILIDADE MANUAL DE RECORTE',
                'POSSUI HABILIDADE MANUAL DE COLAGEM',
                'POSSUI IMAGEM CORPORAL',
                'POSSUI AUTO ESTIMA',
            ],
        ],
        [
            'title' => '5.7- LATERALIDADE',
            'items' => [
                'QUAL SEU LADO DOMINANTE',
                'POSSUI LATERALIDADE DE OLHO',
                'POSSUI LATERALIDADE DE MÃO',
                'POSSUI LATERALIDADE DE OUVIDO',
                'POSSUI LATERALIDADE DE PÉ',
                'IDENTIFICA DIREITA E ESQUERDA EM SI MESMO',
            ],
        ],
        [
            'title' => '5.8- ASPECTOS COGNITIVOS',
            'items' => [
                'CONSEGUE RETIRAR A DIREITA E ESQUERDA NA ...',
                'É CAPAZ DE REALIZAR A MONTAGEM DE QUEBRA-CABEÇAS',
                'É CAPAZ DE REALIZAR A MONTAGEM DE GRAVURAS',
                'É CAPAZ DE REALIZAR A MONTAGEM DE JOGOS',
                'IDENTIFICA A SOMBRA DA IMAGEM',
                'POSSUI PERCEPÇÃO NO JOGO DA MEMÓRIA',
                'POSSUI ATENÇÃO SUSTENTADA',
                'POSSUI CONCENTRAÇÃO NO MOMENTO DAS ATIVIDADES PROPOSTAS',
                'POSSUI FLEXIBILIDADE COGNITIVA',
            ],
        ],
        [
            'title' => '6- ATIVIDADES DE EDUCAÇÃO FÍSICA/PSICOMOTRICIDADE',
            'items' => [
                'RECONHECIMENTO DAS PARTES DO CORPO',
                'CONTROLE RESPIRATÓRIO',
                'COMPREENDE O CONCEITO DE DENTRO E FORA?',
                'ACEITA COM SATISFAÇÃO A ATIVIDADE COLETIVA',
                'COMPREENDE O CONCEITO DE PERTO E LONGE',
                'ACEITA COM ALEGRIA SE VER NO ESPELHO',
                'POSSUI RIGIDEZ MUSCULAR?',
                'POSSUI FLEXIBILIDADE NOS MEMBROS SUPERIORES',
                'POSSUI FLEXIBILIDADE NOS MEMBROS INFERIORES?',
            ],
        ],
        [
            'title' => '7- ARTES',
            'items' => [
                'CONHECE AS CORES PRIMÁRIAS',
                'CONHECE AS CORES SECUNDÁRIAS',
                'CONSEGUE UTILIZAR O PINCEL RESPEITANDO O LIMITE DOS ESPAÇOS DEFINIDOS PELO DESENHO?',
                'UTILIZA AS CORES COM REFERÊNCIA NOS OBJETOS DA REALIDADE',
                'POSSUI HABILIDADE COM A TESOURA?',
            ],
        ],
        [
            'title' => '8- ASPECTOS QUE CONTAM COM O AUXÍLIO DA FAMÍLIA',
            'items' => [
                'ASSIDUIDADE',
                'PONTUALIDADE',
                'USO DO UNIFORME',
                'ACOMPANHAMENTO DA AGENDA/GRUPOS DA FAMÍLIA APAE E LIVES',
            ],
        ],
    ];

    $normalizedResponses = [];

    foreach ($responses as $key => $value) {
        $normalizedResponses[mb_strtolower(trim((string) $key))] = $value;
    }

    $getResponse = function ($sectionIndex, $itemIndex, $item) use ($responses, $normalizedResponses) {
        $key = 'secao-' . $sectionIndex . '-item-' . $itemIndex;

        if (array_key_exists($key, $responses)) {
            return $responses[$key];
        }

        $normalizedItem = mb_strtolower(trim($item));

        if (array_key_exists($normalizedItem, $normalizedResponses)) {
            return $normalizedResponses[$normalizedItem];
        }

        $aliases = [
            'INTERAGE DE FORMA POSITIVA NOS MOMENTOS COLETIVOS' => 'Interage de forma positiva nos momentos coletivos',
            'CONSEGUE REALIZAR ATIVIDADE SOZINHO' => 'Consegue realizar as atividades propostas',
            'NECESSITA DO AUXÍLIO DA PROFESSORA' => 'Necessita de auxílio da professora',
            'SABE EXPRESSAR SUAS IDEIAS' => 'Sabe expressar ideias',
            'IDENTIFICA OS NÚMEROS' => 'Reconhece números',
            'RECONHECE CÉDULAS DO SISTEMA MONETÁRIO: 2,00; 5,00; 10,00; 20,00; 50,00; 100,00; 200,00' => 'Cédulas que reconhece',
            'RECONHECE MOEDAS DO SISTEMA MONETÁRIO: 0,05; 0,10; 0,25; 0,50; 1,00' => 'Moedas que reconhece',
        ];

        if (isset($aliases[$item])) {
            $alias = mb_strtolower(trim($aliases[$item]));

            if (array_key_exists($alias, $normalizedResponses)) {
                return $normalizedResponses[$alias];
            }
        }

        return null;
    };

    $date = $process->evaluation_date
        ? \Illuminate\Support\Carbon::parse($process->evaluation_date)->format('d/m/Y')
        : ($process->created_at ? $process->created_at->format('d/m/Y') : 'Não informada');

    $teacherName = $teacher?->name
        ?? $responses['professora']
        ?? 'Não informado';

    $shift = $responses['turno'] ?? 'Não informado';
@endphp

<x-app-layout>
    <div class="dp-show mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

        <div class="dp-actions mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-green-800 dark:text-green-300">
                    Atendimento · CAEE
                </p>
                <h1 class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Registro de Processo de Desenvolvimento Individual CAEE
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                    Consulte o documento digital com os tópicos, perguntas e respostas registrados.
                </p>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('development-processes.index') }}" class="dp-button dp-secondary">
                    Voltar
                </a>

                <a href="{{ route('development-processes.edit', $process) }}" class="dp-button dp-secondary">
                    Editar registro
                </a>

                <button type="button" onclick="window.print()" class="dp-button dp-primary">
                    Imprimir documento
                </button>
            </div>
        </div>

        <main id="development-process-document">

            <section class="dp-card dp-identification">
                <div class="dp-institution">
                    <h2>CAEE: CENTRO DE ATENDIMENTO EDUCACIONAL ESPECIALIZADO JOSÉ ALVES DOS SANTOS</h2>
                    <h3>REGISTRO DE PROCESSO DE DESENVOLVIMENTO INDIVIDUAL CAEE</h3>
                </div>

                <div class="dp-identification-grid">
                    <div class="dp-information">
                        <span>NOME:</span>
                        <strong>{{ $student?->name ?? 'Não informado' }}</strong>
                    </div>

                    <div class="dp-information">
                        <span>PROFESSORA:</span>
                        <strong>{{ $teacherName }}</strong>
                    </div>

                    <div class="dp-information">
                        <span>TURNO:</span>
                        <strong>{{ $shift }}</strong>
                    </div>

                    <div class="dp-information">
                        <span>DATA:</span>
                        <strong>{{ $date }}</strong>
                    </div>
                </div>
            </section>

            @foreach ($sections as $sectionIndex => $section)
                <section class="dp-card dp-topic">
                    <h2 class="dp-section-title">{{ $section['title'] }}</h2>

                    <div class="dp-table-wrap">
                        <table class="dp-table">
                            <thead>
                                <tr>
                                    <th class="dp-question-column">TÓPICOS</th>
                                    <th>RESPOSTA REGISTRADA</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($section['items'] as $itemIndex => $item)
                                    @php
                                        $answer = $getResponse($sectionIndex, $itemIndex, $item);

                                        if (is_array($answer)) {
                                            $answer = implode(', ', $answer);
                                        }
                                    @endphp

                                    <tr>
                                        <td class="dp-question">{{ $item }}</td>
                                        <td class="dp-answer">
                                            @if (filled($answer))
                                                {{ $answer }}
                                            @else
                                                <span class="dp-empty">Não informado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            @endforeach

            <section class="dp-card dp-topic">
                <h2 class="dp-section-title">OBSERVAÇÕES</h2>
                <div class="dp-text-content">
                    {{ filled($process->observations) ? $process->observations : 'Nenhuma observação registrada.' }}
                </div>
            </section>

            <section class="dp-card dp-topic">
                <h2 class="dp-section-title">ORIENTAÇÕES / ACOMPANHAMENTO DA FAMÍLIA</h2>
                <div class="dp-text-content">
                    {{ filled($process->family_guidance) ? $process->family_guidance : 'Nenhuma orientação registrada.' }}
                </div>
            </section>

        </main>
    </div>

    <style>
        .dp-show {
            color: #42564a;
        }

        .dp-card {
            margin-bottom: 22px;
            padding: 22px;
            border: 1px solid #e2e8e2;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 3px 14px rgba(31, 81, 58, .045);
        }

        .dp-institution {
            padding-bottom: 18px;
            margin-bottom: 20px;
            border-bottom: 2px solid #2f6b4f;
            text-align: center;
        }

        .dp-institution h2 {
            color: #1f513a;
            font-size: 1.05rem;
            font-weight: 800;
        }

        .dp-institution h3 {
            margin-top: 10px;
            color: #42564a;
            font-size: .95rem;
            font-weight: 750;
        }

        .dp-identification-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .dp-information {
            display: flex;
            flex-direction: column;
            gap: 5px;
            min-width: 0;
        }

        .dp-information span {
            color: #78857d;
            font-size: .75rem;
            font-weight: 750;
            letter-spacing: .04em;
        }

        .dp-information strong {
            color: #26382d;
            overflow-wrap: anywhere;
        }

        .dp-section-title {
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid #d7e1d8;
            color: #1f513a;
            font-size: 1rem;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .dp-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .dp-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .82rem;
        }

        .dp-table th,
        .dp-table td {
            padding: 10px;
            border: 1px solid #d7dee5;
            text-align: left;
            vertical-align: top;
            overflow-wrap: anywhere;
        }

        .dp-table th {
            background: #f1f4ef;
            color: #26382d;
            font-size: .72rem;
            font-weight: 800;
        }

        .dp-question-column {
            width: 68%;
        }

        .dp-question {
            color: #26382d;
            font-weight: 600;
        }

        .dp-answer {
            color: #1f513a;
            font-weight: 700;
        }

        .dp-empty {
            color: #78857d;
            font-weight: 400;
            font-style: italic;
        }

        .dp-text-content {
            min-height: 65px;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            color: #26382d;
            line-height: 1.65;
        }

        .dp-signature-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 40px;
            padding-top: 30px;
        }

        .dp-signature {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            text-align: center;
        }

        .dp-signature-line {
            width: 100%;
            height: 1px;
            margin-bottom: 5px;
            background: #42564a;
        }

        .dp-signature strong {
            font-size: .8rem;
            color: #1f513a;
        }

        .dp-signature span {
            color: #42564a;
            font-size: .8rem;
        }

        .dp-motto {
            margin-top: 35px;
            text-align: center;
            color: #42564a;
            font-size: .72rem;
            font-weight: 700;
        }

        .dp-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 15px;
            border: 1px solid #d7e1d8;
            border-radius: 10px;
            font-size: .875rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: background .2s ease;
        }

        .dp-primary {
            background: #2f6b4f;
            color: #fff;
            border-color: #2f6b4f;
        }

        .dp-primary:hover {
            background: #1f513a;
        }

        .dp-secondary {
            background: #fff;
            color: #42564a;
        }

        .dp-secondary:hover {
            background: #f1f4ef;
        }

        .dark .dp-card {
            background: #14271e;
            border-color: #294236;
            box-shadow: none;
            color: #d1dbd3;
        }

        .dark .dp-institution {
            border-color: #76b58f;
        }

        .dark .dp-institution h2,
        .dark .dp-section-title,
        .dark .dp-signature strong {
            color: #8cc9a3;
        }

        .dark .dp-institution h3,
        .dark .dp-information strong,
        .dark .dp-question,
        .dark .dp-text-content,
        .dark .dp-signature span,
        .dark .dp-motto {
            color: #d1dbd3;
        }

        .dark .dp-information span,
        .dark .dp-empty {
            color: #91a197;
        }

        .dark .dp-section-title {
            border-color: #294236;
        }

        .dark .dp-table th {
            background: #1a3025;
            color: #d1dbd3;
        }

        .dark .dp-table td,
        .dark .dp-table th {
            border-color: #496253;
        }

        .dark .dp-answer {
            color: #8cc9a3;
        }

        .dark .dp-signature-line {
            background: #91a197;
        }

        .dark .dp-secondary {
            background: #1a3025;
            color: #d1dbd3;
            border-color: #294236;
        }

        @media (max-width: 640px) {
            .dp-card {
                padding: 14px;
            }

            .dp-identification-grid,
            .dp-signature-grid {
                grid-template-columns: 1fr;
            }

            .dp-signature-grid {
                gap: 35px;
            }
        }

        @media print {
            @page {
                size: A4 portrait;
                margin: 12mm;
            }

            body,
            html {
                background: #fff !important;
                color: #000 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            body * {
                visibility: hidden;
            }

            #development-process-document,
            #development-process-document * {
                visibility: visible;
            }

            #development-process-document {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                color: #000 !important;
            }

            .dp-actions,
            nav,
            header,
            footer,
            button,
            .dp-button {
                display: none !important;
            }

            .dp-card {
                margin-bottom: 12px;
                padding: 12px;
                border: 1px solid #aaa !important;
                border-radius: 0;
                background: #fff !important;
                color: #000 !important;
                box-shadow: none !important;
                break-inside: auto;
            }

            .dp-institution {
                border-color: #333 !important;
            }

            .dp-institution h2,
            .dp-institution h3,
            .dp-section-title,
            .dp-information strong,
            .dp-question,
            .dp-answer,
            .dp-text-content,
            .dp-signature strong,
            .dp-signature span,
            .dp-motto {
                color: #000 !important;
            }

            .dp-section-title {
                margin-bottom: 8px;
                border-color: #aaa !important;
                font-size: 10pt;
            }

            .dp-table {
                font-size: 8pt;
            }

            .dp-table th,
            .dp-table td {
                padding: 6px;
                border: 1px solid #888 !important;
            }

            .dp-table th {
                background: #eee !important;
                color: #000 !important;
            }

            .dp-question-column {
                width: 68%;
            }

            .dp-answer {
                font-weight: 700;
            }

            .dp-empty {
                color: #555 !important;
            }

            .dp-signatures {
                break-inside: avoid;
            }

            .dp-signature-line {
                background: #000 !important;
            }

            .dp-motto {
                margin-top: 24px;
            }
        }
    </style>
</x-app-layout>