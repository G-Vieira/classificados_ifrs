<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anexo[]|\Cake\Collection\CollectionInterface $anexos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Anexo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="anexos index large-9 medium-8 columns content">
    <h3><?= __('Anexos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('anuncio_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('caminho') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anexos as $anexo): ?>
            <tr>
                <td><?= $this->Number->format($anexo->id) ?></td>
                <td><?= $anexo->has('anuncio') ? $this->Html->link($anexo->anuncio->id, ['controller' => 'Anuncios', 'action' => 'view', $anexo->anuncio->id]) : '' ?></td>
                <td><?= h($anexo->caminho) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $anexo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $anexo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $anexo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anexo->id)]) ?>
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
