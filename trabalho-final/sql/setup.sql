-- Script de criação do banco de dados e tabelas
-- Sistema de Avaliação de Qualidade de Serviços Prestados

-- Criar tabela de dispositivos (tablets)
CREATE TABLE IF NOT EXISTS dispositivos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT 'ativo' CHECK (status IN ('ativo', 'inativo'))
);

-- Criar tabela de perguntas
CREATE TABLE IF NOT EXISTS perguntas (
    id SERIAL PRIMARY KEY,
    texto TEXT NOT NULL,
    ordem INTEGER DEFAULT 0,
    status VARCHAR(20) DEFAULT 'ativa' CHECK (status IN ('ativa', 'inativa'))
);

-- Criar tabela de avaliações
CREATE TABLE IF NOT EXISTS avaliacoes (
    id SERIAL PRIMARY KEY,
    id_setor INTEGER REFERENCES dispositivos(id), -- setor avaliado (usando tabela dispositivos como setores)
    id_dispositivo INTEGER REFERENCES dispositivos(id),
    id_pergunta INTEGER REFERENCES perguntas(id),
    resposta INTEGER NOT NULL CHECK (resposta >= 0 AND resposta <= 10),
    feedback_textual TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Criar tabela de usuários administrativos
CREATE TABLE IF NOT EXISTS usuarios_admin (
    id SERIAL PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100) NOT NULL
);

-- Inserir dados de exemplo

-- Inserir dispositivos de exemplo
INSERT INTO dispositivos (nome, status) VALUES 
('Tablet Recepção', 'ativo'),
('Tablet Vendas', 'ativo'),
('Tablet Caixa', 'ativo'),
('Tablet Estacionamento', 'ativo');

-- Inserir perguntas de exemplo
INSERT INTO perguntas (texto, ordem, status) VALUES 
('Como você avalia o atendimento recebido?', 1, 'ativa'),
('Qual é o seu nível de satisfação com a limpeza do estabelecimento?', 2, 'ativa'),
('Como você avalia a organização do ambiente?', 3, 'ativa'),
('Qual é o seu nível de satisfação com o tempo de espera?', 4, 'ativa'),
('Você recomendaria nossos serviços para outras pessoas?', 5, 'ativa');

-- Inserir usuário admin padrão (senha: admin123) usando password_hash gerado previamente
INSERT INTO usuarios_admin (login, senha, nome) VALUES 
('admin', '$2y$10$xpt8olDm1C/jNbZWLUh8cuCzBYsPHAljhl1AxG2eRNS/.0LArNAUq', 'Administrador');
