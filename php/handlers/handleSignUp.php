<?php
$functionsDir = dirname(__DIR__) . '/functions';
require_once($functionsDir . '/classesAutoload.php');
$monthInSeconds = 30*24*60*60;

if ($_SERVER ['REQUEST_METHOD'] ==="POST"){
    $status = $_POST['status-input'] ? $_POST['senha-input'] : 'user';
    $password = password_hash($_POST['senha-input'], PASSWORD_DEFAULT);
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
        [$_POST['tipo-input'] ,  PDO::PARAM_STR],
        [$_POST['status-input'] ,  PDO::PARAM_STR]
    );
    
    try {
        $users = new UserConfig();
        $result = $users->insertNewUser($data);
    }
    catch (PDOException $e) {
        echo($e);
    }

    if ($result) {
        session_start();
        setcookie(
            name: session_name(), 
            value: session_id(), 
            domain: $_SERVER['SERVER_NAME'], 
            path: '/',
                // expires_or_options: time() + $monthInSeconds
            );
        $_SESSION['userEmail'] = $_POST['email-input'];
        $_SESSION['userFullName'] = ucwords($_POST['nome-input']) . ' ' . ucwords($_POST['sobrenome-input']);
        $_SESSION['userStatus'] = $status;
        header('Location: /');
    }
    else {
        echo 'fui executado';
    }
} else{
    echo "metodo get";
}





    
    
 
 
   







