<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
  <nav class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <?php
        if($authUser['role'] == 'admin'){
          echo '<li>' . $this->Form->postLink(
                  __('Deletar'),
                  ['action' => 'delete', $user->id],
                  ['confirm' => __('Deseja deletar # {0}?', $user->id)]
              ) .
          '</li>';
        }
      ?>
      <li><?= $this->Html->link(__('Listar Usuários'), ['action' => 'index']) ?></li>
    </ul>
  </nav>
  <div class="col-md-9 text-center">
    <?= $this->Form->create($user) ?>
    <fieldset>
      <legend><?= __('Editar Usuário') ?></legend>
      <div class="form-group row">
	<label for="username" class="col-sm-3 col-form-label"><b>Usuário</b></label>
	<div class="col-sm-7">
	  <?= $this->Form->control('username',['label'=>false,'class'=>'form-control']) ?>
	</div>
      </div>
      <div class="form-group row">
	<label for="nome" class="col-sm-3 col-form-label"><b>Nome</b></label>
	<div class="col-sm-7">
	  <?= $this->Form->control('nome',['label'=>false,'class'=>'form-control']) ?>
	</div>
      </div>
      <div class="form-group row">
	<label for="password" class="col-sm-3 col-form-label"><b>Senha</b></label>
	<div class="col-sm-7">
	  <?= $this->Form->control('password',['label'=>false,'class'=>'form-control']) ?>
	</div>
      </div>
      <div class="form-group row">
	<label for="email" class="col-sm-3 col-form-label"><b>Email</b></label>
	<div class="col-sm-7">
	  <?= $this->Form->control('email',['label'=>false,'class'=>'form-control']) ?>
	</div>
      </div>
      <div class="form-group row">
	<label for="role" class="col-sm-3 col-form-label"><b>Papel</b></label>
	<div class="col-sm-7">
	  <?= $this->Form->input('role', array('label' => false,'class'=>'form-control',
            'options' => array('admin' => 'Admin','normal' => 'Normal'))) ?>
	</div>
      </div>
      <div class="form-group row">
	<label for="role" class="col-sm-3 col-form-label"><b>Cidade</b></label>
	<div class="col-sm-7"> 
	  <select class="form-control" id="cidade" name="cidade"required>
        <?php foreach ($cidades as $cidade): ?>
	    <option value="<?= $cidade->id ?>"><?= $cidade->nome ?></option>
        <?php endforeach; ?>
	  </select>
	</div>
      </div>
      <div class="form-group row">
	<button class="btn btn-success" type='submit'>gravar</button>
      </div>
    <?= $this->Form->end() ?>
  </div>
</div>