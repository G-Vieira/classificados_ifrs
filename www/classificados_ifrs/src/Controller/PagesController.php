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

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;

/**
* Static content controller
*
* This controller will render views from Template/Pages/
*
* @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
*/
class PagesController extends AppController {

  /**
  * Displays a view
  *
  * @param array ...$path Path segments.
  * @return \Cake\Http\Response|null
  * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
  * @throws \Cake\Network\Exception\NotFoundException When the view file could not
  *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
  */
  public function display(...$path) {
    $count = count($path);
    if (!$count) {
      return $this->redirect('/');
    }
    if (in_array('..', $path, true) || in_array('.', $path, true)) {
      throw new ForbiddenException();
    }
    $page = $subpage = null;

    if (!empty($path[0])) {
      $page = $path[0];
    }
    if (!empty($path[1])) {
      $subpage = $path[1];
    }

    $categorias = $this->get_categorias();
    $anuncios = $this->get_anuncios();
    $favoritos = null;
    if($this->Auth->user()){
      $favoritos = $this->get_favoritos();
    }

    $this->set(compact('page', 'subpage', 'categorias', 'anuncios', 'favoritos'));

    try {
      $this->render(implode('/', $path));
    } catch (MissingTemplateException $exception) {
      if (Configure::read('debug')) {
        throw $exception;
      }
      throw new NotFoundException();
    }
  }

  private function get_anuncios() {
    $temp = TableRegistry::get('Anuncios');
    return $temp->find('all', array(
      'conditions' => array(
        "Anuncios.id  IN " => [1,5,10,15,20,25,30,35,40,100,120,125,127,150,151,152,160,165,170,200,210,215,267,289,300,330,352,400,504,510,580,600,610,670,700,1119,1171]
      )
    ));
  }

  private function get_favoritos() {
    $temp = TableRegistry::get('Anuncios');
    return $temp->find('all', array(
      'join' => [
         'table' => 'favoritos',
         'type' => 'inner',
         'conditions' => 'favoritos.categoria_id = Anuncios.categoria_id'
      ],
      'conditions' => [
        'favoritos.user_id = ' . $this->Auth->user()['id']
        ],
      'limit' => 5,
      'order' => 'Anuncios.created DESC'

    ));
  }

  private function get_categorias() {
    $temp = TableRegistry::get('Categorias');
    return $temp->find('all',[
      'conditions' => ['Categorias.parent_id is null']
    ]);
  }

  public function sobre(){

  }

}
