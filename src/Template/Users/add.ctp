<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
  <ul class="side-nav">
    <li class="heading"><?= __('Ações') ?></li>
    <li><?= $this->Html->link(__('Listar Usuário'), ['action' => 'index']) ?></li>
  </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
  <fieldset>
    <legend><?= __('Novo Usuário') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('nome');
            echo $this->Form->control('email');
            echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin','normal' => 'Normal')));
	?>
        <select class="form-control" id="cidade" name="cidade"required>
        <?php foreach ($cidades as $cidade): ?>
          <option value="<?= $cidade->id ?>"><?= $cidade->nome ?></option>
        <?php endforeach; ?>
        </select>
    ?>
  </fieldset>
    <?= $this->Form->button(__('Gravar')) ?>
    <?= $this->Form->end() ?>
</div>
