<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Ações') ?></li>
        <li><?= $this->Form->postLink(
                __('Deletar'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Deseja deletar # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Usuários'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Editar Usuário') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('nome');
            echo $this->Form->control('email');
            echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin','normal' => 'Normal')));
            echo $this->Form->control('cidade');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Gravar')) ?>
    <?= $this->Form->end() ?>
</div>
