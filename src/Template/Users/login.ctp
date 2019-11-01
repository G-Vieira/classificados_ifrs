<?php

  /**
  * @var \App\View\AppView $this
  */
?>


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 text-center">
    <div class="well well-sm">
      <?= $this->Flash->render() ?>
      <?= $this->Form->create() ?>
      <fieldset>
        <legend><?= __('Entre com seu usuario e senha.') ?></legend>
	<div class="form-group row">
	  <label for="username" maxlenght="50" class="col-sm-6 col-form-label"><b>Usuário</b></label>
	  <div class="col-sm-6">
	    <input class="form-control" id="username" name="username" type='text' required>
	  </div>
	</div>
	<div class="form-group row">
	  <label for="password" maxlenght="20" class="col-sm-6 col-form-label"><b>Senha</b></label>
	  <div class="col-sm-6">
	    <input class="form-control" id="password" name="password" type='password' required>
	  </div>
	</div>
	<div class="form-group row">
	  <button class="btn btn-success" type='submit'>Acessar</button>
	</div>
      </fieldset>
      <?= $this->Form->end() ?>
    </div>
  </div>
  <div class="col-md-3"></div>
</div>
<script>
  ahoy.configure({page: "login"});
  ahoy.trackAll();
</script>