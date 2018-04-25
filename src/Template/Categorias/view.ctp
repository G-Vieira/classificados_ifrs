<?php

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria $categoria
 */
?>
<div class="row">
  <nav class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Actions') ?></li>
      <li><?= $this->Html->link(__('Edit Categoria'), ['action' => 'edit', $categoria->id]) ?> </li>
      <li><?= $this->Form->postLink(__('Delete Categoria'), ['action' => 'delete', $categoria->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categoria->id)]) ?> </li>
      <li><?= $this->Html->link(__('List Categorias'), ['action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('New Categoria'), ['action' => 'add']) ?> </li>
      <li><?= $this->Html->link(__('List Anuncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('New Anuncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?> </li>
      <li><?= $this->Html->link(__('List Favoritos'), ['controller' => 'Favoritos', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('New Favorito'), ['controller' => 'Favoritos', 'action' => 'add']) ?> </li>
    </ul>
  </nav>
  <div class="col-md-9">
    <h3><?= h($categoria->id) ?></h3>
    <table class="vertical-table">
      <tr>
	<th scope="row"><?= __('Descricao') ?></th>
	<td><?= h($categoria->descricao) ?></td>
      </tr>
      <tr>
	<th scope="row"><?= __('Id') ?></th>
	<td><?= $this->Number->format($categoria->id) ?></td>
      </tr>
    </table>
    <div class="related">
      <h4><?= __('Anuncios') ?></h4>
        <?php if (!empty($categoria->anuncios)): ?>
      <table cellpadding="0" cellspacing="0">
	<tr>
	  <th scope="col"><?= __('Id') ?></th>
	  <th scope="col"><?= __('User Id') ?></th>
	  <th scope="col"><?= __('Categoria Id') ?></th>
	  <th scope="col"><?= __('Descricao') ?></th>
	  <th scope="col"><?= __('Titulo') ?></th>
	  <th scope="col"><?= __('Validade') ?></th>
	  <th scope="col"><?= __('Created') ?></th>
	  <th scope="col"><?= __('Modified') ?></th>
	  <th scope="col" class="actions"><?= __('Actions') ?></th>
	</tr>
            <?php foreach ($categoria->anuncios as $anuncios): ?>
	<tr>
	  <td><?= h($anuncios->id) ?></td>
	  <td><?= h($anuncios->user_id) ?></td>
	  <td><?= h($anuncios->categoria_id) ?></td>
	  <td><?= h($anuncios->descricao) ?></td>
	  <td><?= h($anuncios->titulo) ?></td>
	  <td><?= h($anuncios->validade) ?></td>
	  <td><?= h($anuncios->created) ?></td>
	  <td><?= h($anuncios->modified) ?></td>
	  <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Anuncios', 'action' => 'view', $anuncios->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Anuncios', 'action' => 'edit', $anuncios->id]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Anuncios', 'action' => 'delete', $anuncios->id], ['confirm' => __('Deseja deletar # {0}?', $anuncios->id)]) ?>
	  </td>
	</tr>
            <?php endforeach; ?>
      </table>
        <?php endif; ?>
    </div>
    <div class="related">
      <h4><?= __('Favoritos') ?></h4>
        <?php if (!empty($categoria->favoritos)): ?>
      <table cellpadding="0" cellspacing="0">
	<tr>
	  <th scope="col"><?= __('User Id') ?></th>
	  <th scope="col"><?= __('Categoria Id') ?></th>
	  <th scope="col" class="actions"><?= __('Actions') ?></th>
	</tr>
            <?php foreach ($categoria->favoritos as $favoritos): ?>
	<tr>
	  <td><?= h($favoritos->user_id) ?></td>
	  <td><?= h($favoritos->categoria_id) ?></td>
	  <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Favoritos', 'action' => 'view', $favoritos->user_id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Favoritos', 'action' => 'edit', $favoritos->user_id]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Favoritos', 'action' => 'delete', $favoritos->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $favoritos->user_id)]) ?>
	  </td>
	</tr>
            <?php endforeach; ?>
      </table>
        <?php endif; ?>
    </div>
  </div>
</div>
