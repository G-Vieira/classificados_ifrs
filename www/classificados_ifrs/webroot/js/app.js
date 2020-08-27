function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

var url = new URL(document.URL).search;

ahoy.configure({
  urlPrefix: "http://www.classificadosifrstcc.website:81",
  trackingId: "tracking_anuncio",
  trackingIdElem: "text",
  filtros: "filtros",
  campo_busca: "campo_busca",
  carrossel: "carrossel",
  paginacao: "paginacao",
  pagina_produtos: "pagina_anuncio",
});

/* SE HOUVER UM PARAMETRO GET CHAMADO MYSQL, ENTAO GRAVAR O TRACKING NO BANCO MYSQL*/
if(url.includes("mysql")){
  url = "http://localhost";
  eventsUrl = "/tracking/eventosmysql";

  ahoy.configure({
    urlPrefix: url,
    eventsUrl: eventsUrl
  });
}

$(document).ready(function(){
  if(url.includes("preco")){
    if(url.includes("A")){
      $("#filtro_nome").text("Até R$ 500,00");
    }else if(url.includes("B")){
      $("#filtro_nome").text("De R$ 500,00 até R$ 1000,00");
    }else if(url.includes("C")){
      $("#filtro_nome").text("De R$ 1000,00 até R$ 1500,00");
    }else if(url.includes("D")){
      $("#filtro_nome").text("Mais de R$ 1500,00");
    }
  }
});

$(document).on("click",".anuncio_carrossel",function(event){
  event.preventDefault();
  $("#car_" + $(this).attr("data-id"))[0].click();
});
