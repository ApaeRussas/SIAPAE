<x-app-layout>

    <x-table-edit 
        title="Registro de Atendimento" 
        :elementEdit="$attendance" 
        :labelsVariablesTypes="[
            ['Nome do aluno', 'student_id', 'select'],
            ['Data do Atendimento', 'date', 'date'],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'textarea'],
            ['Dificuldades', 'difficulties', 'textarea'],
            ['Assinatura do Professor Responsável', 'signature_id', 'select'],
        ]" 
        :selects="[$students, $professors]"
        actionRoute="attendance">
    </x-table-edit>

</x-app-layout>