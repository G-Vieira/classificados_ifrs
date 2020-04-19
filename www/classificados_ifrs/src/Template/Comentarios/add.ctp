<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $comentario
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Comentarios'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="comentarios form large-9 medium-8 columns content">
    <?= $this->Form->create($comentario) ?>
    <fieldset>
        <legend><?= __('Add Comentario') ?></legend>
        <?php
            echo $this->Form->control('anuncio_id');
            echo $this->Form->control('user_id');
            echo $this->Form->control('descricao');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
