<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($TypeItem, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($TypeItem, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
     <?php if($TypeItem->getIdState() == 1): ?>
        <?php echo link_to('Activar', '/TypeItem/change/id/'.$TypeItem->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($TypeItem->getIdState() == 2): ?>
        <?php echo link_to('Inactivar', '/TypeItem/change/id/'.$TypeItem->getId().'?s=3', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($TypeItem->getIdState() == 3): ?>
        <?php echo link_to('Activar', '/TypeItem/change/id/'.$TypeItem->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
  </ul>
</td>
