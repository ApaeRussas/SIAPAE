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

<header>
    <style>
        /* ===========================
        TIMBRE APAE — ADAPTADO PARA PDF
        =========================== */

        .header-apae {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: nowrap;
            color: #0b5934;
            font-family: Arial, sans-serif;
            margin-bottom: 20px;
        }

        .logo-area img {
            width: 130px;
        }

        .text-area h1 {
            font-size: 16px;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }

        .text-area h2 {
            font-size: 12px;
            margin: 4px 0 8px;
            text-align: center;
        }

        .divider {
            width: 100%;
            height: 3px;
            background-color: #0b5934;
            border-radius: 4px;
            margin: 8px 0 10px;
        }

        .info-row {
            display: flex;
            gap: 25px;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .info-line {
            display: flex;
            flex: 1;
            gap: 6px;
        }

        .info-icon {
            font-weight: bold;
            font-size: 12px;
            padding-top: 1px;
        }
    </style>

    <div class="header-apae">

        <div class="logo-area">
            <img src="{{public_path('logo/logoTimbre.png')}}" alt="Logo APAE">
        </div>

        <div class="text-area">

            <h1>ASSOCIAÇÃO DE PAIS E AMIGOS DOS EXCEPCIONAIS DE RUSSAS - APAE RUSSAS</h1>
            <h2>CENTRO DE ATENDIMENTO EDUCACIONAL ESPECIALIZADO JOSÉ ALVES DOS SANTOS</h2>

            <div class="divider"></div>

            <div class="info-row">
                <div class="info-line">
                    <span class="info-icon">●</span>
                    <span><strong>CNPJ:</strong> 08.691.213/0001-19</span>
                </div>

                <div class="info-line">
                    <span class="info-icon">●</span>
                    <span><strong>LOCAL:</strong> Tv. Joaquim Félix, 340 - N. Sra de Fátima, Russas - CE</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-line">
                    <span class="info-icon">●</span>
                    <span><strong>E-MAIL:</strong> russas@apaece.org.br</span>
                </div>

                <div class="info-line">
                    <span class="info-icon">●</span>
                    <span><strong>FONE:</strong> (88) 2145-1829</span>
                </div>
            </div>

        </div>

        @if(isset($headerNew) || isset($headerOld))
        <div style="width:130px; text-align:right;">
            <p style="border:1px solid #000; padding:4px 0; font-size:12px; text-align:center;">
                @if (isset($ata))
                    {{$data->type_ata}}
                @elseif(isset($donation))
                    CONTRIBUIÇÃO
                @elseif(isset($scfv))
                    SCFV
                @else
                    RELATÓRIO
                @endif
            </p>
        </div>
        @endif

    </div>
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