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
    <h3><?= __('Relatório do teste A/B') ?></h3>
    
    <div class="row" id="aviso" style="display:none">
      <h3>Não existem dados para este relatório!</h3>
    </div>
    
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div id="graficoA" ></div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div id="graficoB" ></div>
      </div>
    </div>
    
  </div>
</div>
<script>
  $(document).on("click","#pesquisar",function(){
    drawChart();
  });

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart(data_ini = null, data_fim = null) {
    ahoy.relatorio(5,data_ini,data_fim,function(dados){
      if(dados.A.length == 0 && dados.B.length == 0){
        $("#chart_div").hide();
        $("#aviso").show();
      }else{
        $("#chart_div").show();
        $("#aviso").hide();
      }
      
      make_chart(dados.A,"graficoA", "A");
      make_chart(dados.B,"graficoB", "B");
    });
  }
  
  function make_chart(dados, grafico, letra){
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');

    var temp = [];
    $(dados).each(function(i,val){
      temp.push([val.informacao,val.quantidade]);
    });
    data.addRows(temp);

    // Set chart options
    var options = {'title':'Elementos mais utilizados pelos usuários no layout ' + letra,width:700,height:500};

    var chart = new google.visualization.PieChart(document.getElementById(grafico));
    chart.draw(data, options);
  }
</script>