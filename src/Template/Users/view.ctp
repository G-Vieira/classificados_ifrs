<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
<nav class="col-md-3" id="actions-sidebar">
    <ul class="nav nav-pills nav-stacked">
        <li class="heading"><?= __('Ações') ?></li>
        <?php
          if($authUser['role'] == 'admin' || $authUser['id'] == $user->id){
            echo '<li>' . $this->Html->link(__('Editar Usuário'), ['action' => 'edit', $user->id]) . '</li>';
          }
        
        if($authUser['role'] == 'admin'){
            echo '<li>' . $this->Form->postLink(
                    __('Deletar'),
                    ['action' => 'delete', $user->id],
                    ['confirm' => __('Deseja deletar # {0}?', $user->id)]
                ) .
            '</li>';
          }
        ?>      
        <li><?= $this->Html->link(__('Listar Usuário'), ['action' => 'index']) ?> </li>
    </ul>
</nav>
<div class="col-md-9">
    <h3><?= h($user->id) ?></h3>
    <table class="table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($user->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cidade') ?></th>
            <td><?= $this->Number->format($user->cidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
