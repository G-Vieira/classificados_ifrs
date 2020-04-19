<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Favoritos Controller
 *
 * @property \App\Model\Table\FavoritosTable $Favoritos
 *
 * @method \App\Model\Entity\Favorito[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FavoritosController extends AppController
{

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
       $this->request->allowMethod(['post', 'add']);
      
        $favorito = $this->Favoritos->newEntity();
        if ($this->request->is('post')) {
            $favorito = $this->Favoritos->patchEntity($favorito, $this->request->getData());
            if ($this->Favoritos->save($favorito)) {
                $this->Flash->success(__('O favorito foi adicionado.'));

                return $this->redirect(['controller' => 'categorias','action' => 'index']);
            }
            $this->Flash->error(__('Erro ao adicionar o favorito.'));
            return $this->redirect(['controller' => 'categorias','action' => 'index']);
        }
        $users = $this->Favoritos->Users->find('list', ['limit' => 200]);
        $categorias = $this->Favoritos->Categorias->find('list', ['limit' => 200]);
        $this->set(compact('favorito', 'users', 'categorias'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Favorito id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){
        $this->request->allowMethod(['post', 'delete']);
        $favorito = $this->Favoritos->get($id);
        if ($this->Favoritos->delete($favorito)) {
            $this->Flash->success(__('O favorito foi deletado.'));
        } else {
            $this->Flash->error(__('Erro ao deletar.'));
        }

        return $this->redirect(['controller' => 'categorias','action' => 'index']);
    }
}
