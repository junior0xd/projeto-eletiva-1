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

INSERT INTO produto (id, nome, descricao, quantidade, quantidade_minima, data_validade, categoria_id) VALUES
(1, 'Máscara Cirúrgica', 'Máscara descartável para proteção contra partículas e gotículas.', 500, 100, '2025-12-31', 1),
(2, 'Luvas de Procedimento', 'Luvas descartáveis de látex para procedimentos médicos.', 300, 50, '2024-11-30', 1),
(3, 'Caneta Esferográfica', 'Caneta azul para uso em escritório.', 200, 20, NULL, 2),
(4, 'Caderno de Anotações', 'Caderno pautado para anotações diversas.', 150, 15, NULL, 2);
(5, 'Álcool em Gel 70%', 'Álcool em gel para higienização das mãos.', 250, 30, '2024-10-15', 1);
(6, 'Adesivo para Etiquetas', 'Adesivo branco para etiquetas de escritório.', 100, 10, NULL, 2);
(7, 'Termômetro Digital', 'Termômetro digital para medição de temperatura corporal.', 80, 10, '2026-01-20', 1);
(8, 'Papel Sulfite A4', 'Resma de papel sulfite tamanho A4 para impressoras.', 300, 25, NULL, 2);
(9, 'Soro Fisiológico 0,9%', 'Soro fisiológico para uso médico.', 120, 20, '2025-08-10', 1);
(10, 'Clips de Papel', 'Pacote de clips para organização de documentos.', 400, 40, NULL, 2);
(11, 'Esparadrapo', 'Fita adesiva médica para fixação de curativos.', 180, 25, '2025-05-05', 1);
(12, 'Marcador Permanente', 'Caneta marcador permanente para quadros brancos.', 90, 15, NULL, 2);
(13, 'Gaze Estéril', 'Gaze estéril para curativos.', 220, 30, '2024-09-25', 1);
(14, 'Pasta de Arquivo', 'Pasta para arquivamento de documentos.', 160, 20, NULL, 2);
(15, 'Termômetro de Mercúrio', 'Termômetro tradicional de mercúrio para medição de temperatura.', 70, 10, '2026-03-15', 1);
(16, 'Fita Adesiva Transparente', 'Fita adesiva transparente para uso em escritório.', 250, 30, NULL, 2);
(17, 'Luvas Cirúrgicas Estéreis', 'Luvas cirúrgicas estéreis para procedimentos médicos.', 150, 20, '2024-12-01', 1);
(18, 'Bloco de Notas Autoadesivas', 'Bloco de notas autoadesivas para lembretes.', 300, 35, NULL, 2);
(19, 'Máscara N95', 'Máscara respiratória N95 para proteção avançada.', 100, 15, '2025-11-30', 1);
(20, 'Grampeador de Mesa', 'Grampeador para uso em escritório.', 80, 10, NULL, 2);
(21, 'Catéter Intravenoso nº 22', 'Catéter intravenoso para administração de medicamentos.', 130, 20, '2025-07-15', 1);
(22, 'Envelope de Papel', 'Envelope tamanho A4 para correspondências.', 200, 25, NULL, 2);
(23, 'Sonda Nasogástrica', 'Sonda para alimentação enteral.', 90, 15, '2026-02-28', 1);
(24, 'Calculadora de Mesa', 'Calculadora para uso em escritório.', 70, 10, NULL, 2);
(25, 'Seringa Descartável 10ml', 'Seringa descartável para administração de medicamentos.', 160, 25, '2024-10-20', 1);
(26, 'Fichário de Argolas', 'Fichário para organização de documentos.', 120, 15, NULL, 2);
(27, 'Termômetro Infravermelho', 'Termômetro infravermelho para medição sem contato.', 60, 10, '2026-04-10', 1);
(28, 'Papel Cartão Colorido', 'Papel cartão colorido para trabalhos manuais.', 180, 20, NULL, 2);
(29, 'Luvas de Vinil', 'Luvas descartáveis de vinil para procedimentos médicos.', 140, 20, '2025-01-15', 1);
(30, 'Marcador de Texto', 'Marcador de texto fluorescente para destaque.', 220, 30, NULL, 2);
(31, 'Máscara de Proteção Facial', 'Máscara facial reutilizável para proteção.', 110, 15, '2025-09-30', 1);
(32, 'Carimbo Personalizado', 'Carimbo para uso em escritório.', 50, 5, NULL, 2);
(33, 'Gaze Não Estéril', 'Gaze não estéril para curativos.', 200, 25, '2024-11-10', 1);
(34, 'Pasta Suspensa', 'Pasta suspensa para arquivamento de documentos.', 140, 15, NULL, 2);
(35, 'Soro Glicosado 5%', 'Soro glicosado para uso médico.', 100, 15, '2025-06-20', 1);
(36, 'Tesoura de Escritório', 'Tesoura para uso em escritório.', 90, 10, NULL, 2);