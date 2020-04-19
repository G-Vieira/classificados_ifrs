<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Sugestoes Controller
 *
 *
 * @method \App\Model\Entity\Sugesto[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SugestoesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {   
        $this->isAdmin(true);
        $sugestoes = $this->paginate($this->Sugestoes);


        $this->set(compact('sugestoes'));
    }

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->deny(['index', 'add', 'edit', 'view']);

    }


    /**
     * View method
     *
     * @param string|null $id Sugesto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->isAdmin(true);
        $sugesto = $this->Sugestoes->get($id, [
            'contain' => []
        ]);

        $this->set('sugesto', $sugesto);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sugesto = $this->Sugestoes->newEntity();
        if ($this->request->is('post')) {
            $sugesto = $this->Sugestoes->patchEntity($sugesto, $this->request->getData());
            if ($this->Sugestoes->save($sugesto)) {
                $this->Flash->success(__('Sugestão salva.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A sugestão não foi salva. Por favor, tente novamente.'));
        }
        $this->set(compact('sugesto'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Sugesto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {   
        $this->isAdmin(true);
        $this->request->allowMethod(['post', 'delete']);
        $sugesto = $this->Sugestoes->get($id);
        if ($this->Sugestoes->delete($sugesto)) {
            $this->Flash->success(__('A sugestão foi deletada.'));
        } else {
            $this->Flash->error(__('A sugestão não foi deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
