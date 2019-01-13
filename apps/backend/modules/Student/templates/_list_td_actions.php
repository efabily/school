<td>
  <ul class="sf_admin_td_actions">
    <?php if($Student->isInscrito($period_id)):?>
      <?php  echo link_to('Cuentas', '/Student/account/id/'.$Student->getId(), array('class_suffix' => 'edit', 'label' => 'Edit',)) ?>
      <?php echo $helper->linkToEdit($Student, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
      <?php  echo link_to('Rude', '/rude.php?id='.$Student->getId().'&p='.$period_id, array('class_suffix' => 'edit', 'label' => 'Edit', 'target' => '_blank')) ?>
    <?php  endif; ?>
     
    <?php  if(!$Student->isInscrito($period_id) && !$Student->isInscritoCurrentPeriod()):?>
      <?php  echo link_to('Inscribir', '/Student/'.$Student->getId().'/recordShortEnroll', array('class_suffix' => 'edit', 'label' => 'Edit',)) ?>
    <?php  endif; ?>
    <?php if(!$Student->getIsPayByContract()):?>
      <li class="sf_admin_action_delete">
          <a onclick="return confirm('Confirma que desea eliminar?')" class="delete" href="/Student/delete/id/<?php echo $Student->getId() ?>"  >Borrar</a>
      </li>
     <?php //echo $helper->linkToDelete($Student, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
    <?php  endif; ?>
  </ul>
</td>