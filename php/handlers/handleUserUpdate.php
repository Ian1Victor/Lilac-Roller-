<?php
$functionsDir = dirname(__DIR__) . '/functions';
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/logError.php');
if ($_SERVER ['REQUEST_METHOD'] ==="POST"){

    $status = $_POST['status-input'] ? $_POST['status-input'] : NULL;
    $password = $_POST['senha-input'] ? password_hash($_POST['senha-input'], PASSWORD_DEFAULT) : NULL;
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
        [$status, PDO::PARAM_STR]
    );

    try{
        $users = new UserConfig();
        if (isset($_GET['usr'])) {
            $result = $users->UpdateUserData($data, $_GET['usr']);
        }
        else {
            $result = $users->UpdateUserData($data, $_SESSION['userEmail']);
            $_SESSION['userEmail'] = $_POST['email-input'];
            $_SESSION['userFullName'] = ucwords($_POST['nome-input']) . ' ' . ucwords($_POST['sobrenome-input']);
        }
        header("Location: /pages/myAccount.php?updateSuccess=true");
    }
    catch(PDOException $e){
        logError($e);
        header("Location: /");
        
    }
}
  else{
    echo "metodo get";
}





    
    
 
 
   







