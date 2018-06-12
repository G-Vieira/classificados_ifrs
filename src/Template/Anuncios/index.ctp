<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anuncio[]|\Cake\Collection\CollectionInterface $anuncios
 */
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Novo Anuncio'), ['action' => 'add']) ?></li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
    </ul>
  </div>
  <div class="col-md-9">
    <h3><?= __('Anuncios') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
      <thead>
        <tr>
          <th scope="col"><?= $this->Paginator->sort('id') ?></th>
          <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
          <th scope="col"><?= $this->Paginator->sort('categoria_id') ?></th>
          <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
          <th scope="col"><?= $this->Paginator->sort('validade') ?></th>
          <th scope="col"><?= $this->Paginator->sort('created') ?></th>
          <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
          <th scope="col" class="actions"><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody>
            <?php foreach ($anuncios as $anuncio): ?>
        <tr>
          <td><?= $this->Number->format($anuncio->id) ?></td>
          <td><?= $anuncio->has('user') ? $this->Html->link($anuncio->user->id, ['controller' => 'Users', 'action' => 'view', $anuncio->user->id]) : '' ?></td>
          <td><?= $anuncio->has('categoria') ? $this->Html->link($anuncio->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $anuncio->categoria->id]) : '' ?></td>
          <td><?= h($anuncio->titulo) ?></td>
          <td><?= h($anuncio->validade) ?></td>
          <td><?= h($anuncio->created) ?></td>
          <td><?= h($anuncio->modified) ?></td>
          <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $anuncio->id]) ?>
                  <?php
                    if($authUser['role'] == 'admin' || $authUser['id'] == $anuncio->user_id){
                       echo $this->Html->link(__('Editar'), ['action' => 'edit', $anuncio->id]);
                       echo $this->Form->postLink(__('Deletar'), ['action' => 'delete', $anuncio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anuncio->id)]);
                    }
                  ?>
          </td>
        </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
    <div class="paginator">
      <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('amterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próximo') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
      </ul>
      <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registros(s) de {{count}}')]) ?></p>
    </div>
  </div>
</div>