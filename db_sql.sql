/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
/**
* Author:  gian.vieira
* Created: 20/03/2018
*/
create database classificados_ifrs;

  CREATE USER 'ifrs'@'%' IDENTIFIED BY 'ifrs';
  GRANT ALL PRIVILEGES ON classificados_ifrs.* TO ifrs;
  FLUSH PRIVILEGES;

  USE classificados_ifrs;

  CREATE TABLE cidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(300) NOT NULL UNIQUE,
    uf CHAR(2) NOT NULL
  );

  CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nome VARCHAR(250) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    role VARCHAR(20) NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    cidade INT NOT NULL,
    FOREIGN KEY(cidade) REFERENCES cidades(id)
  );

  CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(200) NOT NULL UNIQUE
  );

  CREATE TABLE anuncios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    categoria_id INT NOT NULL,
    descricao TEXT NOT NULL,
    preco decimal(12,5) NULL,
    titulo VARCHAR(50) NOT NULL,
    validade DATE NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
  );

  CREATE TABLE anexos(
    id INT AUTO_INCREMENT PRIMARY KEY,
    anuncio_id INT NOT NULL,
    caminho VARCHAR(300) NOT NULL,
    FOREIGN KEY(anuncio_id) REFERENCES anuncios(id)
  );

  CREATE TABLE comentarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    anuncio_id INT NOT NULL,
    user_id INT NOT NULL,
    descricao TEXT NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    FOREIGN KEY(anuncio_id) REFERENCES anuncios(id),
    FOREIGN KEY(user_id) REFERENCES users(id)
  );

  CREATE TABLE favoritos(
    user_id INT NOT NULL,
    categoria_id INT NOT NULL,
    FOREIGN KEY(categoria_id) REFERENCES categorias(id),
    FOREIGN KEY(user_id) REFERENCES users(id),
    PRIMARY KEY(user_id, categoria_id)
  );

  INSERT INTO cidades (nome,uf) VALUES('Ibirubá','RS');
  INSERT INTO cidades (nome,uf) VALUES('Tapera','RS');
  INSERT INTO cidades (nome,uf) VALUES('Selbach','RS');
  INSERT INTO cidades (nome,uf) VALUES('Fortaleza dos Valos','RS');

  INSERT INTO `users` (`username`, `password`, `nome`, `email`, `role`, `created`, `modified`, `cidade`) VALUES
  ('gian.vieira', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Gian Paulo', 'gian.vieira@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:03:51', '2018-03-22 16:03:51', 2),
  ('matheus.neu', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Matheus Neu', 'matheus.neu@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:04:20', '2018-03-22 16:04:20', 4),
  ('everton.hoffmann', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Everton Hoffmann', 'everton.hoffmann@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 3);

  insert into categorias(descricao) values ('Automovel');
  insert into categorias(descricao) values ('Joias');

  insert into anuncios (user_id,categoria_id,descricao,preco,titulo,validade) values(1,1,'Estou vendendo meu Uno, ano 2000',2000.00,'Vendo Uno','06/14/2018');
