<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorito[]|\Cake\Collection\CollectionInterface $favoritos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Favorito'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="favoritos index large-9 medium-8 columns content">
    <h3><?= __('Favoritos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categoria_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($favoritos as $favorito): ?>
            <tr>
                <td><?= $favorito->has('user') ? $this->Html->link($favorito->user->id, ['controller' => 'Users', 'action' => 'view', $favorito->user->id]) : '' ?></td>
                <td><?= $favorito->has('categoria') ? $this->Html->link($favorito->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $favorito->categoria->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $favorito->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $favorito->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $favorito->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $favorito->user_id)]) ?>
                </td>
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
