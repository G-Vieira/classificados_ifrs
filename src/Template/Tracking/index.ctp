<?php
/*
  (1)qual a forma mais utilizada pelos usuários para encontrarem os produtos que desejam?;
  (2) quais os produtos mais procurados?; 
  (3) quais os erros de busca mais frequentes?.
*/
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-9">
    <h3><?= __('Relatórios') ?></h3>

    <div class="row">
      <?= $this->Html->link(__('Forma mais utilizada de busca'), ['controller' => 'tracking', 'action' => 'relatorio1'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Produtos mais procurados'), ['controller' => 'tracking', 'action' => 'relatorio2'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Erros de busca'), ['controller' => 'tracking', 'action' => 'relatorio3'],['class' => 'btn btn-default']) ?>
    </div>

  </div>
</div>