<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sugesto $sugesto
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sugestoes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sugestoes form large-9 medium-8 columns content">
    <?= $this->Form->create($sugesto) ?>
    <fieldset>
        <legend><?= __('Add Sugesto') ?></legend>
        <?php
            echo '<input type="hidden" name="user_id" value="' . $authUser['id'] . '">';
            echo $this->Form->control('comentario');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
