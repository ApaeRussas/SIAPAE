°Bem vindo(a) ao SIAPAE (Sistema Interno da APAE), este documento serve para auxiliar você sobre como funciona o projeto inteiro e sobre como prosseguir com ele, é essencial que você leia todo o documento ou pelo menos grande parte dele; Dito isso boa sorte nos próximos meses.

°Atenção!!! Este documento não irá tratar de nenhum detalhe sobre o site feito em WordPress, o mesmo possui sua própria documentação à parte.

------------------------------------------------------------------------------------------------
Sumário:
1.0 Introdução:

1.1 Regras.

1.2 Descrição geral do projeto.

1.3 Propósito e objetivos.

1.4 Contexto e motivação.

2.0 Instalação:

2.1 Requisitos de sistema.

2.2 Passos detalhados para a instalação.

3.0 Uso:

3.1 Instruções de uso.

3. 2 Funcionalidades principais. 

4.0 Arquitetura:

4.1 Estrutura do projeto.

4.2 Diagrama de arquitetura (se aplicável).

4.3 Descrição dos componentes principais.

5.0 Testes:

5.1 Como executar testes.

5.2 Procedimentos para adicionar novos testes.

6.0 Referências:

6.1 Referências bibliográficas ou de pesquisa.

7.0 Contato:

7.1 Informações de contato para suporte.

------------------------------------------------------------------------------------------------
1.0 Introdução

1.1: Regras: Definimos algumas regras para a atualização desse documento e arquivos do projeto, uma vez que o estagiário ou sua equipe terão a responsabilidade de atualizar as informações aqui presentes.

N°1: Não use palavrões na documentação ou em qualquer comentário nos arquivos do projeto, essa não é uma atitude aceitável. N°2: Evite usar gírias ou ser informal no geral, esse documento será passado para outras pessoas futuramente, então deve-se manter a boa postura. N°3: Não adicione informações fúteis ao documento, insira apenas o essencial para deixá-lo mais organizado e sucinto (Isso vale para brincadeiras ou piadas internas). N°4: Siga o padrão, quem começou a escrever esse documento utiliza uma forma simples de se copiar e entender na estrutura dos parágrafos então se puder não modifique a forma existente, a não ser que sua forma seja melhor que a atual. N°5: Evite usar nomes aqui, este projeto tem e terá vários autores e existe um local adequado para colocar o seu no final deste documento. N°6: Se precisar de ajuda peça, nas cópias físicas e digitais desta documentação haverá um local com números de telefone e contato de outros autores caso for necessário (A sua supervisora Kélvia também possui os números).

1.2 Descrição geral do projeto: O SIAPAE é um site com mais de um CRUD e outras ferramentas desenvolvidas para gestão. Ele é majoritariamente escrito em PHP, porém também apresenta JavaScript e CSS em algumas partes, os frameworks utilizados foram Laravel 11 e Tailwind, além disso utilizamos o Blade para a parte de segurança (login).

1.3 Propósito e objetivos: Aqui iremos falar o motivo de certas escolhas tomadas ao longo do projeto; Laravel 11 é um ótimo framework, é bem documentado e de fácil aprendizagem, o blade é um sistema a parte do Laravel então por isso agregamos ele no projeto. Tailwind é um framework bonito e mais prático que o bootstrap, também tem documentação online e vários tutoriais. O GitHub foi utilizado como plataforma de versionamento por ser bastante conhecida e prática, você pode ver versões mais antigas do projeto caso tenha cometido algum erro. Por favor, caso tenha alguma dificuldade em como utilizar qualquer coisa mencionada anteriormente pesquise! Ninguém nasce sabendo de tudo, nós também tivemos de aprender por conta própria a como utilizar certas coisas. O sistema funciona em servidor local e somente nessa rede de internet, os usuários são inseridos manualmente no banco de dados devido ao baixo número de funcionários

1.4 Contexto e motivação: O propósito do SIAPAE é simplificar e digitalizar processos na APAE (ex. Anamnese, registro de alunos, controle de gastos, entre outros.), demanda essa que surgiu com a alta taxa de informações a serem preenchidas fisicamente. Este sistema traz benefícios como: otimização do tempo, economia de papel e diminuição na sobrecarga de trabalho.

2.0 Instalação

2.1 Requisitos de sistema: A pasta que possui o sistema completo é leve (menos de 300MB), e pode ser facilmente instalada nas máquinas da instituição, porém programas como o VSCode são muito pesados para suportarem, ou seja se possível traga um notebook pessoal para trabalhar com esse sistema. Caso isso não seja possível, você pode tentar usar os computadores da APAE ou conversar com seu orientador sobre outra possibilidade. Além disso é necessário que você tenha previamente instalado os programas: PHP, Composer, Node JS e que tenha feito as devidas modificações para o pleno funcionamento do Laravel em seu PC.

2.2 Passos detalhados para a instalação: Instalação via GitHub, clique em Code, Download zip e após a instalação extraia o arquivo para a pasta com seus projetos de laravel (sugestão de nomes para a pasta: siapae,projApae,etc). Lembre-se que há mais de um método de instalação fornecido pelo próprio GitHub, caso saiba algum mais conveniente (como o gitclone), aplique.

3.0 Uso:

3.1 Instruções de uso: Para que o sistema funcione plenamente é necessário dois terminais em seu VSCode um para que você possa acionar o comando “php artisan serve” e o outro para o comando “npm run dev”. Caso ocorra algum problema ao tentar migrar as tabelas, o correto é checar o limite máximo do nome de uma tabela em app->Providers->AppServiceProvider.php, se mesmo assim o erro persistir busque na internet ou pergunte a uma inteligência artificial como prosseguir. Lembre-se de usar os comandos “composer install” e “npm install” para que os demais comandos funcionem corretamente. Também é importante que você gere uma chave no arquivo .env para que o sistema funcione normalmente o comando para utilizar é: “php artisan key:generate”, aliás no mesmo arquivo você deverá apagar os comentários (#) no trecho relacionado com o banco de dados e não esqueça de renomear o arquivo de “.env.example” para “.env” somente.

2 Funcionalidades principais: INACABADO
4.0 Arquitetura

4.1 Estrutura do projeto: INACABADO 4.2 Diagrama de arquitetura (se aplicável): INACABADO 4.3 Descrição dos componentes principais: INACABADO

5.0 Testes:

5.1 Como executar testes: Alguns dos testes realizados até agora foram manuais, utilizamos tentativas e erros para descobrir bugs e consertá-los, enquanto outros foram utilizando os recursos de seed e factory do laravel 11 . Também fizemos testes com as funcionárias com o objetivo de receber feedback. É de suma importância mostrar o projeto de forma regular para a supervisora, pois ela é quem decide como se deve proceder. Além disso, optamos por não utilizar testes por software, pelo motivo de não ser viável para aquela realidade que estávamos.

5.2 Procedimentos para adicionar novos testes: Você possui à sua disposição alguns softwares que podem realizar testes automaticamente. Se quiser aprofundar seus conhecimentos nesses softwares eu deixo aqui algumas opções: o gerenciador de teste de software Qase e o framework de testes frontend Cypress; para além destes existem também Selenium, Ranorex Studio e o TestComplete como alternativas (Obs: Infelizmente aqui não haverá nenhuma instrução de como utilizar nenhuma dessas ferramentas, pois não utilizamos elas. Se alguém porventura for explorar esses programas, deixe aqui como você fez para usá-los).

6.0 Referências:

6.1 Referências bibliográficas ou de pesquisa: INACABADO

7.0 Contato:

7.1 Informações de contato para suporte: Aqui ficam as informações para contato com outros estagiários de outros anos caso seja necessário.

Estágio 2024 Davi Nicolas de Azevedo Oliveira: (88)99454-5444 davi.oliveira102@aluno.ce.gov.br Leo Messy Matoso Guedes: (88)99367-6510 leo.guedes@aluno.ce.gov.br
