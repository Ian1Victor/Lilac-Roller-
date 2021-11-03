<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');

<<<<<<< HEAD
if ($_SERVER ['REQUEST_METHOD'] ==="GET"){
    $location = '/pages/updateProduct.php?';

  try {
=======
if ($_SERVER ['REQUEST_METHOD'] === "GET"){
    $location = '/pages/updateProduct.php?';
    try {
>>>>>>> 68c84fe5cae9994ff072bd583e1f220dcb0d5738
        $users = new ProductsController();
        $result = $users->deleteProduct($_GET['pid']);
    }
    catch (PDOException $e) {
        echo($e);
    }

    if ($result) {
<<<<<<< HEAD
        $location .= 'deleteSucces=true';
=======
        $location .= 'deleteSuccess=true';
>>>>>>> 68c84fe5cae9994ff072bd583e1f220dcb0d5738
    } 
    else {
        $location .= 'deleteFail=true';
    }
    
<<<<<<< HEAD
    header("Location: {$location}");  
    
=======
    header("Location: {$location}");

>>>>>>> 68c84fe5cae9994ff072bd583e1f220dcb0d5738
} else{
    echo "metodo get";
}