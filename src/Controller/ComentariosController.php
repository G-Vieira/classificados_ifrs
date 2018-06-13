<?php

namespace App\Controller;

use App\Controller\AppController;

  /**
   * Comentarios Controller
   *
   * @property \App\Model\Table\ComentariosTable $Comentarios
   *
   * @method \App\Model\Entity\Comentario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
   */
  class ComentariosController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
      $this->isAdmin(true);
      $this->paginate = [
       'contain' => ['Anuncios', 'Users']
     ];
     $comentarios = $this->paginate($this->Comentarios);

     $this->set(compact('comentarios'));
   }

    /*
     * View method
     *
     * @param string|null $id Comentario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $comentario = $this->Comentarios->get($id, [
       'contain' => ['Anuncios', 'Users']
     ]);

      $this->set('comentario', $comentario);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
      $comentario = $this->Comentarios->newEntity();
      if ($this->request->is('post')) {
       $anuncio = $this->request->getData()['anuncio_id'];
       $comentario = $this->Comentarios->patchEntity($comentario, $this->request->getData());
       if ($this->Comentarios->save($comentario)) {
         $this->Flash->success(__('O comentario foi gravado.'));
         return $this->redirect(['controller' => 'anuncios', 'action' => 'view', $anuncio]);
       }
       $this->Flash->error(__('Erro ao gravar o comentario.'));
       return $this->redirect(['controller' => 'anuncios', 'action' => 'view', $anuncio]);
     }
     $anuncios = $this->Comentarios->Anuncios->find('list', ['limit' => 200]);
     $users = $this->Comentarios->Users->find('list', ['limit' => 200]);
     $this->set(compact('comentario', 'anuncios', 'users'));
   }

    /**
     * Delete method
     *
     * @param string|null $id Comentario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
      $this->request->allowMethod(['post', 'delete']);
      $comentario = $this->Comentarios->get($id);
      if ($this->Comentarios->delete($comentario)) {
       $this->Flash->success(__('O comentario foi deletado.'));
     }
     else {
       $this->Flash->error(__('Erro ao deletar o comentario.'));
     }

     return $this->redirect(['action' => 'index']);
   }

 }
 