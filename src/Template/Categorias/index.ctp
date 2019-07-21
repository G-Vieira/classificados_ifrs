<?php

  $temp = [];
  if(isset($favoritos)){
    foreach($favoritos as $f){
      $temp[$f->categoria_id] = $f->id;
    }
  }

  /**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Categoria[]|\Cake\Collection\CollectionInterface $categorias
 */
  ?>
  <div class="row">
    <div class="col-md-3" id="actions-sidebar">
      <ul class="nav nav-pills nav-stacked">
        <li class="heading"><?= __('Ações') ?></li>
        <?php
        if($authUser['role'] == 'admin'){
         echo '<li>' . $this->Html->link(__('Nova Categoria'), ['action' => 'add']) . '</li>';
       }
       ?>
       <li><?= $this->Html->link(__('Listar Anúncios'), ['controller' => 'Anuncios', 'action' => 'index']) ?></li>
     </ul>
   </div>
   <div class="col-md-9">
    <h3><?= __('Categorias') ?></h3>
    <table cellpadding="0" class="table" cellspacing="0">
      <thead>
       <tr>
         <th scope="col"><?= $this->Paginator->sort('descricao') ?></th>
         <th scope="col"><?= $this->Paginator->sort('parent_id','Categoria Pai') ?></th>
         <th scope="col" class="actions"><?= __('Ações') ?></th>
       </tr>
     </thead>
     <tbody>
      <?php foreach ($categorias as $categoria): ?>
       <tr>
         <td><?= h($categoria->descricao) ?></td>
         <td><?= $categoria->has('parent_id')? $categoria->parent_categoria->descricao: ' ' ?></td>
         <td class="actions">
          <?= $this->Html->link(__('Ver'), ['action' => 'view', $categoria->id]) ?>
          <?php
          if($authUser['role'] == 'admin'){
            echo $this->Html->link(__('Editar'), ['action' => 'edit', $categoria->id]);
            echo $this->Form->postLink(__('Deletar'), ['action' => 'delete', $categoria->id], ['confirm' => __('Deseja deletar # {0}?', $categoria->id)]);
          }
          ?>
        </td>
        <?php
          if($authUser){
              if(isset($temp[$categoria->id])){
                echo '<td>' .
                  $this->Form->postLink(__('Desfavoritar'),
                    ['controller' => 'favoritos', 'action' => 'delete', $temp[$categoria->id]],
                    ['class' => 'btn btn-default','confirm' => __('Deseja desfavoritar # {0}?', $categoria->descricao)]) .
                '</td>';
              }else{
                echo '<td>
                   <form action="favoritos/add/" method="post">
                      <input type="hidden" name="user_id" value="' . $authUser['id'] . '">
                      <input type="hidden" name="categoria_id" value="' . $categoria->id . '">
                      <button type="submit" class="btn btn-default blink">Favoritar</button>
                   </form>
                </td>';
              }
          }
        ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="paginator">
  <ul class="pagination">
    <?= $this->Paginator->first('<< ' . __('primeiro')) ?>
    <?= $this->Paginator->prev('< ' . __('anterior')) ?>
    <?= $this->Paginator->numbers() ?>
    <?= $this->Paginator->next(__('próximo') . ' >') ?>
    <?= $this->Paginator->last(__('ultimo') . ' >>') ?>
  </ul>
  <p><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, mostrando {{current}} registros(s) de {{count}}')]) ?></p>
</div>
</div>
</div>
