<x-app-layout notRegularSidebar :element="$student">

    <x-slot name="header">
        <div class="flex justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-3">
            <div class="flex items-center gap-x-1">
                <h2 class="text-xl md:text-2xl font-bold leading-tight pt-2">
                    Relatórios Pedagógicos do(a) {{ \Illuminate\Support\Str::limit($student->name ?? '------', 15) }}
                </h2>
            </div>
        </div>
    </x-slot>
    
    <x-table 
        title="Relatório Pedagógico" 
        :headers="['Data', 'Texto do Relatório', 'Assinatura']" 
        :rows="$pedagogicals" 
        :variables_DB="['date_pedagogical', 'text', 'professor.name']"
        iteration="false"
        withSearchSelect
        notButtonAdd
        searchRoute="student.showEducationals" 
        :element="$student"
        :years="$years"
        :year="$year"
        withShow
        strLimit="24"
        actionRoute="educational" />

</x-app-layout>