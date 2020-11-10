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

  /*
    Relatório de Forma mais utilizada de busca
  */
  public function relatorio1(){
    $this->isAdmin();
  }

  /*
    Relatório de Produtos mais procurados
  */
  public function relatorio2(){
    $this->isAdmin();//limitando acesso aos administradores
  }

  /*
    Relatório de erros de busca
    Este relatório deve ser implementado em conjunto com a 
    base de dados de anúncios do site em questão para que possa
    haver comparação dos termos de busca com o nome e descrição dos anúncios
  */
  public function relatorio3(){
    $this->isAdmin();
  }

  /*
    Filtros utilizados na busca real
  */
  public function relatorio4(){
    $this->isAdmin();
  }
  
  /*
    Teste A/B
  */
  public function relatorio5(){
    $this->isAdmin();
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
