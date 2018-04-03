<?php

$this->layout = true;
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Actions') ?></li>
    <li><?= $this->Html->link(__('New Anuncio'), ['action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('List Anexos'), ['controller' => 'Anexos', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New Anexo'), ['controller' => 'Anexos', 'action' => 'add']) ?></li>
    <li><?= $this->Html->link(__('List Comentarios'), ['controller' => 'Comentarios', 'action' => 'index']) ?></li>
    <li><?= $this->Html->link(__('New Comentario'), ['controller' => 'Comentarios', 'action' => 'add']) ?></li>
  </ul>
</nav>
<div class="anuncios index large-9 medium-8 columns content">
  <h3><?= __('Anuncios') ?></h3>
  <table cellpadding="0" cellspacing="0">
    <thead>
      <tr>
        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('categoria_id') ?></th>
        <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
        <th scope="col"><?= $this->Paginator->sort('validade') ?></th>
        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
        <th scope="col" class="actions"><?= __('Actions') ?></th>
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
                <?php
                if($authUser['role'] == 'admin'){
                  ?>
        }
        <td class="actions">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $anuncio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anuncio->id)]) ?>
        </td>
                <?php
                }
                
                ?>
      </tr>
            <?php endforeach; ?>
    </tbody>
  </table>
  <div class="paginator">
    <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
  </div>
</div>