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

        <x-table-create
            title="Ata"
            :labelsVariablesTypes="[
                ['Cabeçalho da Ata', 'title_header', 'text', 'Ex: Ata de Eleição da ....'],
                ['Data da Ata', 'date', 'date', 'Ex: 01/01/2001'],
                ['Redação da Reunião', 'text', 'textarea', 'Ex: Aos 29 dias do mês de novembro de ...'],
                ['Tipo de Ata', 'type_ata', 'text', 'Ex: Ata Ordinária'],
                ['Assinaturas Especiais', 'special_signatures', 'textarea', 'Dê um enter (quebra de linha) após cada linha de assinatura com o nome e cargo do representante respectivamente a baixo do outro. 
Ex: Fulana da Silva ...
1ª Secretária
José Fulano ...
Presidente'],
                ['Número de Assinaturas Comuns', 'number_signatures', 'number', 'Ex: 2'],
                ['Cabeçalho da Frequência da Reunião', 'title_frequency', 'text', 'Ex: Freuquência da Ata ....'],
                ['Frequência dos Pais', 'relatives_frequencies', 'textarea', 'Dê um enter (quebra de linha) após cada linha de frequência. 
Ex: João Antonio Ferreira
Maria Lurdes
José Kleber da Silva'],
            ]"
            actionRoute="record"
        />

    </div>

</x-app-layout>