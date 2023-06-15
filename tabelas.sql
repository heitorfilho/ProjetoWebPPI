CREATE TABLE categoria
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   descricao varchar(255)
) ENGINE=InnoDB;

CREATE TABLE anunciante
(
   codigo int PRIMARY KEY auto_increment,
   nome varchar(50),
   cpf char(14) UNIQUE,
   email varchar(50) UNIQUE,
   hash_senha varchar(255),
   telefone varchar(30)
) ENGINE=InnoDB;

CREATE TABLE anuncio
(
   codigo int PRIMARY KEY auto_increment,
   titulo varchar(255),
   descricao varchar(1000),
   preco float,
   dataHora datetime,
   cep varchar(9),
   bairro varchar(30),
   cidade varchar(30),
   estado varchar(30),
   codCategoria int not null,
   codAnunciante int not null,
   FOREIGN KEY (codCategoria) REFERENCES categoria(codigo) ON DELETE CASCADE,
   FOREIGN KEY (codAnunciante) REFERENCES anunciante(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE interesse
(
   codigo int PRIMARY KEY auto_increment,
   mensagem varchar(255),
   dataHora date,
   contato varchar(50),
   codAnuncio int not null,
   FOREIGN KEY (codAnuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE foto
(
   codAnuncio int not null,
   nomeArqFoto varchar(50),
   FOREIGN KEY (codAnuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE base_enderecos
(
   id int PRIMARY KEY auto_increment,
   cep char(10),
   bairro varchar(50),
   cidade varchar(50),
   estado varchar(50)
) ENGINE=InnoDB;
