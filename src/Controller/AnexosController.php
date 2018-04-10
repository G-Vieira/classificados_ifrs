<?php

  namespace App\Controller;

  use App\Controller\AppController;

  /**
   * Anexos Controller
   *
   * @property \App\Model\Table\AnexosTable $Anexos
   *
   * @method \App\Model\Entity\Anexo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class AnexosController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
      $this->paginate = [
	'contain' => ['Anuncios']
      ];
      $anexos = $this->paginate($this->Anexos);

      $this->set(compact('anexos'));
    }

    /**
     * View method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $anexo = $this->Anexos->get($id, [
	'contain' => ['Anuncios']
      ]);

      $this->set('anexo', $anexo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
      $anexo = $this->Anexos->newEntity();
      if ($this->request->is('post')) {
	$anexo = $this->Anexos->patchEntity($anexo, $this->request->getData());
	if ($this->Anexos->save($anexo)) {
	  $this->Flash->success(__('O anexo foi gravado.'));

	  return $this->redirect(['action' => 'index']);
	}
	$this->Flash->error(__('Erro ao gravar o anexo.'));
      }
      $anuncios = $this->Anexos->Anuncios->find('list', ['limit' => 200]);
      $this->set(compact('anexo', 'anuncios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
      $anexo = $this->Anexos->get($id, [
	'contain' => []
      ]);
      $anuncio = $this->Anuncios->get($anexo->anuncio_id, [
	'contain' => []
      ]);

      if ($anuncio->user_id != $this->Auth->user()['id']) {
	$this->isAdmin(true); //redirecionar
	$anuncios = $this->Anexos->Anuncios->find('list', ['limit' => 200]);
      }
      else {
	$anuncios = $this->Anexos->Anuncios->get($anexo->anuncio_id, [
	  'contain' => []
	]);
      }

      if ($this->request->is(['patch', 'post', 'put'])) {
	$anexo = $this->Anexos->patchEntity($anexo, $this->request->getData());
	if ($this->Anexos->save($anexo)) {
	  $this->Flash->success(__('O anexo foi editado.'));

	  return $this->redirect(['action' => 'index']);
	}
	$this->Flash->error(__('Erro ao editar o anexo.'));
      }

      $this->set(compact('anexo', 'anuncios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
      $this->request->allowMethod(['post', 'delete']);
      $anexo = $this->Anexos->get($id);
      $anuncio = $this->Anuncios->get($anexo->anuncio_id, [
	'contain' => []
      ]);

      if ($anuncio->user_id != $this->Auth->user()['id']) {
	$this->isAdmin(true); //redirecionar
	$anuncios = $this->Anexos->Anuncios->find('list', ['limit' => 200]);
      }
      else {
	$anuncios = $this->Anexos->Anuncios->get($anexo->anuncio_id, [
	  'contain' => []
	]);
      }

      if ($this->Anexos->delete($anexo)) {
	$this->Flash->success(__('O anexo foi deletado.'));
      }
      else {
	$this->Flash->error(__('Erro ao deletar o anexo.'));
      }

      return $this->redirect(['action' => 'index']);
    }

  }
  