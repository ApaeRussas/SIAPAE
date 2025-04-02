<x-header-export 
    title="ATA pdf"
    headerNew
    ata
    :data="$data">
    
    <main>
        <div class="center-text font-sikta" style="font-size: 24px; margin-bottom: 20px; padding: 0px 30px;">
            <strong>
                {{$data->title_header}}
            </strong>
        </div>

        <div class="content justify font-arial">
        @foreach (explode("\n", $data->text) as $linha)
            <div class="paragrafo">
                <span class="tab"></span>
                @foreach (preg_split('/\s+/', $linha) as $palavra)
                    <span class="palavra">{{ $palavra }}</span>
                @endforeach
            </div>
        @endforeach
        </div>
    </main>

    <div class="center-text" style="margin-top:15px">
        @php
            // Divide o texto em linhas e agrupa de 2 em 2 (nome + cargo)
            $linhas = explode("\n", $data->special_signatures);
            $linhas = array_filter($linhas, function($linha) {
                return !empty(trim($linha));
            });
        @endphp

        @for ($i = 0; $i < count($linhas); $i += 2)
            ________________________________________________________________________________________
            <p style="margin-top: 3px; margin-bottom: 3px;">
                {{ $linhas[$i] }}<br>
                @if(isset($linhas[$i + 1]))
                    {{ $linhas[$i + 1] }}
                @endif
            </p>
        @endfor

        <p style="margin-top: 1px">
            @for ($i = 0; $i < $data->number_signatures; $i++)
            ________________________________________________________________________________________ 
            @endfor
        </p>
    </div>

    <div class="page-break"></div>

    {{-- PÁGINA FREQUÊNCIA --}}

    <table class="table-dif">
        <tr class="tr-dif">
            <td class="td-dif center-text no-bottom-border" style="width: 80%; text-align: left; padding: 20px 20px; font-size: 14px;">
                <strong> {{ $data->title_frequency }} </strong>
            </td>
            <td class="td-dif bg-gray center-text no-bottom-border" style="width: 20%; padding: 20px 20px; font-size: 14px;">
                <strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->date)->format('d/m/Y') }} </strong>
            </td>
        </tr>
    </table>

    <table class="table-dif">
        @php
            // Obter todas as linhas do texto digitado pelo usuário
            $linhas = array_filter(explode("\n", data_get($data, 'relatives_frequencies')));
            // Ordenar alfabeticamente
            sort($linhas);
            
            // Definir quantas assinaturas cabem por página
            $assinaturasPorPagina = 30;
            // Calcular quantas linhas vazias precisamos adicionar
            $totalLinhas = count($linhas);
            $linhasRestantes = $totalLinhas % $assinaturasPorPagina;
            $linhasVaziasNecessarias = $linhasRestantes > 0 ? $assinaturasPorPagina - $linhasRestantes : 0;
            
            // Adicionar linhas vazias ao array
            for ($i = 0; $i < $linhasVaziasNecessarias; $i++) {
                $linhas[] = '';
            }
        @endphp

        <thead>
            <tr class="tr-dif">
                <th class="th-dif" style="width:80%; font-size: 13px; padding: 10px">
                    NOME
                </th>
                <th class="th-dif" style="width:10%; font-size: 13px; padding: 10px">
                    CPF
                </th>
                <th class="th-dif" style="width:130%; font-size: 13px; padding: 10px">
                    ASSINATURA
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($linhas as $index => $linha)
                @if ($index > 0 && $index % $assinaturasPorPagina === 0)
                    <!-- Adicionar quebra de página após cada 30 linhas -->
                    <div style="page-break-after: always;"></div>
                    <!-- Recriar o cabeçalho para a nova página -->
                    <thead>
                        <tr class="tr-dif">
                            <th class="th-dif" style="width:80%; font-size: 13px; padding: 10px">
                                NOME
                            </th>
                            <th class="th-dif" style="width:10%; font-size: 13px; padding: 10px">
                                CPF
                            </th>
                            <th class="th-dif" style="width:130%; font-size: 13px; padding: 10px">
                                ASSINATURA
                            </th>
                        </tr>
                    </thead>
                @endif
                
                <tr class="tr-dif">
                    <td class="{{!empty($linha) ? 'bg-gray' : ''}} center-text td-dif">
                        <div class="capslock" style="padding: 0px 10px; text-align: left;">
                            <strong>
                                {{ ($index + 1) . '. ' }}
                                @if (!empty($linha))
                                    @php
                                        $textoLimitado = \Illuminate\Support\Str::limit($linha, 31);
                                        $palavras = preg_split('/\s+/', $textoLimitado);
                                    @endphp
                                    {!! collect($palavras)->map(function($palavra) {
                                        return "<span>{$palavra}</span>";
                                    })->implode(' ') !!}
                                @endif
                            </strong>  
                        </div>
                    </td>
                    <td class="td-dif">
                        {{-- Coluna Vazia Para CPF do Aluno ou Responsável --}}
                    </td>
                    <td class="td-dif">
                        {{-- Coluna Vazia Para Assinatura do Aluno ou Responsável --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-header-export>