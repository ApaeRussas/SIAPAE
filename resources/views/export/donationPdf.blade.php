<x-header-export title="Lista de Doações - {{$data[0]->year_of_donation}}" headerNew donation>

    <main>
        <div class="center-text font-arial" style="font-size: 14px;">
            <strong>
                CONTRIBUIÇÃO VOLUNTÁRIA ASSOCIADOS APAE-{{$data[0]->year_of_donation}}
            </strong>
        </div>
        <br>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Jan</th>
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Mai</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ago</th>
                    <th>Set</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dez</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $donation)
                <tr>
                    <td style="text-align: left; padding-left: 4px; font-size: 9px; text-transform: uppercase;">{{$loop->iteration . '.   ' . \Illuminate\Support\Str::words($donation->student->name, 2, '')}}</td>
                    <td>{{$donation->Jan ?? '---'}}</td>
                    <td>{{$donation->Fev ?? '---'}}</td>
                    <td>{{$donation->Mar ?? '---'}}</td>
                    <td>{{$donation->Abr ?? '---'}}</td>
                    <td>{{$donation->Mai ?? '---'}}</td>
                    <td>{{$donation->Jun ?? '---'}}</td>
                    <td>{{$donation->Jul ?? '---'}}</td>
                    <td>{{$donation->Ago ?? '---'}}</td>
                    <td>{{$donation->Set ?? '---'}}</td>
                    <td>{{$donation->Out ?? '---'}}</td>
                    <td>{{$donation->Nov ?? '---'}}</td>
                    <td>{{$donation->Dez ?? '---'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</x-header-export>