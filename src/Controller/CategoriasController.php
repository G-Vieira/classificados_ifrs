<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Categorias Controller
 *
 * @property \App\Model\Table\CategoriasTable $Categorias
 *
 * @method \App\Model\Entity\Categoria[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriasController extends AppController {

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index() {
    $this->paginate = [
      'contain' => ['ParentCategorias','ChildCategorias']
    ];
    
    $categorias = $this->paginate($this->Categorias);

    if($this->Auth->user()){
      $favoritos = $this->Categorias->Favoritos->find('all',[
        'conditions' => [
           'Favoritos.user_id' => $this->Auth->user()['id']
          ]
        ]
      );
    }
    
    $this->set(compact('categorias','favoritos'));
  }


  /**
   * View method
   *
   * @param string|null $id Categoria id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null) {
    $categoria = $this->Categorias->get($id, [
        'contain' => ['Favoritos', 'ParentCategorias','ChildCategorias']
    ]);

    $resultado = $this->Categorias->Anuncios->find('all', array(
      'conditions' => array(
        "Anuncios.categoria_id = " => $categoria->id
      )
    ));

    $anuncios = $this->paginate($resultado);
    $this->set(compact('categoria','anuncios'));
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add() {
    $this->isAdmin(true);
    $categoria = $this->Categorias->newEntity();
    if ($this->request->is('post')) {
      $categoria = $this->Categorias->patchEntity($categoria, $this->request->getData());
      if ($this->Categorias->save($categoria)) {
        $this->Flash->success(__('The categoria has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao gravar a categoria! Tente novamente.'));
    }
    $categorias = $this->Categorias->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);
    $this->set(compact('categoria','categorias'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Categoria id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null) {
    $this->isAdmin(true);
    $categoria = $this->Categorias->get($id, [
        'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $categoria = $this->Categorias->patchEntity($categoria, $this->request->getData());
      if ($this->Categorias->save($categoria)) {
        $this->Flash->success(__('A categoria foi alterada.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Erro ao alterar a categoria! Tente novamente.'));
    }
    $categorias = $this->Categorias->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);
    $this->set(compact('categoria','categorias'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Categoria id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null) {
    $this->isAdmin(true);
    $this->request->allowMethod(['post', 'delete']);
    $categoria = $this->Categorias->get($id);
    if ($this->Categorias->delete($categoria)) {
      $this->Flash->success(__('A categoria foi deletada.'));
    } else {
      $this->Flash->error(__('Erro ao deletar a categoria! Tente novamente.'));
    }

    return $this->redirect(['action' => 'index']);
  }

}
