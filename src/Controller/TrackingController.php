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

    $eventos = $this->request->data['events_json'];
    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];

    $redis = new \Predis\Client();
    
    echo json_encode(['result' => 'OK']);
  }

  public function eventos(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false;

    $eventos = $this->request->data['events_json'];
    $visit_token = $this->request->data['visit_token'];
    $visitor_token = $this->request->data['visitor_token'];
    
    $redis = new \Predis\Client();


    echo json_encode(['result' => 'OK']);
  }

  public function teste(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false; 

    $redis = new \Predis\Client();
    echo json_encode(['result' => 'OK']);
  }

}