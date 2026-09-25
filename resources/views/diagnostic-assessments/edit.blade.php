<x-app-layout :context="$context">

    <x-slot name="header">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <p class="text-sm font-semibold tracking-wide text-[#3B7D5A] mb-1">
                SIAPAE
            </p>

            <h2 class="text-2xl md:text-3xl font-bold leading-tight text-[#102A43]">
                Editar Sondagem Diagnóstica
            </h2>

        </div>

    </x-slot>


    <div class="py-6 bg-[#F4F6F8] min-h-screen">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-[#E1E7EC] shadow-sm overflow-hidden">

                {{-- CABEÇALHO --}}

                <div class="px-6 md:px-8 pt-7 pb-6 border-b border-[#E1E7EC]">

                    <h1 class="text-xl md:text-2xl font-bold text-[#102A43]">
                        Editar Sondagem Diagnóstica Psicopedagógica
                    </h1>

                    <p class="mt-1 text-sm md:text-base text-[#66788A]">
                        Atualize os dados registrados para esta sondagem.
                    </p>

                </div>


                {{-- ERROS --}}

                @if ($errors->any())

                    <div class="mx-6 md:mx-8 mt-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4">

                        <p class="font-semibold text-red-700 mb-2">
                            Verifique os campos abaixo:
                        </p>

                        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('diagnostic-assessments.update', $assessment->id) }}"
                    class="px-6 md:px-8 py-6"
                >

                    @csrf
                    @method('PUT')


                    @php

                        $language =
                            old('language', $assessment->language ?? []);

                        $logicalMathematical =
                            old(
                                'logical_mathematical',
                                $assessment->logical_mathematical ?? []
                            );

                        $functionalLife =
                            old(
                                'functional_life',
                                $assessment->functional_life ?? []
                            );

                        $bodyExperience =
                            old(
                                'body_experience',
                                $assessment->body_experience ?? []
                            );

                        $natureSociety =
                            old(
                                'nature_society',
                                $assessment->nature_society ?? []
                            );

                        $educationalInformatics =
                            old(
                                'educational_informatics',
                                $assessment->educational_informatics ?? []
                            );

                        $cognitive =
                            old(
                                'cognitive',
                                $assessment->cognitive ?? []
                            );

                    @endphp


                    {{-- =====================================================
                         IDENTIFICAÇÃO
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                1. Identificação
                            </h2>

                            <p class="mt-1 text-sm text-[#66788A]">
                                Dados de identificação do aluno.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">


                            {{-- ALUNO --}}

                            <div class="lg:col-span-2">

                                <label
                                    for="student_id"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    Aluno
                                    <span class="text-red-600">*</span>
                                </label>

                                <select
                                    id="student_id"
                                    name="student_id"
                                    required
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                                    <option value="">
                                        Selecione um aluno
                                    </option>

                                    @foreach ($students as $student)

                                        <option
                                            value="{{ $student->id }}"
                                            {{ old('student_id', $assessment->student_id) == $student->id ? 'selected' : '' }}
                                        >
                                            {{ $student->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('student_id')

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>


                            {{-- IDADE --}}

                            <div>

                                <label
                                    for="age"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    Idade
                                </label>

                                <input
                                    type="number"
                                    id="age"
                                    name="age"
                                    min="0"
                                    max="150"
                                    value="{{ old('age', $assessment->age) }}"
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                            </div>


                            {{-- SÉRIE --}}

                            <div>

                                <label
                                    for="series"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    Série
                                </label>

                                <input
                                    type="text"
                                    id="series"
                                    name="series"
                                    value="{{ old('series', $assessment->series) }}"
                                    maxlength="100"
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                            </div>


                            {{-- ESCOLA --}}

                            <div class="lg:col-span-2">

                                <label
                                    for="school"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    Escola
                                </label>

                                <input
                                    type="text"
                                    id="school"
                                    name="school"
                                    value="{{ old('school', $assessment->school) }}"
                                    maxlength="255"
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                            </div>


                            {{-- CID --}}

                            <div>

                                <label
                                    for="cid"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    CID10 ou CID11
                                </label>

                                <input
                                    type="text"
                                    id="cid"
                                    name="cid"
                                    value="{{ old('cid', $assessment->cid) }}"
                                    maxlength="100"
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                            </div>


                            {{-- DATA --}}

                            <div>

                                <label
                                    for="date"
                                    class="block text-sm font-semibold text-[#334E68] mb-2"
                                >
                                    Data
                                    <span class="text-red-600">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="date"
                                    name="date"
                                    value="{{ old('date', $assessment->date) }}"
                                    placeholder="dd/mm/aaaa"
                                    maxlength="10"
                                    inputmode="numeric"
                                    pattern="\d{2}/\d{2}/\d{4}"
                                    required
                                    oninput="formatarData(this)"
                                    class="w-full rounded-lg border border-[#D7DEE5] bg-white px-3 py-2.5 text-[#243B53] focus:border-[#3B7D5A] focus:ring-2 focus:ring-[#3B7D5A]/10 outline-none"
                                >

                                @error('date')

                                    <p class="mt-1 text-sm text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         LINGUAGEM
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                2. Linguagem
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Linguístico, alfabeto móvel, loto palavra, texto simples,
                                texto paragrafado e frases.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

                            @foreach ([
                                'represents_letters' => 'Representa as letras',
                                'recognizes_letters' => 'Reconhece as letras',
                                'syllable' => 'Reconhece/trabalha sílaba',
                                'simple_word' => 'Reconhece palavra simples',
                                'complex_word' => 'Reconhece palavra complexa',
                                'short_sentence' => 'Reconhece frase curta',
                                'long_sentence' => 'Reconhece frase longa',
                                'understands_verbal_instructions' => 'Capacidade de compreender instruções verbais',
                                'holds_pencil_correctly' => 'Segura corretamente o lápis',
                                'interest_in_writing' => 'Demonstra interesse pela escrita (letras, numerais, palavras, Braille e Libras)'
                            ] as $key => $label)

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="language[{{ $key }}]"
                                        value="1"
                                        {{ !empty($language[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>


                        <div class="mt-6 rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Leitura e interpretação
                            </h3>


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                @foreach ([
                                    'simple_text' => 'Texto simples',
                                    'simple_text_interprets' => 'Interpreta texto simples',
                                    'paragraph_text' => 'Texto com três parágrafos ou mais',
                                    'paragraph_text_interprets' => 'Interpreta texto com três parágrafos ou mais'
                                ] as $key => $label)

                                    <label class="assessment-check">

                                        <input
                                            type="checkbox"
                                            name="language[{{ $key }}]"
                                            value="1"
                                            {{ !empty($language[$key]) ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="mt-6 rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Níveis de escrita
                            </h3>


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                                @foreach ([
                                    'pre_syllabic' => 'Pré-silábico',
                                    'syllabic' => 'Silábico',
                                    'syllabic_alphabetic' => 'Silábico-alfabético',
                                    'alphabetic' => 'Alfabético'
                                ] as $key => $label)

                                    <label class="assessment-radio">

                                        <input
                                            type="radio"
                                            name="language[writing_level]"
                                            value="{{ $key }}"
                                            {{ ($language['writing_level'] ?? '') === $key ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         LÓGICO MATEMÁTICO
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                3. Lógico Matemático
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos / materiais para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Número e quantidade, relógio, calculadora, placa de carro,
                                ábaco, jogo bloco lógico, dominó da adição,
                                dominó da multiplicação, adição e subtração,
                                material dourado e dinheiro.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

                            @foreach ([
                                'identifies_numbers_contexts' => 'Identifica números nos diferentes contextos em que se encontram (relógio, placa de carro, calculadora)',
                                'identifies_number_position' => 'Identifica posição do número',
                                'associates_number_name_symbol' => 'Associa a denominação do número à sua respectiva representação simbólica',
                                'relates_numbers_quantities' => 'Relaciona os números às quantidades correspondentes',
                                'quantifies' => 'Consegue quantificar',
                                'understands_tens_units' => 'Compreende dezena e unidade',
                                'knows_money' => 'Conhece dinheiro',
                                'differentiates_money_values' => 'Consegue diferenciar valores',
                                'solves_word_problems' => 'Consegue resolver situações-problemas'
                            ] as $key => $label)

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="logical_mathematical[{{ $key }}]"
                                        value="1"
                                        {{ !empty($logicalMathematical[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>


                        <div class="mt-6 rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Formas geométricas
                            </h3>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                                @foreach ([
                                    'triangle' => 'Triângulo',
                                    'square' => 'Quadrado',
                                    'circle' => 'Círculo',
                                    'rectangle' => 'Retângulo'
                                ] as $key => $label)

                                    <label class="assessment-check">

                                        <input
                                            type="checkbox"
                                            name="logical_mathematical[geometric_shapes][{{ $key }}]"
                                            value="1"
                                            {{ !empty($logicalMathematical['geometric_shapes'][$key] ?? null) ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="mt-6 rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Operações
                            </h3>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                                @foreach ([
                                    'addition' => 'Adição',
                                    'multiplication' => 'Multiplicação',
                                    'subtraction' => 'Subtração',
                                    'division' => 'Divisão'
                                ] as $key => $label)

                                    <label class="assessment-check">

                                        <input
                                            type="checkbox"
                                            name="logical_mathematical[operations][{{ $key }}]"
                                            value="1"
                                            {{ !empty($logicalMathematical['operations'][$key] ?? null) ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="mt-6 rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Conhecimento para
                            </h3>


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                @foreach ([
                                    'inside_outside' => ['Dentro', 'Fora'],
                                    'behind_front' => ['Atrás', 'Na frente'],
                                    'above_below' => ['Em cima', 'Em baixo'],
                                    'much_little' => ['Muito', 'Pouco']
                                ] as $key => $options)

                                    <div>

                                        <p class="text-sm font-semibold text-[#334E68] mb-2">
                                            {{ $options[0] }} / {{ $options[1] }}
                                        </p>

                                        <div class="flex flex-wrap gap-3">

                                            @foreach ($options as $option)

                                                <label class="assessment-radio">

                                                    <input
                                                        type="radio"
                                                        name="logical_mathematical[spatial_knowledge][{{ $key }}]"
                                                        value="{{ $option }}"
                                                        {{ ($logicalMathematical['spatial_knowledge'][$key] ?? '') === $option ? 'checked' : '' }}
                                                    >

                                                    <span>{{ $option }}</span>

                                                </label>

                                            @endforeach

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         VIDA FUNCIONAL
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                4. Vida Funcional — AVD's e AVP's
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Dado AVD's, banheira infantil e boneco.
                            </p>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

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

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="functional_life[{{ $key }}]"
                                        value="1"
                                        {{ !empty($functionalLife[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         VIVÊNCIA CORPORAL
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                5. Vivência Corporal
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Esquema corporal, expressões faciais e desenho do corpo.
                            </p>

                        </div>


                        <label class="assessment-check mb-5">

                            <input
                                type="checkbox"
                                name="body_experience[body_parts]"
                                value="1"
                                {{ !empty($bodyExperience['body_parts']) ? 'checked' : '' }}
                            >

                            <span>
                                Identifica as partes do corpo
                            </span>

                        </label>


                        <label class="assessment-check mb-6">

                            <input
                                type="checkbox"
                                name="body_experience[right_left]"
                                value="1"
                                {{ !empty($bodyExperience['right_left']) ? 'checked' : '' }}
                            >

                            <span>
                                Sabe diferenciar lado direito do lado esquerdo do corpo em si mesmo
                            </span>

                        </label>


                        <div class="rounded-xl border border-[#E1E7EC] p-5 mb-6">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                O desenho do corpo está na fase
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                                @foreach ([
                                    'garatuja' => 'Garatuja',
                                    'pre_schematic' => 'Pré-esquemático',
                                    'schematic' => 'Esquemático',
                                    'realism' => 'Realismo'
                                ] as $key => $label)

                                    <label class="assessment-radio">

                                        <input
                                            type="radio"
                                            name="body_experience[drawing_phase]"
                                            value="{{ $key }}"
                                            {{ ($bodyExperience['drawing_phase'] ?? '') === $key ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="rounded-xl border border-[#E1E7EC] p-5 mb-6">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Qual o seu lado dominante?
                            </h3>

                            <div class="flex flex-wrap gap-3">

                                <label class="assessment-radio">

                                    <input
                                        type="radio"
                                        name="body_experience[dominant_side]"
                                        value="Direita"
                                        {{ ($bodyExperience['dominant_side'] ?? '') === 'Direita' ? 'checked' : '' }}
                                    >

                                    <span>Direita</span>

                                </label>


                                <label class="assessment-radio">

                                    <input
                                        type="radio"
                                        name="body_experience[dominant_side]"
                                        value="Esquerda"
                                        {{ ($bodyExperience['dominant_side'] ?? '') === 'Esquerda' ? 'checked' : '' }}
                                    >

                                    <span>Esquerda</span>

                                </label>

                            </div>

                        </div>


                        <div class="rounded-xl border border-[#E1E7EC] p-5">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Expressão facial
                            </h3>

                            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">

                                @foreach ([
                                    'alegre' => 'Alegre',
                                    'triste' => 'Triste',
                                    'raiva' => 'Raiva',
                                    'dor' => 'Dor',
                                    'timido' => 'Tímido'
                                ] as $key => $label)

                                    <label class="assessment-check">

                                        <input
                                            type="checkbox"
                                            name="body_experience[facial_expression][{{ $key }}]"
                                            value="1"
                                            {{ !empty($bodyExperience['facial_expression'][$key] ?? null) ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         NATUREZA E SOCIEDADE
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                6. Natureza e Sociedade
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Semáforo e placas de trânsito, imagens do meio ambiente
                                preservado e destruído, objetos de casa para trabalhar
                                organização e bagunça e objetos pessoais.
                            </p>

                        </div>


                        <label class="assessment-check mb-5">

                            <input
                                type="checkbox"
                                name="nature_society[traffic_light_colors]"
                                value="1"
                                {{ !empty($natureSociety['traffic_light_colors']) ? 'checked' : '' }}
                            >

                            <span>
                                Conhece e sabe identificar as cores do semáforo
                            </span>

                        </label>


                        <div class="rounded-xl border border-[#E1E7EC] p-5 mb-6">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Conhece as placas de trânsito
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">

                                @foreach ([
                                    'stop' => 'Pare',
                                    'left' => 'À esquerda',
                                    'right' => 'À direita',
                                    'pedestrian_crossing' => 'Faixa de pedestre',
                                    'school' => 'Placa escola',
                                    'hospital' => 'Placa hospital'
                                ] as $key => $label)

                                    <label class="assessment-check">

                                        <input
                                            type="checkbox"
                                            name="nature_society[traffic_signs][{{ $key }}]"
                                            value="1"
                                            {{ !empty($natureSociety['traffic_signs'][$key] ?? null) ? 'checked' : '' }}
                                        >

                                        <span>{{ $label }}</span>

                                    </label>

                                @endforeach

                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

                            @foreach ([
                                'environment_care' => 'Tem cuidado com o meio ambiente',
                                'organizes_mess' => 'Ajuda a organizar o que bagunçou',
                                'personal_objects_care' => 'Tem cuidado com seus objetos pessoais'
                            ] as $key => $label)

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="nature_society[{{ $key }}]"
                                        value="1"
                                        {{ !empty($natureSociety[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         INFORMÁTICA PEDAGÓGICA
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                7. Informática Pedagógica
                            </h2>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

                            @foreach ([
                                'computer' => 'Conhece e sabe manusear o computador',
                                'mouse' => 'Sabe o que é mouse',
                                'screen' => 'Sabe o que é tela',
                                'keyboard' => 'Sabe o que é teclado'
                            ] as $key => $label)

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="educational_informatics[{{ $key }}]"
                                        value="1"
                                        {{ !empty($educationalInformatics[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>

                    </section>


                    <div class="h-px bg-[#E1E7EC] mb-8"></div>


                    {{-- =====================================================
                         COGNITIVO
                         ===================================================== --}}

                    <section class="mb-8">

                        <div class="mb-5">

                            <h2 class="text-lg md:text-xl font-bold text-[#102A43]">
                                8. Cognitivo
                            </h2>

                        </div>


                        <div class="rounded-xl bg-[#EDF5F0] border border-[#DCEBE2] px-5 py-4 mb-5">

                            <p class="text-sm font-bold text-[#2F684A] mb-2">
                                Jogos para avaliação
                            </p>

                            <p class="text-sm text-[#66788A]">
                                Calendário, jogo sequência lógica, jogo da memória
                                (usar só as imagens), imagem sombra e jogo das mãos.
                            </p>

                        </div>


                        <div class="rounded-xl border border-[#E1E7EC] p-5 mb-6">

                            <h3 class="font-semibold text-[#102A43] mb-4">
                                Conhecimento para
                            </h3>

                            <div class="space-y-5">

                                @foreach ([
                                    'day' => 'Dia',
                                    'month' => 'Mês',
                                    'year' => 'Ano'
                                ] as $key => $label)

                                    <div>

                                        <p class="text-sm font-semibold text-[#334E68] mb-2">
                                            {{ $label }}
                                        </p>

                                        <div class="flex flex-wrap gap-3">

                                            @foreach ([
                                                'ontem' => 'Ontem',
                                                'hoje' => 'Hoje',
                                                'amanha' => 'Amanhã'
                                            ] as $value => $option)

                                                <label class="assessment-radio">

                                                    <input
                                                        type="radio"
                                                        name="cognitive[time_knowledge][{{ $key }}]"
                                                        value="{{ $value }}"
                                                        {{ ($cognitive['time_knowledge'][$key] ?? '') === $value ? 'checked' : '' }}
                                                    >

                                                    <span>{{ $option }}</span>

                                                </label>

                                            @endforeach

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        </div>


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3">

                            @foreach ([
                                'story_sequence' => 'Sabe colocar a história na sequência correta',
                                'pairs_image_shadow' => 'Sabe parear imagem à sombra',
                                'sustained_attention' => 'Possui atenção sustentada',
                                'story_beginning_middle_end' => 'Sabe diferenciar início, meio e fim de uma história',
                                'repeat_five_words' => 'Consegue repetir uma frase de cinco palavras',
                                'repeat_three_words' => 'Consegue repetir uma frase de três palavras'
                            ] as $key => $label)

                                <label class="assessment-check">

                                    <input
                                        type="checkbox"
                                        name="cognitive[{{ $key }}]"
                                        value="1"
                                        {{ !empty($cognitive[$key]) ? 'checked' : '' }}
                                    >

                                    <span>{{ $label }}</span>

                                </label>

                            @endforeach

                        </div>

                    </section>


                    {{-- =====================================================
                         BOTÕES
                         ===================================================== --}}

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-[#E1E7EC]">

                        <a
                            href="{{ route('diagnostic-assessments.show', $assessment->id) }}"
                            class="inline-flex items-center justify-center rounded-lg border border-[#D7DEE5] bg-white px-6 py-2.5 font-semibold text-[#334E68] hover:bg-[#F4F6F8] transition"
                        >
                            Cancelar
                        </a>


                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-[#3B7D5A] px-7 py-2.5 font-semibold text-white hover:bg-[#2F684A] transition shadow-sm"
                        >
                            Salvar Alterações
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <style>

        body {
            background-color: #F4F6F8 !important;
        }


        .assessment-check,
        .assessment-radio {

            display: flex;

            align-items: flex-start;

            gap: 10px;

            padding: 10px 12px;

            border: 1px solid transparent;

            border-radius: 8px;

            color: #334E68;

            font-size: 14px;

            line-height: 1.5;

            cursor: pointer;

            transition:
                background-color .2s ease,
                border-color .2s ease;
        }


        .assessment-check:hover,
        .assessment-radio:hover {

            background-color: #F8FAFB;

            border-color: #E1E7EC;
        }


        .assessment-check input,
        .assessment-radio input {

            margin-top: 3px;

            flex-shrink: 0;

            accent-color: #3B7D5A;

            width: 16px;

            height: 16px;
        }


        input:focus,
        select:focus {

            outline: none;
        }

    </style>


    <script>

        function formatarData(input) {

            if (!input) {
                return;
            }

            let valor = input.value.replace(/\D/g, '');

            valor = valor.substring(0, 8);

            if (valor.length >= 5) {

                input.value =
                    valor.substring(0, 2) +
                    '/' +
                    valor.substring(2, 4) +
                    '/' +
                    valor.substring(4);

            } else if (valor.length >= 3) {

                input.value =
                    valor.substring(0, 2) +
                    '/' +
                    valor.substring(2);

            } else {

                input.value = valor;
            }
        }

    </script>

</x-app-layout>