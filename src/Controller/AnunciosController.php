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
    $this->Auth->allow(['ultimos','procurados']);
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

    if ($this->request->is('post')) {
      $requisicao = $this->request->getData();
      $pesquisa = str_replace(' ', '%', $requisicao['pesquisa']);
      if ($pesquisa == '') {
        $anuncios = $anuncios = $this->paginate($this->Anuncios);
      } else {
        $resultado = $this->Anuncios->find('all', array(
          'conditions' => array(
            "Anuncios.titulo LIKE " => '%' . $pesquisa . '%'
          )
        ));
        $anuncios = $this->paginate($resultado);
      }
    } else {
      $anuncios = $this->paginate($this->Anuncios);
    }

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

    //Ajustar os anuncios fixos
    $resultado = $this->Anuncios->find('all', array(
      'conditions' => array(
        "Anuncios.id  IN " => [100,200,300,400,500,600,700,800,900,1000,1100,1200,1300,1400,1500,1600,1700,1800,1900,2000]
      )
    ));

    $anuncios = $this->paginate($resultado);
    $this->set(compact('anuncios'));
  }

  /*
    Ultimos adicionados (por ajustar)
  */
  public function ultimos() {
    $this->paginate = [
      'contain' => ['Users', 'Categorias']
    ];

    $resultado = $this->Anuncios->find('all', array(
      'limit' => 20,
      'order' => 'Anuncios.created DESC'
    ));

    $anuncios = $this->paginate($resultado);
    $this->set(compact('anuncios'));
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
