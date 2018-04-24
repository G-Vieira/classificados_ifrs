<?php

  /**
  * @var \App\View\AppView $this
  */
?>
<div class="row">
  <div class="col-md-12 text-center">
    <div class="well well-sm">
    <?= $this->Form->create($user) ?>
      <fieldset>
	<legend><?= __('Registrar-se') ?></legend>
	<div class="form-group row">
	  <label for="username" maxlenght="50" class="col-sm-4 col-form-label"><b>Usuário</b></label>
	  <div class="col-sm-6">
	    <input class="form-control" id="username" name="username" type='text' required>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="password" maxlenght="20" class="col-sm-4 col-form-label"><b>Senha</b></label>
	  <div class="col-sm-6">
	    <input class="form-control" id="password" name="password" type='password' required>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="nome" maxlenght="250" class="col-sm-4 col-form-label"><b>Nome</b></label>
	  <div class="col-sm-6">
	    <input class="form-control" id="nome" name="nome" type='text' required>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="email" maxlenght="200" class="col-sm-4 col-form-label"><b>Email</b></label>
	  <div class="col-sm-6">
	    <div class='input-group'>
	      <input class="form-control" aria-describedby="basic-addon2" id="email" name="email" type='text' required>
	      <span class="input-group-addon" id="basic-addon2">@example.com</span>
	    </div>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="cidade" class="col-sm-4 col-form-label"><b>Cidade</b></label>
	  <div class="col-sm-6">
	    <select class="form-control" id="cidade" name="cidade"required>
	       <?php foreach ($cidades as $cidade): ?>
	      <option value="<?= $cidade->id ?>"><?= $cidade->nome ?></option>
	       <?php endforeach; ?>
	    </select>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="role" class="col-sm-4 col-form-label"><b>Papel</b></label>
	  <div class="col-sm-6">
	    <select class="form-control" id="role" name="role" required>
	      <option value='normal'>Normal</option>
	    </select>
	  </div>
	</div>
	<div class="form-group row">
	  <button class="btn btn-success" type='submit'>Registrar</button>
	</div>
      </fieldset>
    <?= $this->Form->end() ?>
    </div>
  </div>
</div>