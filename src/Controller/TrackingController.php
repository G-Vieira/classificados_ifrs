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
    echo json_encode($_POST);
  }

  public function eventos(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false; 
    echo json_encode($_POST);
  }

  public function teste(){
    $this->RequestHandler->respondAs('json');
    $this->response->type('application/json');  
    $this->autoRender = false; 

    $redis = new \Predis\Client();
    $redis->set('cakephp', 'a');
    echo json_encode([$redis->get('cakephp')]);
  }

}