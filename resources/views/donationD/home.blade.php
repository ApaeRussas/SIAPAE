<x-app-layout :context="$context">

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <div class="flex justify-between w-full">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                    {{ __('Controle de Doações') }} 
                </h2>
                <p class="py-2 text-xs md:text-base w-20 md:w-auto opacity-50">
                    (Atualize a Página Antes de Exportar)
                </p>
            </div>
        </div>
    </x-slot>

    @if ($errors->any())
        <script>
            let errors = '';
            @foreach ($errors->all() as $error)
                errors += '{{ $error }}\n';
            @endforeach
            alert(errors); 
        </script>
    @endif
    
    <x-table
    iteration="true"
    title="Doação" 
    :headers="['Nome', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez', 'Total']" 
    :rows="$donations"
    :elementsExcelOrPdf="$allDonations"
    onlyHead 
    notButtonAdd
    notActions
    withExportExcel
    withExportPdf
    withSearchSelect
    actionRoute="donation"
    :valueTotal="$valueTotal"
    :years="$years"
    :year="$year">
    
        @forelse ($donations as $donation)
            <tr data-id="{{$donation->id}}" id="tabela-gastos">

                <td class="border border-gray-300 dark:border-gray-600 px-3 py-3 text-center text-gray-800 dark:text-gray-300">
                    {{ $loop->iteration }}
                </td>

                <td class="border border-gray-300 dark:border-gray-600 px-3 py-3 text-center text-gray-800 dark:text-gray-300">
                    {{$donation->student ? \Illuminate\Support\Str::words($donation->student->name, 2, ' ...') : 'Estudante não encontrado'}}
                </td>

                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Jan">
                    {{ $donation->Jan == '' ? '---' : $donation->Jan}}

                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Fev">
                    <div class="flex justify-center items-center" class="editable" data-field="Fev">
                        {{ $donation->Fev == '' ? '---' : $donation->Fev}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Mar">
                    <div class="flex justify-center items-center" class="editable" data-field="Mar">
                        {{ $donation->Mar == '' ? '---' : $donation->Mar}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Abr">
                    <div class="flex justify-center items-center" class="editable" data-field="Abr">
                        {{ $donation->Abr == '' ? '---' : $donation->Abr}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Mai">
                    <div class="flex justify-center items-center" class="editable" data-field="Mai">
                        {{ $donation->Mai == '' ? '---' : $donation->Mai}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Jun">
                    <div class="flex justify-center items-center" class="editable" data-field="Jun">
                        {{ $donation->Jun == '' ? '---' : $donation->Jun}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Jul">
                    <div class="flex justify-center items-center" class="editable" data-field="Jul">
                        {{ $donation->Jul == '' ? '---' : $donation->Jul}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Ago">
                    <div class="flex justify-center items-center" class="editable" data-field="Ago">
                        {{ $donation->Ago == '' ? '---' : $donation->Ago}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Set">
                    <div class="flex justify-center items-center" class="editable" data-field="Set">
                        {{ $donation->Set == '' ? '---' : $donation->Set}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Out">
                    <div class="flex justify-center items-center" class="editable" data-field="Out">
                        {{ $donation->Out == '' ? '---' : $donation->Out}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Nov">
                    <div class="flex justify-center items-center" class="editable" data-field="Nov">
                        {{ $donation->Nov == '' ? '---' : $donation->Nov}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300
                            editable" data-field="Dez">
                    <div class="flex justify-center items-center" class="editable" data-field="Dez">
                        {{ $donation->Dez == '' ? '---' : $donation->Dez}}
                    </div>
                </td>
                <td class="border border-gray-300 dark:border-gray-600 px-1 py-1 text-center text-gray-800 dark:text-gray-300">
                    <div class="flex justify-center items-center">
                        {{ $donation->Total == '0' ? '---' : $donation->Total}}
                    </div>
                </td>
            </tr>

        @empty
            <tr class="text-center">
                <td class="border border-gray-300 dark:border-gray-600 p-3 font-normal dark:text-gray-300" colspan="{{ 14 }}">
                    Nenhum registro encontrado.
                </td>
            </tr>
        @endforelse

    </x-table>

</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Quando o usuário clicar em uma célula para editar
        $('#tabela-gastos .editable').on('click', function () {
            var currentText = $(this).text().trim();;
            if(currentText == '---') {currentText = ''}
            var inputField = $('<input>', {
                value: currentText,
                class: 'form-control m-0 w-20 border-gray-400 rounded-md dark:border-gray-600 dark:bg-dark-eval-1',
                type: 'text',
                oninput: 'maskMoedaDonation(event)',
            });

            $(this).html(inputField);

            inputField.focus();

            // Quando o usuário sair da célula (blur)
            inputField.on('blur', function () {
                var newValue = $(this).val();
                var field = $(this).closest('td').data('field');
                var rowId = $(this).closest('tr').data('id');

                // Atualizando a célula para o novo valor

                $(this).closest('td').html(newValue);

                if (newValue === '0,01') { newValue = '---'; }

                // Enviar a atualização via AJAX
                $.ajax({
                    url: '/donation/' + rowId,  // Rota para atualizar o gasto
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        field: field,
                        value: newValue
                    },
                    // success: function (response) {
                    //     alert('Gasto atualizado com sucesso!');
                    // },
                    // error: function () {
                    //     alert('Erro ao atualizar o gasto.');
                    // }
                });
            });
        });
    });
</script>