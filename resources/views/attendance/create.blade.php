<x-app-layout> 

    <x-table-create
        title="Registro de Atendimento"
        :labelsVariablesTypes="[
            ['Nome do aluno', 'student_id', 'select', '', $student_id],
            ['Data do Atendimento', 'date', 'date', 'Data do Atendimento:', $date],
            ['Eixo educacional trabalhado', 'educational_axis', 'text'],
            ['Avanços', 'advances', 'textarea'],
            ['Dificuldades', 'difficulties', 'textarea'],
            ['Assinatura do Professor Responsável', 'signature_id', 'select'],
        ]" 
        :selects="[$students, $professors]"
        actionRoute="attendance"/>

</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtenha valores do localStorage
        const year = localStorage.getItem('year');
        const faixaSemana = localStorage.getItem('faixaSemana');

        // Defina os valores nos campos de entrada ocultos
        document.getElementById('year').value = year;
        document.getElementById('faixaSemana').value = faixaSemana;
    });
</script>