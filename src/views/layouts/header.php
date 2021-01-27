<?php use App\WebStore\Classes\Store;?>
<div class="container-fluid h-nav">
  <div class="row align-items-center pt-3 pb-3">
      <div class="col-6 d-flex align-items-center">
        <a href="/"><h3><?= APP_NAME ?></h3></a>
      </div>
      <div class="col-6 text-end">
        <a href="?a=home">Home</a>
        <a href="?a=store">Loja</a>
          <?php if (Store::ClienteLogado()): ?>
            <a href="#">Sair</a>
          <?php else: ?>
            <a href="?a=">Login</a>
            <a href="#">Cadastrar</a>
          <?php endif; ?>
        <a href="#"><i class="fas fa-shopping-cart"></i>
          <span class="badge bg-warning">10</span>
        </a>
      </div>
  </div>
</div>