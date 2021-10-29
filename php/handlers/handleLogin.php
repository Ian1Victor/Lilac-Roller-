<?php
$functionsDir= dirname(__DIR__) . '/functions';
require_once($functionsDir . '/autoload.php');
require_once($functionsDir . '/logError.php');

if ($_SERVER ['REQUEST_METHOD'] ==="POST"){
    
    $email = $_POST['login-input'];
    $pass =  $_POST['senha-input'];
    
    try{
        $users = new UserConfig();
        $result = $users->validateUser($email, $pass);
    }
    catch(PDOException $e){
        logError($e);
    }
    if ($result) {
        session_start();
        setcookie(
            name: session_name(), 
            value: session_id(), 
            domain: $_SERVER['SERVER_NAME'], 
            path: '/',
            // expires_or_options: time() + $monthInSeconds // lifetime
        );
        foreach($result as $k => $v) {
            $_SESSION[$k] = $v;
        }
        header("Location: /");
    } 
    else {
        header("Location: /pages/paginadelogin.php?authError=true");
    }
}
else{
    echo 'Dançou banbino';
}




