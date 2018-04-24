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
                ['confirm' => __('Deseja deletar # {0}?', $anuncio->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Anuncios'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Listar Anexos'), ['controller' => 'Anexos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Novo Anexo'), ['controller' => 'Anexos', 'action' => 'add', $anuncio->id]) ?></li>
        <li><?= $this->Html->link(__('Listar Comentarios'), ['controller' => 'Comentarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Novo Comentario'), ['controller' => 'Comentarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="anuncios form large-9 medium-8 columns content">
    <?= $this->Form->create($anuncio) ?>
    <fieldset>
        <legend><?= __('Editar Anuncio') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('categoria_id', ['options' => $categorias]);
	    echo $this->Form->control('titulo');
            echo $this->Form->control('descricao');
	    $data = ((new DateTime(date('Y-m-d H:i:s')))->modify('+1 month'))->format('Y-m-d');
            echo '<input type="date" name="validade" value = "' . $data , '" style="display:none;" required />';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Gravar')) ?>
    <?= $this->Form->end() ?>
</div>
