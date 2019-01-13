<td>
  <ul class="sf_admin_td_actions">     
     <?php if(!$Student->getActive()):?>
      <?php // echo $helper->linkTo('', array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
      <?php echo link_to('Inscribir', '/Student/enroll/id/'.$Student->getId(), array('class_suffix' => 'edit', 'label' => 'Edit',)) ?>
     <?php endif; ?>
    <?php echo $helper->linkToEdit($Student, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
    <?php echo $helper->linkToDelete($Student, array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  </ul>
</td>
