FinFlow - Sistema de Gerenciamento Financeiro
FinFlow é um sistema de gerenciamento financeiro pessoal que permite a gestão de categorias de despesas e transações. O sistema é construído utilizando PHP, MySQL, Tailwind CSS e Chart.js para visualização de dados, com foco em usabilidade e boa experiência para o usuário.

Funcionalidades
Cadastro e Login: Permite que os usuários se cadastrem e façam login com autenticação segura.

Gerenciamento de Categorias: Os usuários podem criar, editar e excluir categorias de despesas.

Dashboard Financeiro: Exibe uma visão geral das transações do usuário com gráficos dinâmicos usando Chart.js.

CRUD de Transações: Registro, visualização, edição e exclusão de transações financeiras.

Design Responsivo: Usando Tailwind CSS para garantir que a interface seja totalmente responsiva para dispositivos móveis e desktop.

Tecnologias Utilizadas
PHP: Linguagem de programação para backend.

MySQL: Banco de dados relacional para armazenar as informações do usuário e transações.

Tailwind CSS: Framework CSS utilitário para um design responsivo e moderno.

Chart.js: Biblioteca para visualização de gráficos dinâmicos.

HTML5 & JavaScript: Para construção das páginas e interatividade.

Instalação
Requisitos
Servidor Apache ou Nginx

PHP (recomendado versão 7.4 ou superior)

MySQL

Composer (para gerenciamento de dependências PHP, caso necessário)

Passos para Configuração
Clone o repositório:

bash
Copiar
Editar
git clone https://github.com/usuario/finflow.git
cd finflow
Configuração do banco de dados:

Crie um banco de dados MySQL chamado finflow.

Importe as tabelas com o seguinte script SQL:

sql
Copiar
Editar
CREATE DATABASE finflow;

USE finflow;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    category_id INT,
    amount DECIMAL(10, 2) NOT NULL,
    description TEXT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
Configuração do arquivo de banco de dados:

Edite o arquivo includes/db.php com as suas credenciais do banco de dados MySQL:

php
Copiar
Editar
<?php
$host = 'localhost';
$dbname = 'finflow';
$username = 'root';
$password = ''; // sua senha do MySQL
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
}
?>
Instalação do Composer (se necessário):

Se você usa o Composer para gerenciar pacotes, execute:

bash
Copiar
Editar
composer install
Iniciar o servidor local:

Se você está usando o PHP built-in server, execute:

bash
Copiar
Editar
php -S localhost:8000
Acesse a aplicação em http://localhost:8000.

Uso
Página de Login
Ao acessar o sistema, o usuário verá a tela de login.

O usuário pode fazer login com e-mail e senha, ou se cadastrar caso ainda não tenha uma conta.

Dashboard
Após o login, o usuário será redirecionado para o Dashboard, onde poderá visualizar suas transações e categorias.

O gráfico exibido no dashboard apresenta uma visualização das transações por categoria usando Chart.js.

Gerenciamento de Categorias
Na página de Gerenciamento de Categorias, o usuário pode criar novas categorias, editar ou excluir as existentes.

Gerenciamento de Transações
O usuário pode registrar transações financeiras associadas a uma categoria específica.

O sistema permite editar e excluir transações.

Comandos do Terminal
Aqui estão os comandos úteis para trabalhar com o projeto:

Instalar dependências (se usar Composer):

bash
Copiar
Editar
composer install
Rodar o servidor local (PHP built-in server):

bash
Copiar
Editar
php -S localhost:8000
Migrar o banco de dados (se necessário): Se você utilizar um sistema de migração de banco de dados, use o comando correspondente. Caso não esteja utilizando migrador, basta importar o SQL manualmente.

Rodar os testes (se houver testes configurados):

bash
Copiar
Editar
php vendor/bin/phpunit
Contribuição
Se você quiser contribuir para este projeto, sinta-se à vontade para enviar um pull request. Antes de enviar, por favor, abra uma issue para discutir o que você deseja mudar ou adicionar.

Fork o repositório.

Crie uma nova branch para suas modificações (git checkout -b feature/nova-feature).

Faça commit das suas alterações (git commit -am 'Adiciona nova feature').

Envie para o repositório remoto (git push origin feature/nova-feature).

Abra um Pull Request.

Licença
Este projeto está licenciado sob a MIT License - veja o arquivo LICENSE para mais detalhes.
