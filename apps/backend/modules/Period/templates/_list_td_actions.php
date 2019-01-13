<td>
  <ul class="sf_admin_td_actions">
    
    <?php //echo $helper->linkToDelete($Period, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
      <?php if($Period->getIdState() == 1): ?>
        <?php echo $helper->linkToEdit($Period, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php echo link_to('Activar', '/Period/change/id/'.$Period->getId().'/s/2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($Period->getIdState() == 2): ?>
        <?php echo link_to('Inactivar', '/Period/change/id/'.$Period->getId().'/s/3', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
  </ul>
</td>