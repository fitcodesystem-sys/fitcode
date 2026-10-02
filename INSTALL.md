# 🚀 Guia de Instalação — FitCode

Siga as instruções abaixo para configurar e executar o projeto **FitCode** em seu ambiente local.

---

## 📋 Pré-requisitos

Certifique-se de ter instalado em sua máquina:

* **PHP** >= 8.2 (com extensões `pdo`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `curl`)
* **Composer** >= 2.x
* **Node.js** >= 18.x e **NPM**
* **MySQL** ou **MariaDB**
* **Git**

---

## ⚙️ Passo a Passo para Instalação

### 1. Clonar o Repositório
`git clone [https://github.com/seu-usuario/fitcode.git](https://github.com/seu-usuario/fitcode.git)`
`cd fitcode`


### 2. Instalar Dependências do PHP (Composer)
`composer install`


### 3. Instalar Dependências do JavaScript (NPM)
`npm install`

### 4. Configurar as Variáveis de Ambiente
Crie o arquivo .env copiando o exemplo fornecido:

`cp .env.example .env`

Abra o arquivo .env e configure as credenciais do seu banco de dados:

### 5. Gerar a Chave da Aplicação
`php artisan key:generate`


### 6. Executar as Migrações e Seeders (Banco de Dados)
Crie o banco de dados especificado no .env (ex: fitcode_db) e em seguida rode:

`php artisan migrate --seed`

### 7. Compilar os Assets (CSS/JS)
`npm run build`

### 8. Iniciar o Servidor Local
`php artisan serve`

#### Acesse no seu navegador: http://localhost:8000
