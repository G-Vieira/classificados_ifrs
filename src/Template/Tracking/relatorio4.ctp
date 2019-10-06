<?php
  
  $resultados = [];

  $lastFilter = 'a';
  foreach($dados as $dado){
    foreach($dado as $d){
      $json = json_decode($d)[0];
      if(isset($json->properties->section)){

        if ($json->properties->section == 'acoes_busca'){
          continue;
        }

        $lastFilter = $json->properties->section;      
      }

      if(isset($json->properties->url)){
        if(strpos($json->properties->url,'anuncios/view') !== false){
          if(!isset($resultados[$lastFilter])){
            $resultados[$lastFilter] = 0;
          }
          $resultados[$lastFilter]++;
        }
        
      }
    }
  }

  arsort($resultados);
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
  </div>
  <div class="col-md-6 col-12">
    <h3><?= __('Filtro utilizado na busca real') ?></h3>

    <?php if(empty($resultados)): ?>
      <div class="row">
        <h3>Não existem dados para este relatório!</h3>
      </div>
    <?php else: ?>
      <table class="table">
        <thead>
          <th>FILTRO</th>
          <th>QUANTIDADE</th>
        </thead>
        <tbody>
        <?php foreach($resultados as $key => $resultado): ?>
          <tr>
            <td><?= $key/*ucfirst(str_replace('_',' ',$key))*/ ?></td>
            <td><?= $resultado ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>

  </div>
</div>