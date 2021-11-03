<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');

if ($_SERVER ['REQUEST_METHOD'] ==="GET"){
    $location = '/pages/updateProduct.php?';
    try {
        $users = new ProductsController();
        $result = $users->deleteProduct($_GET['pid']);
    }
    catch (PDOException $e) {
        logError($e);
    }

    if ($result) {
        $location .= 'deleteSuccess=true';
    } 
    else {
        $location .= 'deleteFail=true';
    }
    
    header("Location: {$location}");

} else{
    echo "metodo get";
}