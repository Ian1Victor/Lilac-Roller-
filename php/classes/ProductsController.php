<?php
spl_autoload_register(function($className) {
    require_once(__DIR__ . "\\{$className}.php");
});

class ProductsController extends DbConfig{

    public function __construct(){
        parent::__construct();
    }

    public function getProducts() {
        $sql = 'SELECT * FROM produtos';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id) {
        $sql = 'SELECT * FROM produtos WHERE id=:id';
        $stmt = $this->dbh->prepare($sql);
        $stmt ->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewProduct($data){
        $sql = 'INSERT INTO produtos (name, preco, estoque, imagem, categoria, descricao, ficha_tecnica) VALUES (?,?,?,?,?,?,?)';
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value){
            $stmt -> bindValue(($key +1), $value[0], $value[1]);}
        return $stmt->execute();
    }

    public function UpdateProductsData($data, $id) {
        $sql ='UPDATE produtos SET name=?,preco=?,estoque=?,categoria=?,descricao=?,imagem=?, ficha_tecninca=? WHERE id=?';
        $stmt = $this ->dbh->prepare($sql);
        foreach($data as $key => $value){
            $stmt -> bindValue(($key+1), $value[0], $value[1]);
        }
        $stmt -> bindValue((count($data)+1), $id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $sql = <<<SQL
        DELETE FROM produtos WHERE id=:id
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
};