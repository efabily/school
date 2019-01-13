<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($Item, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php // echo $helper->linkTo($Item, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
     <?php if($Item->getIdState() == 1): ?>
        <?php echo link_to('Activar', '/Item/change/id/'.$Item->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($Item->getIdState() == 2): ?>
        <?php echo link_to('Inactivar', '/Item/change/id/'.$Item->getId().'?s=3', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($Item->getIdState() == 3): ?>
        <?php echo link_to('Activar', '/Item/change/id/'.$Item->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
  </ul>
</td>
