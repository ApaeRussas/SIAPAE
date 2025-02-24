<x-header-export
    title="Relatório Regional"
    headerOld>

    <main>
        <br>
        <div class="center-text font-sikta" style="margin-bottom: 20px">    
            RELATÓRIO PEDAGÓGICO DO {{$data->period}} SEMESTRE {{$data->year}}
        </div>
        <br><br><br>

        <div class="center-text">
            <p>A APAE RUSSAS tem como referência a <strong><u>lei LEI Nº 9.394, DE 20 DE DEZEMBRO DE 1996</u>, o CNE, SEDUC, CEE do nosso estado</strong></p>
        </div>
        <br>
        
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
        {{$data->coordinator->name}} <br>
    </div>

</x-header-export>