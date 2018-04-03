<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Registrar-se') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
	    echo $this->Form->control('nome');
            echo $this->Form->control('email');
	    echo $this->Form->control('cidade');
            echo $this->Form->input('role', array(
            'options' => array('normal' => 'Normal')));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>