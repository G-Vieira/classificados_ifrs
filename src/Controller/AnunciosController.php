<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
* Anuncios Controller
*
* @property \App\Model\Table\AnunciosTable $Anuncios
*
* @method \App\Model\Entity\Anuncio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class AnunciosController extends AppController {

  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->Auth->allow(['ultimos','procurados','pesquisar']);
  }

  /**
  * Index method
  *
  * @return \Cake\Http\Response|void
  */
  public function index() {
    $this->paginate = [
      'contain' => ['Users', 'Categorias']
    ];

    if(isset($this->request->query['preco'])){
      $preco = $this->request->query['preco'];
      
      switch($preco){
        case 'A': 
          $condicoes = [
            'conditions' => ['Anuncios.preco <= ' => 500]
          ];
          break;
        case 'B':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 500],
              ['Anuncios.preco <= ' => 1000]
            ]
          ];
          break;
          case 'C':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 1000],
              ['Anuncios.preco <= ' => 1500]
            ]
          ];
          break;
        case 'D':
        $condicoes = [
          'conditions' => ['Anuncios.preco > ' => 1500]
        ];
          break;
        default: $condicoes = [];
      }

      $resultado = $this->Anuncios->find('all', $condicoes);

      $anuncios = $this->paginate($resultado);
    }else{
      $anuncios = $this->paginate($this->Anuncios);
    }

    $temp = TableRegistry::get('Categorias');
    $categorias = $temp->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);

    $this->set(compact('anuncios','categorias'));
  }

  public function pesquisar() {
    $this->paginate = [
      'contain' => ['Users', 'Categorias']
    ];

    if ($this->request->is('post')) {
      $requisicao = $this->request->getData();
      $pesquisa = str_replace(' ', '%', $requisicao['pesquisa']);
    } else {
      $pesquisa = $this->request->query['pesquisa'];
    }

    $resultado = $this->Anuncios->find('all', array(
      'conditions' => array(
        'OR' => [
          ["Anuncios.titulo LIKE " => '%' . $pesquisa . '%'],
          ["Anuncios.descricao LIKE " => '%' . $pesquisa . '%']
        ]
      )
    ));
    $anuncios = $this->paginate($resultado);

    $temp = TableRegistry::get('Categorias');
    $categorias = $temp->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);

    $this->set(compact('anuncios','categorias'));
  }

  /*
    Anuncios mais procurados (FIXO)
  */
  public function procurados() {
    $this->paginate = [
      'contain' => ['Users', 'Categorias']
    ];

    if(isset($this->request->query['preco'])){
      $preco = $this->request->query['preco'];
      
      switch($preco){
        case 'A': 
          $condicoes = [
            'conditions' => ['Anuncios.preco <= ' => 500]
          ];
          break;
        case 'B':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 500],
              ['Anuncios.preco <= ' => 1000]
            ]
          ];
          break;
          case 'C':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 1000],
              ['Anuncios.preco <= ' => 1500]
            ]
          ];
          break;
        case 'D':
        $condicoes = [
          'conditions' => ['Anuncios.preco > ' => 1500]
        ];
          break;
        default: $condicoes = [
          'conditions' => []
        ];
      }
    }

    $condicoes['conditions']["Anuncios.id  IN "] = [1,5,10,15,20,25,30,35,40,100,120,125,127,150,151,152,160,165,170,200,210,215,267,289,300,330,350,400,504,510,580,600,610,670,700];

    $resultado = $this->Anuncios->find('all', $condicoes);
    $anuncios = $this->paginate($resultado);

    $temp = TableRegistry::get('Categorias');
    $categorias = $temp->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);

    $this->set(compact('anuncios','categorias'));
  }

  /*
    Ultimos adicionados (por ajustar)
  */
  public function ultimos() {
    $this->paginate = [
      'contain' => ['Users', 'Categorias']
    ];

    if(isset($this->request->query['preco'])){
      $preco = $this->request->query['preco'];
      
      switch($preco){
        case 'A': 
          $condicoes = [
            'conditions' => ['Anuncios.preco <= ' => 500]
          ];
          break;
        case 'B':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 500],
              ['Anuncios.preco <= ' => 1000]
            ]
          ];
          break;
          case 'C':
          $condicoes = [
            'conditions' => [
              ['Anuncios.preco >= ' => 1000],
              ['Anuncios.preco <= ' => 1500]
            ]
          ];
          break;
        case 'D':
        $condicoes = [
          'conditions' => ['Anuncios.preco > ' => 1500]
        ];
          break;
        default: $condicoes = [];
      }

    }else{
      $condicoes = [];
    }

    $condicoes['limit'] = 20;
    $condicoes['order'] = 'Anuncios.created DESC';

    $resultado = $this->Anuncios->find('all', $condicoes);
    $anuncios = $this->paginate($resultado);

    $temp = TableRegistry::get('Categorias');
    $categorias = $temp->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);

    $this->set(compact('anuncios','categorias'));
  }

  /**
  * View method
  *
  * @param string|null $id Anuncio id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null) {
    $ncomentario = $this->Anuncios->Comentarios->newEntity();
    $anuncio = $this->Anuncios->get($id, [
      'contain' => ['Users', 'Categorias', 'Comentarios']
    ]);

    $this->set('anuncio', $anuncio);
    $this->set('ncomentario');
  }

 public function vencidos(){
   $resultado = $this->Anuncios->find('all', array(
     'conditions' => array(
       "Anuncios.validade <= CURRENT_DATE"
     )
   ));
   $anuncios = $this->paginate($resultado);
   $this->set(compact('anuncios'));
 }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add() {
    $anuncio = $this->Anuncios->newEntity();
    if ($this->request->is('post')) {
      $anuncio = $this->Anuncios->patchEntity($anuncio, $this->request->getData());
      if ($this->Anuncios->save($anuncio)) {
        $this->Flash->success(__('O anuncio foi criado.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao criar o anuncio.'));
    }
    $categorias = $this->Anuncios->Categorias->find('all');

    $this->set(compact('anuncio', 'categorias'));
  }

  /**
  * Edit method
  *
  * @param string|null $id Anuncio id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null) {
    $anuncio = $this->Anuncios->get($id, [
      'contain' => []
    ]);
    if ($anuncio->user_id != $this->Auth->user()['id']) {
      $this->isAdmin(true); //redirecionar
      $users = $this->Anuncios->Users->find('list', ['limit' => 200]);
    } else {
      $users = $this->Anuncios->Users->get($anuncio->user_id, [
        'contain' => []
      ]);
    }

    if ($this->request->is(['patch', 'post', 'put'])) {
      $anuncio = $this->Anuncios->patchEntity($anuncio, $this->request->getData());
      if ($this->Anuncios->save($anuncio)) {
        $this->Flash->success(__('O anuncio foi alterado.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao editar o arquivo.'));
    }

    $categorias = $this->Anuncios->Categorias->find('all');
    $this->set(compact('anuncio', 'users', 'categorias'));
  }

  /**
  * Delete method
  *
  * @param string|null $id Anuncio id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null) {
    $this->request->allowMethod(['post', 'delete']);
    $anuncio = $this->Anuncios->get($id);

    if ($anuncio->user_id != $this->Auth->user()['id']) {
      $this->isAdmin(true); //redirecionar
      $users = $this->Anuncios->Users->find('list', ['limit' => 200]);
    } else {
      $users = $this->Anuncios->Users->get($anuncio->user_id, [
        'contain' => []
      ]);
    }

    if ($this->Anuncios->delete($anuncio)) {
      $this->Flash->success(__('O anuncio foi deletado.'));
    } else {
      $this->Flash->error(__('Erro ao deletar o anuncio.'));
    }

    return $this->redirect(['action' => 'index']);
  }

}
