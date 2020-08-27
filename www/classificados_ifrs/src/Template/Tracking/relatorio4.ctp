<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<style>
  #chartdiv {
    width: 100%;
    height: 600px;
  }
</style>

<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-10 text-center">
    <h3><?= __('Relatório de busca improdutivas') ?></h3>
    <div class="row" id="aviso" style="display:none">
      <h3>Não existem dados para este relatório!</h3>
    </div>
    <div id="chartdiv" ></div>
    <table class="table" id="tabela">
      <thead>
        <th>FILTRO</th>
        <th>QUANTIDADE</th>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="col-lg-1"></div>
</div>
<script>

  ahoy.relatorio(4,null,null,function(dados){
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("chartdiv", am4charts.RadarChart);
    let label = chart.chartContainer.createChild(am4core.Label);
    label.text = "Os 10 erros mais recorrentes";
    label.align = "center";

    chart.data = dados.slice(0,10);
    chart.innerRadius = am4core.percent(40);
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.dataFields.category = "informacao";
    categoryAxis.renderer.minGridDistance = 60;
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.labels.template.location = 0.5;
    categoryAxis.renderer.grid.template.strokeOpacity = 0.08;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.min = 0;
    valueAxis.extraMax = 0.1;
    valueAxis.renderer.grid.template.strokeOpacity = 0.08;

    chart.seriesContainer.zIndex = -10;

    var series = chart.series.push(new am4charts.RadarColumnSeries());
    series.dataFields.categoryX = "informacao";
    series.dataFields.valueY = "quantidade";
    series.tooltipText = "{valueY.value}"
    series.columns.template.strokeOpacity = 0;
    series.columns.template.radarColumn.cornerRadius = 5;
    series.columns.template.radarColumn.innerCornerRadius = 0;

    chart.zoomOutButton.disabled = true;

    // as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
    series.columns.template.adapter.add("fill", (fill, target) => {
      return chart.colors.getIndex(target.dataItem.index);
    });

    categoryAxis.sortBySeries = series;

    chart.cursor = new am4charts.RadarCursor();
    chart.cursor.behavior = "none";
    chart.cursor.lineX.disabled = true;
    chart.cursor.lineY.disabled = true;

    if(dados.length == 0){
      $("#tabela").hide();
      $("#chart_div").hide();
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