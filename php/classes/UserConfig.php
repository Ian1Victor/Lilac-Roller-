<?php
spl_autoload_register(function($className) {
    require_once(__DIR__ . "\\{$className}.php");
});

class UserConfig extends DbConfig{

    public function __construct(){
        parent::__construct();
    }

    public function getAllUserData($email) {
        $sql = 'SELECT * FROM usuarios WHERE email=:email';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewUser($data){
        $sql = 'INSERT INTO usuarios (nome, sobrenome, cpf, endereco, cidade ,estado, cep, genero, email, telefone, nomesocial, password, tipopessoa ) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
        
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(($key+1), $value[0], $value[1]); 
        }
        return $stmt->execute();
    }
    public function validateUser($email, $password){
        $sql = 'SELECT nome, sobrenome, password, status FROM usuarios WHERE email = ?';
        $stmt = $this->dbh->prepare($sql);
        $stmt -> bindValue(1, $email, PDO::PARAM_STR);
        $stmt -> execute(); // transação com banco de dados ultimas 4 linhas
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $storedpassword = $data['password'];
        if (password_verify($password, $storedpassword)) {
            return [
                'userFullName' => ucwords($data['nome']) . ' ' . ucwords($data['sobrenome']),
                'userEmail' => $email,
                'userStatus' => $data['status']
            ];

        }
        else{
            return false;
        }
    }
   
    public function UpdateUserData($data, $email) {
        $sql ='UPDATE usuarios SET nome=?, sobrenome=?, cpf=?, endereco=?, cidade=?, estado=?, cep=?,
        genero=?, email=?, telefone=?, nomesocial=?, password=IFNULL(?, password), tipopessoa=?, status=IFNULL(?, password) 
        WHERE email=?';
        $stmt = $this ->dbh->prepare($sql);
        foreach($data as $key => $value){
            $stmt -> bindValue(($key+1), $value[0], $value[1]);
        }
        $stmt -> bindValue((count($data)+1), $email, PDO::PARAM_STR);
        return $stmt->execute();
    }
};