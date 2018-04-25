<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria[]|\Cake\Collection\CollectionInterface $categorias
 */
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Nova Categoria'), ['action' => 'add']) ?></li>
      <li><?= $this->Html->link(__('Listar Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?></li>
    </ul>
  </div>
  <div class="col-md-9">
    <h3><?= __('Categorias') ?></h3>
    <table cellpadding="0" class="table" cellspacing="0">
      <thead>
	<tr>
	  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('descricao') ?></th>
	  <th scope="col" class="actions"><?= __('Ações') ?></th>
	</tr>
      </thead>
      <tbody>
            <?php foreach ($categorias as $categoria): ?>
	<tr>
	  <td><?= $this->Number->format($categoria->id) ?></td>
	  <td><?= h($categoria->descricao) ?></td>
	  <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $categoria->id]) ?>
                    <?php
		     echo $this->Html->link(__('Editar'), ['action' => 'edit', $categoria->id]);
                     echo $this->Form->postLink(__('Deletar'), ['action' => 'delete', $categoria->id], ['confirm' => __('Deseja deletar # {0}?', $categoria->id)]);
		    ?>
	  </td>
	</tr>
            <?php endforeach; ?>
      </tbody>
    </table>
    <div class="paginator">
      <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próximo') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
      </ul>
      <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registros(s) de {{count}}')]) ?></p>
    </div>
  </div>
</div>