<?php

  /**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
  </head>
  <body>
    <nav class="top-bar expanded" data-topbar role="navigation">
      <div class="top-bar-section">
	<ul class="left">
	  <li class="name">
                <?php
                  //Se o usuario estiver logado, mostre uma frase de boas-vindas
                  if($authUser){
                    echo "<h1>" . $this->Html->link(__('Olá, ' . $authUser['username']), ['controller' => 'users', 'action' => 'view', $authUser['id']])  . "</h1>";
                  }
                ?>
	  </li>
	</ul>
	<ul class="right">
	  <li class="name">
	    <h1><?= $this->Html->link(__('Home'), ['controller' => 'Pages']	) ?></h1>
	  </li>
	      <?php
                //se o usuario estiver logado, exiba o link para usuarios
                if($authUser['role'] === 'admin') {
                  echo "<li class='name'><h1>" . $this->Html->link(__('Usuarios'), ['controller' => 'Users', 'action' => 'index']) . "</h1></li>";
                }
              ?>
	  <li class="name">
                <?php
                  //se o usuario estiver logado, exiba o link para sair, senão exiba o link para entrar
                  if($authUser) {
                    echo $this->Html->image('logout_logo.png', array(
                        'alt' => 'logout',
                        'url' => array('controller' => 'users', 'action' => 'logout'))
                      );
                  } else {
                    echo $this->Html->image('login_logo.png', array(
                        'alt' => 'login',
                        'url' => array('controller' => 'users', 'action' => 'login'))
                      );
                  }
                ?>
	  </li>          
	</ul>
      </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
  </body>
</html>
