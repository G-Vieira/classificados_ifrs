<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anuncio $anuncio
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Ações') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $anuncio->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $anuncio->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Anuncios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Categoria'), ['controller' => 'Categorias', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Anexos'), ['controller' => 'Anexos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Anexo'), ['controller' => 'Anexos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comentarios'), ['controller' => 'Comentarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comentario'), ['controller' => 'Comentarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="anuncios form large-9 medium-8 columns content">
    <?= $this->Form->create($anuncio) ?>
    <fieldset>
        <legend><?= __('Edit Anuncio') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('categoria_id', ['options' => $categorias]);
            echo $this->Form->control('descricao');
            echo $this->Form->control('titulo');
	    $data = ((new DateTime(date('Y-m-d H:i:s')))->modify('+1 month'))->format('Y-m-d');
            echo '<input type="date" value = "' . $data , '" style="display:none;" required />';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
