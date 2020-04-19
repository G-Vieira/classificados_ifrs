<?php

  namespace App\Controller;

  use App\Controller\AppController;
  use Cake\Event\Event;

  /**
   * Cidades Controller
   *
   * @property \App\Model\Table\CidadesTable $Cidades
   *
   * @method \App\Model\Entity\Cidade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class CidadesController extends AppController {

    public function beforeFilter(Event $event) {
      parent::beforeFilter($event);
      $this->Auth->deny(['index','add','edit','view','delete']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
      $this->isAdmin();
      $cidades = $this->paginate($this->Cidades);

      $this->set(compact('cidades'));
    }

    /**
     * View method
     *
     * @param string|null $id Cidade id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $this->isAdmin();
      $cidade = $this->Cidades->get($id, [
	'contain' => []
      ]);

      $this->set('cidade', $cidade);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
      $this->isAdmin();
      $cidade = $this->Cidades->newEntity();
      if ($this->request->is('post')) {
	$cidade = $this->Cidades->patchEntity($cidade, $this->request->getData());
	if ($this->Cidades->save($cidade)) {
	  $this->Flash->success(__('The cidade has been saved.'));

	  return $this->redirect(['action' => 'index']);
	}
	$this->Flash->error(__('The cidade could not be saved. Please, try again.'));
      }
      $this->set(compact('cidade'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cidade id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
      $this->isAdmin();
      $cidade = $this->Cidades->get($id, [
	'contain' => []
      ]);
      if ($this->request->is(['patch', 'post', 'put'])) {
	$cidade = $this->Cidades->patchEntity($cidade, $this->request->getData());
	if ($this->Cidades->save($cidade)) {
	  $this->Flash->success(__('The cidade has been saved.'));

	  return $this->redirect(['action' => 'index']);
	}
	$this->Flash->error(__('The cidade could not be saved. Please, try again.'));
      }
      $this->set(compact('cidade'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cidade id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
      $this->isAdmin();
      $this->request->allowMethod(['post', 'delete']);
      $cidade = $this->Cidades->get($id);
      if ($this->Cidades->delete($cidade)) {
	$this->Flash->success(__('The cidade has been deleted.'));
      }
      else {
	$this->Flash->error(__('The cidade could not be deleted. Please, try again.'));
      }

      return $this->redirect(['action' => 'index']);
    }

  }
  