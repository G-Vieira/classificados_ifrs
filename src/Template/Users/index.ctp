<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Novo Usuário'), ['action' => 'add']) ?></li>
    </ul>
  </div>
  <div class="col-md-9">
    <h3><?= __('Usuários') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
      <thead>
	<tr>
	  <th scope="col"><?= $this->Paginator->sort('id') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('username') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('email') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('role') ?></th>
	  <th scope="col"><?= $this->Paginator->sort('cidade') ?></th>
	  <th scope="col" class="actions"><?= __('Ações') ?></th>
	</tr>
      </thead>
      <tbody>
            <?php foreach ($users as $user): ?>
	<tr>
	  <td><?= $this->Number->format($user->id) ?></td>
	  <td><?= h($user->username) ?></td>
	  <td><?= h($user->nome) ?></td>
	  <td><?= h($user->email) ?></td>
	  <td><?= h($user->role) ?></td>
	  <td><?= $this->Number->format($user->cidade) ?></td>
	  <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Exluir'), ['action' => 'delete', $user->id], ['confirm' => __('Deseja deletar # {0}?', $user->id)]) ?>
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