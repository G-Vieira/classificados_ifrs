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
    <div class="row">
    <?php  foreach ($anuncios as $anuncio): ?>

      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href="./anuncios/view/<?= $anuncio->id ?>">
            <img src="">
          </a>
          <div class="caption">
            <h3><?= $anuncio->titulo ?></h3>
            <p><?= $anuncio->descricao ?></p>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
    </div>
  </div>
</div>