<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cidade $cidade
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cidade->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cidade->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cidades'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="cidades form large-9 medium-8 columns content">
    <?= $this->Form->create($cidade) ?>
    <fieldset>
        <legend><?= __('Edit Cidade') ?></legend>
        <?php
            echo $this->Form->control('nome');
            echo $this->Form->control('uf');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
