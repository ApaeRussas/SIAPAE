<x-header-export 
    title="SCFV pdf"    
    headerNew 
    scfv 
    withFooterLandscape>

    <main>

        {{-- PRIMEIRA PÁGINA - 1ª QUINZENA --}}

        <div class="center-text font-arial px14" style="margin-bottom: 20px">
            <strong>
                PLANEJAMENTO MENSAL E REGISTRO DAS ATIVIDADES {{$data->year}}
                <br>
                <span class="capslock"> {{$data->nameMonth}} </span>
            </strong>
        </div>

        <table>
            <tr>
                <td style="width: 75%; padding: 25px 20px">
                    <strong style="font-size: 14px">
                        SERVIÇO DE CONVINVÊNCIA E FORTALECIMENTO DE VÍNCULOS DA APAE RUSSAS
                    </strong>
                </td>
                <td class="bg-gray" style="width: 25%;">
                    <strong style="font-size: 14px">
                        PERÍODO DE EXECUÇÃO 1ª QUINZENA / 2ªQUINZENA
                    </strong>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="bg-gray no-top-border" style="width: 20%; padding: 20px 20px;">
                    <strong style="font-size: 14px">
                        TEMA:
                    </strong>
                </td>
                <td class="no-top-border" style="width: 80%; padding: 4px 20px; font-size: 12px; text-align: left">
                    <div class="content font-arial capslock">
                        @foreach (explode("\n", $data->theme) as $linha)
                            <div>
                                @foreach (preg_split('/\s+/', $linha) as $palavra)
                                    <span>{{ $palavra }}</span>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <thead>
                <tr class="no-top-border" style="font-size: 14px;">
                    <th class="bg-gray border no-top-border" style=" width: 20%">
                        OBJETIVO
                    </th>
                    <th class="bg-gray no-top-border" style=" width: 20%">
                        AÇÃO/ATIVIDADE
                    </th>
                    <th class="bg-gray no-top-border" style=" width: 30%">
                        DESCRIÇÃO DA ATIVIDADE
                    </th>
                    <th class="bg-gray no-top-border" style=" width: 15%">
                        RECURSOS NECESSÁRIOS
                    </th>
                    <th class="bg-gray no-top-border" style="padding: 0px; border-right: 0.5px solid black; width: 15%">
                        <p style="padding: 8px 8px 8px 8px;border-right: 0.5px solid black;">
                            RESPONSÁVEIS/ PARCEIROS
                        </p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="font-arial" style="margin-top: 5px; font-size: 12px;">
                    <td style="padding: 5px 10px; width: 20%; vertical-align: top;" class="no-bottom-border">
                        (1ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '1Q_objective')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td> 
                    <td style="padding: 5px 10px; width: 20%; vertical-align: top" class="no-bottom-border">
                        (1ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '1Q_activity')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px 10px; width: 30%; vertical-align: top" class="no-bottom-border">
                        (1ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '1Q_description')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px; width: 15%; vertical-align: top" class="no-bottom-border">
                        (1ª QUINZENA)
                        <div class="content center-text" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '1Q_resource')) as $linha)
                                <div class="paragrafo capslock" style="padding-bottom: 6px">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px; width: 15%; vertical-align: top" class="no-bottom-border">
                        (1ª QUINZENA)
                        <div class="content center-text" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '1Q_partner')) as $linha)
                                <div class="paragrafo capslock" style="padding-bottom: 6px">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <p style="margin-right: -20px; width:0px; font-size: 2px;">
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                    </p>
                </tr>
                </tbody>
        </table>

        <div class="page-break"></div>

        {{-- SEGUNDA PÁGINA - 2ª QUINZENA --}}
        
        <table>
            <tbody>
                <tr class="font-arial" style="margin-top: 5px; font-size: 12px;">
                    <td style="padding: 5px 10px; width: 20%; vertical-align: top;" class="no-top-border">
                        (2ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '2Q_objective')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td> 
                    <td style="padding: 5px 10px; width: 20%; vertical-align: top" class="no-top-border">
                        (2ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '2Q_activity')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px 10px; width: 30%; vertical-align: top" class="no-top-border">
                        (2ª QUINZENA)
                        <div class="content justify" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '2Q_description')) as $linha)
                                <div class="paragrafo capslock">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px 10px; width: 15%; vertical-align: top" class="no-top-border">
                        (2ª QUINZENA)
                        <div class="content center-text" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '2Q_resource')) as $linha)
                                <div class="paragrafo capslock" style="padding-bottom: 6px">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 5px 10px; width: 15%; vertical-align: top" class="no-top-border">
                        (2ª QUINZENA)
                        <div class="content center-text" style="padding: 6px 0px; font-size: 10px;">
                            @foreach (explode("\n", data_get($data, '2Q_partner')) as $linha)
                                <div class="paragrafo capslock" style="padding-bottom: 6px">
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span class="palavra">{{ $palavra }}</span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <p style="margin-right: -20px; width:0px; font-size: 2px;">
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                        . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
                    </p>
                </tr>
            </tbody>
        </table>
        <table>
            <tr class="font-arial">
                <td class="bg-gray no-top-border center-text" style="width: 20%; font-size: 13px; padding: 25px 0px;">
                    <strong>
                        QUINZENA/LOCAL/DATA
                    </strong>
                </td>
                <td class="no-top-border" style="width: 80%; text-align: left; font-size: 12px; padding: 0px 10px;">
                    <p>
                        1ª QUINZENA: {{data_get($data, '1Q_date') . ' - ' . data_get($data, '1Q_place')}}
                    </p>
                    <br>
                    <p>
                        2ª QUINZENA: {{data_get($data, '2Q_date') . ' - ' . data_get($data, '2Q_place')}}
                    </p>
                </td>
            </tr>
        </table>

        <div class="page-break"></div>

        {{-- TERCEIRA PÁGINA - FREQUêNCIA 1ª QUINZ. --}}

        <table>
            <tr>
                <td class="center-text no-bottom-border" style="width: 80%; text-align: left; padding: 20px 20px; font-size: 14px;">
                    <strong> FREQUÊNCIA: </strong> 1ª QUINZENA - {{data_get($data, '1Q_place') . ' - ' . data_get($data, '1Q_date')}}
                </td>
                <td class="bg-gray center-text no-bottom-border" style="width: 20%; padding: 20px 20px; font-size: 14px;">
                    <strong> 1ª QUINZENA </strong>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th style="width: 25%; font-size: 13px; padding: 10px">
                        NOME
                    </th>
                    <th style="width: 75%; font-size: 13px; padding: 10px">
                        REGISTRO
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (explode("\n", data_get($data, 'students_frequency')) as $linha)
                    <tr>
                        <td class="bg-gray center-text">
                            <div class="capslock" style="padding: 0px 10px; text-align: left;">
                                <strong>
                                    {{$loop->iteration . '. '}}
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span>{{ $palavra }}</span>
                                    @endforeach
                                </strong>
                            </div>
                        </td>
                        <td>
                            {{-- Coluna Vazia Para Assinatura do Aluno ou Responsável --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature">
            ___________________________________________________ <br> 
            Técnica do Centro de Convinvência APAE Russas
        </div>

        <div class="page-break"></div>

        {{-- QUARTA PÁGINA - FREQUêNCIA 2ª QUINZ. --}}

        <table>
            <tr>
                <td class="center-text no-bottom-border" style="width: 80%; text-align: left; padding: 20px 20px; font-size: 14px;">
                    <strong> FREQUÊNCIA: </strong> 2ª QUINZENA - {{data_get($data, '2Q_place') . ' - ' . data_get($data, '2Q_date')}}
                </td>
                <td class="bg-gray center-text no-bottom-border" style="width: 20%; padding: 20px 20px; font-size: 14px;">
                    <strong> 2ª QUINZENA </strong>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th style="width: 25%; font-size: 13px; padding: 10px">
                        NOME
                    </th>
                    <th style="width: 75%; font-size: 13px; padding: 10px">
                        REGISTRO
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (explode("\n", data_get($data, 'students_frequency')) as $linha)
                    <tr>
                        <td class="bg-gray center-text">
                            <div class="capslock" style="padding: 0px 10px; text-align: left;">
                                <strong>
                                    {{$loop->iteration . '. '}}
                                    @foreach (preg_split('/\s+/', $linha) as $palavra)
                                        <span>{{ $palavra }}</span>
                                    @endforeach
                                </strong>
                            </div>
                        </td>
                        <td>
                            {{-- Coluna Vazia Para Assinatura do Aluno ou Responsável --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 

        <div class="signature">
            ___________________________________________________ <br> 
            Técnica do Centro de Convinvência APAE Russas
        </div>

    </main>

</x-header-export>