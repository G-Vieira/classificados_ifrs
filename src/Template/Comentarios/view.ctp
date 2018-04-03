<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $comentario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comentario'), ['action' => 'edit', $comentario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comentario'), ['action' => 'delete', $comentario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comentario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comentarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comentario'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comentarios view large-9 medium-8 columns content">
    <h3><?= h($comentario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($comentario->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Anuncio Id') ?></th>
            <td><?= $this->Number->format($comentario->anuncio_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($comentario->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($comentario->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($comentario->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Descricao') ?></h4>
        <?= $this->Text->autoParagraph(h($comentario->descricao)); ?>
    </div>
</div>
