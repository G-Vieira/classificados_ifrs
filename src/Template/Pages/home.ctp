  <div data-section="filtros" class="col-sm-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><b><?= __('Filtros Por:') ?></b></li>
      <li><?= __('Categorias') ?></li>
      <?php foreach ($categorias as $categoria): ?>
        <li><?= $this->Html->link(__($categoria->descricao), ['controller' => 'categorias','action' => 'view',$categoria->id],['data-id'=>$categoria->id]) ?></li>
      <?php endforeach; ?>
      <li><?= __('Anúncios') ?></li>
      <li><?= $this->Html->link(__('Últimos adicionados'), ['controller' => 'anuncios','action' => 'ultimos']) ?></li>
      <li><?= $this->Html->link(__('Mais procurados'), ['controller' => 'anuncios','action' => 'procurados']) ?></li>
    </ul>
  </div>
  <div class="col-md-9">
    <?php if($favoritos != null): ?>
      <div class="row">
        <?php  foreach ($favoritos as $favorito): ?>
  
          <div class="col-sm-6 col-md-4">
            <div>
              <h3><?= $favorito->titulo ?></h3>
  	             <a data-id="<?= $favorito->id ?>" href="./anuncios/view/<?= $favorito->id ?>" class="thumbnail">
                 <?= $this->Html->image('../files/Anuncios/imagem/' . $favorito->imagem, ['class' => 'img_anuncio_home']); ?>
              </a>
            </div>
          </div>
  
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
      <div class="row">
          <?php if(!$anuncios->isEmpty()): ?>
          <h3>Anúncios mais procurados</h3>
          <hr>
          <div id="carousel_anuncios" data-section="carrossel" class="carousel slide" data-ride="carousel">
         
            <!--
            <ol class="carousel-indicators">
              <li data-target="#carousel_anuncios" data-slide-to="0"></li>
              <li data-target="#carousel_anuncios" data-slide-to="1"></li>
              <li data-target="#carousel_anuncios" data-slide-to="2"></li>
            </ol>-->

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <?php  foreach ($anuncios as $key => $anuncio): ?>
              <div class="item <?= ($key == 0)? 'active':' ' ?>">
                  <div class="carousel-caption">
                    <h2><?= $anuncio->titulo ?></h2>
                  </div>
                <?= $this->Html->link(
                  $this->Html->image('../files/Anuncios/imagem/' . $anuncio->imagem,['alt' => $anuncio->titulo,'data-id' => $anuncio->id,'class' => 'anuncio_carrossel']),
                  [
                    'controller' => 'anuncios', 
                    'action' => 'view',
                    $anuncio->id
                  ], ['escape' => false, 'id' => 'car_' . $anuncio->id]); 
                ?>
                  
              </div>
              <?php endforeach; ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#carousel_anuncios" data-slide="prev">
              <span class="icon-prev" aria-hidden="true"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="right carousel-control" href="#carousel_anuncios" data-slide="next">
              <span class="icon-next" aria-hidden="true"></span>
              <span class="sr-only">Próximo</span>
            </a>
          </div>
          <?php else: ?>
            <div>
              <h3>Não existem anúncios ainda!</h3>
            </div>
          <?php endif; ?>
        
      </div>
  </div>
