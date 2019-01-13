<td>
  <ul class="sf_admin_td_actions">
    <?php echo $helper->linkToEdit($Discount, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php //echo $helper->linkToDelete($Discount, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
     <?php if($Discount->getIdState() == 1): ?>
        <?php echo link_to('Activar', '/Discount/change/id/'.$Discount->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($Discount->getIdState() == 2): ?>
        <?php echo link_to('Inactivar', '/Discount/change/id/'.$Discount->getId().'?s=3', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($Discount->getIdState() == 3): ?>
        <?php echo link_to('Activar', '/Discount/change/id/'.$Discount->getId().'?s=2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
  </ul>
</td>
