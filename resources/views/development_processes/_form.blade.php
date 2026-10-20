@php
$process = $process ?? $record ?? $individualDevelopment ?? null;
$responses = old('responses', data_get($process, 'responses', []));
$studentId = old('student_id', data_get($process, 'student_id', data_get($student ?? null, 'id')));
$teacherId = old('teacher_id', data_get($process, 'teacher_id'));
$evaluationDate = old('evaluation_date', data_get($process, 'evaluation_date') ? \Illuminate\Support\Carbon::parse(data_get($process, 'evaluation_date'))->format('Y-m-d') : now()->format('Y-m-d'));
$teachers = $teachers ?? \App\Models\User::query()->where('position', '!=', '---')->orderBy('name')->get();

$sections = [
['title'=>'1-ASPECTOS SÓCIO-','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['INTERAGE DE FORMA POSITIVA NOS MOMENTOS COLETIVOS','CONSEGUE REALIZAR ATIVIDADE SOZINHO','NECESSITA DO AUXÍLIO DA PROFESSORA','PARTICIPA DAS ATIVIDADES SOCIAIS: SEMANA INTERNACIONAL DA PESSOA COM DEFICIÊNCIA INTELECTUAL E MÚLTIPLA, FESTIVAL JUNINO, MOMENTO CÍVICO, CAMPANHAS BENEFICIENTES.','APRESENTA EMPATIA EM SITUAÇÕES ADVERSAS','SABE EXPRESSAR SUAS IDEIAS','SABE SER CRIATIVO QUANDO NECESSÁRIO.','ESTABELECE DIÁLOGO E É SOLÍCITO COM COLEGAS.','POSSUI AUTOCONTROLE EM MOMENTOS DE FRUSTRAÇÕES ESTANDO NO COLETIVO.']],
['title'=>'1.1.2-ASPECTOS EMOCIONAIS','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['SABE EXPRESSAR SEUS SENTIMENTOS','MANIFESTA INSEGURANÇA','APRESENTA TIMIDEZ','ATENDE OS CHAMADOS E AS SOLICITAÇÕES DA PROFESSORA','UTILIZA ATITUDES DE CORTESIA: OBRIGADO/POR FAVOR/DESCULPA/COM LICENÇA/DEMONSTRANDO BOAS MANEIRAS.','APRESENTA MUDANÇA DE COMPORTAMENTO','SEGUE RECOMENDAÇÕES E ORIENTAÇÕES','APRESENTA ALTERAÇÃO DE HUMOR E COMPORTAMENTO','DESAFIA ATIVAMENTE OU RECUSA PEDIDOS DOS ADULTOS OU REGRAS','FAZ COISAS DE PROPÓSITO PARA ABORRECER OUTRAS PESSOAS','CULPA OS OUTROS POR SEUS ERROS OU MAU COMPORTAMENTO','É SUSCETÍVEL OU FACILMENTE ABORRECIDO PELOS OUTROS','FICA FACILMENTE ENRAIVECIDO E RESSENTIDO','É RANCOROSO OU VINGATIVO']],
['title'=>'1.2- ASPECTOS FÍSICOS','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['RESPEITA OS LIMITES DA FOLHA','TEM EQUILÍBRIO E AGILIDADE AO SE LOCOMOVER','SE EXPRESSA CORPORALMENTE AO SOM DE CANÇÕES SEGUINDO COMANDOS','PARTICIPA DAS ATIVIDADES PSICOMOTORAS COM INTERESSE','SEGURA CORRETAMENTE O LÁPIS E PINCEL','UTILIZA CORRETAMENTE A TESOURA','APRESENTA DIFICULDADE PARA APANHAR PEQUENOS OBJETOS (MOVIMENTO PINÇA).','CHEGA SONOLENTO AOS ATENDIMENTOS','PARTICIPA DAS ATIVIDADES DE COORDENAÇÃO MOTORA AMPLA COM HABILIDADE.','TEM DIFICULDADE DE ESPERAR SUA VEZ','ESTÁ SEMPRE EM MOVIMENTO OU FREQUENTEMENTE AGE COMO SE ESTIVESSE “LIGADO EM UM MOTOR”','DISTRAI-SE COM OS ESTÍMULOS EXTERNOS']],
['title'=>'2- COMUNICAÇÃO','options'=>['ALTERNATIVAS DE COMUNICAÇÃO'],'items'=>['UTILIZA DE QUAL COMUNICAÇÃO','É CAPAZ DE EXPRESSAR SUAS IDEIAS COM CLAREZA']],
['title'=>'2.1- EIXO DO CONHECIMENTO LINGUÍSTICO','options'=>['SIM','EM PARTE','AINDA NÃO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['APRECIA AULAS EM VÍDEOS E EM CANÇÕES','APRECIA AULAS EXPERIMENTAIS','FAZ A LEITURA INTERPRETATIVA DE VÍDEOS, CANÇÕES E CARTAZES','COMPREENDE O SOM DAS LETRAS','ARTICULA CORRETAMENTE O SOM DAS LETRAS','É CAPAZ DE REPRODUZIR A LETRA ATRAVÉS DO SOM DA LETRA','É CAPAZ DE INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS ASSOCIADOS AO CONCRETO.']],
['title'=>'2.1.2- PERSPECTIVA DO LETRAMENTO','options'=>['SIM','EM PARTE','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['TEM LEITURA DE IMAGENS POR MEIO DE: GRAVURAS/RÓTULOS/LOGOMARCAS/PANFLETOS','É CAPAZ DE REPRODUZIR A ESCRITA ESPONTÂNEA ATRAVÉS DA IMAGEM.','REPRESENTA SUAS IDEIAS COM CLAREZA DE ACORDO COM SEU NÍVEL.','CONSEGUE REALIZAR A LEITURA POR MEIO DE:','LEITURA POR MEIO DE:','REPRESENTA LETRAS TRABALHADAS','REPRESENTA LETRAS TRABALHADAS','ESCREVE O NOME PRÓPRIO','NÍVEL DA ESCRITA']],
['title'=>'3- EIXO DO CONHECIMENTO LÓGICO MATEMÁTICO','options'=>['SIM','EM DESENVOLVIMENTO','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['IDENTIFICA OS NÚMEROS','IDENTIFICA AS CLASSES NUMÉRICAS','RELACIONA OS NÚMEROS ÀS QUANTIDADES CORRESPONDENTES','COMPREENDE O QUE É DEZENA E UNIDADE','CONSEGUE QUANTIFICAR','POSSUI NOÇÕES DE QUANTIDADE','CONSEGUE FAZER OPERAÇÕES SIMPLES DE MULTIPLICAÇÃO E DIVISÃO']],
['title'=>'3.2- SISTEMA MONETÁRIO E OPERAÇÕES MATEMÁTICAS','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['RECONHECE CÉDULAS DO SISTEMA MONETÁRIO: 2,00; 5,00; 10,00; 20,00; 50,00; 100,00; 200,00','RECONHECE MOEDAS DO SISTEMA MONETÁRIO: 0,05; 0,10; 0,25; 0,50; 1,00','CONSEGUE DIFERENCIAR VALORES','RECONHECE O MATERIAL DOURADO: CUBINHO, BARRA, PLACA, CUBO','CONSEGUE RESOLVER SITUAÇÕES-PROBLEMA UTILIZANDO O DINHEIRO','POSSUI NOÇÃO DE TROCO A PARTIR DOS VALORES']],
['title'=>'4- EIXO DO CONHECIMENTO NATUREZA E SOCIEDADE','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['ATENDE AO SER CHAMADO PELO NOME PRÓPRIO','É CAPAZ DE REPRESENTAR SEU AUTORRETRATO','É CAPAZ DE SE AUTORRECONHECER','PARTICIPA DAS ATIVIDADES COMEMORATIVAS?','RECONHECE E NOMEIA AS ESTAÇÕES DO ANO? INVERNO, VERÃO, OUTONO, PRIMAVERA','SABE DIZER COMO SE ENCONTRA EMOCIONALMENTE','SABE DIFERENCIAR ANIMAIS OVÍPAROS DOS MAMÍFEROS','IDENTIFICA OS COMPONENTES QUÍMICOS NA SOLUÇÃO ÁGUA E SABÃO?','RECONHECE OS PERSONAGENS DA HISTÓRIA DE JESUS','LEIS DE TRÂNSITO','CONHECE AS SINALIZAÇÕES VERTICAIS EM PLACAS','CONHECE AS SINALIZAÇÕES HORIZONTAIS EM PLACAS','RECONHECE O SEMÁFORO DE PEDESTRE','IDENTIFICA AS CORES E FUNÇÕES DO SEMÁFORO']],
['title'=>'5- EIXO DO CONHECIMENTO DAS ATIVIDADES DA VIDA DIÁRIA E PRÁTICA (AVD’S E AVP’S)','options'=>['SIM','RESTRIÇÃO','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['5.1- ATIVIDADE DE ALIMENTAÇÃO','SE ALIMENTA SÓ','TEM RESTRIÇÃO ALIMENTAR: DIABETE, HIPERTENSÃO, CELÍACA','POSSUI SELETIVIDADE ALIMENTAR','5.2- ATIVIDADE DE HIGIENE','SABE IDENTIFICAR OBJETOS DE HIGIENE','DEMONSTRA AUTO CUIDADO?','APRESENTA CUIDADOS COM A SAÚDE DO SEU CORPO','COMO SE SENTE QUANDO ESTÁ COM O CORPO SUJO E O CABELO EMBARAÇADO?','5.3- ATIVIDADES DE VESTUÁRIO','IDENTIFICA OS TIPOS DE VESTUÁRIO','VESTE-SE SOZINHO','CONSEGUE RETIRAR A ROUPA SOZINHO','IDENTIFICA OS LUGARES CORRETOS DE GUARDAR AS PEÇAS ÍNTIMAS DO VESTUÁRIO','SABE SE CALÇAR CORRETAMENTE','SABE DIFERENCIAR AS PEÇAS ÍNTIMAS LIMPAS DAS SUJAS?','SABE VESTIR AS MEIAS CORRETAMENTE?','COMO SE SENTE QUANDO ESTÁ COM SUAS VESTES SUJAS?','5.4- VIDA PRÁTICA','POSSUI ORGANIZAÇÃO AMBIENTAL','UTILIZA OS AMBIENTES DE HIGIENE ADEQUADAMENTE','IDENTIFICA E UTILIZA CORRETAMENTE OS OBJETOS DE LIMPEZA','CONSEGUE ANDAR NA RUA COM INDEPENDÊNCIA?','SABE TOMAR BANHO SOZINHO?','DIFERENCIA O XAMPU DO SABONETE','UTILIZA CORRETAMENTE OS PRODUTOS DE HIGIENE DO BANHO']],
['title'=>'5.5 EIXO DO CONHECIMENTO VIVÊNCIA CORPORAL','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['APRESENTA EQUILÍBRIO DO CORPO','É CAPAZ DE REALIZAR ATIVIDADES QUE ENVOLVAM A COORDENAÇÃO MOTORA?','RECONHECE AS PARTES DO CORPO','MOSTROU INTERESSE PELOS JOGOS COLETIVOS: TÊNIS, FUTEBOL, VÔLEI, BASQUETE, DAMA/XADREZ']],
['title'=>'5.6- ASPECTOS PSICOMOTORES','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['APRESENTA EQUILÍBRIO DE MARCHA ATRAVÉS DOS COMANDOS PULAR, SALTITAR EM PERCURSOS','POSSUI HABILIDADE MANUAL DE RECORTE','POSSUI HABILIDADE MANUAL DE COLAGEM','POSSUI IMAGEM CORPORAL','POSSUI AUTO ESTIMA']],
['title'=>'5.7- LATERALIDADE','options'=>['DIREITA','ESQUERDA','CRUZADA'],'items'=>['QUAL SEU LADO DOMINANTE','POSSUI LATERALIDADE DE OLHO','POSSUI LATERALIDADE DE MÃO','POSSUI LATERALIDADE DE OUVIDO','POSSUI LATERALIDADE DE PÉ','IDENTIFICA DIREITA E ESQUERDA EM SI MESMO']],
['title'=>'5.8- ASPECTOS COGNITIVOS','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['CONSEGUE REALIZAR O ENCAIXE DE JOGOS PROPOSTOS','É CAPAZ DE REALIZAR A MONTAGEM DE QUEBRA-CABEÇAS','É CAPAZ DE REALIZAR A MONTAGEM DE GRAVURAS','É CAPAZ DE REALIZAR A MONTAGEM DE JOGOS','IDENTIFICA A SOMBRA DA IMAGEM','POSSUI PERCEPÇÃO NO JOGO DA MEMÓRIA','POSSUI ATENÇÃO SUSTENTADA','POSSUI CONCENTRAÇÃO NO MOMENTO DAS ATIVIDADES PROPOSTAS','POSSUI FLEXIBILIDADE COGNITIVA']],
['title'=>'6- ATIVIDADES DE EDUCAÇÃO FÍSICA/PSICOMOTRICIDADE','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['RECONHECIMENTO DAS PARTES DO CORPO','CONTROLE RESPIRATÓRIO','COMPREENDE O CONCEITO DE DENTRO E FORA?','ACEITA COM SATISFAÇÃO A ATIVIDADE COLETIVA','COMPREENDE O CONCEITO DE PERTO E LONGE','ACEITA COM ALEGRIA SE VER NO ESPELHO','POSSUI RIGIDEZ MUSCULAR?','POSSUI FLEXIBILIDADE NOS MEMBROS SUPERIORES','POSSUI FLEXIBILIDADE NOS MEMBROS INFERIORES?']],
['title'=>'7- ARTES','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['CONHECE AS CORES PRIMÁRIAS','CONHECE AS CORES SECUNDÁRIAS','CONSEGUE UTILIZAR O PINCEL RESPEITANDO O LIMITE DOS ESPAÇOS DEFINIDOS PELO DESENHO?','UTILIZA AS CORES COM REFERÊNCIA NOS OBJETOS DA REALIDADE','POSSUI HABILIDADE COM A TESOURA?']],
['title'=>'8- ASPECTOS QUE CONTAM COM O AUXÍLIO DA FAMÍLIA','options'=>['SIM','EM PARTE','AINDA NÃO','COM AUXÍLIO','NÃO FOI POSSÍVEL AVALIAR'],'items'=>['ASSIDUIDADE','PONTUALIDADE','USO DO UNIFORME','ACOMPANHAMENTO DA AGENDA/GRUPOS DA FAMÍLIA APAE E LIVES']],
];
@endphp

@if ($errors->any())
<div class="caee-alert" role="alert">
    <strong>Confira os campos abaixo:</strong>
    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
</div>
@endif

<div class="caee-form">
    <section class="caee-hero">
        <div class="caee-brand-mark" aria-hidden="true">A</div>
        <div class="caee-hero-copy">
            <p class="caee-kicker">APAE RUSSAS · ATENDIMENTO EDUCACIONAL ESPECIALIZADO</p>
            <h1>Registro de Processo de Desenvolvimento Individual</h1>
            <p>CAEE — Centro de Atendimento Educacional Especializado José Alves dos Santos</p>
        </div>
    </section>

    <section class="caee-panel">
        <div class="caee-panel-heading"><span class="caee-step">01</span><div><h2>Identificação do estudante</h2><p>Preencha os dados antes de iniciar o registro.</p></div></div>
        <div class="caee-fields">
            <div class="caee-field"><label for="student_id">Nome do estudante</label><select id="student_id" name="student_id" required><option value="">Selecione o estudante</option>@foreach ($students as $student)<option value="{{ $student->id }}" @selected((string) $studentId === (string) $student->id)>{{ $student->name }}</option>@endforeach</select></div>
            <div class="caee-field"><label for="teacher_id">Professora responsável</label><select id="teacher_id" name="teacher_id" required><option value="">Selecione a professora</option>@foreach ($teachers as $teacher)<option value="{{ $teacher->id }}" @selected((string) $teacherId === (string) $teacher->id)>{{ $teacher->name }}</option>@endforeach</select></div>
            <div class="caee-field"><label for="shift">Turno</label><select id="shift" name="responses[turno]" required><option value="">Selecione</option>@foreach (['MANHÃ','TARDE','INTEGRAL'] as $shift)<option value="{{ $shift }}" @selected(old('responses.turno', $responses['turno'] ?? '') === $shift)>{{ $shift }}</option>@endforeach</select></div>
            <div class="caee-field"><label for="evaluation_date">Data da avaliação</label><input id="evaluation_date" type="date" name="evaluation_date" value="{{ $evaluationDate }}" required></div>
        </div>
    </section>

    @foreach ($sections as $sectionIndex => $section)
        <section class="caee-panel caee-section">
            <div class="caee-panel-heading"><span class="caee-step">{{ str_pad($sectionIndex + 2, 2, '0', STR_PAD_LEFT) }}</span><div><h2>{{ $section['title'] }}</h2><p>{{ count($section['items']) }} {{ count($section['items']) === 1 ? 'item para avaliar' : 'itens para avaliar' }}</p></div></div>
            @if (str_contains($section['title'], 'COMUNICAÇÃO'))
                @php
                    $communicationQuestions = [
                        ['label'=>'UTILIZA DE QUAL COMUNICAÇÃO','options'=>['VISUAL','EXPRESSÕES FACIAIS','MOVIMENTOS CORPORAIS','LIBRAS','BRAILLE','GESTOS','VERBAL','ALTERNATIVA']],
                        ['label'=>'É CAPAZ DE EXPRESSAR SUAS IDEIAS COM CLAREZA','options'=>['LIBRAS','BRAILLE','GESTOS','VERBAL','OUTRA TEC. ASSISTIVA','DESCRIÇÃO VISUAL']],
                    ];
                @endphp
                @foreach ($communicationQuestions as $itemIndex => $question)
                    @php $key = 'secao-'.$sectionIndex.'-item-'.$itemIndex; @endphp
                    <div class="caee-question">
                        <p class="caee-question-title">{{ $question['label'] }}</p>
                        <div class="caee-options caee-options-check">
                            @foreach ($question['options'] as $option)
                                <label class="caee-option"><input type="checkbox" name="responses[{{ $key }}][]" value="{{ $option }}" @checked(in_array($option, (array) ($responses[$key] ?? []), true))><span>{{ $option }}</span></label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($section['items'] as $itemIndex => $item)
                    @php
                        $key = 'secao-'.$sectionIndex.'-item-'.$itemIndex;
                        $isSubheading = preg_match('/^(5\.[1-4]-|LEIS DE TRÂNSITO$)/u', $item) === 1;
                        $specialOptions = [];
                        if (str_contains($item, 'COMPREENDE O SOM DAS LETRAS')) $specialOptions = ['VOGAIS EM PARTE','CONSOANTES EM PARTE','SÍLABAS EM PARTE','PALAVRAS EM PARTE'];
                        elseif (str_contains($item, 'INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS')) $specialOptions = ['LIBRAS','BRAILLE','GESTOS','VERBAL','OUTRA TEC. ASSISTIVA','DESCRIÇÃO VISUAL'];
                        elseif (str_contains($item, 'RECONHECE CÉDULAS DO SISTEMA MONETÁRIO')) $specialOptions = ['2,00','5,00','10,00','20,00','50,00','100,00','200,00'];
                        elseif (str_contains($item, 'RECONHECE MOEDAS DO SISTEMA MONETÁRIO')) $specialOptions = ['0,05','0,10','0,25','0,50','1,00'];
                        elseif (str_contains($item, 'POSSUI NOÇÃO DE TROCO')) $specialOptions = ['1,00','2,00','5,00','10,00','20,00'];
                        elseif (str_contains($item, 'TEM RESTRIÇÃO ALIMENTAR')) $specialOptions = ['DIABETE','HIPERTENSÃO','CELÍACA'];
                        elseif (str_contains($item, 'RECONHECE O MATERIAL DOURADO')) $specialOptions = ['CUBINHO','BARRA','PLACA','CUBO'];
                        elseif (str_contains($item, 'RECONHECE E NOMEIA AS ESTAÇÕES DO ANO')) $specialOptions = ['INVERNO','VERÃO','OUTONO','PRIMAVERA'];
                        elseif (str_contains($item, 'MOSTROU INTERESSE PELOS JOGOS COLETIVOS')) $specialOptions = ['TÊNIS/BOLICHE','FUTEBOL','VÔLEI','BASQUETE','DAMA/XADREZ'];
                        elseif (str_contains($item, 'IDENTIFICA AS CLASSES NUMÉRICAS')) $specialOptions = ['UNIDADE','DEZENA','CENTENA','UNIDADE DE MILHAR'];
                        elseif (str_contains($item, 'ESCRITA ESPONTÂNEA')) $specialOptions = ['LIBRAS','ESCRITA','GESTOS','VERBALMENTE'];
                        elseif (str_contains($item, 'REPRESENTA SUAS IDEIAS')) $specialOptions = ['GARATUJA/RABISCO','DESENHO','ESCRITA','ORALMENTE'];
                        elseif (str_contains($item, 'CONSEGUE REALIZAR A LEITURA POR MEIO DE')) $specialOptions = ['DESENHO','DE MEMÓRIA','CRIATIVA'];
                        elseif (str_contains($item, 'LEITURA POR MEIO DE:')) $specialOptions = ['LIBRAS','BRAILLE','FRASES','TEXTOS','IMAGENS','SÍLABAS SIMPLES','SOMENTE LETRAS','GESTOS'];
                        elseif (str_contains($item, 'ESCREVE O NOME PRÓPRIO')) $specialOptions = ['COMPLETO','PRÉ-NOME','PARTES DO NOME','COM AUXÍLIO DA FICHA','COM AUXÍLIO DA PROFESSORA','AINDA NÃO CONSEGUE'];
                        elseif (str_contains($item, 'NÍVEL DA ESCRITA')) $specialOptions = ['GARATUJA','PRÉ-SILÁBICO','SILÁBICO','SILÁBICO ALFABÉTICO','ALFABÉTICO','AINDA NÃO FOI POSSÍVEL AVALIAR'];
                        elseif (str_contains($item, 'REPRESENTA LETRAS TRABALHADAS') && $itemIndex === 5) $specialOptions = ['ESCRITA CONVENCIONAL TODAS AS LETRAS','ESCRITA CONVENCIONAL DE ALGUMAS LETRAS','ESCRITA DE LETRAS OBSERVANDO O MODELO TRAÇOS/CURVAS E RABISCOS','MOVIMENTOS LINEARES','MOVIMENTOS CIRCULARES'];
                        elseif (str_contains($item, 'REPRESENTA LETRAS TRABALHADAS')) $specialOptions = ['INICIAIS DAS PALAVRAS','ACOMPANHA O TRAÇADO DE LETRAS','FAZ TENTATIVAS DE REPRODUZIR O TRAÇADO DE LETRAS COM AUXÍLIO'];
                    @endphp

                    @if ($isSubheading)
                        <div class="caee-subheading">{{ $item }}</div>
                    @else
                        <div class="caee-question">
                            <p class="caee-question-title">{{ $item }}</p>
                            @if (!empty($specialOptions))
                                <div class="caee-options caee-options-check">
                                    @foreach ($specialOptions as $option)
                                        <label class="caee-option"><input type="checkbox" name="responses[{{ $key }}][]" value="{{ $option }}" @checked(in_array($option, (array) ($responses[$key] ?? []), true))><span>{{ $option }}</span></label>
                                    @endforeach
                                </div>
                            @else
                                <div class="caee-options">
                                    @foreach ($section['options'] as $option)
                                        <label class="caee-option"><input type="radio" name="responses[{{ $key }}]" value="{{ $option }}" @checked(($responses[$key] ?? '') === $option)><span>{{ $option }}</span></label>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @endif
        </section>
    @endforeach

    <section class="caee-panel">
        <div class="caee-panel-heading"><span class="caee-step">✎</span><div><h2>Observações e acompanhamento</h2><p>Registre informações complementares relevantes.</p></div></div>
        <div class="caee-fields caee-fields-one">
            <div class="caee-field"><label for="observations">Observações</label><textarea id="observations" class="caee-textarea" name="observations" rows="4">{{ old('observations', data_get($process, 'observations')) }}</textarea></div>
            <div class="caee-field"><label for="family_guidance">Orientações / acompanhamento da família</label><textarea id="family_guidance" class="caee-textarea" name="family_guidance" rows="4">{{ old('family_guidance', data_get($process, 'family_guidance')) }}</textarea></div>
        </div>
    </section>

    <div class="caee-actions"><a class="caee-btn caee-btn-light" href="{{ route('development-processes.index') }}">Cancelar</a><button class="caee-btn caee-btn-primary" type="submit">{{ $submitLabel ?? 'Salvar registro' }}</button></div>
</div>

<style>
.caee-form{--caee-green:#2f6b4f;--caee-green-dark:#1f513a;--caee-green-soft:#eaf3ec;--caee-ink:#26382d;--caee-muted:#6b7b70;--caee-border:#dce6de;--caee-surface:#fff;--caee-field:#fff;display:flex;flex-direction:column;gap:22px;color:var(--caee-ink)}
.caee-hero{display:flex;align-items:center;gap:20px;padding:28px;border-radius:18px;background:linear-gradient(120deg,#1f513a,#347858);color:#fff;box-shadow:0 8px 24px rgba(31,81,58,.13)}
.caee-brand-mark{display:flex;align-items:center;justify-content:center;flex:0 0 58px;width:58px;height:58px;border:1px solid rgba(255,255,255,.55);border-radius:17px;font-size:30px;font-weight:800;color:#fff;background:rgba(255,255,255,.12)}
.caee-kicker{margin:0 0 7px;font-size:11px;font-weight:800;letter-spacing:.13em;opacity:.82}
.caee-hero h1{margin:0;font-size:clamp(1.25rem,2.5vw,1.85rem);font-weight:800;line-height:1.25;color:#fff}
.caee-hero-copy>p:last-child{margin:7px 0 0;font-size:.92rem;opacity:.9}
.caee-panel{padding:24px;border:1px solid var(--caee-border);border-radius:16px;background:var(--caee-surface);box-shadow:0 3px 14px rgba(28,55,37,.035);min-width:0}
.caee-panel-heading{display:flex;align-items:flex-start;gap:13px;margin-bottom:21px;padding-bottom:17px;border-bottom:1px solid var(--caee-border)}
.caee-step{display:flex;align-items:center;justify-content:center;flex:0 0 38px;height:38px;border-radius:12px;background:var(--caee-green-soft);color:var(--caee-green-dark);font-size:.78rem;font-weight:850}
.caee-panel-heading h2{margin:1px 0 4px;color:var(--caee-green-dark);font-size:1.08rem;font-weight:800;line-height:1.4}
.caee-panel-heading p{margin:0;color:var(--caee-muted);font-size:.84rem}
.caee-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:18px}
.caee-fields-one{grid-template-columns:minmax(0,1fr)}
.caee-field{display:flex;flex-direction:column;gap:7px;min-width:0}
.caee-field label{font-size:.83rem;font-weight:750;color:var(--caee-ink)}
.caee-field input,.caee-field select,.caee-textarea{width:100%;min-height:44px;border:1px solid #d5e0d7;border-radius:10px;padding:10px 12px;background:var(--caee-field);color:var(--caee-ink);font:inherit;font-size:.92rem;outline:none;transition:border-color .15s,box-shadow .15s}
.caee-field input:focus,.caee-field select:focus,.caee-textarea:focus{border-color:var(--caee-green);box-shadow:0 0 0 3px rgba(47,107,79,.12)}
.caee-textarea{resize:vertical;min-height:110px}
.caee-question{padding:17px 0;border-bottom:1px solid #e9eee9}
.caee-question-title{margin:0 0 13px;color:var(--caee-ink);font-size:.9rem;font-weight:700;line-height:1.55}
.caee-options{display:flex;flex-wrap:wrap;gap:8px}
.caee-option{position:relative;display:inline-flex;align-items:center;gap:8px;max-width:100%;min-height:36px;padding:8px 11px;border:1px solid var(--caee-border);border-radius:9px;background:#fbfcfa;color:#405347;font-size:.8rem;line-height:1.35;cursor:pointer;transition:background .15s,border-color .15s,box-shadow .15s}
.caee-option:hover{border-color:#8eb49a;background:#f0f6f1}
.caee-option:has(input:checked){border-color:var(--caee-green);background:var(--caee-green-soft);color:var(--caee-green-dark);box-shadow:inset 0 0 0 1px rgba(47,107,79,.08)}
.caee-option input{flex:0 0 auto;width:15px;height:15px;margin:0;accent-color:var(--caee-green)}
.caee-options-check .caee-option{align-items:flex-start}
.caee-options-check .caee-option input{margin-top:1px}
.caee-subheading{margin:14px 0 0;padding:11px 13px;border-left:4px solid var(--caee-green);border-radius:0 8px 8px 0;background:var(--caee-green-soft);color:var(--caee-green-dark);font-size:.84rem;font-weight:850;line-height:1.45}
.caee-motto{margin:22px 0 0;padding-top:17px;border-top:1px solid var(--caee-border);text-align:center;color:var(--caee-muted);font-size:.75rem;font-weight:750;letter-spacing:.025em}
.caee-actions{display:flex;justify-content:flex-end;gap:12px;flex-wrap:wrap}
.caee-btn{display:inline-flex;align-items:center;justify-content:center;min-height:44px;padding:11px 19px;border:1px solid transparent;border-radius:10px;font-size:.9rem;font-weight:750;text-decoration:none;cursor:pointer;transition:transform .15s,background .15s}
.caee-btn:hover{transform:translateY(-1px)}
.caee-btn-primary{background:var(--caee-green);color:#fff;border-color:var(--caee-green)}
.caee-btn-primary:hover{background:var(--caee-green-dark)}
.caee-btn-light{background:var(--caee-surface);color:var(--caee-ink);border-color:var(--caee-border)}
.caee-alert{margin-bottom:18px;padding:16px 18px;border:1px solid #f0b9b9;border-radius:12px;background:#fff4f4;color:#9b2424}
.caee-alert ul{margin:8px 0 0;padding-left:20px;list-style:disc}
.dark .caee-form{--caee-ink:#e3ece5;--caee-muted:#a7b8ac;--caee-border:#294236;--caee-surface:#14271e;--caee-field:#0f2018;--caee-green-soft:#20392c;color:var(--caee-ink)}
.dark .caee-hero{background:linear-gradient(120deg,#14271e,#234b36);border:1px solid #365945}
.dark .caee-panel{box-shadow:none}
.dark .caee-step{background:#20392c;color:#a9d7b7}
.dark .caee-panel-heading h2{color:#a9d7b7}
.dark .caee-field input,.dark .caee-field select,.dark .caee-textarea{border-color:#365343}
.dark .caee-option{background:#182d22;border-color:#365343;color:#d1dbd3}
.dark .caee-option:hover{background:#20392c;border-color:#76b58f}
.dark .caee-option:has(input:checked){background:#244a35;border-color:#76b58f;color:#e0f1e4}
.dark .caee-subheading{background:#20392c;color:#a9d7b7}
.dark .caee-btn-light{background:#1a3025;color:#d1dbd3;border-color:#365343}
.dark .caee-alert{background:#351d20;border-color:#783b42;color:#ffd6d9}
@media(max-width:700px){.caee-form{gap:15px}.caee-hero{padding:20px;align-items:flex-start;gap:13px}.caee-brand-mark{flex-basis:43px;width:43px;height:43px;border-radius:12px;font-size:23px}.caee-panel{padding:17px;border-radius:13px}.caee-fields{grid-template-columns:minmax(0,1fr);gap:14px}.caee-panel-heading{gap:10px}.caee-step{flex-basis:33px;height:33px}.caee-options{gap:7px}.caee-option{font-size:.77rem;padding:8px 9px}.caee-actions>*{flex:1}}
@media print{.caee-hero{background:#fff!important;color:#1f513a;border:1px solid #aaa;box-shadow:none}.caee-hero h1{color:#1f513a}.caee-panel{break-inside:avoid;box-shadow:none;border-color:#aaa}.caee-actions{display:none}.caee-option{background:#fff;color:#222}.caee-form{gap:12px}}
</style>
