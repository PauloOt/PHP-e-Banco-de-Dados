create database banco;
use banco;

create table usuario( 
id int auto_increment primary key, 
nome varchar(30) not null,
email varchar(40) not null unique,
senha varchar(50) not null
);

select * from usuario;

	