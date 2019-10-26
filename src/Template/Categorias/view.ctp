<?php

/**
* @var \App\View\AppView $this
* @var \App\Model\Entity\Categoria $categoria
*/

?>
<script>
  ahoy.configure({page: "ver_categoria"});
  ahoy.trackAll();
</script>

<div class="row" >
  <nav data-section="filtros" class="col-md-2" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><?= __('Ações') ?></li>
      <?php
        if($authUser['role'] == 'admin'){
          echo '<li>' . $this->Html->link(__('Nova Categoria'), ['action' => 'add']) . '</li>';
          echo '<li>' . $this->Html->link(__('Editar Categoria'), ['action' => 'edit', $categoria->id]) . '</li>';
          echo '<li>' . $this->Form->postLink(__('Deletar Categoria'), ['action' => 'delete', $categoria->id], ['confirm' => __('Deseja deletar # {0}?', $categoria->id)]) . '</li>';
        }
      ?>
      <li><?= $this->Html->link(__('Listar Categorias'), ['action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Listar Anúncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?> </li>
      <li><?= $this->Html->link(__('Novo Anúncio'), ['controller' => 'Anuncios', 'action' => 'add']) ?> </li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li class="heading"><b><?= __('Filtros Por:') ?></b></li>
      <li><?= __('Anúncios') ?></li>
      <li><?= $this->Html->link(__('Últimos adicionados'), ['controller' => 'anuncios','action' => 'ultimos']) ?></li>
      <li><?= $this->Html->link(__('Mais procurados'), ['controller' => 'anuncios','action' => 'procurados']) ?></li>
      <li><?= __('Preço') ?></li>
      <li><?= $this->Html->link(__('Até R$ 500,00'), ['action' => 'view', $categoria->id,'?' => ['preco' => 'A']]) ?></li>
      <li><?= $this->Html->link(__('De R$ 500,00 até R$ 1000,00'), ['action' => 'view', $categoria->id,'?' => ['preco' => 'B']]) ?></li>
      <li><?= $this->Html->link(__('De R$ 1000,00 até R$ 1500,00'), ['action' => 'view', $categoria->id,'?' => ['preco' => 'C']]) ?></li>
      <li><?= $this->Html->link(__('Mais de R$ 1500,00'), ['action' => 'view', $categoria->id,'?' => ['preco' => 'D']]) ?></li>
    </ul>
  </nav>
  <div class="col-md-10">
    <h3><?= h($categoria->id) ?></h3>
    <table class="table">
      <tr>
        <th scope="row"><?= __('Descricao') ?></th>
        <td><?= h($categoria->descricao) ?></td>
      </tr>
      <tr>
        <th scope="row"><?= __('Categoria Pai') ?></th>
        <td><?= $categoria->has('parent_id')? $this->Html->link($categoria->parent_categoria->descricao, ['controller' => 'Categorias', 'action' => 'view', $categoria->parent_categoria->id]): ' ' ?></td>
      </tr>
    </table>
    <div class="row" data-section="filtros">
      <?php if (!empty($categoria->child_categorias)): ?>
        <h4><?= __('Sub-Categorias') ?></h4>
        <table cellpadding="0" cellspacing="0" class="table">
          <tr>
            <th scope="col"><?= __('Descricao') ?></th>
            <th scope="col" class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php foreach ($categoria->child_categorias as $cat): ?>
            <tr>  
              <td><?= h($cat->descricao) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Ver'), ['controller' => 'Categorias', 'action' => 'view', $cat->id]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>
    <div class="row">
      <?php if (!$anuncios->isEmpty()): ?>
        <h4><?= __('Anúncios') ?></h4><h4 id="filtro_nome"></h4>
        <table cellpadding="0" cellspacing="0" class="table">
          <tr>
            <th scope="col"><?= __('Imagem') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Titulo') ?></th>
            <th scope="col"><?= $this->Paginator->sort('Preco') ?></th>
            <th scope="col" class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php foreach ($anuncios as $anuncio): ?>
            <tr>  
              <td><?= $this->Html->image('../files/Anuncios/imagem/' . $anuncio->imagem); ?></td>
              <td><?= h($anuncio->titulo) ?></td>
              <td>R$ <?= h($anuncio->preco) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Ver'), ['controller' => 'Anuncios', 'action' => 'view', $anuncio->id]) ?>
            
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
        <div class="paginator" data-section="paginacao">
          <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('próximo') . ' >') ?>
            <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
          </ul>
          <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registros(s) de {{count}}')]) ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
