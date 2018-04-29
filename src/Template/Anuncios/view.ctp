<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anuncio $anuncio
 */
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Editar Anuncio'), ['action' => 'edit', $anuncio->id]) ?> </li>
      <li><?= $this->Form->postLink(__('Deletar Anuncio'), ['action' => 'delete', $anuncio->id], ['confirm' => __('Deseja deletar # {0}?', $anuncio->id)]) ?> </li>
      <li><?= $this->Html->link(__('Listar Anuncios'), ['action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Novo Anuncio'), ['action' => 'add']) ?> </li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Listar Anexos'), ['controller' => 'Anexos', 'action' => 'index', $anuncio->id]) ?> </li>
      <li><?= $this->Html->link(__('Novo Anexo'), ['controller' => 'Anexos', 'action' => 'add',$anuncio->id]) ?> </li>
      <li><?= $this->Html->link(__('Listar Comentarios'), ['controller' => 'Comentarios', 'action' => 'index',$anuncio->id]) ?> </li>
      <li><?= $this->Html->link(__('Novo Comentario'), ['controller' => 'Comentarios', 'action' => 'add',$anuncio->id]) ?> </li>
    </ul>
  </div>
  <div class="col-md-9">
    <h3><?= h($anuncio->id) ?></h3>
    <table class="table">
      <tr>
        <th scope="row"><?= __('User') ?></th>
        <td><?= $anuncio->has('user') ? $this->Html->link($anuncio->user->id, ['controller' => 'Users', 'action' => 'view', $anuncio->user->id]) : '' ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Categoria') ?></th>
        <td><?= $anuncio->has('categoria') ? $this->Html->link($anuncio->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $anuncio->categoria->id]) : '' ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Titulo') ?></th>
        <td><?= h($anuncio->titulo) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($anuncio->id) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Validade') ?></th>
        <td><?= h($anuncio->validade) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($anuncio->created) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($anuncio->modified) ?></td>
      </tr>
    </table>
    <div class="row">
      <h4><?= __('Descricao') ?></h4>
        <?= $this->Text->autoParagraph(h($anuncio->descricao)); ?>
    </div>
    <div class="related">
      <h4><?= __('Anexos') ?></h4>
        <?php if (!empty($anuncio->anexos)): ?>
      <table cellpadding="0" cellspacing="0">
        <tr>
          <th scope="col"><?= __('Id') ?></th>
          <th scope="col"><?= __('Anuncio Id') ?></th>
          <th scope="col"><?= __('Caminho') ?></th>
          <th scope="col" class="actions"><?= __('Ações') ?></th>
        </tr>
            <?php foreach ($anuncio->anexos as $anexos): ?>
        <tr>
          <td><?= h($anexos->id) ?></td>
          <td><?= h($anexos->anuncio_id) ?></td>
          <td><?= h($anexos->caminho) ?></td>
          <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Anexos', 'action' => 'view', $anexos->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Anexos', 'action' => 'edit', $anexos->id]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Anexos', 'action' => 'delete', $anexos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anexos->id)]) ?>
          </td>
        </tr>
            <?php endforeach; ?>
      </table>
        <?php endif; ?>
    </div>
    <div class="related">
      <h4><?= __('Comentarios') ?></h4>
        <?php if (!empty($anuncio->comentarios)): ?>
      <table cellpadding="0" cellspacing="0" class="table">
        <tr>
          <th scope="col"><?= __('Id') ?></th>
          <th scope="col"><?= __('Anuncio Id') ?></th>
          <th scope="col"><?= __('User Id') ?></th>
          <th scope="col"><?= __('Descricao') ?></th>
          <th scope="col"><?= __('Created') ?></th>
          <th scope="col"><?= __('Modified') ?></th>
          <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
            <?php foreach ($anuncio->comentarios as $comentarios): ?>
        <tr>
          <td><?= h($comentarios->id) ?></td>
          <td><?= h($comentarios->anuncio_id) ?></td>
          <td><?= h($comentarios->user_id) ?></td>
          <td><?= h($comentarios->descricao) ?></td>
          <td><?= h($comentarios->created) ?></td>
          <td><?= h($comentarios->modified) ?></td>
          <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Comentarios', 'action' => 'view', $comentarios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Comentarios', 'action' => 'edit', $comentarios->id]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Comentarios', 'action' => 'delete', $comentarios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comentarios->id)]) ?>
          </td>
        </tr>
            <?php endforeach; ?>
      </table>
        <?php endif; ?>
    </div>
  </div>
</div>