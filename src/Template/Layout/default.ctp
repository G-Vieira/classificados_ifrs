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

  $cakeDescription = 'Classificados Ifrs';
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

    <!-- $this->Html->css('base.css')
      $this->Html->css('cake.css') -->
      <?= $this->Html->css('bootstrap.min.css'); ?>
      <?= $this->Html->css('smartmenu.css'); ?>
      <?= $this->Html->css('jquery.smartmenus.bootstrap.css'); ?>
      <?= $this->Html->css('app.css'); ?>

      <?= $this->Html->script('jquery.js') ?>
      <?= $this->Html->script('bootstrap.min.js') ?>
      <?= $this->Html->script('jquery.smartmenus.min.js') ?>
      <?= $this->Html->script('jquery.smartmenus.bootstrap.min.js') ?>
      <?= $this->Html->script('ahoy.js') ?>
      <?= $this->Html->script('app.js') ?>

      <?= $this->fetch('meta') ?>
      <?= $this->fetch('css') ?>
      <?= $this->fetch('script') ?>
    </head>
    <body>
      <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
           <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="/" >IFRS</a>
       </div>
       <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-left">
           <?php
           if($authUser){
            echo "
            <li>
            <a href='javascript:void(0);'><label>Olá, " . $authUser['username'] . "<span class='caret'></span></label></a>
            <ul class='dropdown-menu '>
            <li>".$this->Html->link(__('Perfil'), ['controller' => 'users', 'action' => 'view', $authUser['id']])."</li>
            <li>".$this->Html->link(__('Sair'), ['controller' => 'users', 'action' => 'logout'])."</li>
            </ul>
            </li>
            ";
          }else{
           //echo "<li>" . $this->Html->link(__('Registrar-se'), ['controller' => 'users', 'action' => 'register'])  . "</li>";
           echo "<li>" . $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login'])  . "</li>";
         }
         ?>
         <form data-section="campo_busca" class="navbar-form navbar-left" method="post" action="<?= $this->Url->build(["controller" => "Anuncios","action" => "pesquisar"]); ?>">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Pesquisar anúncios" name="pesquisa">
          </div>
          <button type="submit" class="btn btn-default">Procurar</button>
        </form>
      </ul>
      <ul class="nav navbar-nav navbar-right" data-section="acoes_busca">
        <li style="padding: 8px 8px;"><button class="btn btn-default" id="acao_busca">Iniciar Busca</button></li>
      </ul>
      <ul class="nav navbar-nav navbar-right" data-section="filtros">
       <li><?= $this->Html->link(__('Anúncios'), ['controller' => 'anuncios']) ?></li>
       <li><?= $this->Html->link(__('Categorias'), ['controller' => 'categorias']) ?></li>
       <li><?= ($authUser)?($this->Html->link(__('Sugestões'), ['controller' => 'sugestoes', 'action' => 'add'])):'' ?></li>
       <li><?= ($authUser['role'] === 'admin')? ($this->Html->link(__('Usuarios'), ['controller' => 'Users', 'action' => 'index'])): ''?></li>
      
     </ul> 
   </div><!--/.nav-collapse -->
 </div>
 <?= $this->Flash->render() ?>
 <div class="container-fluid">
  <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
