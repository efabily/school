<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/28 22:29:39
?>
<?php if ($sf_request->hasErrors()): ?>
<div id="sf_admin_container">
<div id="sf_admin_header">
<div class="form-errors">
<h2><?php echo __('There are some errors that prevent the form to validate') ?></h2>
<dl>
<?php foreach ($sf_request->getErrorNames() as $name): ?>
  <dt><?php echo __($labels[$name]) ?></dt>
  <dd><?php echo $sf_request->getError($name) ?></dd>
<?php endforeach; ?>
</dl>
</div>
</div>
</div>
<?php elseif ($sf_flash->has('notice')): ?>
<div id="sf_admin_container">
<div class="save-ok">
<h2><?php echo __($sf_flash->get('notice')) ?></h2>
</div>
</div>
<?php endif; ?>
