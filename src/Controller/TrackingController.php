<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*
* @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class TrackingController extends AppController {

  public function index(){
    $this->isAdmin();
  }

  public function get_conexao(){
    $redis = new \Predis\Client([
      "scheme" => "tcp",
		  "host" => "redis",
      "password" => "tccredis",
      "port" => 6379,
      "database" => 1
    ]);

    return $redis;
  }

  /*
    Função para resgate dos dados brutos gravados no Redis 
    A conexão deve ser configurada para a instância em questão
  */
  public function get_dados(){
    $redis = get_conexao();

    $keys = $redis->keys('*events*');

    $dados = [];
    foreach($keys as $key){
      $dados[str_replace('events:','',$key)] = $redis->lrange($key,0,-1);
    }

    return $dados;
  }

  /*
    Função para resgate da configuração das seções monitoradas
  */
  public function getJsonConfig(){
    try{
      $tracking_config = json_decode(file_get_contents(WWW_ROOT.'js/tracking_config.json'));
    }catch(Exception $ex){
      $tracking_config = null;
    }

    return $tracking_config;
  }

  /*
    Relatório de Forma mais utilizada de busca
  */
  public function relatorio1(){
    $this->isAdmin();//limitando acesso aos administradores
    $dados = $this->get_dados();
    $jsonConfig = $this->getJsonConfig();

    $resultados = [];

    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if(isset($json->properties->section)){
          if($json->properties->section == 'section'){
            continue;
          }

          if(!isset($resultados[$json->properties->section])){
            $resultados[$json->properties->section] = 0;
          }
          $resultados[$json->properties->section]++;
        }
      }
    }

    arsort($resultados);
    $this->set(compact('resultados'));
  }

  /*
    Relatório de Produtos mais procurados
  */
  public function relatorio2(){
    $this->isAdmin();//limitando acesso aos administradores

    $dados = $this->get_dados();
    $jsonConfig = $this->getJsonConfig();

    $resultados = [];

    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if (isset($json->properties->url)){
          if($json->properties->page == $jsonConfig->pagina_produtos &&  $json->name == '$view'){
            //Elementos no HTML com o atributo 'id' foram configurados para ter o nome do anúncio no atributo 'data-id'
            $anuncio = $json->properties->view_id;
            
            if(!isset($resultados[$anuncio])){
              $resultados[$anuncio] = 0;
            }

            $resultados[$anuncio]++;

          }
        }
  
      }
    }
    arsort($resultados);

    $this->set(compact('resultados'));
  }

  /*
    Relatório de erros de busca
    Este relatório deve ser implementado em conjunto com a 
    base de dados de anúncios do site em questão para que possa
    haver comparação dos termos de busca com o nome e descrição dos anúncios
  */
  public function relatorio3(){
    $this->isAdmin();
    
    $dados = $this->get_dados();
    $jsonConfig = $this->getJsonConfig();
    $resultados = [];

    $temp = TableRegistry::get('Anuncios');

    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if(isset($json->properties->section)){
  
          if ($json->properties->section == $jsonConfig->campo_busca && isset($json->properties->value)){
            /*Alterar esta linha para pesquisar no banco de dados do site 
              por um ou mais anúncios que possuem escrita similiar */
            $resultado = $temp->find('all', ['conditions' => ["Anuncios.titulo LIKE " => '%' . str_replace(' ','%',$json->properties->value) . '%']]);
            
            //Caso não haja nenhum anúncio com tal similiaridade...
            if($resultado->isEmpty()){
              if(!isset($resultados[$json->properties->value])){
                $resultados[$json->properties->value] = 0;
              }

              $resultados[$json->properties->value]++;
            }
          }
  
        }
      }
    }

    arsort($resultados);
    $this->set(compact('resultados'));
  }

  /*
    Filtros utilizados na busca real
  */
  public function relatorio4(){
    $this->isAdmin();
    $dados = $this->get_dados();
    $jsonConfig = $this->getJsonConfig();

    $resultados = [];

    $lastFilter = '';
    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if(isset($json->properties->section)){
          $lastFilter = $json->properties->section;      
        }
        if($lastFilter == 'section'){
          continue;
        }
  
        if($json->properties->page == $jsonConfig->pagina_produtos &&  $json->name == '$view'){
          if(!isset($resultados[$lastFilter])){
            $resultados[$lastFilter] = 0;
          }
          $resultados[$lastFilter]++;
        }
      }
    }
  
    arsort($resultados);

    $this->set(compact('resultados'));
  }

  public function visitas(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $events = $this->request->data['events_json'];
    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];

    $events = json_decode($events);
    $events[0]->ip = $this->request->clientIp();
    $events = json_encode($events);
    
    $redis = get_conexao();
    
    $key = "visitor:$visit_token";
    if(empty($redis->get($key))){
      $redis->set($key, $visit_token);
    }
    
    echo json_encode(['result' => 'OK']);
  }

  public function eventos(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $events = $this->request->data['events_json'];
    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];

    $events = json_decode($events);
    $events[0]->ip = $this->request->clientIp();
    $data = date('d/m/Y',$events[0]->time);
    $events = json_encode($events);
    
    $redis = get_conexao();

    $res = $redis->rpush("events:$data:$visitor_token", $events);
    echo json_encode(['result' => $events]);
  }

  public function visitasmysql(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];

    $saveData = [
      'visitor_token' => $this->request->data['visitor_token'],
      'visit_token' => $this->request->data['visit_token'],
      'event' => ' ',
      'data' => date('d/m/Y')
    ];

    $this->loadModel('Event');
    $evento = $this->Event->newEntity($saveData);
    $ok = $this->Event->save($evento);

    echo json_encode(['result' => $ok]);
  }

  public function eventosmysql(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $t = json_decode($this->request->data['events_json']);
    $data = date('d/m/Y',$t[0]->time);

    $saveData = [
      'visitor_token' => $this->request->data['visitor_token'],
      'visit_token' => $this->request->data['visit_token'],
      'event' => $this->request->data['events_json'],
      'data' => $data
    ];

    $this->loadModel('Event');
    $evento = $this->Event->newEntity($saveData);
    $ok = $this->Event->save($evento);

    echo json_encode(['result' => $ok]);
  }

}
