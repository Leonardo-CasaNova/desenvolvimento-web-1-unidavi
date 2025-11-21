# Sistema de Avaliação de Qualidade de Serviços

Sistema de avaliação anônima para tablets onde clientes avaliam serviços em escala de 0 a 10.

## Funcionalidades

- Formulário de avaliação dinâmico
- Perguntas do banco de dados
- Escala de 0 a 10
- Campo para comentários
- Validação JavaScript
- Design responsivo
- Painel administrativo (Parte 2): login, CRUD de perguntas, dashboard com métricas e gráficos

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

### 8. Painel Administrativo (Parte 2)

Login em: `http://localhost/trabalho-final/public/admin/login.php`

Usuário padrão: `admin`
Senha padrão: `admin123`

Após login você terá acesso a:

- Dashboard com: total de avaliações, média geral, gráficos (média por pergunta, média por dispositivo, evolução últimos dias)
- Gerenciamento de perguntas (criar, editar, excluir, ativar/inativar, ordenar)

Caso queira alterar a senha inicial, rode no PostgreSQL:

```sql
UPDATE usuarios_admin SET senha = 'NOVO_HASH_AQUI' WHERE login = 'admin';
```

Para gerar um novo hash em PHP:

```php
echo password_hash('novaSenha', PASSWORD_DEFAULT);
```

### Recriar Banco (se necessário)

Se precisar resetar:

```sql
DROP TABLE avaliacoes;
DROP TABLE perguntas;
DROP TABLE dispositivos;
DROP TABLE usuarios_admin;
\i C:/xampp/htdocs/trabalho-final/sql/setup.sql
```

## Autor

Leonardo Casa Nova

## Data de Entrega

Parte 1: 14/11/2025
Parte 2: (painel admin) em desenvolvimento
