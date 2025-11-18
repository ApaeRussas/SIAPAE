<x-header-export 
    title="Relatório Inidividual AEE"
    headerOld>

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
                <p class="m-bottom"> <strong> ASSOCIAÇÃO DOS PAIS E AMIGOS DOS EXCEPCIONAIS DE RUSSAS - APAE RUSSAS </strong>
                </p>
                <p class="m-bottom"> <strong> CAEE: </strong> CENTRO DE ATENDIMENTO EDUCACIONAL ESPECIALIZADO JOSÉ ALVES DOS SANTOS </p>
    
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

    <div class="signature">
        ___________________________________________________ <br> 
        <strong> {{$data->professor->name}}</strong> <br>
        Professor do CAEE / APAE RUSSAS
    </div>

</x-header-export>