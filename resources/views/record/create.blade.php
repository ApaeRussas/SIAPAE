<x-app-layout> 

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
        actionRoute="record"/>
 
</x-app-layout> 