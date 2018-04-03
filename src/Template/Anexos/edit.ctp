<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anexo $anexo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $anexo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $anexo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Anexos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="anexos form large-9 medium-8 columns content">
    <?= $this->Form->create($anexo) ?>
    <fieldset>
        <legend><?= __('Edit Anexo') ?></legend>
        <?php
            echo $this->Form->control('anuncio_id', ['options' => $anuncios]);
            echo $this->Form->control('caminho');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
