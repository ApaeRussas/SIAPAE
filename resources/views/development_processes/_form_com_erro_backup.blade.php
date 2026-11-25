                        if (str_contains($item, 'COMPREENDE O SOM DAS LETRAS')) $specialOptions = ['VOGAIS EM PARTE','CONSOANTES EM PARTE','SÍLABAS EM PARTE','PALAVRAS EM PARTE'];
                        elseif (str_contains($item, 'INTERPRETAR GRAVURAS, TEXTOS E HISTÓRIAS')) $specialOptions = ['LIBRAS','BRAILLE','GESTOS','VERBAL','OUTRA TEC. ASSISTIVA','DESCRIÇÃO VISUAL'];
                        elseif (str_contains($item, 'RECONHECE CÉDULAS DO SISTEMA MONETÁRIO')) $specialOptions = ['2,00','5,00','10,00','20,00','50,00','100,00','200,00'];
                        elseif (str_contains($item, 'RECONHECE MOEDAS DO SISTEMA MONETÁRIO')) $specialOptions = ['0,05','0,10','0,25','0,50','1,00'];
                        elseif (str_contains($item, 'POSSUI NOÇÃO DE TROCO')) $specialOptions = ['1,00','2,00','5,00','10,00','20,00'];
                        elseif (str_contains($item, 'TEM RESTRIÇÃO ALIMENTAR')) $specialOptions = ['DIABETE','HIPERTENSÃO','CELÍACA','NÃO POSSUI'];
                        elseif (str_contains($item, 'COMO SE SENTE QUANDO ESTÁ COM O CORPO SUJO')) $customRadioOptions = ['SE INCOMODA','NÃO SE INCOMODA','NÃO FOI POSSÍVEL AVALIAR'];
                        elseif (str_contains($item, 'COMO SE SENTE QUANDO ESTÁ COM SUAS VESTES SUJAS')) $customRadioOptions = ['SIM','AINDA NÃO','RESTRIÇÃO','COM AUXÍLIO','SE INCOMODA','NÃO SE INCOMODA'];
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
                            @elseif ($customRadioOptions !== null)
                                <div class="caee-options">
                                    @foreach ($customRadioOptions as $option)
                                        <label class="caee-option"><input type="radio" name="responses[{{ $key }}]" value="{{ $option }}" @checked(($responses[$key] ?? '') === $option)><span>{{ $option }}</span></label>
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

    <div class="caee-actions"><a class="caee-btn caee-btn-light" href="{{ route('development-processes.index') }}">Cancelar</a><button class="caee-btn caee-btn-primary" type="submit">{{ $submitLabel ?? 'Salvar registro' }}</button></div>
</div>

<style>
.caee-form{--caee-green:#2f6b4f;--caee-green-
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
