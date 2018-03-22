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

use classificados_ifrs;

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

INSERT INTO cidades (nome,uf) VALUES('Ibirubá','RS');
INSERT INTO cidades (nome,uf) VALUES('Tapera','RS');
INSERT INTO cidades (nome,uf) VALUES('Selbach','RS');
INSERT INTO cidades (nome,uf) VALUES('Fortaleza dos Valos','RS');

INSERT INTO `users` (`username`, `password`, `nome`, `email`, `role`, `created`, `modified`, `cidade`) VALUES
('gian.vieira', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Gian Paulo', 'gian.vieira@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:03:51', '2018-03-22 16:03:51', 2),
('matheus.neu', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Matheus Neu', 'gian.vieira@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:04:20', '2018-03-22 16:04:20', 4),
('everton.hoffmann', '$2y$10$KWQ8kH/nGRAmVcmwSdufbuo2Shh4tgV.NUyBA3DGyYOTLJIeohYtm', 'Everton Hoffmann', 'gian.vieira@ibiruba.ifrs.edu.br', 'admin', '2018-03-22 16:05:00', '2018-03-22 16:05:00', 3);