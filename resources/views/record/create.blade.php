<x-app-layout> 

    <x-table-create
        title="Ata"
        :labelsVariablesTypes="[
            ['Cabeçalho da Ata', 'title_header', 'text', 'Ex: Ata de Eleição da ....'],
            ['Data da Ata', 'date', 'date', 'Ex: 01/01/2001'],
            ['Redação da Reunião', 'text', 'textarea', 'Ex: Aos 29 dias do mês de novembro de '],
            ['Tipo de Ata', 'type_ata', 'text', 'Ex: Ata Ordinária'],
            ['Assinaturas Especiais', 'special_signatures', 'textarea', 'Dê um enter (quebra de linha) após cada linha de assinatura. 
Ex: 1ª Secretária
Presidente'],
            ['Número de Assinaturas Comuns', 'number_signatures', 'number', 'Ex: 2'],
            ['Frequência dos Pais', 'relatives_frequencies', 'textarea', 'Dê um enter (quebra de linha) após cada linha de frequência. 
Ex: João Antonio Ferreira
Maria Lurdes
José Kleber da Silva'],
        ]" 
        actionRoute="record"/>
 
</x-app-layout> 