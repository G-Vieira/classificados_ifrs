<?php

/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Categoria $categoria
*/
?>
<div class="row" >
  <nav data-section="filtros" class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Actions') ?></li>
      <?php
        if($authUser['role'] == 'admin'){
          echo '<li>' . $this->Html->link(__('Nova Categoria'), ['action' => 'add']) . '</li>';
          echo '<li>' . $this->Html->link(__('Editar Categoria'), ['action' => 'edit', $categoria->id]) . '</li>';
          echo '<li>' . $this->Form->postLink(__('Deletar Categoria'), ['action' => 'delete', $categoria->id], ['confirm' => __('Deseja deletar # {0}?', $categoria->id)]) . '</li>';
        }
      ?>
      <li><?= $this->Html->link(__('Listar Categorias'), ['action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Listar Anúncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Novo Anúncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?> </li>
    </ul>
  </nav>
  <div class="col-md-10">
    <h3><?= h($categoria->id) ?></h3>
    <table class="table">
      <tr>
        <th scope="row"><?= __('Descricao') ?></th>
        <td><?= h($categoria->descricao) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Categoria Pai') ?></th>
        <td><?= $categoria->has('parent_id')? $this->Html->link($categoria->parent_categoria->descricao, ['controller' => 'Categorias', 'action' => 'view', $categoria->parent_categoria->id]): ' ' ?></td>
      </tr>
    </table>
    <div class="row" data-section="filtros">
      <?php if (!empty($categoria->child_categorias)): ?>
        <h4><?= __('Sub-Categorias') ?></h4>
        <table cellpadding="0" cellspacing="0" class="table">
          <tr>
            <th scope="col"><?= __('Descricao') ?></th>
            <th scope="col" class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php foreach ($categoria->child_categorias as $cat): ?>
            <tr>  
              <td><?= h($cat->descricao) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Ver'), ['controller' => 'Categorias', 'action' => 'view', $cat->id]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
    <div class="row" data-section="filtros">
      <?php if (!empty($categoria->anuncios)): ?>
        <h4><?= __('Anúncios') ?></h4>
        <table cellpadding="0" cellspacing="0" class="table">
          <tr>
            <th scope="col"><?= __('Titulo') ?></th>
            <th scope="col"><?= __('Descricao') ?></th>
            <th scope="col" class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php foreach ($categoria->anuncios as $anuncios): ?>
            <tr>  
              <td><?= h($anuncios->titulo) ?></td>
              <td><?= h($anuncios->descricao) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Ver'), ['controller' => 'Anuncios', 'action' => 'view', $anuncios->id]) ?>
            
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>
