<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array('pp' => 'btnSave'),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array('pp' => 'btnSaveAdd'),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
<?php else: ?>
  <?php // echo $helper->linkToDelete($form->getObject(), array(  'params' =>   array(  ),  'confirm' => 'Are you sure?',  'class_suffix' => 'delete',  'label' => 'Delete',)) ?>
  <?php echo $helper->linkToList(array(  'params' =>   array(  ),  'class_suffix' => 'list',  'label' => 'Back to list',)) ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'params' =>   array('pp' => 'btnSave'),  'class_suffix' => 'save',  'label' => 'Save',)) ?>
  <?php echo $helper->linkToSaveAndAdd($form->getObject(), array(  'params' =>   array('pp' => 'btnSaveAdd'),  'class_suffix' => 'save_and_add',  'label' => 'Save and add',)) ?>
<?php endif; ?>
</ul>

<script>
jQuery(function($){
   $("form").submit(function(){
      $(".sf_admin_action_save input, .sf_admin_action_save_and_add input").attr("disabled", "disabled");
   });
});
</script>
