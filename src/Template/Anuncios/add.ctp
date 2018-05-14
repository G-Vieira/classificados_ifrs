<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anuncio $anuncio
 */
 
?>
<div class="row">
  <nav class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Listar Anuncios'), ['action' => 'index']) ?></li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
    </ul>
  </nav>
  <div class="col-md-9 text-center">
    <?= $this->Form->create($anuncio) ?>
    <fieldset>
      <legend><?= __('Editar Anuncio') ?></legend>
      <div class="form-group row">
        <label for="user_id" class="col-sm-3 col-form-label"><b>Usuario</b></label>
        <div class="col-sm-7">
	  <?= $this->Form->control('user_id',['options' => $users,'label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="categoria_id" class="col-sm-3 col-form-label"><b>Categoria</b></label>
        <div class="col-sm-7">
	  <?= $this->Form->control('categoria_id',['options' => $categorias,'label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="titulo" class="col-sm-3 col-form-label"><b>Titulo</b></label>
        <div class="col-sm-7">
	  <?= $this->Form->control('titulo',['label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="descricao" class="col-sm-3 col-form-label"><b>Descrição</b></label>
        <div class="col-sm-7">
	  <?= $this->Form->control('descricao',['label'=>false,'class'=>'form-control']) ?>
        </div>
      </div>
      <div class="form-group row">
        <label for="preco" class="col-sm-3 col-form-label"><b>Preço</b></label>
        <div class="col-sm-7">
	  <?= $this->Form->control('preco',['label'=>false,'class'=>'form-control','type'=>'number']) ?>
        </div>
      </div>
        <?php
	    $data = ((new DateTime(date('Y-m-d H:i:s')))->modify('+1 month'))->format('Y-m-d');
            echo '<input type="date" name="validade" value = "' . $data , '" style="display:none;" required />';
        ?>
    </fieldset>
    <div class="form-group row">
      <button class="btn btn-success" type='submit'>gravar</button>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>