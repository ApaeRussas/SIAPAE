<x-app-layout>

    <x-table-show 
        :title="'Informações do(a) ' . $expense->type . ' ' . $expense->fiscal_number . $expense->cupom_number" 
        :elementShow="$expense" 
        onlyHead 
        actionRoute="expense">


        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Data de Emissão:
            </p>
            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ \Carbon\Carbon::parse($expense->date_of_emission)->format('d/m/Y') }}
            </p>
        </div>

        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Tipo de Gasto:
            </p>
            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ $expense->type }}
            </p>
        </div>

        @if ($expense->type == "Nota Fiscal")
            <div>
                <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                    Número da Nota Fiscal:
                </p>
                <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                            font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                    {{ $expense->fiscal_number }}
                </p>
            </div>            
        @elseif($expense->type == "Cupom Fiscal")
        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Número do Cupom:
            </p>
            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ $expense->cupom_number }}
            </p>
        </div>
        @elseif($expense->type == "Recibo")
        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Descrição do Recibo:
            </p>
            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ $expense->description }}
            </p>
        </div>
        @endif
            
        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Empresa Responsável:
            </p>
            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                        font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ $expense->enterprise }}
            </p>
        </div>

        <div>
            <p class="text-gray-700 dark:text-gray-400 font-normal mt-3 mb-2">
                Valor do Gasto:
            </p>

            <p class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 
                font-normal dark:text-gray-300 py-2 px-3 rounded-lg">
                {{ 'R$ ' . number_format($expense->price, 2, ',', '.') }}
            </p>
        </div>

    </x-table-show>

</x-app-layout>