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
    <div class="row" id="aviso" style="display:none">
      <h3>Não existem dados para este relatório!</h3>
    </div>
    <div id="chart_div" ></div>
  </div>
</div>
<script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    ahoy.relatorio(3,null,null,function(dados){
      if(dados.length == 0){
        $("#chart_div").hide();
        $("#aviso").show();
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