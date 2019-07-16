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

  public function visitas(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false; 
    
    echo json_encode(['result' => 'OK']);
  }

  public function eventos(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $events = $this->request->data['events_json'];
    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];
    
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
    $res = $redis->rpush("events:$visitor_token", $events);

    echo json_encode(['result' => $res]);
  }

}