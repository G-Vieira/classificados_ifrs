<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cidade $cidade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cidade'), ['action' => 'edit', $cidade->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cidade'), ['action' => 'delete', $cidade->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cidade->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cidades'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cidade'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cidades view large-9 medium-8 columns content">
    <h3><?= h($cidade->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($cidade->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uf') ?></th>
            <td><?= h($cidade->uf) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cidade->id) ?></td>
        </tr>
    </table>
</div>
