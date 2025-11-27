CREATE DATABASE IF NOT EXISTS projeto_estoque;
USE projeto_estoque;

CREATE TABLE IF NOT EXISTS usuario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cadastro VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    cargo TINYINT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS categoria(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS produto(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    quantidade INT NOT NULL,
    quantidade_minima INT,
    data_validade DATE,
    data_adicionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    categoria_id INT NOT NULL,
    INDEX fk_produto_categoria_id (categoria_id ASC),
    CONSTRAINT fk_produto_categoria
        FOREIGN KEY (categoria_id)
        REFERENCES projeto_estoque.categoria (id)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categoria (id, nome) VALUES
(1, 'Enfermagem'),
(2, 'Escritório');