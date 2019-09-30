<div class="row">
  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-6">
    <h3><?= __('Relatório de Produtos mais procurados') ?></h3>

    <?php if(empty($resultados)): ?>
      <div class="row">
        <h3>Não existem dados para este relatório!</h3>
      </div>
    <?php else: ?>
      <table class="table">
        <thead>
          <th>PRODUTO</th>
          <th>QUANTIDADE</th>
        </thead>
        <tbody>
        <?php foreach($resultados as $key => $resultado): ?>
          <tr>
            <td><?= $key ?></td>
            <td><?= $resultado ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

  </div>
</div>