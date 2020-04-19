<div class="row">
  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-6 col-12">
    <h3><?= __('Relatório de produtos mais procurados') ?></h3>
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
  ahoy.relatorio(2,function(dados){

    var vazio = true;    
    for(var key in dados){
      $("#tabela > tbody").append(
        $("<tr>").append($("<td>").text(key))
                 .append($("<td>").text(dados[key]))
      );
      vazio = false;
    }

    if(vazio){
      $("#tabela").hide();
      $("#aviso").show();
    }

  });
</script>