<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anexo $anexo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Anexo'), ['action' => 'edit', $anexo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Anexo'), ['action' => 'delete', $anexo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anexo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Anexos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Anexo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="anexos view large-9 medium-8 columns content">
    <h3><?= h($anexo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Anuncio') ?></th>
            <td><?= $anexo->has('anuncio') ? $this->Html->link($anexo->anuncio->id, ['controller' => 'Anuncios', 'action' => 'view', $anexo->anuncio->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Caminho') ?></th>
            <td><?= h($anexo->caminho) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($anexo->id) ?></td>
        </tr>
    </table>
</div>
