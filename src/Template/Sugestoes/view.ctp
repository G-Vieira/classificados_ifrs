<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sugesto $sugesto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sugesto'), ['action' => 'edit', $sugesto->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sugesto'), ['action' => 'delete', $sugesto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sugesto->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sugestoes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sugesto'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sugestoes view large-9 medium-8 columns content">
    <h3><?= h($sugesto->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $sugesto->has('user') ? $this->Html->link($sugesto->user->id, ['controller' => 'Users', 'action' => 'view', $sugesto->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($sugesto->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comentario') ?></h4>
        <?= $this->Text->autoParagraph(h($sugesto->comentario)); ?>
    </div>
</div>
