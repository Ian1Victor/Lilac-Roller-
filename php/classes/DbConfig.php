<?php
class DbConfig{
    protected $dbh;

    protected function __construct(){
        $this->dbh = new PDO('mysql:host=localhost;dbname=lilac','root','');
        $this->createUsersTable();
    }

    private function createUsersTable(){
        $this-> dbh->exec( 'CREATE TABLE IF NOT EXISTS usuarios(
            nome varchar(255),
            sobrenome varchar(50),
            cpf varchar(11),
            endereco varchar(50),
            cidade varchar(30),
            estado varchar(20),
            cep varchar(9),
            genero varchar(13),
            email varchar(20) PRIMARY KEY,
            telefone varchar(13),
            nomesocial varchar(255),
            password varchar(255),
            tipopessoa varchar(30),
            status varchar(7) NOT NULL DEFAULT "user"
        )');
    }

    private function createProductsTable(){
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS produtos(
            id int primary key auto_increment,
            name varchar(255) NOT NULL,
            preco decimal(10,2) NOT NULL,
            estoque int UNSIGNED NOT NULL,
            imagem varchar(255) NOT NULL,
            categoria varchar(100) NOT NULL,
            descricao text(65000) NOT NULL DEFAULT "Sem Descrição...",
            ficha_tecnica text(65000) NOT NULL DEFAULT "Sem Ficha Técnica..."
            )');
    }

    private function createShoppingcartTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS shoppingcart(
            product_id INT UNSIGNED NOT NULL,
            user_email VARCHAR(255) NOT NULL,
            FOREIGN KEY(product_id) REFERENCES Products(id),
            FOREIGN KEY (user_email) REFERENCES Users(email)
            )');
    }
}