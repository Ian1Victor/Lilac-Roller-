<?php
$functionsDir= dirname(__DIR__) . '/php/functions';

require_once($functionsDir . '/startSession.php');
require_once($functionsDir . '/autoload.php');
require_once($functionsDir . '/genericas.php');

$baseURL = getBaseURL();
$products = new ProductsController();
$data = $products->getProducts();
$teste = $data[0];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" />
  <link rel="stylesheet" type="text/css" href="../css/updateProducts.css" />
  <link rel="icon" type="image/x-icon" href="../pics/lilac-icon.png">

  <title>Lilac Roller</title>
  
</head>

<body>
  <!-- Inicio do header-->
  <?php require_once("../php/componentes/header.php"); ?>
  <!--fim do header-->  
    

  <!-- Barra de menus inicio-->
    <?php require_once("../php/componentes/navbar.php"); ?>
  <!-- Barra de menus fim-->
    
  <!-- Pagina principal começo-->
  <main>
    <!--main container inicio-->
    <div class="container-master">
      <?php foreach($data as $product):; ?> 
        <div id="caixa-items" class="caixa-update"><!--Caixa para os items-->
          <div class="items-container container-update">
          <img class="img-update" src="<?php echo($baseURL . $product['imagem']); ?>">
            <div class="flexboxteste">
              <h4 class="item-title update-item-title"><?php echo $product['name']; ?></h4>
              <h3 class="item-title update-item-title">R$ <?php echo formatToBRL($product['preco']); ?></h3>
              <p><?php echo $product['descricao'];?></p>
            </div>
            <div class="btn-adm">
              <button class="btn-edit btn btn-primary btn-grad">
                <img src="../pics/editicon.png" class="btn-icon">
                <span>Editar</span>
              </button>
              <button class="btn-delet btn btn-primary">
                <img src="../pics/deleteicon.png" class="btn-icon">
                <a href="../php/handlers/handleDeleteProduct.php?pid=<?php echo $product['id']; ?>">Excluir</a>
              </button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <!--Caixa para os items fim-->   
      
    </div><!--main container final-->
  </main>
    
  <?php require_once('../php/componentes/footer.php')?>

  <script type="text/javascript">
  function redirect2() {
    document.getElementById("cadastro2").innerHTML = "Cadastrado";
  }
  </script>
  <script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </body>
</html>
