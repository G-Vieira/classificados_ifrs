<div class="row">
  <div class="col-sm-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Categorias') ?></li>
      <?php foreach ($categorias as $categoria): ?>
        <li><?= $this->Html->link(__($categoria->descricao), ['controller' => 'categorias','action' => 'view',$categoria->id]) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="col-md-9">
  <?php 
    if($favoritos != null){
  ?>
    <div class="row">
      <?php  foreach ($favoritos as $favorito): ?>

        <div class="col-sm-6 col-md-4">
          <div>
            <h3><?= $favorito->titulo ?></h3>
	    <a href="./anuncios/view/<?= $favorito->id ?>" class="thumbnail">
              <img class="img_anuncio_home" src="webroot/files/Anuncios/imagem/<?= $favorito->imagem ?>">
            </a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  <?php
    }
  ?>
  <hr>
    <div class="row">
      <?php  foreach ($anuncios as $anuncio): ?>

        <div class="col-sm-6 col-md-4">
          <div>
            <h3><?= $anuncio->titulo ?></h3>
	    <a href="./anuncios/view/<?= $anuncio->id ?>" class="thumbnail">
              <img class="img_anuncio_home" src="webroot/files/Anuncios/imagem/<?= $anuncio->imagem ?>">
            </a>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
</div>