# 🧩 Sistema CRUD de Usuários + Formulário de Suporte (Docker + Mailtrap)

Olá meu nome é Marley.  
Aqui está tudo o que você precisa saber para rodar o sistema localmente, configurar o Mailtrap para testar o envio de e-mails (sandbox) e utilizar o CRUD de usuários e o formulário de suporte.  
Siga os passos abaixo com calma para não ter problemas.

> 🔗 **Repositório:** [https://github.com/Mxrlrey/clube-fullstack-projetos.git](https://github.com/Mxrlrey/clube-fullstack-projetos.git)

---

## 🚀 O que este projeto faz
Este repositório contém um **sistema CRUD de usuários** e um **formulário de suporte funcional**, que envia e-mails via SMTP usando **PHPMailer** e **Mailtrap**.  
Tudo roda em um ambiente **Docker (PHP + MySQL)** configurado para execução local de forma simples e rápida.

---

## ⚙️ Requisitos
Antes de iniciar, você precisa ter instalado:
- 🐳 **Docker** e **Docker Compose**
- 💻 **Git** (para clonar o repositório)
- (Opcional) **Composer** localmente — se não tiver, mostro abaixo como rodar via container.

---

## 📁 Estrutura importante do projeto
| Caminho | Descrição |
|----------|------------|
| `docker-compose.yml` | Configuração dos containers (PHP + MySQL) |
| `Dockerfile` | Imagem PHP que serve o diretório `/public` |
| `composer.json` | Dependências (PHPMailer, PDO) |
| `bootstrap.php` | Inicialização do app e autoload |
| `public/` | Arquivos públicos e página inicial (`index.php`) |
| `app/functions/` | Funções principais do sistema (`database.php`, `email.php`, etc.) |

---

## 🧰 Instalação e execução

### 1️⃣ Clonar o repositório
```bash
git clone https://github.com/Mxrlrey/clube-fullstack-projetos.git
cd clube-fullstack-projetos
```
---
### 2️⃣ Instalar dependências do PHP (via Composer)

Para que o projeto funcione corretamente, é necessário instalar as dependências PHP definidas no arquivo `composer.json`, incluindo o **PHPMailer** e o **PDO** para conexão ao banco de dados.

#### 💡 Se você **já possui o Composer instalado** localmente:
Execute o comando abaixo dentro da pasta do projeto:

```bash
composer install
```
#### 🐳 Se você não possui o Composer instalado:
Você pode rodar o Composer diretamente em um container Docker, sem precisar instalá-lo no seu sistema:
```bash
docker run --rm -v "$(pwd)":/app -w /app composer install
```
---
### 3️⃣ Subir os containers Docker
```bash
docker compose -f docker-compose.yml up --build -d
```
Verifique se está rodando:
```bash
docker ps
```
Você verá algo como:
>php_app → rodando na porta 8000
>
>mysql_db → rodando na porta 3306
---
### 4️⃣ Criar o banco de dados e tabela `user`

Crie um arquivo chamado **`schema.sql`** na raiz do projeto com o conteúdo abaixo:

```mysql
CREATE DATABASE IF NOT EXISTS `clube-fullstack` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `clube-fullstack`;

CREATE TABLE `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `sobrenome` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
```
Depois, importe para o container MySQL:
```bash
docker exec -i mysql_db mysql -uroot -proot clube-fullstack < schema.sql
```
---
### 5️⃣ Acessar a aplicação
Abra o navegador e vá para:

> http://localhost:8000

A aplicação deverá abrir com a tela inicial do CRUD de Usuários.

---

### 6️⃣ Configurando o Mailtrap (sandbox)
Esta é a parte que permite enviar e visualizar e-mails de teste com segurança.

#### ⚙️ 1. Configuração Inicial do Mailtrap

1.  **Acesse o Mailtrap:**
    * Vá para:
    >[https://mailtrap.io](https://mailtrap.io).
    * Crie uma conta gratuita ou faça login usando seu GitHub/Google.
    

2.  **Acesse a Sandbox e Credenciais:**
    * No painel lateral (sidebar) do Mailtrap, navegue até **Sandboxes**.
    * Clique em **MySandbox** (ou crie uma nova caixa de entrada/sandbox).
    * Dentro da sua sandbox, deixe a aba em **SMTP**.
    

3.  **Credenciais a Serem Obtidas:**
    * **Username** (código alfanumérico)
    * **Password** (botão "Click to copy" - clique para copiar a senha)

---

#### 💻 2. Integração no Backend (Projeto)

No backend do seu projeto (arquivo `app/functions/email.php`), substitua apenas as linhas de `Username` e `Password` pelas credenciais obtidas no Mailtrap:

```php
// Arquivo: app/functions/email.php

// ... outras configurações

$mail->Username = 'COLOQUE_SEU_USERNAME_DO_MAILTRAP_AQUI'; // Substitua pelo seu código Mailtrap
$mail->Password = 'COLOQUE_SEU_PASSWORD_DO_MAILTRAP_AQUI'; // Substitua pela sua senha Mailtrap

// ... restante do código
```
---
#### 🧪 3. Teste de Envio do E-mail
1.  **Acesse a Página de Suporte:**
    * No navegador, vá para a página de Suporte da aplicação: 
    > http://localhost:8000/?page=contato

   2.  **Preencha os campos e Envie o Formulário:**
       * Nome.
       * E-mail.
       * Assunto.
       * Mensagem

       Clique em Enviar.

3.  **Verifique o E-mail no Mailtrap:**
    * Volte para a sandbox do Mailtrap no seu navegador.
    * O e-mail enviado aparecerá instantaneamente lá dentro.
---
## 🧭 Uso do sistema
| Página | Função                                                            |
|----------|-------------------------------------------------------------------|
| `/` | Lista todos os usuários cadastrados                               |
| `?page=create_user` | Formulário para cadastrar um novo usuário                         |
| `?page=contato` | Formulário de Suporte com envio via Mailtrap                      |
| `Navbar → Suporte` | Acesso rápido à página de suporte                                  |
---
## ⚠️ Problemas comuns e soluções
| Problema                         | Solução                                      |
|----------------------------------|----------------------------------------------|
| `E-mail não aparece no Mailtrap` | Confira as credenciais (Username e Password) e se está usando a sandbox correta          |
| `Porta 8000 não abre`              | Verifique docker ps e se não há outro processo usando a porta    |
---
## 🧾 Conclusão
Pronto! Agora você pode:
* Rodar o sistema completo em Docker.
* Gerenciar usuários com CRUD.
* Enviar e-mails de teste via Mailtrap Sandbox.
* Visualizar mensagens enviadas sem precisar de servidor real.
---
