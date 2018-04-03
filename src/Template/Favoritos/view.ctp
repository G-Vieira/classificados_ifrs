<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Favorito $favorito
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Favorito'), ['action' => 'edit', $favorito->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Favorito'), ['action' => 'delete', $favorito->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $favorito->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Favoritos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Favorito'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="favoritos view large-9 medium-8 columns content">
    <h3><?= h($favorito->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $favorito->has('user') ? $this->Html->link($favorito->user->id, ['controller' => 'Users', 'action' => 'view', $favorito->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Categoria') ?></th>
            <td><?= $favorito->has('categoria') ? $this->Html->link($favorito->categoria->id, ['controller' => 'Categorias', 'action' => 'view', $favorito->categoria->id]) : '' ?></td>
        </tr>
    </table>
</div>
