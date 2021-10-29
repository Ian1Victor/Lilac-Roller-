<?php
require_once(dirname(__DIR__) . '/functions/classesAutoload.php');
require_once(dirname(__DIR__) . '/functions/autoload.php');
$monthInSeconds = 30*24*60*60;
if ($_SERVER ['REQUEST_METHOD'] ==="POST"){
    try {
        $users = new UserConfig();
        $userPassword = $users->getAllUserData($_SESSION['userEmail'])['password'];
    }
    catch (PDOException $e) {
        echo($e);
    }
    $password =  $_POST['senha-input'] ? password_hash($_POST['senha-input'], PASSWORD_DEFAULT) : $userPassword;
    $data = array (
        [$_POST['nome-input'], PDO::PARAM_STR],
        [$_POST['sobrenome-input'],  PDO::PARAM_STR],
        [$_POST['cpf-input'],  PDO::PARAM_STR],
        [$_POST['endereco-input'],  PDO::PARAM_STR],
        [$_POST['cidade-input'],  PDO::PARAM_STR],
        [$_POST['estado-input'],  PDO::PARAM_STR],
        [$_POST['cep-input'],  PDO::PARAM_STR],
        [$_POST['genero-input'],  PDO::PARAM_STR],
        [$_POST['email-input'],  PDO::PARAM_STR],
        [$_POST['telefone-input'],  PDO::PARAM_STR],
        [$_POST['social-input'],  PDO::PARAM_STR],
        [$password, PDO::PARAM_STR],
        [$_POST['tipo-input'] ,  PDO::PARAM_STR]

    );
}else{
    echo "metodo get";
}