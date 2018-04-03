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
class AnexosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
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
    public function view($id = null)
    {
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
    public function add()
    {
        $anexo = $this->Anexos->newEntity();
        if ($this->request->is('post')) {
            $anexo = $this->Anexos->patchEntity($anexo, $this->request->getData());
            if ($this->Anexos->save($anexo)) {
                $this->Flash->success(__('The anexo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The anexo could not be saved. Please, try again.'));
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
    public function edit($id = null)
    {
        $anexo = $this->Anexos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $anexo = $this->Anexos->patchEntity($anexo, $this->request->getData());
            if ($this->Anexos->save($anexo)) {
                $this->Flash->success(__('The anexo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The anexo could not be saved. Please, try again.'));
        }
        $anuncios = $this->Anexos->Anuncios->find('list', ['limit' => 200]);
        $this->set(compact('anexo', 'anuncios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $anexo = $this->Anexos->get($id);
        if ($this->Anexos->delete($anexo)) {
            $this->Flash->success(__('The anexo has been deleted.'));
        } else {
            $this->Flash->error(__('The anexo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
