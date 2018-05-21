<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sugesto $sugesto
 */
?>
<div class = "row">
    <div class="col-md-3" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Ações') ?></li>
            <li><?= $this->Html->link(__('Sugestoes'), ['action' => 'index']) ?></li>


        </ul>
    </div>
    <div class="col-md-9 text-center">
        <?= $this->Form->create($sugesto) ?>
        <fieldset>
            <legend><?= __('Adicionar Sugestão') ?></legend>
            <?php
            echo '<input type="hidden" name="user_id" value="' . $authUser['id'] . '">';
            
            ?>
            <div class="form-group row">
               <label for="descricao" class="col-sm-3 col-form-label"><b>Descrição</b></label>
               <div class="col-sm-7">
                 <?= $this->Form->control('comentario',['label'=>false,'class'=>'form-control']) ?>
             </div>
         </div>
         <div class="form-group row">
            <div class="form-group row">
             <button class="btn btn-success" type='submit'>Gravar</button>
         </div>
     </fieldset>

     <?= $this->Form->end() ?>
 </div>
</div>

