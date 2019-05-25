<?php

/**
* CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
* @link      https://cakephp.org CakePHP(tm) Project
* @since     0.2.9
* @license   https://opensource.org/licenses/mit-license.php MIT License
*/

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
* Application Controller
*
* Add your application-wide methods in the class below, your controllers
* will inherit them.
*
* @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
*/
class AppController extends Controller {

  /**
  * Initialization hook method.
  *
  * Use this method to add common initialization code like loading components.
  *
  * e.g. `$this->loadComponent('Security');`
  *
  * @return void
  */
  public function initialize() {
    parent::initialize();

    $this->loadComponent('RequestHandler');
    $this->loadComponent('Flash');
    $this->loadComponent('Auth', [
      'loginRedirect' => [
        'controller' => 'Pages',
        'action' => 'display'
      ],
      'authError' => 'Area de acesso privado.',
      'logoutRedirect' => [
        'controller' => 'Pages',
        'action' => 'display'
      ]
    ]);
    $this->set('authUser', $this->Auth->user());
  }

  /*
  * Função que retorna se um usuario é admin ou não
  * Caso receba true como parametro, ela irá redirecionar o usuario(caso ele não seja admin)
  * Função no nivel dos controllers
  */

  public function isAdmin($redirecionar = true) {
    $user = ($this->Auth->user()) ? $this->Auth->user() : null;

    if (($user['role'] === 'admin')) {
      return true;
    }
    if ($redirecionar) {
      return $this->redirect(
        array('controller' => 'Pages',
        'action' => 'display'));
      }
      else {
        return false;
      }
    }

    /**
    * Before render callback.
    *
    * @param \Cake\Event\Event $event The beforeRender event.
    * @return \Cake\Network\Response|null|void
    */
    public function beforeRender(Event $event) {
      if (!array_key_exists('_serialize', $this->viewVars) &&
      in_array($this->response->type(), ['application/json', 'application/xml'])
    ) {
      $this->set('_serialize', true);
    }
  }

  /*
  * Filtro para autorização
  */

  public function beforeFilter(Event $event) {
    $this->Auth->deny(['add', 'edit', 'delete']);
    $this->Auth->allow(['index', 'display', 'view','visitas','eventos']);
  }

}
