/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
/**
* Author:  gian.vieira
* Created: 20/03/2018
*/

  CREATE USER 'ifrs'@'%' IDENTIFIED BY 'ifrs';
  CREATE DATABASE classificados_ifrs;
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
    imagem VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
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
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id int not null,
    categoria_id int not null,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(categoria_id) REFERENCES categorias(id)
  );

  CREATE TABLE sugestoes(
    user_id INT NOT NULL,
    id INT AUTO_INCREMENT PRIMARY KEY,
    comentario text NOT NULL,
    FOREIGN KEY(user_id) REFERENCES users(id)
  );

  INSERT INTO cidades (nome,uf) VALUES('Ibirubá','RS');
  INSERT INTO cidades (nome,uf) VALUES('Tapera','RS');
  INSERT INTO cidades (nome,uf) VALUES('Selbach','RS');
  INSERT INTO cidades (nome,uf) VALUES('Fortaleza dos Valos','RS');

  INSERT INTO `users` (`username`, `password`, `nome`, `email`, `role`, `created`, `modified`, `cidade`) VALUES
  ('gian.vieira', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Gian Paulo', 'gian.vieira@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:03:51', '2018-03-22 16:03:51', 2),
  ('matheus.neu', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Matheus Neu', 'matheus.neu@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:04:20', '2018-03-22 16:04:20', 4),
  ('everton.hoffmann', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Everton Hoffmann', 'everton.hoffmann@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 3),
  ('catarina.rene', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Catarina Rene', 'catarina.rene@teste.ifrs.edu.br', 'normal', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 2),
  ('pedro.pedroso', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Pedro Pedroso', 'pedro.pedroso@teste.ifrs.edu.br', 'normal', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 3),
  ('joao.barro', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Joao de Barro', 'joao.barro@teste.ifrs.edu.br', 'normal', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 3),
  ('zabuza.momochi', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Zabuza Momochi', 'zabuza.momochi@teste.ifrs.edu.br', 'normal', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 2);

  insert into categorias(descricao) values 
  ('Automovel'),
  ('Joias'),
  ('Games'),
  ('Celulares'),
  ('Bijuterias'),
  ('Serviços'),
  ('Animais');

  insert into anuncios (user_id,categoria_id,descricao,preco,titulo,imagem,validade,created,modified) values
  (4,1,'Estou vendendo meu Uno, ano 2000',2000.00,'Vendo Uno','uno.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (4,1,'Estou vendendo meu Gol, ano 2005',3000.00,'Vendo Gol','sem_imagem.jpg','2018-06-04','2018-05-04','2018-05-04'),
  (4,2,'Vendo colar de ouro',1000.00,'Vendo Colar de Ouro','colar_ouro.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (5,2,'Vendo anel de diamante',2500.00,'Vendo Anel de diamante','anel_diamante.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (2,3,'Vendo PlayStation 4, usado mas em boas condições.',2000.00,'Vendo PS4','sem_imagem.jpg','2018-06-04','2018-05-04','2018-05-04'),
  (2,3,'Vendo VR, novo, importado dos EUA.',4000.00,'Vendo VR','vr.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (7,4,'Estou vendendo um Nokia SX 500, com capa grátis, não possui arranhões nem fissuras. \n4GB RAM, 32GB MEMORIA',900.00,'Vendo NOKIA SX 500','nokia_sx.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (7,4,'Vendo Nokia tijolão, só pela nostalgia.',10.00,'Vendo Nokia Tijolão','nokia_tj.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (6,5,'Vendo anel de casamento que minha ex-namorada não quis.',300.00,'Vendo Anel de Casamento','anel_c.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (5,4,'Vendo pulseira de plástico que minha sobrinha fez.',5.00,'Vendo Pulseira','pulseira.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (1,6,'Formato computadores',70.00,'Formato Computador','formatacao.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (3,6,'Faço serviço de personal trainer.',70.00,'Personal Trainer','sem_imagem.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (3,7,'Vendo monstro, bem comportado, basta alimenta-lo com uma dose de whey a cada dois dias, \n e frango com batata doce.',1000.00,'Vendo Monstro','sem_imagem.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),
  (6,7,'vendo meu cavalo, ele se chama Pé de Pano.',2500.00,'Vendo Pé de Pano','sem_imagem.jpg','2018-07-04',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);