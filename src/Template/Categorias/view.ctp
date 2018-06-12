<?php

/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Categoria $categoria
*/
?>
<div class="row">
  <nav class="col-md-2" id="actions-sidebar">
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
      <li><?= $this->Html->link(__('Listar Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Novo Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?> </li>
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
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($categoria->id) ?></td>
      </tr>
    </table>
    <div class="row">
      <h4><?= __('Anuncios') ?></h4>
      <?php if (!empty($categoria->anuncios)): ?>
        <table cellpadding="0" cellspacing="0" class="table">
          <tr>
            <th scope="col"><?= __('Id') ?></th>
            <th scope="col"><?= __('User Id') ?></th>
            <th scope="col"><?= __('Categoria Id') ?></th>
            <th scope="col"><?= __('Descricao') ?></th>
            <th scope="col"><?= __('Titulo') ?></th>
            <th scope="col"><?= __('Validade') ?></th>
            <th scope="col"><?= __('Created') ?></th>
            <th scope="col"><?= __('Modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
          <?php foreach ($categoria->anuncios as $anuncios): ?>
            <tr>
              <td><?= h($anuncios->id) ?></td>
              <td><?= h($anuncios->user_id) ?></td>
              <td><?= h($anuncios->categoria_id) ?></td>
              <td><?= h($anuncios->descricao) ?></td>
              <td><?= h($anuncios->titulo) ?></td>
              <td><?= h($anuncios->validade) ?></td>
              <td><?= h($anuncios->created) ?></td>
              <td><?= h($anuncios->modified) ?></td>
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
