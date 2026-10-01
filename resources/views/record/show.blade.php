<x-app-layout>

    <div
        class="
            [&_.bg-blue-50]:!bg-[#E7F0E9]
            [&_.bg-blue-100]:!bg-[#E7F0E9]
            [&_.bg-blue-200]:!bg-[#D5E5D9]
            [&_.bg-blue-300]:!bg-[#B8CCBD]
            [&_.bg-blue-400]:!bg-[#6F9B80]
            [&_.bg-blue-500]:!bg-[#2F6B4F]
            [&_.bg-blue-600]:!bg-[#2F6B4F]
            [&_.bg-blue-700]:!bg-[#23543E]
            [&_.text-blue-400]:!text-[#6F9B80]
            [&_.text-blue-500]:!text-[#2F6B4F]
            [&_.text-blue-600]:!text-[#2F6B4F]
            [&_.text-blue-700]:!text-[#23543E]
            [&_.border-blue-400]:!border-[#6F9B80]
            [&_.border-blue-500]:!border-[#2F6B4F]
            [&_.border-blue-600]:!border-[#2F6B4F]
            [&_.border-blue-700]:!border-[#23543E]
            [&_.hover\:bg-blue-500:hover]:!bg-[#2F6B4F]
            [&_.hover\:bg-blue-600:hover]:!bg-[#23543E]
            [&_.hover\:bg-blue-700:hover]:!bg-[#23543E]
            [&_.hover\:text-blue-500:hover]:!text-[#2F6B4F]
            [&_.hover\:text-blue-600:hover]:!text-[#2F6B4F]
        "
    >

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
                ['Cabeçalho da Frequência da Reunião', 'title_frequency', 'text'],
                ['Frequência dos Pais', 'relatives_frequencies', 'textarea'],
            ]"
            exportPdf
            filePath="file/record/"
            actionRoute="record"
        >

        </x-table-show>

    </div>

</x-app-layout>