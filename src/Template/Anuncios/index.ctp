<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Anuncio[]|\Cake\Collection\CollectionInterface $anuncios
 */

?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <li><?= $this->Html->link(__('Novo Anúncio'), ['action' => 'add']) ?></li>
      <li><?= $this->Html->link(__('Listar Categorias'), ['controller' => 'Categorias', 'action' => 'index']) ?></li>
    </ul>
    <ul data-section="section" class="nav nav-pills nav-stacked">
      <li class="heading"><b><?= __('Filtros Por:') ?></b></li>
      <li><?= __('Categorias') ?></li>
      <?php foreach ($categorias as $categoria): ?>
        <li><?= $this->Html->link(__($categoria->descricao), ['controller' => 'categorias','action' => 'view',$categoria->id],['data-id'=>$categoria->id]) ?></li>
      <?php endforeach; ?>
      <li><?= __('Anúncios') ?></li>
      <li><?= $this->Html->link(__('Últimos adicionados'), ['controller' => 'anuncios','action' => 'ultimos']) ?></li>
      <li><?= $this->Html->link(__('Mais procurados'), ['controller' => 'anuncios','action' => 'procurados']) ?></li>
      <li><?= __('Preço') ?></li>
      <li><?= $this->Html->link(__('Até R$ 500,00'), ['?' => ['preco' => 'A']]) ?></li>
      <li><?= $this->Html->link(__('De R$ 500,00 até R$ 1000,00'), ['?' => ['preco' => 'B']]) ?></li>
      <li><?= $this->Html->link(__('De R$ 1000,00 até R$ 1500,00'), ['?' => ['preco' => 'C']]) ?></li>
      <li><?= $this->Html->link(__('Mais de R$ 1500,00'), ['?' => ['preco' => 'D']]) ?></li>
    </ul>
  </div>
  <div class="col-md-9">
    <h3><?= __('Anúncios') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
      <thead>
        <tr>
          <th scope="col"><?= __('Imagem') ?></th>
          <th scope="col"><?= $this->Paginator->sort('categoria_id') ?></th>
          <th scope="col"><?= $this->Paginator->sort('titulo') ?></th>
          <th scope="col"><?= $this->Paginator->sort('preco') ?></th>
          <th scope="col" class="actions"><?= __('Ações') ?></th>
        </tr>
      </thead>
      <tbody>
            <?php foreach ($anuncios as $anuncio): ?>
        <tr>  
          <td><?= $this->Html->image('../files/Anuncios/imagem/' . $anuncio->imagem); ?></td>
          <td><?= $anuncio->has('categoria') ? $this->Html->link($anuncio->categoria->descricao, ['controller' => 'Categorias', 'action' => 'view', $anuncio->categoria->id]) : '' ?></td>
          <td><?= h($anuncio->titulo) ?></td>
          <td>R$ <?= h($anuncio->preco) ?></td>
          <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $anuncio->id]) ?>
                  <?php
                    if($authUser['role'] == 'admin' || $authUser['id'] == $anuncio->user_id){
                       echo $this->Html->link(__('Editar'), ['action' => 'edit', $anuncio->id]);
                       echo $this->Form->postLink(__('Deletar'), ['action' => 'delete', $anuncio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anuncio->id)]);
                    }
                  ?>
          </td>
        </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
    <div class="paginator">
      <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('amterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próximo') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
      </ul>
      <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registros(s) de {{count}}')]) ?></p>
    </div>
  </div>
</div>