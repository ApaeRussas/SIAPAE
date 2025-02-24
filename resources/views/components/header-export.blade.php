<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{$title ?? 'PDF'}}</title>
    
    {{-- 
    O css externo não funciona, apenas o inline ou o interno. É preciso adicionar pelo controller caso queira usar o externo.
    CSS usado: <link rel="stylesheet" href="{{asset('css/export.css')}}">
    --}}
</head>

<body>

    <header class="center-text">
        <table id="header">
            <tr>
                <td style="{{isset($scfv) ? 'width: 18%;' : 'width: 15%;'}}" class="center-image">
                    <img src="{{public_path('logo/mini-logo-light.png')}}" alt="Logo" style="width: 60px; height: auto;">
                </td>

                @if (isset($headerOld))
                <td style="width: 65%">
                    <strong class="font-arial" style="">
                        <p style="font-size: 14px">APAE RUSSAS</p>
                        <p style="font-size: 11px">CENTRO DE ATENDIMENTO EDUCACIONAL</p>
                        <p style="font-size: 11px">ESPECIALIZADO JOSÉ ALVES DOS SANTOS</p>
                        <p style="font-size: 11px">EMAIL: <a href="mailto:russas@apaece.org.br">russas@apaece.org.br</a> | CONTATO: 88 21451829</p>
                    </strong>
                </td>
                <td style="width: 20%; text-align: right; place-items: center;">
                    <strong>
                        <p style="width: 130px; border: 1px solid #000; display: inline-block; text-align: center;">
                            RELATÓRIO
                        </p>
                    </strong>
                </td>

                @elseif (isset($headerNew))
                <td style="width: 67%">
                    <strong class="font-arial center-text">
                        <p style="font-size: 11px" class="capslock">Associação de Pais e Amigos dos Exepcionais - APAE RUSSAS</p>
                        @if (isset($scfv))
                        <p style="font-size: 11px" class="capslock">Serviço de Convivência e Fortalecimento de Vínculo da APAE RUSSAS</p>
                        @endif
                        <p style="font-size: 11px" class="capslock">Tv. Joaquim Felix, 332, Bairro N.S. de Fátima, Russas - CE, CEP: 62900000</p>
                        <p style="font-size: 11px">CNPJ 08.691.213/0001-19 | EMAIL: <a href="mailto:russas@apaece.org.br">russas@apaece.org.br</a> | CONTATO: 88 21451829</p>
                    </strong>
                </td>
                <td style="width: 18%; text-align: right; place-items: center;">
                    <strong>
                        @if (isset($ata))
                            <p style="width: 130px; border: 1px solid #000; display: inline-block; text-align: center;">
                                {{$data->type_ata}}
                            </p>
                        @elseif (isset($donation))
                            <p style="width: 140px; border: 1px solid #000; display: inline-block; text-align: center;">
                                CONTRIBUIÇÃO
                            </p>
                        @elseif(isset($scfv))
                            <p style="width: 80px; border: 1px solid #000; display: inline-block; text-align: center;">
                                SCFV
                            </p>
                        @endif
                    </strong>
                </td>
                @endif
            </tr>
        </table>
    </header>

    @if (isset($withFooterLandscape))
    <footer>
        <table>
            <tr style="font-size: 13px" class="font-arial">
                <td style="width:10%" class="center-text">
                    <strong>
                        REALIZAÇÃO PARCERIA/APOIO
                    </strong>
                </td>
                <td style="width:16%" class="center-image">
                    <img src="{{public_path('logo/logo-light.png')}}" alt="Logo" style="width: 110px; height: auto; margin-left: 10px">
                </td>
                <td style="width:40%" class="center-text">
                    <strong>
                        SUPERAR BARREIRAS PARA GARANTIR A INCLUSÃO
                    </strong>
                </td>
                <td style="width:5%"></td>
                <td style="width:25%;" class="center-text center-image">
                    <img src="{{public_path('logo/logo-russas.png')}}" alt="Logo" style="width: 130px; height: 50px;">
                    <hr style="margin-top: -3px; height: 1px; background-color: black; border: none;">
                    <p style="font-size: 10px"> Secretária do Trabalho e Assistência Social - SETAS </p>
                </td>
            </tr>
        </table>
    </footer>
    @endif

    {{$slot}}

</body>

</html>