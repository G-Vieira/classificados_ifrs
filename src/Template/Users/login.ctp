
<div class="large-4 columns">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Entre com seu usuario e senha.') ?></legend>
        <?= $this->Form->control('username') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Form->button(__('Acessar')); ?>
    </fieldset>
<?= $this->Form->end() ?>
</div>