CREATE DATABASE IF NOT EXISTS biblioteca_virtual;
USE biblioteca_virtual;

CREATE TABLE livros (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    titulo VARCHAR(255),
    autor VARCHAR(255),
    genero VARCHAR(100),
    ano_publicacao INT
);