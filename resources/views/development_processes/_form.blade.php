@php
$process = $process ?? $record ?? $individualDevelopment ?? null;
$responses = old('responses', data_get($process, 'responses', []));
$studentId = old('student_id', data_get($process, 'student_id', data_get($student ?? null, 'id')));
$teacherId = old('teacher_id', data_get($process, 'teacher_id'));
$evaluationDate = old('evaluation_date', data_get($process, 'evaluation_date') ? \Illuminate\Support\Carbon::parse(data_get($process, 'evaluation_date'))->format('Y-m-d') : now()->format('Y-m-d'));
$teachers = $teachers ?? \App\Models\User::query()->where('position', '!=', '---')->orderBy('name')->get();
$sections = [
['title'=>'1-ASPECTOS SÓCIO-','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'INTERAGE DE FORMA POSITIVA NOS MOMENTOS COLETIVOS',
'CONSEGUE REALIZAR ATIVIDADE SOZINHO',
'NECESSITA DO AUXÍLIO DA PROFESSORA',
'PARTICIPA DAS ATIVIDADES SOCIAIS: SEMANA INTERNACIONAL DA PESSOA COM DEFICIÊNCIA INTELECTUAL E MÚLTIPLA, FESTIVAL JUNINO, MOMENTO CÍVICO, CAMPANHAS BENEFICIENTES.',
'APRESENTA EMPATIA EM SITUAÇÕES ADVERSAS','SABE EXPRESSAR SUAS IDEIAS','SABE SER CRIATIVO QUANDO NECESSÁRIO.',
'ESTABELECE DIÁLOGO E É SOLÍCITO COM COLEGAS.','POSSUI AUTOCONTROLE EM MOMENTOS DE FRUSTRAÇÕES ESTANDO NO COLETIVO.']],
['title'=>'1.1.2-ASPECTOS EMOCIONAIS','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'SABE EXPRESSAR SEUS SENTIMENTOS','MANIFESTA INSEGURANÇA','APRESENTA TIMIDEZ',
'ATENDE OS CHAMADOS E AS SOLICITAÇÕES DA PROFESSORA',
'UTILIZA ATITUDES DE CORTESIA: OBRIGADO/POR FAVOR/DESCULPA/COM LICENÇA/DEMONSTRANDO BOAS MANEIRAS.',
'APRESENTA MUDANÇA DE COMPORTAMENTO','SEGUE RECOMENDAÇÕES E ORIENTAÇÕES',
'APRESENTA ALTERAÇÃO DE HUMOR E COMPORTAMENTO','IDENTIFICA E EXPRESSA SEUS SENTIMENTOS',
'FAZ COMENTÁRIOS OU BRINCADEIRAS INADEQUADAS','FAZ COISAS DE PROPÓSITO PARA ABORRECER OUTRAS PESSOAS',
'CULPA OS OUTROS POR SEUS ERROS OU MAU COMPORTAMENTO','É FACILMENTE IRRITADO PELOS OUTROS',
'FICA FACILMENTE ENVERGONHADO OU RESSENTIDO','É RANCOROSO OU VINGATIVO']],
['title'=>'1.2- ASPECTOS FÍSICOS','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'RESPEITA OS LIMITES DA FOLHA','TEM EQUILÍBRIO E AGILIDADE AO SE LOCOMOVER',
'SE EXPRESSA CORPORALMENTE AO SOM DE CANÇÕES SEGUINDO COMANDOS',
'PARTICIPA DAS ATIVIDADES PSICOMOTORAS COM INTERESSE','SEGURA CORRETAMENTE O LÁPIS E PINCEL',
'UTILIZA CORRETAMENTE A TESOURA','APRESENTA DIFICULDADE PARA APANHAR PEQUENOS OBJETOS (MOVIMENTO PINÇA).',
'CHEGA SONOLENTO AOS ATENDIMENTOS','PARTICIPA DAS ATIVIDADES DE COORDENAÇÃO MOTORA AMPLA COM HABILIDADE.',
'TEM DIFICULDADE DE ESPERAR SUA VEZ',
'ESTÁ SEMPRE EM MOVIMENTO OU FREQUENTEMENTE AGE COMO SE ESTIVESSE “LIGADO EM UM MOTOR”',
'DISTRAI-SE COM OS ESTÍMULOS EXTERNOS']],
['title'=>'2- COMUNICAÇÃO','options'=>['ALTERNATIVAS DE COMUNICAÇÃO'],'items'=>['UTILIZA DE QUAL COMUNICAÇÃO','É CAPAZ DE EXPRESSAR SUAS IDEIAS COM CLAREZA']],
['title'=>'2.1- EIXO DO CONHECIMENTO LINGUÍSTICO','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'APRECIA AULAS EM VÍDEOS E EM CANÇÕES','APRECIA AULAS EXPERIMENTAIS',
'FAZ A LEITURA INTERPRETATIVA DE VÍDEOS, CANÇÕES E CARTAZES, COMPREENDE O SOM DAS LETRAS.',
'ARTICULA CORRETAMENTE O SOM DAS LETRAS','É CAPAZ DE REPRODUZIR A LETRA ATRAVÉS DO SOM DA LETRA',
'É CAPAZ DE INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS ASSOCIADOS AO CONCRETO.']],
['title'=>'2.1.2- PERSPECTIVA DO LETRAMENTO','options'=>['SIM','EM PARTE','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'TEM LEITURA DE IMAGENS POR MEIO DE: GRAVURAS/RÓTULOS/LOGOMARCAS/PANFLETOS',
'É CAPAZ DE REPRODUZIR A ESCRITA ESPONTÂNEA ATRAVÉS DA IMAGEM.',
'REPRESENTA SUAS IDEIAS COM CLAREZA DE ACORDO COM SEU NÍVEL.',
'CONSEGUE REALIZAR A LEITURA POR MEIO DE:',
'LEITURA POR MEIO DE:']],
['title'=>'3- EIXO DO CONHECIMENTO LÓGICO MATEMÁTICO','options'=>['SIM','EM DESENVOLVIMENTO','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'IDENTIFICA OS NÚMEROS','IDENTIFICA AS CLASSES NUMÉRICAS','RELACIONA OS NÚMEROS ÀS QUANTIDADES CORRESPONDENTES',
'COMPREENDE O QUE É DEZENA E UNIDADE','CONSEGUE QUANTIFICAR','POSSUI NOÇÕES DE QUANTIDADE',
'CONSEGUE FAZER OPERAÇÕES SIMPLES DE MULTIPLICAÇÃO E DIVISÃO']],
['title'=>'3.2- SISTEMA MONETÁRIO E OPERAÇÕES MATEMÁTICAS','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'RECONHECE CÉDULAS DO SISTEMA MONETÁRIO: 2,00; 5,00; 10,00; 20,00; 50,00; 100,00; 200,00',
'RECONHECE MOEDAS DO SISTEMA MONETÁRIO: 0,05; 0,10; 0,25; 0,50; 1,00',
'CONSEGUE DIFERENCIAR VALORES','RECONHECE O MATERIAL DOURADO: CUBINHO, BARRA, PLACA, CUBO',
'CONSEGUE RESOLVER SITUAÇÕES-PROBLEMA UTILIZANDO O DINHEIRO','POSSUI NOÇÃO DE TROCO A PARTIR DOS VALORES']],
['title'=>'4- EIXO DO CONHECIMENTO NATUREZA E SOCIEDADE','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'ATENDE AO SER CHAMADO PELO NOME PRÓPRIO','É CAPAZ DE REPRESENTAR SEU AUTORRETRATO','É CAPAZ DE SE AUTORRECONHECER',
'PARTICIPA DAS ATIVIDADES COMEMORATIVAS?','RECONHECE E NOMEIA AS ESTAÇÕES DO ANO? INVERNO, VERÃO, OUTONO, PRIMAVERA',
'SABE DIZER COMO SE ENCONTRA EMOCIONALMENTE','SABE DIFERENCIAR ANIMAIS OVÍPAROS DOS MAMÍFEROS',
'IDENTIFICA OS COMPONENTES QUÍMICOS NA SOLUÇÃO ÁGUA E SABÃO?','RECONHECE OS PERSONAGENS DA HISTÓRIA DE JESUS',
'LEIS DE TRÂNSITO: CONHECE AS SINALIZAÇÕES VERTICAIS EM PLACAS; CONHECE AS SINALIZAÇÕES HORIZONTAIS EM PLACAS; RECONHECE O SEMÁFORO DE PEDESTRE; IDENTIFICA AS CORES E FUNÇÕES DO SEMÁFORO']],
['title'=>'5- EIXO DO CONHECIMENTO DAS ATIVIDADES DA VIDA DIÁRIA E PRÁTICA (AVD’S E AVP’S)','options'=>['SIM','RESTRIÇÃO','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'5.1- ATIVIDADE DE ALIMENTAÇÃO','SE ALIMENTA SÓ','TEM RESTRIÇÃO ALIMENTAR: DIABETE, HIPERTENSÃO, CELÍACA','POSSUI SELETIVIDADE ALIMENTAR',
'5.2- ATIVIDADE DE HIGIENE','SABE IDENTIFICAR OBJETOS DE HIGIENE','DEMONSTRA AUTO CUIDADO?','APRESENTA CUIDADOS COM A SAÚDE DO SEU CORPO',
'COMO SE SENTE QUANDO ESTÁ COM O CORPO SUJO E O CABELO EMBARAÇADO?','5.3- ATIVIDADES DE VESTUÁRIO',
'IDENTIFICA OS TIPOS DE VESTUÁRIO','VESTE-SE SOZINHO','CONSEGUE RETIRAR A ROUPA SOZINHO',
'IDENTIFICA OS LUGARES CORRETOS DE GUARDAR AS PEÇAS ÍNTIMAS DO VESTUÁRIO','SABE SE CALÇAR CORRETAMENTE',
'SABE DIFERENCIAR AS PEÇAS ÍNTIMAS LIMPAS DAS SUJAS?','SABE VESTIR AS MEIAS CORRETAMENTE?','COMO SE SENTE QUANDO ESTÁ COM SUAS VESTES SUJAS?',
'5.4- VIDA PRÁTICA','POSSUI ORGANIZAÇÃO AMBIENTAL','UTILIZA OS AMBIENTES DE HIGIENE ADEQUADAMENTE',
'IDENTIFICA E UTILIZA CORRETAMENTE OS OBJETOS DE LIMPEZA','CONSEGUE ANDAR NA RUA COM INDEPENDÊNCIA?','SABE TOMAR BANHO SOZINHO?',
'DIFERENCIA O XAMPU DO SABONETE','UTILIZA CORRETAMENTE OS PRODUTOS DE HIGIENE DO BANHO']],
['title'=>'5.5 EIXO DO CONHECIMENTO VIVÊNCIA CORPORAL','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'APRESENTA EQUILÍBRIO DO CORPO','É CAPAZ DE REALIZAR ATIVIDADES QUE ENVOLVAM A COORDENAÇÃO MOTORA?',
'RECONHECE AS PARTES DO CORPO','MOSTROU INTERESSE PELOS JOGOS COLETIVOS: TÊNIS, FUTEBOL, VÔLEI, BASQUETE, DAMA/XADREZ']],
['title'=>'5.6- ASPECTOS PSICOMOTORES','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'APRESENTA EQUILÍBRIO DE MARCHA ATRAVÉS DOS COMANDOS PULAR, SALTITAR EM PERCURSOS','POSSUI HABILIDADE MANUAL DE RECORTE',
'POSSUI HABILIDADE MANUAL DE COLAGEM','POSSUI IMAGEM CORPORAL','POSSUI AUTO ESTIMA']],
['title'=>'5.7- LATERALIDADE','options'=>['DIREITA','ESQUERDA','CRUZADA'],'items'=>[
'QUAL SEU LADO DOMINANTE','POSSUI LATERALIDADE DE OLHO','POSSUI LATERALIDADE DE MÃO','POSSUI LATERALIDADE DE OUVIDO','POSSUI LATERALIDADE DE PÉ','IDENTIFICA DIREITA E ESQUERDA EM SI MESMO']],
['title'=>'5.8- ASPECTOS COGNITIVOS','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'CONSEGUE RETIRAR A DIREITA E ESQUERDA NA ...','É CAPAZ DE REALIZAR A MONTAGEM DE QUEBRA-CABEÇAS','É CAPAZ DE REALIZAR A MONTAGEM DE GRAVURAS',
'É CAPAZ DE REALIZAR A MONTAGEM DE JOGOS','IDENTIFICA A SOMBRA DA IMAGEM','POSSUI PERCEPÇÃO NO JOGO DA MEMÓRIA','POSSUI ATENÇÃO SUSTENTADA',
'POSSUI CONCENTRAÇÃO NO MOMENTO DAS ATIVIDADES PROPOSTAS','POSSUI FLEXIBILIDADE COGNITIVA']],
['title'=>'6- ATIVIDADES DE EDUCAÇÃO FÍSICA/PSICOMOTRICIDADE','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'RECONHECIMENTO DAS PARTES DO CORPO','CONTROLE RESPIRATÓRIO','COMPREENDE O CONCEITO DE DENTRO E FORA?',
'ACEITA COM SATISFAÇÃO A ATIVIDADE COLETIVA','COMPREENDE O CONCEITO DE PERTO E LONGE','ACEITA COM ALEGRIA SE VER NO ESPELHO',
'POSSUI RIGIDEZ MUSCULAR?','POSSUI FLEXIBILIDADE NOS MEMBROS SUPERIORES','POSSUI FLEXIBILIDADE NOS MEMBROS INFERIORES?']],
['title'=>'7- ARTES','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'CONHECE AS CORES PRIMÁRIAS','CONHECE AS CORES SECUNDÁRIAS','CONSEGUE UTILIZAR O PINCEL RESPEITANDO O LIMITE DOS ESPAÇOS DEFINIDOS PELO DESENHO?',
'UTILIZA AS CORES COM REFERÊNCIA NOS OBJETOS DA REALIDADE','POSSUI HABILIDADE COM A TESOURA?']],
['title'=>'8- ASPECTOS QUE CONTAM COM O AUXÍLIO DA FAMÍLIA','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>[
'ASSIDUIDADE','PONTUALIDADE','USO DO UNIFORME','ACOMPANHAMENTO DA AGENDA/GRUPOS DA FAMÍLIA APAE E LIVES']],
];
@endphp

<div class="space-y-6">
<section class="dp-card">
<h2 class="dp-section-title">CAEE: CENTRO DE ATENDIMENTO EDUCACIONAL ESPECIALIZADO JOSÉ ALVES DOS SANTOS</h2>
<div class="grid gap-5 md:grid-cols-2">
<div><label class="dp-label" for="student_id">NOME:</label><select class="dp-field" id="student_id" name="student_id" required><option value="">Selecione o estudante</option>@foreach ($students as $student)<option value="{{ $student->id }}" @selected((string) $studentId === (string) $student->id)>{{ $student->name }}</option>@endforeach</select></div>
<div><label class="dp-label" for="teacher_id">PROFESSORA:</label><select class="dp-field" id="teacher_id" name="teacher_id" required><option value="">Selecione a professora</option>@foreach ($teachers as $teacher)<option value="{{ $teacher->id }}" @selected((string) $teacherId === (string) $teacher->id)>{{ $teacher->name }}</option>@endforeach</select></div>
<div><label class="dp-label" for="shift">TURNO:</label><select class="dp-field" id="shift" name="responses[turno]" required><option value="">Selecione o turno</option>@foreach (['MANHÃ', 'TARDE', 'INTEGRAL'] as $shift)<option value="{{ $shift }}" @selected(old('responses.turno', $responses['turno'] ?? '') === $shift)>{{ $shift }}</option>@endforeach</select></div>
<div><label class="dp-label" for="evaluation_date">DATA:</label><input class="dp-field" id="evaluation_date" type="date" name="evaluation_date" value="{{ $evaluationDate }}"></div>
</div>
<h2 class="mt-6 text-center text-lg font-bold text-gray-900 dark:text-gray-100">REGISTRO DE PROCESSO DE DESENVOLVIMENTO INDIVIDUAL CAEE</h2>
</section>

@foreach ($sections as $sectionIndex => $section)
<section class="dp-card">
<h2 class="dp-section-title">{{ $section['title'] }}</h2>
<div class="overflow-x-auto"><table class="dp-table"><thead><tr><th class="dp-item-column">TÓPICOS</th>@foreach ($section['options'] as $option)<th>{{ $option }}</th>@endforeach</tr></thead><tbody>
@if (str_contains($section['title'], 'COMUNICAÇÃO'))
@php
    $communicationOptions = ['VISUAL', 'EXPRESSÕES FACIAIS', 'MOVIMENTOS CORPORAIS', 'LIBRAS', 'BRAILLE', 'GESTOS', 'VERBAL', 'OUTRAS TEC. ASSISTIVA', 'DESCRIÇÃO VISUAL'];
    $communicationQuestions = ['UTILIZA DE QUAL COMUNICAÇÃO', 'É CAPAZ DE EXPRESSAR SUAS IDEIAS COM CLAREZA'];
@endphp
@foreach ($communicationQuestions as $itemIndex => $item)
    @php($key = 'secao-'.$sectionIndex.'-item-'.$itemIndex)
    <tr>
        <td class="dp-item-text">{{ $item }}</td>
        <td class="dp-choice-cell" colspan="{{ count($section['options']) }}">
            <div class="dp-multi-options">
                @foreach ($communicationOptions as $option)
                    <label class="dp-choice">
                        <input type="checkbox" name="responses[{{ $key }}][]" value="{{ $option }}" @checked(in_array($option, (array) ($responses[$key] ?? []), true)) aria-label="{{ $option }}">
                        <span>{{ $option }}</span>
                    </label>
                @endforeach
            </div>
        </td>
    </tr>
@endforeach
@else
@foreach ($section['items'] as $itemIndex => $item)
    @php($key = 'secao-'.$sectionIndex.'-item-'.$itemIndex)
    @php($isSoundLetters = str_contains($item, 'COMPREENDE O SOM DAS LETRAS'))
    @php($isInterpretation = str_contains($item, 'INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS'))
    @php($literacyOptions = match (true) {
        str_contains($item, 'ESCRITA ESPONTÂNEA') => ['LIBRAS','ESCRITA','GESTOS','VERBALMENTE'],
        str_contains($item, 'REPRESENTA SUAS IDEIAS') => ['GARATUJA/RABISCO','DESENHO','ESCRITA','ORALMENTE'],
        str_contains($item, 'CONSEGUE REALIZAR A LEITURA POR MEIO DE') => ['DESENHO','DE MEMÓRIA','CRIATIVA'],
        str_contains($item, 'LEITURA POR MEIO DE:') => ['LIBRAS','BRAILLE','FRASES','TEXTOS','IMAGENS','SÍLABAS SIMPLES','SOMENTE LETRAS','GESTOS'],
        default => [],
    })
    @php($specialOptions = $isSoundLetters ? ['VOGAIS','VOGAIS EM PARTE','CONSOANTES','CONSOANTES EM PARTE','SÍLABAS','SÍLABAS EM PARTE','PALAVRAS','PALAVRAS EM PARTE'] : ($isInterpretation ? ['LIBRAS','BRAILLE','GESTOS','VERBAL','OUTRA TEC. ASSISTIVA','DESCRIÇÃO VISUAL'] : $literacyOptions))
    <tr>
        <td class="dp-item-text">{{ $item }}</td>
        @if ($specialOptions)
            <td class="dp-choice-cell" colspan="{{ count($section['options']) }}"><div class="dp-multi-options">
                @foreach ($specialOptions as $option)
                    <label class="dp-choice"><input type="checkbox" name="responses[{{ $key }}][]" value="{{ $option }}" @checked(in_array($option, (array) ($responses[$key] ?? []), true))><span>{{ $option }}</span></label>
                @endforeach
            </div></td>
        @else
            @foreach ($section['options'] as $option)
                <td class="dp-choice-cell"><label class="dp-choice"><input type="radio" name="responses[{{ $key }}]" value="{{ $option }}" @checked(($responses[$key] ?? '') === $option) aria-label="{{ $option }}"><span>{{ $option }}</span></label></td>
            @endforeach
        @endif
    </tr>
@endforeach
@endif
</tbody></table></div>
</section>
@endforeach

<section class="dp-card">
<h2 class="dp-section-title">ASSINATURAS</h2>
<div class="grid gap-5 md:grid-cols-2">
<div><label class="dp-label" for="teacher_signature">ASSINATURA DA PROFESSORA</label><input class="dp-field" id="teacher_signature" name="teacher_signature" value="{{ old('teacher_signature', data_get($process, 'teacher_signature')) }}"></div>
<div><label class="dp-label" for="coordination_signature">ASSINATURA DA COORDENAÇÃO</label><input class="dp-field" id="coordination_signature" name="coordination_signature" value="{{ old('coordination_signature', data_get($process, 'coordination_signature')) }}"></div>
</div>
<p class="mt-5 text-center text-xs text-gray-600 dark:text-gray-300">TRATE A TODOS COM IGUALDADE E RESPEITO. MAS NA HORA DA AÇÃO USE A EQUIDADE COMO MEDIDA.</p>
</section>
<section class="dp-card">
<h2 class="dp-section-title">Observações complementares</h2>
<label class="dp-label" for="observations">Observações</label><textarea class="dp-field dp-textarea" id="observations" name="observations" rows="4">{{ old('observations', data_get($process, 'observations')) }}</textarea>
<label class="dp-label mt-5" for="family_guidance">Orientações / acompanhamento da família</label><textarea class="dp-field dp-textarea" id="family_guidance" name="family_guidance" rows="4">{{ old('family_guidance', data_get($process, 'family_guidance')) }}</textarea>
</section>
<div class="flex flex-wrap justify-end gap-3"><a class="dp-button dp-button-secondary" href="{{ route('development-processes.index') }}">Cancelar</a><button class="dp-button dp-button-primary" type="submit">{{ $submitLabel ?? 'Salvar registro' }}</button></div>
</div>

<style>
.dp-card{background:#fff;border:1px solid #e2e8e2;border-radius:14px;padding:20px;color:#42564a;box-shadow:0 3px 14px rgba(31,81,58,.045)}
.dp-section-title{font-size:1rem;font-weight:750;color:#1f513a;margin-bottom:14px}
.dp-label{display:block;font-size:.85rem;font-weight:700;color:#42564a;margin-bottom:7px}
.dp-field{width:100%;border:1px solid #d7e1d8;border-radius:7px;padding:8px 10px;background:#fff;color:#24372c;outline:none}
.dp-field:focus{border-color:#2f6b4f;box-shadow:0 0 0 3px rgba(47,107,79,.12)}
.dp-table{width:100%;border-collapse:collapse;font-size:.78rem}.dp-table th,.dp-table td{border:1px solid #9ca3af;padding:8px;vertical-align:top}.dp-table th{background:#f1f4ef;color:#26382d;font-weight:750;text-align:center}.dp-table .dp-item-column{min-width:270px;text-align:left}.dp-table td:not(:first-child){min-width:80px}.dp-choice{display:flex;align-items:flex-start;justify-content:center;gap:5px}.dp-choice input{margin-top:3px}.dp-multi-options{display:flex;flex-wrap:wrap;gap:12px 18px}.dp-multi-options .dp-choice{min-width:max-content}.dp-multi-options .dp-choice{justify-content:flex-start;align-items:center}.dp-multi-options .dp-choice input{flex-shrink:0}.dp-item-text{min-width:270px;font-weight:500;text-transform:uppercase;white-space:pre-line}
.dp-button{display:inline-flex;align-items:center;justify-content:center;border-radius:10px;padding:10px 16px;font-weight:650;text-decoration:none}.dp-button-primary{background:#2f6b4f;color:#fff;border:1px solid #2f6b4f}.dp-button-primary:hover{background:#1f513a}.dp-button-secondary{background:#fff;color:#42564a;border:1px solid #d7e1d8}.dp-textarea{resize:vertical}
.dark .dp-card{background:#14271e;border-color:#294236;box-shadow:none;color:#d1dbd3}.dark .dp-section-title{color:#8cc9a3}.dark .dp-label{color:#d1dbd3}.dark .dp-field{background:#0f2018;border-color:#294236;color:#f5f1e8}.dark .dp-table th{background:#1a3025;color:#d1dbd3}.dark .dp-table td,.dark .dp-table th{border-color:#496253}.dark .dp-button-secondary{background:#1a3025;color:#d1dbd3;border-color:#294236}
@media print{nav,header,button,.dp-button{display:none!important}.dp-card{break-inside:avoid;box-shadow:none;border-color:#ccc}.dp-table{font-size:9px}}
</style>