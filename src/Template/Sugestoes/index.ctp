<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sugesto[]|\Cake\Collection\CollectionInterface $sugestoes
 */
?>
<div class = "row">
    <div class="col-md-3" id="actions-sidebar">
      <ul class="nav nav-pills nav-stacked">
        <li class="heading"><?= __('Ações') ?></li>
        <li><?= $this->Html->link(__('Nova Sugestão'), ['action' => 'add']) ?></li>
        </li>
      </ul>
    </div>
    <div class="col-md-9">
        <h3><?= __('Sugestoes') ?></h3>
        <table cellpadding="0" class="table" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sugestoes as $sugesto): ?>
                    <tr>
                        <td><?= $sugesto->has('user') ? $this->Html->link($sugesto->user->id, ['controller' => 'Users', 'action' => 'view', $sugesto->user->id]) : '' ?></td>
                        <td><?= $this->Number->format($sugesto->id) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $sugesto->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sugesto->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sugesto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sugesto->id)]) ?>
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
            <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} comentários(s) de {{count}} total')]) ?></p>
        </div>
    </div>
</div>
