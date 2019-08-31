function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

var buscando = getCookie("buscando");

if(buscando == 1){
  ahoy.configure({
    urlPrefix: "",
    visitsUrl: "/tracking/visitas",
    eventsUrl: "/tracking/eventos",
    page: null,
    platform: "Web",
    useBeacon: true,
    startOnReady: true,
    trackVisits: true,
    cookies: true,
    cookieDomain: null,
    headers: {},
    visitParams: {},
    withCredentials: false
  });
  ahoy.trackAll();
}

$(document).ready(function(){
  var url = new URL(document.URL).search;
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

$(document).on("click","#acao_busca",function(event){
  if(buscando == 1){
    if(confirm("Deseja para a busca?")){
      document.cookie = "buscando=0";
      buscando = 0;
      $(this).text("Iniciar busca");
    }
  }else{
    document.cookie = "buscando=1";
    buscando = 1;
    $(this).text("Parar busca");
  }
});

