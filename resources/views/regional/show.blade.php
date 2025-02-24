<x-app-layout>

    <x-table-show 
        :title="'Relatório Regional'" 
        :elementShow="$regional" 
        :labelsVariables="[
            ['Título', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Data do Relatório', 'date', 'date'],
            ['Assinatura da Cordenadora Responsável', 'coordinator.name', 'select'],
        ]" 
        exportPdf
        actionRoute="regional">
    </x-table-show>

</x-app-layout>
