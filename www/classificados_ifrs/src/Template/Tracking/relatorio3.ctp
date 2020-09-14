<?= $this->Html->script('https://www.gstatic.com/charts/loader.js') ?>

<style>
  #chart_div > div {
    margin: 0 auto !important;
    display: block;
    display: inline-block
  }
</style>

<div class="row">
  <div class="col-12 text-center">
    <h3><?= __('Relatório da forma mais utilizada pelos usuários para chegar até os produtos de interesse') ?></h3>
    
    <div style="display:flex!important;" class="row">
      <div class="col-lg-2 col-md-1 col-sm-1"></div>
      <div class="col-lg-4 col-md-5 col-sm-5">
        <b>Data Inicial</b>
        <input type="date" min="2000-01-01" max="2100-12-31"  class="form-control" id="data_ini" />
      </div>
      <div class="col-lg-4 col-md-5 col-sm-5">
        <b>Data Final</b>
        <input type="date" min="2000-01-01" max="2100-12-31"  class="form-control" id="data_fim" />
      </div>
      <div class="col-lg-2 col-md-1 col-sm-1"></div>
    </div>

    <div class="row" style="margin-top: 5px;">
      <div>
        <button class="btn btn-default" id="pesquisar" type="button">Pesquisar</button>
      </div>
    </div>
    
    <div class="row" id="aviso" style="display:none">
      <h3>Não existem dados para este relatório!</h3>
    </div>
    <div id="chart_div" ></div>
  </div>
</div>
<script>
  $(document).on("click","#pesquisar",function(){
    drawChart(
      ($("#data_ini").val() == ""?null:$("#data_ini").val()),
      ($("#data_fim").val() == ""?null:$("#data_fim").val())
    );
  });

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart(data_ini = null, data_fim = null) {
    ahoy.relatorio(3,data_ini,data_fim,function(dados){
      if(dados.length == 0){
        $("#chart_div").hide();
        $("#aviso").show();
      }else{
        $("#chart_div").show();
        $("#aviso").hide();
      }

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Topping');
      data.addColumn('number', 'Slices');

      var temp = [];
      $(dados).each(function(i,val){
        temp.push([val.informacao,val.quantidade]);
      });
      data.addRows(temp);

      // Set chart options
      var options = {'title':'Elementos mais utilizados pelos usuários',width:700,height:500};

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    });
  }
</script>