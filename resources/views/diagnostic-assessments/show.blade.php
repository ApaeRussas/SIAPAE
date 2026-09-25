<x-app-layout :context="$context">

    <x-slot name="header">

        <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div>

                <p class="text-sm font-semibold tracking-wide text-[#3B7D5A] mb-1">
                    SIAPAE
                </p>

                <h2 class="text-2xl md:text-3xl font-bold text-[#102A43]">
                    Sondagem Diagnóstica
                </h2>

            </div>

            <div class="flex gap-3">

                <a
                    href="{{ route('diagnostic-assessments.edit', $assessment->id) }}"
                    class="inline-flex items-center rounded-lg bg-[#3B7D5A] px-5 py-2.5 font-semibold text-white hover:bg-[#2F684A] transition"
                >
                    Editar
                </a>

                <a
                    href="{{ route('diagnostic-assessments.index') }}"
                    class="inline-flex items-center rounded-lg border border-[#D7DEE5] bg-white px-5 py-2.5 font-semibold text-[#334E68] hover:bg-[#F4F6F8] transition"
                >
                    Voltar
                </a>

            </div>

        </div>

    </x-slot>


    <div class="py-6 bg-[#F4F6F8] min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- =====================================================
                 IDENTIFICAÇÃO
                 ===================================================== --}}

            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden mb-6">

                <div class="px-6 md:px-8 py-6 border-b border-[#E1E7EC]">

                    <h1 class="text-xl md:text-2xl font-bold text-[#102A43]">
                        Identificação
                    </h1>

                    <p class="mt-1 text-sm text-[#66788A]">
                        Dados registrados na sondagem diagnóstica.
                    </p>

                </div>


                <div class="px-6 md:px-8 py-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="lg:col-span-2">

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            Aluno
                        </p>

                        <p class="mt-1 text-base font-semibold text-[#102A43]">
                            {{ $assessment->student->name ?? 'Aluno não encontrado' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            Idade
                        </p>

                        <p class="mt-1 text-base text-[#334E68]">
                            {{ $assessment->age ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            Série
                        </p>

                        <p class="mt-1 text-base text-[#334E68]">
                            {{ $assessment->series ?: '—' }}
                        </p>

                    </div>


                    <div class="lg:col-span-2">

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            Escola
                        </p>

                        <p class="mt-1 text-base text-[#334E68]">
                            {{ $assessment->school ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            CID10 ou CID11
                        </p>

                        <p class="mt-1 text-base text-[#334E68]">
                            {{ $assessment->cid ?: '—' }}
                        </p>

                    </div>


                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-[#66788A]">
                            Data
                        </p>

                        <p class="mt-1 text-base font-semibold text-[#334E68]">
                            {{ optional($assessment->date)->format('d/m/Y') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FUNÇÃO AUXILIAR PARA EXIBIR CHECKBOXES
                 ===================================================== --}}

            @php

                function itemMarcado($array, $key)
                {
                    return isset($array[$key]) && $array[$key];
                }

            @endphp


            {{-- =====================================================
                 LINGUAGEM
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Linguagem</h2>
                </div>


                <div class="diagnostic-grid">

                    @php
                        $languageLabels = [
                            'represents_letters' => 'Representa as letras',
                            'recognizes_letters' => 'Reconhece as letras',
                            'syllable' => 'Reconhece/trabalha sílaba',
                            'simple_word' => 'Reconhece palavra simples',
                            'complex_word' => 'Reconhece palavra complexa',
                            'short_sentence' => 'Reconhece frase curta',
                            'long_sentence' => 'Reconhece frase longa',
                            'understands_verbal_instructions' => 'Compreende instruções verbais',
                            'holds_pencil_correctly' => 'Segura corretamente o lápis',
                            'interest_in_writing' => 'Demonstra interesse pela escrita',
                        ];
                    @endphp

                    @foreach ($languageLabels as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->language ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->language ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>


                <div class="diagnostic-subsection">

                    <h3>Leitura e interpretação</h3>

                    <div class="diagnostic-grid">

                        @foreach ([
                            'simple_text' => 'Texto simples',
                            'simple_text_interprets' => 'Interpreta texto simples',
                            'paragraph_text' => 'Texto com três parágrafos ou mais',
                            'paragraph_text_interprets' => 'Interpreta texto com três parágrafos ou mais'
                        ] as $key => $label)

                            <div class="diagnostic-item">

                                <span class="diagnostic-check {{ itemMarcado($assessment->language ?? [], $key) ? 'checked' : '' }}">
                                    {{ itemMarcado($assessment->language ?? [], $key) ? '✓' : '○' }}
                                </span>

                                <span>{{ $label }}</span>

                            </div>

                        @endforeach

                    </div>

                </div>


                <div class="diagnostic-subsection">

                    <h3>Nível de escrita</h3>

                    <p class="diagnostic-value">
                        @php
                            $writingLevels = [
                                'pre_syllabic' => 'Pré-silábico',
                                'syllabic' => 'Silábico',
                                'syllabic_alphabetic' => 'Silábico-alfabético',
                                'alphabetic' => 'Alfabético'
                            ];
                        @endphp

                        {{ $writingLevels[$assessment->language['writing_level'] ?? ''] ?? 'Não informado' }}
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 LÓGICO MATEMÁTICO
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Lógico Matemático</h2>
                </div>


                <div class="diagnostic-grid">

                    @php
                        $mathLabels = [
                            'identifies_numbers_contexts' => 'Identifica números em diferentes contextos',
                            'identifies_number_position' => 'Identifica posição do número',
                            'associates_number_name_symbol' => 'Associa denominação e representação simbólica',
                            'relates_numbers_quantities' => 'Relaciona números às quantidades correspondentes',
                            'quantifies' => 'Consegue quantificar',
                            'understands_tens_units' => 'Compreende dezena e unidade',
                            'knows_money' => 'Conhece dinheiro',
                            'differentiates_money_values' => 'Consegue diferenciar valores',
                            'solves_word_problems' => 'Consegue resolver situações-problemas',
                        ];
                    @endphp

                    @foreach ($mathLabels as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->logical_mathematical ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->logical_mathematical ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>


                <div class="diagnostic-subsection">

                    <h3>Formas geométricas</h3>

                    <div class="diagnostic-grid">

                        @foreach ([
                            'triangle' => 'Triângulo',
                            'square' => 'Quadrado',
                            'circle' => 'Círculo',
                            'rectangle' => 'Retângulo'
                        ] as $key => $label)

                            <div class="diagnostic-item">

                                <span class="diagnostic-check {{ itemMarcado($assessment->logical_mathematical['geometric_shapes'] ?? [], $key) ? 'checked' : '' }}">
                                    {{ itemMarcado($assessment->logical_mathematical['geometric_shapes'] ?? [], $key) ? '✓' : '○' }}
                                </span>

                                <span>{{ $label }}</span>

                            </div>

                        @endforeach

                    </div>

                </div>


                <div class="diagnostic-subsection">

                    <h3>Operações</h3>

                    <div class="diagnostic-grid">

                        @foreach ([
                            'addition' => 'Adição',
                            'multiplication' => 'Multiplicação',
                            'subtraction' => 'Subtração',
                            'division' => 'Divisão'
                        ] as $key => $label)

                            <div class="diagnostic-item">

                                <span class="diagnostic-check {{ itemMarcado($assessment->logical_mathematical['operations'] ?? [], $key) ? 'checked' : '' }}">
                                    {{ itemMarcado($assessment->logical_mathematical['operations'] ?? [], $key) ? '✓' : '○' }}
                                </span>

                                <span>{{ $label }}</span>

                            </div>

                        @endforeach

                    </div>

                </div>

                <div class="diagnostic-subsection">

                    <h3>Conhecimento espacial</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        @foreach ([
                            'inside_outside' => 'Dentro / Fora',
                            'behind_front' => 'Atrás / Na frente',
                            'above_below' => 'Em cima / Em baixo',
                            'much_little' => 'Muito / Pouco'
                        ] as $key => $label)

                            <div>

                                <p class="text-sm font-semibold text-[#334E68]">
                                    {{ $label }}
                                </p>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    {{ $assessment->logical_mathematical['spatial_knowledge'][$key] ?? 'Não informado' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 VIDA FUNCIONAL
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Vida Funcional — AVD's e AVP's</h2>
                </div>

                <div class="diagnostic-grid">

                    @foreach ([
                        'hygiene_objects' => 'Sabe identificar objetos de higiene',
                        'clothing_types' => 'Identifica os tipos de vestuários',
                        'tie_knot' => 'Sabe dar laço',
                        'zipper_close' => 'Sabe fechar zíper',
                        'zipper_open' => 'Sabe abrir zíper',
                        'knot' => 'Sabe dar nó',
                        'buckle_close' => 'Sabe fechar fivela',
                        'buckle_open' => 'Sabe abrir fivela',
                        'shoes' => 'Sabe se calçar'
                    ] as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->functional_life ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->functional_life ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =====================================================
                 VIVÊNCIA CORPORAL
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Vivência Corporal</h2>
                </div>


                <div class="diagnostic-grid">

                    @foreach ([
                        'body_parts' => 'Identifica as partes do corpo',
                        'right_left' => 'Diferencia lado direito e lado esquerdo'
                    ] as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->body_experience ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->body_experience ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>


                <div class="diagnostic-subsection">

                    <h3>Fase do desenho do corpo</h3>

                    @php
                        $drawingPhases = [
                            'garatuja' => 'Garatuja',
                            'pre_schematic' => 'Pré-esquemático',
                            'schematic' => 'Esquemático',
                            'realism' => 'Realismo'
                        ];
                    @endphp

                    <p class="diagnostic-value">
                        {{ $drawingPhases[$assessment->body_experience['drawing_phase'] ?? ''] ?? 'Não informado' }}
                    </p>

                </div>


                <div class="diagnostic-subsection">

                    <h3>Lado dominante</h3>

                    <p class="diagnostic-value">
                        {{ $assessment->body_experience['dominant_side'] ?? 'Não informado' }}
                    </p>

                </div>


                <div class="diagnostic-subsection">

                    <h3>Expressão facial</h3>

                    <div class="diagnostic-grid">

                        @foreach ([
                            'alegre' => 'Alegre',
                            'triste' => 'Triste',
                            'raiva' => 'Raiva',
                            'dor' => 'Dor',
                            'timido' => 'Tímido'
                        ] as $key => $label)

                            <div class="diagnostic-item">

                                <span class="diagnostic-check {{ itemMarcado($assessment->body_experience['facial_expression'] ?? [], $key) ? 'checked' : '' }}">
                                    {{ itemMarcado($assessment->body_experience['facial_expression'] ?? [], $key) ? '✓' : '○' }}
                                </span>

                                <span>{{ $label }}</span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 NATUREZA E SOCIEDADE
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Natureza e Sociedade</h2>
                </div>


                <div class="diagnostic-grid">

                    <div class="diagnostic-item">

                        <span class="diagnostic-check {{ itemMarcado($assessment->nature_society ?? [], 'traffic_light_colors') ? 'checked' : '' }}">
                            {{ itemMarcado($assessment->nature_society ?? [], 'traffic_light_colors') ? '✓' : '○' }}
                        </span>

                        <span>
                            Conhece e sabe identificar as cores do semáforo
                        </span>

                    </div>


                    @foreach ([
                        'environment_care' => 'Tem cuidado com o meio ambiente',
                        'organizes_mess' => 'Ajuda a organizar o que bagunçou',
                        'personal_objects_care' => 'Tem cuidado com seus objetos pessoais'
                    ] as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->nature_society ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->nature_society ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>


                <div class="diagnostic-subsection">

                    <h3>Placas de trânsito</h3>

                    <div class="diagnostic-grid">

                        @foreach ([
                            'stop' => 'Pare',
                            'left' => 'À esquerda',
                            'right' => 'À direita',
                            'pedestrian_crossing' => 'Faixa de pedestre',
                            'school' => 'Placa escola',
                            'hospital' => 'Placa hospital'
                        ] as $key => $label)

                            <div class="diagnostic-item">

                                <span class="diagnostic-check {{ itemMarcado($assessment->nature_society['traffic_signs'] ?? [], $key) ? 'checked' : '' }}">
                                    {{ itemMarcado($assessment->nature_society['traffic_signs'] ?? [], $key) ? '✓' : '○' }}
                                </span>

                                <span>{{ $label }}</span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 INFORMÁTICA PEDAGÓGICA
                 ===================================================== --}}

            <div class="diagnostic-card">

                <div class="diagnostic-card-header">
                    <h2>Informática Pedagógica</h2>
                </div>


                <div class="diagnostic-grid">

                    @foreach ([
                        'computer' => 'Conhece e sabe manusear o computador',
                        'mouse' => 'Sabe o que é mouse',
                        'screen' => 'Sabe o que é tela',
                        'keyboard' => 'Sabe o que é teclado'
                    ] as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->educational_informatics ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->educational_informatics ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =====================================================
                 COGNITIVO
                 ===================================================== --}}

            <div class="diagnostic-card mb-6">

                <div class="diagnostic-card-header">
                    <h2>Cognitivo</h2>
                </div>


                <div class="diagnostic-subsection">

                    <h3>Conhecimento temporal</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        @foreach ([
                            'day' => 'Dia',
                            'month' => 'Mês',
                            'year' => 'Ano'
                        ] as $key => $label)

                            <div>

                                <p class="text-sm font-semibold text-[#334E68]">
                                    {{ $label }}
                                </p>

                                <p class="mt-1 text-sm text-[#66788A]">
                                    {{ [
                                        'ontem' => 'Ontem',
                                        'hoje' => 'Hoje',
                                        'amanha' => 'Amanhã'
                                    ][$assessment->cognitive['time_knowledge'][$key] ?? ''] ?? 'Não informado' }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>


                <div class="diagnostic-grid">

                    @foreach ([
                        'story_sequence' => 'Sabe colocar a história na sequência correta',
                        'pairs_image_shadow' => 'Sabe parear imagem à sombra',
                        'sustained_attention' => 'Possui atenção sustentada',
                        'story_beginning_middle_end' => 'Sabe diferenciar início, meio e fim de uma história',
                        'repeat_five_words' => 'Consegue repetir uma frase de cinco palavras',
                        'repeat_three_words' => 'Consegue repetir uma frase de três palavras'
                    ] as $key => $label)

                        <div class="diagnostic-item">

                            <span class="diagnostic-check {{ itemMarcado($assessment->cognitive ?? [], $key) ? 'checked' : '' }}">
                                {{ itemMarcado($assessment->cognitive ?? [], $key) ? '✓' : '○' }}
                            </span>

                            <span>{{ $label }}</span>

                        </div>

                    @endforeach

                </div>

            </div>


        </div>

    </div>


    <style>

        .diagnostic-card {

            background: #FFFFFF;

            border: 1px solid #E1E7EC;

            border-radius: 16px;

            box-shadow: 0 1px 3px rgba(16, 42, 67, .04);

            overflow: hidden;

            margin-bottom: 24px;
        }


        .diagnostic-card-header {

            padding: 22px 24px;

            border-bottom: 1px solid #E1E7EC;

            background: #FAFBFC;
        }


        .diagnostic-card-header h2 {

            margin: 0;

            font-size: 20px;

            font-weight: 700;

            color: #102A43;
        }


        .diagnostic-grid {

            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 10px 24px;

            padding: 24px;
        }


        .diagnostic-item {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            padding: 10px 12px;

            border-radius: 8px;

            font-size: 14px;

            line-height: 1.5;

            color: #334E68;
        }


        .diagnostic-check {

            flex-shrink: 0;

            width: 21px;

            height: 21px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #F4F6F8;

            color: #9FB0BF;

            font-size: 13px;

            font-weight: 700;
        }


        .diagnostic-check.checked {

            background: #EDF5F0;

            color: #3B7D5A;
        }


        .diagnostic-subsection {

            margin: 0 24px 24px;

            padding: 18px;

            border: 1px solid #E1E7EC;

            border-radius: 12px;

            background: #FFFFFF;
        }


        .diagnostic-subsection h3 {

            margin: 0 0 14px;

            font-size: 15px;

            font-weight: 700;

            color: #102A43;
        }


        .diagnostic-value {

            margin: 0;

            font-size: 14px;

            color: #334E68;

            font-weight: 600;
        }


        @media (max-width: 768px) {

            .diagnostic-grid {

                grid-template-columns: 1fr;

            }

        }

    </style>

</x-app-layout>