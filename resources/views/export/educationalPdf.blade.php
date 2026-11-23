<x-header-export
    title="Relatório Individual CAEE"
    headerOld
    caeeHeader>
    <main>
        <div class="center-text font-sitka" style="font-size: 24px; margin-bottom: 20px">
            <i>
                <strong>
                    RELATÓRIO INDIVIDUAL CAEE
                </strong>
            </i>
        </div>
        <div style="padding-right: 16px;">
            <div class="retangulo">
    
                <p><strong>Aluno(a): {{$data->student->name}}</strong> </p>
                <table class="m-bottom-table">
                    <tr>
                        <td><strong>Data de Nascimento: </strong>{{$data->student->date_of_birth}} </td>
                        <td><strong>Idade: </strong>{{$data->age}} </td>
                    </tr>
                </table>
                <p style="margin-bottom:7px"><strong>Escola que estuda:</strong>
                    {{$data->school == '------' ? 'Não está estudando nesse período' : $data->school }}</p>
                <table class="m-bottom-table">
                    <tr>
                        <td><strong>Série/Ano: </strong>{{$data->grade_school}} </td>
                        <td><strong>Turno: </strong>{{$data->turn_school}} </td>
                    </tr>
                </table>
                <table class="m-bottom-table">
                    <tr>
                        <td><strong>Período:</strong> {{$data->period}} Semestre </td>
                        <td><strong>Ano Letivo:</strong> {{$data->school_year}}</td>
                    </tr>
                </table>
                <p class="m-bottom"><strong>Professora do CAEE: </strong>{{$data->professor_signature}} </p>
                <p><strong>Data:</strong> <span class="capslock"> {{$data->date_pedagogical}} </span> </p>
            </div>
        </div>
        
        <div class="content font-arial" style="display: block; text-align: justify; line-height: 1.5; width: 100%;">
            @foreach (preg_split('/\r\n|\r|\n/', $data->text) as $linha)
                @if(trim($linha) !== '')
                    <p style="text-indent: 35px; margin-bottom: 12px; line-height: 1.5;">
                        {{ trim($linha) }}
                    </p>
                @endif
            @endforeach
        </div>
    </main>

   <div class="signature" style="position: static !important; bottom: auto !important; margin-top: 30px; text-align: center; page-break-inside: avoid; width: 100%;">
        ___________________________________________________ <br> 
        <strong> {{$data->professor->name}}</strong> <br>
        Professor do CAEE / APAE RUSSAS
    </div>

</x-header-export>
