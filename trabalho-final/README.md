# Sistema de Avaliação de Qualidade de Serviços

Sistema de avaliação anônima para tablets onde clientes avaliam serviços em escala de 0 a 10.

## Funcionalidades

- Formulário de avaliação dinâmico
- Perguntas do banco de dados
- Escala de 0 a 10
- Campo para comentários
- Validação JavaScript
- Design responsivo

## Tecnologias

- HTML5, CSS3, JavaScript
- PHP
- PostgreSQL

## Instalação (Windows - XAMPP)

### 1. Instalar o XAMPP
- Baixe em: https://www.apachefriends.org/
- Instale normalmente

### 2. Instalar o PostgreSQL
- Baixe em: https://www.postgresql.org/download/windows/
- Durante a instalação, defina a senha como `postgres`
- Deixe a porta padrão `5432`

### 3. Habilitar extensão PostgreSQL no PHP

Abra o arquivo `C:\xampp\php\php.ini` e remova o `;` das linhas:

```ini
extension=pgsql
extension=pdo_pgsql
```

Salve o arquivo e reinicie o Apache no painel do XAMPP.

### 4. Criar o banco de dados

Abra o pgAdmin (instalado com o PostgreSQL) e execute o script `sql/setup.sql`

Ou via terminal:
```bash
psql -U postgres
CREATE DATABASE avaliacao_servicos;
\c avaliacao_servicos
\i C:/xampp/htdocs/trabalho-final/sql/setup.sql
```

### 5. Configurar o projeto

Edite o arquivo `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'avaliacao_servicos');
define('DB_USER', 'postgres');
define('DB_PASS', 'postgres'); // sua senha do PostgreSQL
```

### 6. Copiar para o XAMPP

Copie a pasta `trabalho-final` para `C:\xampp\htdocs\`

### 7. Acessar

Abra no navegador: http://localhost/trabalho-final/public/

## Estrutura de Arquivos

```
trabalho-final/
├── public/
│   ├── css/style.css
│   ├── js/
│   │   ├── script.js
│   │   └── redirect.js
│   ├── index.php
│   ├── processar.php
│   └── obrigado.php
├── src/
│   ├── db.php
│   ├── perguntas.php
│   ├── respostas.php
│   └── funcoes.php
├── sql/setup.sql
└── config.php
```

## Banco de Dados

### Tabelas

- **dispositivos** - Tablets cadastrados
- **perguntas** - Perguntas do formulário
- **avaliacoes** - Respostas dos clientes
- **usuarios_admin** - Usuários admin (Parte 2)

### Dados iniciais

- 4 dispositivos (Recepção, Vendas, Caixa, Estacionamento)
- 5 perguntas exemplo
- 1 usuário admin (login: admin / senha: admin123)

## Problemas Comuns

### Erro: Call to undefined function pg_connect()

A extensão PostgreSQL não está habilitada.

**Solução:**
1. Abra `C:\xampp\php\php.ini`
2. Procure por `;extension=pgsql`
3. Remova o `;` (ponto e vírgula)
4. Faça o mesmo com `;extension=pdo_pgsql`
5. Reinicie o Apache

### Erro: Connection refused

O PostgreSQL não está rodando.

**Solução:**
1. Abra "Serviços" do Windows (Win + R, digite services.msc)
2. Procure por "postgresql"
3. Clique em "Iniciar"

### Erro: database does not exist

O banco não foi criado.

**Solução:**
Abra o pgAdmin e execute o script `sql/setup.sql`

## Autor

Leonardo Casa Nova

## Data de Entrega

Parte 1: 14/11/2025
