<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sugesto $sugesto
 */
?>
<div class="row">
  <div class="col-md-3" id="actions-sidebar">
       <ul class="side-nav">
           <li class="heading"><?= __('Ações') ?></li>
           <li><?= $this->Html->link(__('Sugestoes'), ['action' => 'index']) ?></li>
       </ul>
  </div>
  <div class="col-md-9 text-center">
      <h3><?= h($sugesto->id) ?></h3>
      <table class="table">
          <tr>
              <th scope="row"><?= __('User') ?></th>
              <td><?= $sugesto->has('user') ? $this->Html->link($sugesto->user->id, ['controller' => 'Users', 'action' => 'view', $sugesto->user->id]) : '' ?></td>
          </tr>
          <tr>
              <th scope="row"><?= __('Id') ?></th>
              <td><?= $this->Number->format($sugesto->id) ?></td>
          </tr>
      </table>
      <div class="row">
          <h4><?= __('Sugestão') ?></h4>
          <?= $this->Text->autoParagraph(h($sugesto->comentario)); ?>
      </div>
  </div>
</div>