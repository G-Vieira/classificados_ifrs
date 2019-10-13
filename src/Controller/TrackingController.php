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

  public function get_dados(){
    $redis = new \Predis\Client([
      "scheme" => "tcp",
		  "host" => "redis",
      "password" => "tccredis",
      "port" => 6379,
      "database" => 0
    ]);

    $keys = $redis->keys('*events*');

    $dados = [];
    foreach($keys as $key){
      $dados[str_replace('events:','',$key)] = $redis->lrange($key,0,-1);
    }

    return $dados;
  }

  public function relatorio1(){
    $this->isAdmin();
    
    $dados = $this->get_dados();
    $this->set(compact('dados'));
  }

  public function relatorio2(){
    $this->isAdmin();

    $dados = $this->get_dados();

    $resultados = [];
    $temp = TableRegistry::get('Anuncios');

    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if (isset($json->properties->url)){
          if(strpos($json->properties->url,'anuncios/view') !== false){
            $id = explode('/',$json->properties->url);
            $resultado = $temp->find('all', ['conditions' => ["Anuncios.id = " => $id[count($id) - 1]]]);
            
            if(!isset($resultados[$resultado->first()->titulo])){
              $resultados[$resultado->first()->titulo] = 0;
            }

            $resultados[$resultado->first()->titulo]++;

          }
        }
  
      }
    }
    arsort($resultados);

    $this->set(compact('resultados'));
  }

  public function relatorio3(){
    $this->isAdmin();
    
    $dados = $this->get_dados();
    $resultados = [];
    $temp = TableRegistry::get('Anuncios');

    foreach($dados as $dado){
      foreach($dado as $d){
        $json = json_decode($d)[0];
        if(isset($json->properties->section)){
  
          if ($json->properties->section == 'campo_busca' && isset($json->properties->value)){
            $resultado = $temp->find('all', ['conditions' => ["Anuncios.titulo LIKE " => '%' . str_replace(' ','%',$json->properties->value) . '%']]);
            
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

  public function relatorio4(){
    $this->isAdmin();
    
    $dados = $this->get_dados();
    $this->set(compact('dados'));
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
    
    $redis = new \Predis\Client([
      "scheme" => "tcp",
		  "host" => "redis",
      "password" => "tccredis",
		  "port" => 6379
    ]);
    
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
    
    $redis = new \Predis\Client([
      "scheme" => "tcp",
		  "host" => "redis",
      "password" => "tccredis",
		  "port" => 6379
    ]);

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