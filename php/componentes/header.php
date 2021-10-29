<header>

    <div class="logo">
      <a class="logo-name" href="../../index.php">LILAC ROLLER</a>
    </div>

    <div class="space-menu"></div>

    <div class="search-box">
      <input class="search-txt"type="text"placeholder="Sua barra de pesquisa favorita"/>
      <a class="search-btn" href="#">
        <i class="fas fa-search"></i>
      </a>
    </div>

    <?php if (session_id()): ?>
        <div class="acc-text">
          <div class="dropdown">
              <a class="user_acc" href="#"> Olá, <?php echo $_SESSION['userFullName']; ?> </a>
              <div class="dropdown-content">
                <a href="../../pages/myAccount.php">Minha Conta</a>
                <a href="../../pages/updateProduct.php">Editar Produto</a>
                <a href="../../pages/newProduct.php">Novo Produto</a>
                <a href="../../php/handlers/signout.php">Sair</a>
              </div>
            </div>  
            <a class="user_acc" href="../../pages/carrinho.php"> Carrinho</a>
        </div>
    <?php else: ?>

        <div class="acc-text">
          <a class="user_acc" href="../../pages/paginadelogin.php">Login</a>
        </div>

    <?php endif;?>    
  </header>