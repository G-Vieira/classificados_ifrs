<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria $categoria
 */

 
$array_categorias = [];
$array_categorias[null] = ' ';
foreach($categorias as $cat){
  $array_categorias[$cat->id] = $cat->descricao;
}
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Actions') ?></li>
      <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $categoria->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $categoria->id)]
            )
        ?></li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['action' => 'index']) ?></li>
    </ul>
    <ul data-section="section" class="nav nav-pills nav-stacked">
      <li class="heading"><b><?= __('Filtros Por:') ?></b></li>
      <li><?= __('Anúncios') ?></li>
      <li><?= $this->Html->link(__('Últimos adicionados'), ['controller' => 'anuncios','action' => 'ultimos']) ?></li>
      <li><?= $this->Html->link(__('Mais procurados'), ['controller' => 'anuncios','action' => 'procurados']) ?></li>
    </ul>
  </div>
  <div class="col-md-9 text-center">
    <?= $this->Form->create($categoria) ?>
    <fieldset>
      <legend><?= __('Editar Categoria') ?></legend>

      <div class="form-group row">
        <label for="descricao" class="col-sm-3 col-form-label"><b>Descrição</b></label>
        <div class="col-sm-7">
          <?= $this->Form->control('descricao',['label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="parent_id" class="col-sm-3 col-form-label"><b>Categoria Pai</b></label>
        <div class="col-sm-7">
          <?= $this->Form->control('parent_id',['options' => $array_categorias,'label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
      	<button class="btn btn-success" type='submit'>Gravar</button>
      </div>
    </fieldset>
    <?= $this->Form->end() ?>
  </div>
</div>