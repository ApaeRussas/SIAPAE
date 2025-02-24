<x-app-layout> 

    <x-table-create
        title="Relatório Regional"
        :labelsVariablesTypes="[
            ['Título do Relatório', 'title', 'text'],
            ['Subtítulo', 'subtitle', 'text'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Data do Relatório', 'date', 'date'],
            ['Assinatura do(a) Cordenador(a) Responsável', 'signature_id', 'select'],
        ]" 
        :selects="$coordinators"
        actionRoute="regional"/>
 
</x-app-layout> 