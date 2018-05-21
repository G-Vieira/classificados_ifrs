<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*
* @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class UsersController extends AppController {

  public function beforeFilter(Event $event) {
    parent::beforeFilter($event);
    $this->Auth->deny(['index']);
    $this->Auth->allow(['register']);
  }

  /*
  * Função para login
  */

  public function login() {
    if ($this->Auth->user()) {
      $this->isAdmin();
    }

    if ($this->request->is('post')) {
      $user = $this->Auth->identify();
      if ($user) {
        $this->Auth->setUser($user);
        return $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error(__('Usuario e/ou senha errado(s).'));
    }
  }

  /*
  * Função para logout
  */

  public function logout() {
    return $this->redirect($this->Auth->logout());
  }

  /**
  * Index method
  *
  * @return \Cake\Http\Response|void
  */
  public function index() {
    $this->isAdmin();
    $users = $this->paginate($this->Users);

    $this->set(compact('users'));
  }

  /**
  * View method
  *
  * @param string|null $id User id.
  * @return \Cake\Http\Response|void
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null) {
    //$this->isAdmin();
    $user = $this->Users->get($id, [
      'contain' => []
    ]);

    $this->set('user', $user);
  }

  /**
  * Add method
  *
  * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
  */
  public function add() {
    $this->isAdmin();
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('O usuario foi salvo.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao gravar o usuario! Tente novamente.'));
    }
    $temp = TableRegistry::get('Cidades');
    $cidades = $temp->find();

    $this->set(compact('user'));
    $this->set(compact('cidades'));
  }

  /**
  * Edit method
  *
  * @param string|null $id User id.
  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null) {
    $tuser = $this->Auth->user();

    if ($tuser['id'] != $id) {
      $this->isAdmin();
    }

    $user = $this->Users->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('O usuario foi alterado.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao alterar o usuario! Tente novamente.'));
    }
    $temp = TableRegistry::get('Cidades');
    $cidades = $temp->find();

    $this->set(compact('user'));
    $this->set(compact('cidades'));
  }

  /**
  * Delete method
  *
  * @param string|null $id User id.
  * @return \Cake\Http\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null) {
    $this->isAdmin();
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('O usuario foi deletado.'));
    }
    else {
      $this->Flash->error(__('Erro ao deletar o usuario! Tente novamente.'));
    }

    return $this->redirect(['action' => 'index']);
  }

  public function register() {
    if ($this->Auth->user()) {
      $this->isAdmin();
    }

    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('O usuário foi criado.'));
        return $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error(__('Erro ao criar o usuário! Tente novamente.'));
    }
    $temp = TableRegistry::get('Cidades');
    $cidades = $temp->find();

    $this->set(compact('user'));
    $this->set(compact('cidades'));
    $this->set('_serialize', ['user', 'cidades']);
  }

}
