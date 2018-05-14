<?php

namespace App\Controller;

use App\Controller\AppController;

/**
* Anuncios Controller
*
* @property \App\Model\Table\AnunciosTable $Anuncios
*
* @method \App\Model\Entity\Anuncio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class AnunciosController extends AppController {

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
      'contain' => ['Users', 'Categorias', 'Anexos', 'Comentarios']
    ]);

    $this->set('anuncio', $anuncio);
    $this->set('ncomentario');
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
    $users = $this->Anuncios->Users->find('list', ['limit' => 200]);
    $categorias = $this->Anuncios->Categorias->find('list', ['limit' => 200]);
    $this->set(compact('anuncio', 'users', 'categorias'));
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
