<?php
$functionsDir = dirname(__DIR__) . '/functions';
require_once($functionsDir . '/classesAutoload.php');
require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/logError.php');

function makePath($separator, ...$segments) {
    return implode($separator, $segments);
}

function getResourcePath() {
    $imageExists = boolval($_FILES['imagem-input']['name']);
    if (!$imageExists) {
        return NULL;
    }
    $root = dirname(dirname(__DIR__));
    $relativePath = 'img_catalogo';
    $fileName = $_FILES['imagem-input']['name'];
    $imgDestination = makePath(DIRECTORY_SEPARATOR, $root, $relativePath, $fileName);
    move_uploaded_file($_FILES['imagem-input']['tmp_name'], $imgDestination);
    return '/' . makePath('/', $relativePath, $fileName);
}

if ($_SERVER ['REQUEST_METHOD'] ==="POST"){
    $location = '/pages/updateProduct.php?';
    $resourcePath = getResourcePath();
    $data = array (
        [$_POST['nome-input'], PDO::PARAM_STR],
        [$_POST['preco-input'],  PDO::PARAM_STR],
        [$_POST['estoque-input'],  PDO::PARAM_INT],
        [$resourcePath,  PDO::PARAM_STR],
        [$_POST['categoria-input'],  PDO::PARAM_STR],
        [$_POST['descricao-input'],  PDO::PARAM_STR],
        [$_POST['fichaTecnica-input'],  PDO::PARAM_STR],
    );

    try {
        $users = new ProductsController();
        $result = $users->UpdateProductsData($data, $_GET['pid']);
    }
    catch (PDOException $e) {
        logError($e);
    }

    $location .= $result ? 'updateSuccess=true' : 'updateFail=true';
    header("Location: {$location}");
}
  else{
    echo "metodo get";
}





    
    
 
 
   







