<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anexo $anexo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Ações') ?></li>
	<li><?= $this->Html->link(__('Ver Anuncio'), ['controller' => 'Anuncios', 'action' => 'view',$anuncio->id]) ?></li>
        <li><?= $this->Html->link(__('Listar Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Novo Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="anexos form large-9 medium-8 columns content">
    <?= $this->Form->create($anexo) ?>
    <fieldset>
        <legend><?= __('Add Anexo') ?></legend>
        <?php
            echo $this->Form->control('anuncio_id', ['options' => [$anuncio->id => $anuncio->titulo]]);
            echo $this->Form->control('caminho');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
