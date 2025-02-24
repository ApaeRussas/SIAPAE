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
        @foreach (explode("\n", $data->special_signatures) as $linha)
        ________________________________________________________________________________________ 
        <p style="margin-top: 3px margin-bottom: 3px">
            {{$linha}}
        </p>
        @endforeach

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
                <strong> FREQUÊNCIA DOA PAIS - ATA </strong>
            </td>
            <td class="td-dif bg-gray center-text no-bottom-border" style="width: 20%; padding: 20px 20px; font-size: 14px;">
                <strong> {{ \Carbon\Carbon::createFromFormat('Y-m-d', $data->date)->format('d/m/Y') }} </strong>
            </td>
        </tr>
    </table>

    <table class="table-dif">
        <thead>
            <tr class="tr-dif">
                <th class="th-dif" style="width: 25%; font-size: 13px; padding: 10px">
                    NOME
                </th>
                <th class="th-dif" style="width: 75%; font-size: 13px; padding: 10px">
                    REGISTRO
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach (explode("\n", data_get($data, 'relatives_frequencies')) as $linha)
                <tr class="tr-dif">
                    <td class="bg-gray center-text td-dif">
                        <div class="capslock" style="padding: 0px 10px; text-align: left;">
                            <strong>
                                {{$loop->iteration . '. '}}
                                @foreach (preg_split('/\s+/', $linha) as $palavra)
                                    <span>{{ $palavra }}</span>
                                @endforeach
                            </strong>
                        </div>
                    </td>
                    <td class="td-dif">
                        {{-- Coluna Vazia Para Assinatura do Aluno ou Responsável --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-header-export>