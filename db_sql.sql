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