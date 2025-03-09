-- database/schema.sql

-- Cria o banco de dados 'portfolio' se ele não existir
CREATE DATABASE IF NOT EXISTS portfolio;
-- Seleciona o banco de dados 'portfolio' para uso
USE portfolio;

-- Tabela principal para informações básicas de cada portfólio de aluno
CREATE TABLE IF NOT EXISTS portfolios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(255) NOT NULL UNIQUE, -- Identificador único do aluno (login, matrícula, etc.)
    nome_aluno VARCHAR(255) NOT NULL,       -- Nome do aluno para exibição
    email_aluno VARCHAR(255) UNIQUE,        -- Email do aluno (opcional, para contato)
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data e hora de criação do portfólio
    -- Outros campos gerais sobre o portfólio, se necessário
);

-- Tabela para informações pessoais (seção "Sobre Mim")
CREATE TABLE IF NOT EXISTS portfolio_informacoes_pessoais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    nome VARCHAR(255),
    sobrenome VARCHAR(255),
    foto_perfil VARCHAR(255), -- Caminho para a foto de perfil (opcional)
    bio TEXT,                -- Biografia/descrição sobre o aluno
    profissao VARCHAR(255),    -- Profissão/cargo atual
    localizacao VARCHAR(255),  -- Localização (cidade, país)
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);

-- Tabela para Experiência Acadêmica
CREATE TABLE IF NOT EXISTS portfolio_experiencia_academica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    instituicao VARCHAR(255) NOT NULL,
    curso VARCHAR(255) NOT NULL,
    periodo VARCHAR(255),       -- Ex: "2020 - 2024" ou "Em andamento"
    descricao TEXT,             -- Descrição das atividades/conquistas (opcional)
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);

-- Tabela para Cursos e Certificações
CREATE TABLE IF NOT EXISTS portfolio_cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    nome_curso VARCHAR(255) NOT NULL,
    instituicao VARCHAR(255),    -- Opcional, caso seja relevante
    data_conclusao DATE,         -- Opcional
    descricao TEXT,             -- Descrição do curso/certificação (opcional)
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);

-- Tabela para Projetos Realizados
CREATE TABLE IF NOT EXISTS portfolio_projetos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    titulo_projeto VARCHAR(255) NOT NULL,
    descricao_projeto TEXT,
    link_projeto VARCHAR(255),   -- Link para o projeto online (se houver)
    link_github VARCHAR(255),    -- Link para o repositório GitHub (se houver)
    imagem_projeto VARCHAR(255),  -- Caminho para a imagem do projeto (opcional)
    tecnologias_usadas VARCHAR(255), -- Ex: "HTML, CSS, JavaScript, PHP" (opcional)
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);

-- Tabela para Seção "Sobre Mim" (mais detalhada, se necessário além da bio em 'informacoes_pessoais')
CREATE TABLE IF NOT EXISTS portfolio_secao_sobre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    titulo_secao VARCHAR(255),   -- Ex: "Minha História", "Quem Sou Eu"
    conteudo_secao TEXT,
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);

-- Tabela para Redes Sociais e Contato
CREATE TABLE IF NOT EXISTS portfolio_contato_redes_sociais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL, -- Chave estrangeira referenciando a tabela 'portfolios'
    linkedin VARCHAR(255),
    github VARCHAR(255),
    whatsapp VARCHAR(20),
    email VARCHAR(255),
    -- Outras redes sociais podem ser adicionadas aqui (ex: instagram, twitter, etc.)
    FOREIGN KEY (portfolio_id) REFERENCES portfolios(id) ON DELETE CASCADE
);