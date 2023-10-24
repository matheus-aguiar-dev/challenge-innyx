# Teste Técnico - Aplicação CRUD com Laravel e Vue.js

## Sobre o Projeto
O projeto consiste em desenvolver um sistema de gerenciamento de produtos com duas partes principais: o frontend e o backend.

## Frontend (Vue.js)

O frontend da aplicação será construído utilizando o framework Vue.js. As principais funcionalidades que devem ser implementadas no frontend incluem:

    Listagem de Produtos: Exibir a lista de produtos cadastrados no sistema.
    Adição de Produtos: Permitir aos usuários adicionar novos produtos à lista.
    Atualização de Produtos: Permitir aos usuários editar informações dos produtos existentes.
    Exclusão de Produtos: Permitir aos usuários remover produtos da lista.


## Backend (Laravel)

O backend da aplicação será construído utilizando o framework Laravel. As principais funcionalidades que devem ser implementadas no backend incluem:

    API para CRUD de Produtos: Implementar uma API RESTful que permita realizar operações de CRUD (Create, Read, Update, Delete) nos produtos. Esta API será consumida pelo frontend Vue.js.

    Validações: Implementar validações para garantir que os dados enviados pela aplicação frontend sejam válidos e seguros.

    Persistência de Dados: Utilizar um banco de dados para armazenar os dados dos produtos.

## Tecnologias Utilizadas

    Vue.js 3.2 : Framework JavaScript para construção de interfaces de usuário interativas.
    Laravel(10.28): Framework PHP para desenvolvimento de aplicativos web robustos e eficientes.
    PHP(8.2):
    MySQL(8.0.34): Para armazenar os dados dos produtos.
    Git: Sistema de controle de versão para colaboração e controle de mudanças no código-fonte.
    Docker (opcional): Para facilitar o ambiente de desenvolvimento e garantir consistência entre diferentes ambientes.

## Libs Utilizadas: 
    Bootstrap:Framework de front-end para designs de interface responsivos e atraentes.
    Sanctum:Pacote oficial do Laravel para autenticação de API segura.
    Axios:Biblioteca de cliente HTTP para requisições assíncronas em JavaScript.
    fontawesome:Biblioteca de ícones vetoriais escaláveis para melhorar o design da interface do usuário.

# Como Executar o Projeto
1. Clone o Projeto: 

    ```git clone https://github.com/matheus-aguiar-dev/challenge-innyx.git```

2. Vá para o diretório do Projeto:

    ```cd challenge-innyx```

3. Execute o Docker Compose:

    ```docker-compose up -d```

4. Ajuste as Permissões e Execute as Migrações/Seeders:
    ```
    docker exec -it nginx chown -R www-data:www-data /var/www/html/public/images
    docker exec -it laravel-app php artisan migrate --seed
    ```
O primeiro comando ajusta as permissões do diretório de imagens. O segundo executa as migrações do Laravel e os seeders, populando o banco de dados com dados de teste.

5.Acesse o Aplicativo:

Abra o navegador e acesse http://localhost:8080. Isso deve levá-lo à página inicial do seu aplicativo.

6. Faça Login com as Credenciais Fornecidas:

    Login: admin@innyx.com.br
    Senha: admin
     
    
