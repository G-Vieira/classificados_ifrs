<div class="row">
  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-6 col-12">
    <h3><?= __('Relatório de busca sem sucesso') ?></h3>
    <div class="row" id="aviso" style="display:none">
      <h3>Não existem dados para este relatório!</h3>
    </div>
    <table class="table" id="tabela">
      <thead>
        <th>FILTRO</th>
        <th>QUANTIDADE</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<script>
  ahoy.relatorio(4,null,null,function(dados){

    if(dados.length == 0){
      $("#tabela").hide();
      $("#aviso").show();
    }

    $(dados).each(function(i, val){
      $("#tabela > tbody").append(
        $("<tr>").append($("<td>").text(val.informacao))
                 .append($("<td>").text(val.quantidade))
      );
    });

  });
</script>