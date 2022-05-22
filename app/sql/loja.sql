CREATE
DATABASE loja;

USE
loja;

CREATE TABLE categoria
(
    id PRIMARY KEY AUTO_INCREMENT,
    nome VARACHAR(200)
);

CREATE TABLE roupa
(
    id           INT PRIMARY KEY AUTO_INCREMENT,
    nome         VARCHAR(50),
    preco        FLOAT,
    descricao    VARCHAR(200),
    numero       INT,
    quantidade INT,
    categoria_id INT
        CONSTRAINT rp_cat_id FOREIGN KEY (categoria_id) REFERENCES categoria(id);
);

CREATE TABLE cliente
(
    id PRIMARY KEY AUTO_INCREMENT,
    nome    VARCHAR(200),
    usuario VARCHAR(200),
    senha   VARCHAR(200)
);