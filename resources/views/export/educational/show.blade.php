<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    @php
        $student_archived = ($pedagogical->student->state_student == 'archived' ? true : null);
    @endphp

    <x-table-show 
        :title="'Relatório Pedagógico'" 
        :elementShow="$pedagogical" 
        :labelsVariables="[
            ['Nome do aluno', 'student.name', 'select'],
            ['Data do Relatório', 'date_pedagogical', 'date'],
            ['Data de Nascimento', 'student.date_of_birth', 'date'],
            ['Escola', 'school', 'text'],
            ['Turno na Escola', 'turn_school', 'select'],
            ['Série/Ano', 'grade_school', 'text'],
            ['Idade', 'age', 'text'],
            ['Ano Letivo', 'school_year', 'text'],
            ['Assinatura do Professor da CAEE', 'professor_signature', 'select'],
            ['Texto do Relatório', 'text', 'textarea'],
            ['Assinatura', 'professor.name', 'select'],
        ]" 
        exportPdf
        notRegularSidebar
        actionRoute="educational"
        :notButtonDelete="$student_archived">
    </x-table-show>

</x-app-layout>
