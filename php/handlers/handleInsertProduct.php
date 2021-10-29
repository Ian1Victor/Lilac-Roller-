<?php
require_once('../functions/classesAutoload.php');
require_once('../functions/logError.php');

function makePath($separator=DIRECTORY_SEPARATOR, ...$segments) {
    return implode($separator, $segments);
}

if ($_SERVER ['REQUEST_METHOD'] ==="POST"){

    $root = dirname(dirname(__DIR__));
    $relativePath = realpath($root . '/img_catalogo');
    $fileName = $_FILES['imagem-input']['name'];
    $imgDestination = $relativePath . '\\' . $fileName;
    move_uploaded_file($_FILES['imagem-input']['tmp_name'], $imgDestination);
    $resourcePath = realpath($relativePath . "/{$fileName}");

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
        $data = $users->insertNewProduct($data);
        header("Location: /pages/newProduct.php");  
    }
    catch (PDOException $e) {
        echo($e);
    }

} else{
    echo "metodo get";
}