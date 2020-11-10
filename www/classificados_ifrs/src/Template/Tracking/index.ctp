  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-9">
    <h3><?= __('Relatórios') ?></h3>

    <div class="row">
      <?= $this->Html->link(__('Relatório das ações dos usuários'), ['controller' => 'tracking', 'action' => 'relatorio1'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Relatório dos produtos mais procurados'), ['controller' => 'tracking', 'action' => 'relatorio2'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Relatório da forma mais utilizada pelos usuários para chegar até os produtos de interesse'), ['controller' => 'tracking', 'action' => 'relatorio3'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Relatório de busca improdutivas'), ['controller' => 'tracking', 'action' => 'relatorio4'],['class' => 'btn btn-default']) ?>
    </div>
    
    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Relatório de comparação A/B'), ['controller' => 'tracking', 'action' => 'relatorio5'],['class' => 'btn btn-default']) ?>
    </div>

  </div>
