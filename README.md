# FinFlow - Sistema de Gerenciamento de Finanças

FinFlow é uma aplicação web para controle financeiro pessoal, permitindo aos usuários registrar, categorizar e gerenciar suas transações financeiras de forma simples e eficiente. O sistema foi desenvolvido utilizando **PHP**, **MySQL**, **Tailwind CSS**, e **JavaScript** para os gráficos interativos.

## Funcionalidades

- **Cadastro e Login de Usuários**: Registro e autenticação de usuários com sessões seguras.
- **Gerenciamento de Transações**: Cadastro, edição e exclusão de transações financeiras.
- **Categorias de Despesas**: Organização das transações por categorias (Ex: Alimentação, Lazer, Transporte).
- **Dashboard Interativo**: Visualização das transações com gráficos interativos.
- **Exportação de Dados**: Opções para exportar as transações para **PDF** ou **Excel**.
- **Interface Responsiva**: Design moderno e responsivo utilizando **Tailwind CSS**.

## Tecnologias Utilizadas

- **Frontend**:
  - HTML
  - CSS (Tailwind CSS)
  - JavaScript
- **Backend**:
  - PHP
  - MySQL
  - PDO (para conexão com o banco de dados)
- **Gráficos**:
  - Chart.js para gráficos interativos

## Estrutura do Projeto

A estrutura do projeto é organizada da seguinte forma:

```bash
/finflow
│
├── /includes        # Arquivos de configuração e funções auxiliares
│   ├── db.php       # Conexão com o banco de dados
│   ├── functions.php # Funções auxiliares do sistema
│
├── /public          # Arquivos públicos acessíveis pela web
│   ├── index.php    # Página principal (Dashboard)
│   ├── login.php    # Página de login
│   ├── register.php # Página de registro de usuário
│   ├── categories.php # Gerenciamento de categorias
│   ├── new_transaction.php # Adicionar nova transação
│   ├── edit_transaction.php # Editar transação
│   ├── delete_transaction.php # Excluir transação
│
├── /assets          # Imagens, ícones e outros recursos estáticos
│   ├── logo.png
│   └── icons.svg
│
└── README.md        # Este arquivo
````

### Como Rodar o Projeto
**1. Clonar o Repositório**

Clone este repositório para o seu ambiente local:
````bash
git clone https://github.com/usuario/finflow.git
cd finflow
````

### 2.Configuração do Ambiente
**Banco de Dados**: Configure o banco de dados no db.php com suas credenciais locais.

**Dependências**: Não há dependências externas além do próprio PHP e MySQL. Apenas certifique-se de ter o XAMPP ou MAMP instalado para rodar o Apache e o MySQL localmente.

### 3. Importar o Banco de Dados
Crie um banco de dados no MySQL chamado finflow.

Importe o esquema do banco de dados utilizando o seguinte SQL:
````SQL
CREATE DATABASE finflow;

USE finflow;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
````

### 4. Iniciar o Servidor
Se estiver usando o XAMPP, inicie o **Apache** e o **MySQL** no painel de controle.

### 5. Acessar a Aplicação
Abra o navegador e acesse a aplicação:
````
http://localhost/finflow/index.php
````

## Como Contribuir
Fork este repositório.

Crie uma branch para a sua feature: git checkout -b minha-feature.

Faça suas modificações.

Adicione e commit suas alterações: git commit -am 'Adiciona nova feature'.

Envie para o repositório remoto: git push origin minha-feature.

Abra um Pull Request no GitHub.

## Comandos do Git
Aqui estão os comandos básicos que você pode usar para trabalhar com Git:

### 1. Inicializar o repositório
````
git init
````

### 2. Adicionar arquivos ao repositório
````
git add .
````

### 3. Fazer commit
````
git commit -m "Descrição do seu commit"
````

### 4. Conectar ao repositório remoto
````
git remote add origin https://github.com/usuario/finflow.git
````

### 5. Enviar alterações para o GitHub
````
git push -u origin master
````

### 6. Puxar as últimas alterações
````
git pull origin master
````

## Licença
Este projeto está licenciado sob a licença **MIT** - veja o arquivo **LICENSE** para mais detalhes.


Feito com ❤️ por **teresabat**
