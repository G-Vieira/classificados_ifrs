
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
      <?= $this->Html->link(__('Filtro utilizado na busca real'), ['controller' => 'tracking', 'action' => 'relatorio3'],['class' => 'btn btn-default']) ?>
    </div>

    <div class="row" style="margin-top: 10px;">
      <?= $this->Html->link(__('Erros de busca'), ['controller' => 'tracking', 'action' => 'relatorio4'],['class' => 'btn btn-default']) ?>
    </div>

  </div>
</div>