<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/28 22:29:39
?>
<table class="toolbar">
  <tr>
    <?php if($pass): ?>
      <td class="button" id="toolbar-cancel">
        <a href="#" onclick="javascript: document.forms.sf_admin_edit_form.do_after.value='save';document.forms.sf_admin_edit_form.submit()" class="toolbar">
        <span class="icon-32-save" title="<?php echo __('Save') ?>">
        </span> <?php echo __('Save') ?> </a>
      </td>
    <?php else: ?>
      <?php include_partial('edit_actions_complete', array('sf_guard_user' => $sf_guard_user)) ?>
      <td class="button" id="toolbar-cancel">
        <?php echo link_to('<span class="icon-32-cancel" title="'.__('Cancel').'"> </span>'.__('Cancel'), 'sfGuardUser/list', array('class'=>'toolbar')) ?>
      </td>
    <?php endif; ?>
  </tr>
</table>