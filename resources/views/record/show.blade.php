<x-app-layout>

    <x-table-show 
        :title="'Ata de Reunião'" 
        :elementShow="$record" 
        :labelsVariables="[
            ['Cabeçalho da Ata', 'title_header', 'text'],
            ['Data da Ata', 'date', 'date'],
            ['Redação da Reunião', 'text', 'textarea'],
            ['Tipo de Ata', 'type_ata', 'text'],
            ['Assinaturas Especiais', 'special_signatures', 'textarea'],
            ['Número de Assinaturas Comuns', 'number_signatures', 'number'],
            ['Frequência dos Pais', 'relatives_frequencies', 'textarea'],
        ]" 
        exportPdf
        filePath="file/record/"
        actionRoute="record">
    </x-table-show>

</x-app-layout>
