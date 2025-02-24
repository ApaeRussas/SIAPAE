**°Bem vindo(a) ao SIAPAE (Sistema Interno da APAE)! Este documento serve para auxiliar você sobre como funciona o projeto inteiro e sobre como prosseguir com ele, é essencial que você leia todo o documento ou pelo menos grande parte dele; Dito isso boa sorte nos próximos meses de estágio.**

**°Atenção!!! Este documento não irá tratar de nenhum detalhe sobre o site feito em WordPress, o mesmo possui sua própria documentação à parte.**

------------------------------------------------------------------------------------------------
Sumário:
1.0 Introdução.

1.1 Regras.

1.2 Descrição geral do projeto.

1.3 Propósito e objetivos.

1.4 Contexto e motivação.

2.0 Instalação.

2.1 Requisitos de sistema.

2.2 Passos detalhados para a instalação.

3.0 Uso.

3.1 Instruções de uso.

3.2 Funcionalidades principais. 

4.0 Arquitetura.

4.1 Estrutura do projeto.

4.2 Descrição dos componentes principais.

5.0 Testes.

5.1 Como executar testes.

5.2 Procedimentos para adicionar novos testes.

6.0 Referências.

6.1 Referências bibliográficas ou de pesquisa.

7.0 Contato.

7.1 Informações de contato para suporte.

------------------------------------------------------------------------------------------------
## 1.0 Introdução

1.1: Regras:
Definimos algumas regras para a atualização desse documento e arquivos do projeto, uma vez que você ou sua equipe terão a responsabilidade de atualizar as informações aqui presentes.

- N°1: Não use palavrões na documentação ou em qualquer comentário nos arquivos do projeto, seja ético(a).
- N°2: Evite usar gírias ou ser informal no geral, esse documento será passado para outras pessoas futuramente, então deve-se manter a boa postura.
- N°3: Não adicione informações fúteis ao documento, insira apenas o essencial para deixá-lo mais organizado e sucinto possível.
- N°4: Tente seguir a estruturação de parágrafos, para que futuros estagiários possam agregar o documento de forma mais simples, a não ser que sua forma seja melhor que a atual.
- N°5: Evite usar nomes aqui, este projeto tem e terá vários autores, além disso existe um local adequado para colocar o seu no final deste documento.
- N°6: Se precisar de ajuda peça, nas cópias físicas e digitais desta documentação haverá um local com números de telefone e contato de outros autores caso for necessário (a sua supervisora Kélvia também possui os números).

1.2 Descrição geral do projeto:
O SIAPAE é um site com mais de um CRUD e outras ferramentas desenvolvidas para gestão. Ele é majoritariamente escrito em PHP, porém também apresenta JavaScript e CSS em algumas partes, os frameworks utilizados foram Laravel 11 e Tailwind, além disso utilizamos o Blade para a parte de segurança (login). (Obs: Para a sidebar, utilizamos Alpine e outras bibliotecas)

1.3 Propósito e objetivos:
Aqui iremos falar o motivo de certas escolhas tomadas ao longo do projeto; Laravel 11 é um ótimo framework, é bem documentado e de fácil aprendizagem, o blade é um sistema a parte do Laravel então por isso agregamos ele no projeto.
Tailwind é um framework bonito e mais prático que o bootstrap, também tem documentação online e vários tutoriais.
O GitHub foi utilizado como plataforma de versionamento por ser bastante conhecida e simples, você pode ver ou retornar à versões mais antigas do projeto caso tenha cometido algum erro.
Por favor, caso tenha alguma dificuldade em como utilizar qualquer coisa mencionada anteriormente pesquise! Ninguém nasce sabendo de tudo, nós também tivemos de aprender por conta própria a como utilizar certas coisas.
Além do mais, o sistema funciona em servidor local e somente nessa rede de internet.

1.4 Contexto e motivação: 
O propósito do SIAPAE é simplificar e digitalizar processos na APAE (ex. Anamnese, registro de alunos, controle de gastos, entre outros.), demanda essa que surgiu com a alta taxa de informações a serem preenchidas fisicamente. Este sistema traz benefícios como: otimização do tempo, economia de papel e diminuição na sobrecarga de trabalho.

## 2.0 Instalação

2.1 Requisitos de sistema:
A pasta que possui o sistema completo é leve (menos de 1GB), e pode ser facilmente instalada nas máquinas da instituição, porém programas como o VSCode são muito pesados para suportarem, ou seja se possível traga um notebook pessoal para trabalhar com esse sistema. Caso isso não seja possível, você pode tentar usar os computadores da APAE ou conversar com seu orientador sobre outra possibilidade. Além disso é necessário que você tenha previamente instalado os programas: PHP, Composer, git, Node JS e que tenha feito as devidas modificações para o pleno funcionamento do Laravel em seu PC.

2.2 Passos detalhados para a instalação:
Instalação via GitHub, clique em Code, Download zip e após a instalação extraia o arquivo para a pasta com seus projetos de laravel (sugestão de nomes para a pasta: siapae,projApae,etc). Lembre-se que há mais de um método de instalação fornecido pelo próprio GitHub, caso saiba outro mais conveniente (como o gitclone), aplique.

## 3.0 Uso

3.1 Instruções de uso:
Para que o sistema funcione plenamente é necessário dois terminais em seu VSCode um para que você possa acionar o comando “php artisan serve” e outro para o comando “npm run dev”. Caso ocorra algum problema ao tentar migrar as tabelas, o correto é checar o limite máximo do nome de uma tabela em app/Providers/AppServiceProvider.php, se mesmo assim o erro persistir busque na internet ou pergunte a uma inteligência artificial como prosseguir. Lembre-se de usar os comandos “composer install” e “npm install” para que os demais comandos funcionem corretamente. Também é importante que você gere uma chave no arquivo .env para que o sistema funcione normalmente o comando para utilizar é: “php artisan key:generate”, aliás no mesmo arquivo você deverá apagar os comentários (#) no trecho relacionado com o banco de dados e não esqueça de renomear o arquivo de “.env.example” para “.env” somente.

3.2 Funcionalidades principais:
O sistema é dividido entre a parte administrativa e a parte educacional. A parte educacional é composta por uma área para preenchimento do documento da anamnese, outra para registro de alunos no sistema, para o registro da frequência diária, para o registro de atendimento das professoras, para o preenchimento de dois relatórios: pedagógico e regional e uma parte específica para guardar atas de reuniões. Já a parte administrativa é menor, possui apenas duas áreas para controle de doações e de gastos, respectivamente, e uma área abaixo do perfil para o controle de usuários do sistema.

## 4.0 Arquitetura

4.1 Estrutura do projeto:

O SIAPAE segue a estrutura de pastas já existente do Laravel, mas algumas diferenças é que em resources/views cada “aba” do sistema (ex: Lista dos Estudantes) é uma pasta com seus respectivos caminhos, outra coisa diferente é a parte da validação, em app/Http você poderá ver uma pasta chamada Requests, cada arquivo dessa pasta contém uma validação para cada uma das views, para realizar quaisquer modificações nas views de uma forma geral basta acessar a pasta resources/views/components, lá estarão os arquivos table.blade.php e suas variantes, desta forma o trabalho fica bem mais simplificado, também é nessa pasta que encontrarão o arquivo com o código da navbar que utilizamos para o projeto. Novas views serão adicionadas, então não esqueça de adicionar cada botão com o link correspondente de sua página home.

4.2 Descrição dos componentes principais:

- Anamnese:
Este é um formulário cujo propósito é esclarecer a vida clínica e pessoal de um novo aluno da instituição, ele é bem extenso justamente para extrair as informações mais importantes de cada pessoa. Possui apenas ações simples como criar, editar, excluir e mostrar (show).

- Ficha dos estudantes:
É um dos CRUDS mais importantes do sistema, ele guarda o registro dos estudantes com algumas informações sobre os mesmos. Nele é possível ver a ficha de anamnese do aluno e cada um de seus registros de atendimento, possui todas as ações básicas, porém a exclusão é um pouco diferente, pois não se pode excluir as informações de um aluno desligado, por isso nesse caso os alunos são mantidos no armazém, lá ele pode ser retornado ou excluído definitivamente (em caso de teste).

- Lista de Frequência:
Esta é a área responsável pelo controle de faltas do sistema, os professores podem administrar as faltas de todos os alunos através de filtros de classe, turno e data. Nessa parte também é possível adicionar a assinatura do professor responsável e em determinado input colocar a justificativa da falta, caso haja.

- Registro de atendimento:
Local reservado para registrar avanços, dificuldades e o eixo trabalhado em cada atendimento e para cada aluno. Esta parte é essencial para o desenvolvimento cognitivo e intelectual de cada aluno. Ele possui todas as ações básicas, mas com um diferencial: seu show apresenta um atalho para o show do aluno do qual se trata o registro.

- Relatório Pedagógico:
É a parte destinada ao preenchimento do relatório pedagógico, que seria um resumo completo feito a cada semestre sobre o desenvolvimento individual de cada aluno. É uma das views que possui a ação para exportação em pdf caso o show seja visualizado, além de ter todas as funções básicas.

- Relatório Regional:
Esse relatório é exclusivo para a coordenação, ele é semestral e retrata o que está sendo desenvolvido na APAE durante o semestre. Ele possui todas as funcionalidades do outro relatório, inclusive a exportação para PDF.

- Atas de Reuniões: 
É uma área destinada à criação de atas e arquivamento das mesmas, possui um botão para exportação além de criar, editar, excluir e mostrar. Além disso, é a última view (por enquanto) da parte pedagógica do sistema.

- Controle de Doações:
É a view responsável pelo controle das doações dos contribuintes, ela possui um filtro de ano e uma calculadora que mostra quanto foi arrecadado no ano por cada aluno. Possui duas exportações: para planilha de excel e para PDF.

- Controle de Gastos:
O nome é autoexplicativo, possui as mesmas ações de outros CRUDS, as exportações já mencionadas e a calculadora também. Existem três formas de salvar um custo: Recibo, Nota fiscal e Cupom fiscal. É a última view da parte administrativa (até agora).

- Lista de Usuários:
É uma parte exclusiva para os(as) coordenadores(as) ou aqueles que têm acesso admin, quem é apenas coordenador (não tendo o nível de acesso: admin) não consegue adicionar, editar ou excluir o usuário, apenas tem a opção de ver as suas informações assim como o registro de atendimento do(a) professor(a) (caso ele seja um), arquivar e restaurar os usuários. O admin é a única pessoa do sistema que consegue adicionar, editar e excluir um usuário. (Obs: Quem não tem uma conta no SIAPAE não a tem opção de se registrar, apenas o admin consegue adicionar usuários no sistema)

## 5.0 Testes

5.1 Como executar testes:
Alguns dos testes realizados até agora foram manuais, utilizamos tentativas e erros para descobrir bugs e repará-los, enquanto outros foram utilizando os recursos de seed e factory do laravel 11 . Também fizemos testes com as funcionárias com o objetivo de receber feedback. É de suma importância mostrar o projeto de forma regular para a supervisora, pois ela é quem decide como se deve proceder. Além disso, optamos por não utilizar testes por software, pelo motivo de não ser viável para aquela realidade que estávamos.
(Obs: caso você não tenha experiência com a utilização de seeds e factories, é aconselhável não utilizar esses recursos, pois podem causar erros acidentais).

5.2 Procedimentos para adicionar novos testes:
Você possui à sua disposição alguns softwares que podem realizar testes automaticamente. Se quiser aprofundar seus conhecimentos nesses softwares eu deixo aqui algumas opções: o gerenciador de teste de software Qase e o framework de testes frontend Cypress; para além destes existem também Selenium, Ranorex Studio e o TestComplete como alternativas

## 6.0 Referências

6.1 Referências bibliográficas ou de pesquisa:
Deixamos para você alguns vídeos para melhor compreensão de algumas partes do SIAPAE, essas foram nossas fontes para desenvolvimento do projeto:
- https://trello.com/b/Tz0tNb2w/siapae Trello oficial do projeto
- https://laravel.com/docs/11.x Documentação oficial do Laravel 11
- https://tailwindcss.com/docs/installation/using-vite Documentação oficial do Tailwind
- https://github.com/lucascudo/laravel-pt-BR-localization Github do responsável pela tradução de quase todo o texto do projeto
Github oficial do projeto
- https://youtu.be/YbTUc0GUXp8?si=_kYZLjd0IYhluY2h Vídeo sobre como fazer Upload de arquivos com laravel
- https://youtu.be/1pHsTamRzis?si=VYanvLLXxrVUDR0Y Vídeo sobre como fazer um filtro com intervalo de datas
- https://youtu.be/Cx1cjr7uSq4?si=1TqtJCNEfwRDvNAT Vídeo sobre como fazer seeder no laravel
- https://youtu.be/X3JsQ8jL1Ko?si=JDWrYAeEX3Lkbpwe Vídeo sobre como fazer factories no laravel
- https://www.youtube.com/watch?v=8IBlbBvcI3U&list=PLVSNL1PHDWvS1e1aeoJV7VvaDZ9m67YPU Playlist do canal especializa ti sobre laravel (usamos alguns vídeos desta playlist então colocamos ela de forma completa para facilitar).
- https://youtu.be/b9ur89XItlI?si=t26zuYDrA322vpvh Vídeo explicando sobre Gates no laravel (referente a autorização do administrador)
- https://github.com/Kamona-WD/kui-laravel-breeze Template utilizado como base do projeto.
- https://youtu.be/R58XZ8pAXoE?si=6DNyJtC5cDGu7L-F Vídeo sobre como fazer a barra de pesquisa
- https://youtu.be/8eMBg6pBrVs?si=ia0Mit0v0fOniZWQ Vídeo sobre como exportar para PDF com laravel
- Para exportação com Excel eu utilizei o Copilot da Microsoft (uma IA muito boa para programadores), não só para essa finalidade em específico, várias outras partes do projeto foram feitas com uso de IA.

## 7.0 Contato

7.1 Informações de contato para suporte:
Aqui ficam as informações para contato (telefone e email) com outros estagiários de outros anos caso seja necessário.

- Estágio 2024
- Davi Nícolas de Azevedo Oliveira: (88)99454-5444 davi.oliveira102@aluno.ce.gov.br
- Leo Messy Matoso Guedes: (88)99367-6510 leo.guedes@aluno.ce.gov.br
