<?php
  
/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Anuncio $anuncio
*/
?>
<!-- PARA REGISTRO DO NOME DO ANUNCIO -->
<div class="row">
  <div class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <?php 
	      if($authUser){
	        echo '<li>' . $this->Html->link(__('Novo Anuncio'), ['action' => 'add']) . '</li>';
	      }
	      if($authUser['role'] == 'admin' || $authUser['id'] == $anuncio->user_id){
	        echo '<li>' . $this->Html->link(__('Editar Anúncio'), ['action' => 'edit', $anuncio->id]) . '</li>';
	        echo '<li>' . $this->Form->postLink(__('Deletar Anúncio'), ['action' => 'delete', $anuncio->id], ['confirm' => __('Deseja deletar # {0}?', $anuncio->id)]) . '</li>';
	      }
      ?>
      <li><?= $this->Html->link(__('Listar Anúncios'), ['action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
    </ul>
  </div>
  <div class="col-md-10">
    <h3 data-id="<?= $anuncio->id ?>">ID: <?= h($anuncio->id) ?></h3>
    <?= $this->Html->image('../files/Anuncios/imagem/' . $anuncio->imagem); ?>
    <table class="table">
      <tr>
        <th scope="row"><?= __('Criado por') ?></th>
        <td><?= $anuncio->has('user') ? $this->Html->link($anuncio->user->username, ['controller' => 'Users', 'action' => 'view', $anuncio->user->id]) : '' ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Categoria') ?></th>
        <td><?= $anuncio->has('categoria') ? $this->Html->link($anuncio->categoria->descricao, ['controller' => 'Categorias', 'action' => 'view', $anuncio->categoria->id]) : '' ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Titulo') ?></th>
        <td id="tracking_anuncio"><?= h($anuncio->titulo) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Preço') ?></th>
        <td><?= $this->Number->format($anuncio->preco) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Validade') ?></th>
        <td><?= h($anuncio->validade) ?></td>
      </tr>
    </table>
    <div class="row">
      <h4><?= __('Descrição') ?></h4>
      <?= $this->Text->autoParagraph(h($anuncio->descricao)); ?>
    </div>
    <br>

    <?php if($authUser): ?>
    <?= $this->Form->create($ncomentario,['url'=>'/comentarios/add/']) ?>
    <fieldset>
      <legend><?= __('Adicionar Comentario') ?></legend>
      <?= $this->Form->control('anuncio_id',['type'=>'hidden','value'=>$anuncio->id]); ?>
      <?= $this->Form->control('user_id',['type'=>'hidden','value'=>$anuncio->user_id]); ?>
      <div class="form-group row">
        <div class="col-md-12">
          <?= $this->Form->control('descricao',['class'=>'form-control']); ?>
        </div>
      </div>
      <div class="form-group row">
        <button class="btn btn-success" type="submit">Gravar</button>
      </div>
    </fieldset>
    <?= $this->Form->end() ?>
    <?php endif; ?>

    <br>
    <div class="row">
      <h4><?= __('Comentários') ?></h4>
      <ul class="list-group">
        <?php if (!empty($anuncio->comentarios)): ?>

          <?php foreach ($anuncio->comentarios as $comentario): ?>
            <li class="list-group-item">
              <?= $this->Form->postLink(__('Usuario: ' . $comentario->user_id), ['controller' => 'users', 'action' => 'view',$comentario->user_id]) ?>
              <br>
              <?= h($comentario->descricao) ?>
              <br><br>
              <?php
              if(($authUser['id'] == $anuncio->user_id) || ($authUser['id'] == $comentario->user_id) || ($authUser['role'] === 'admin')){
                echo $this->Form->postLink(__('Deletar'), ['controller' => 'Comentarios', 'action' => 'delete', $comentario->id], ['confirm' => __('Deseja deletar # {0}?', $comentario->id)]);
              }
              ?>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<script>
  ahoy.configure({page: "pagina_anuncio"});
  ahoy.trackAll();
</script>