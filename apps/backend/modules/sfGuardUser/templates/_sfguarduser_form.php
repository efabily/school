<tr>
  <td width="100" class="key"><?php echo __('Username') ?>:</td>
  <td>
  <?php if ($sf_request->hasError('sf_guard_user{username}')): ?>
    <?php echo form_error('sf_guard_user{username}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = object_input_tag($sf_guard_user, 'getUsername', array (
  'size' => 30,
  'control_name' => 'sf_guard_user[username]',
)); echo $value ? $value : '&nbsp;' ?>
  </td>
</tr>
<?php if($pass): ?>
  <tr>
    <td width="100" class="key"><?php echo __('Password') ?>:</td>
    <td>
    <?php if ($sf_request->hasError('sf_guard_user{password_old}')): ?>
      <?php echo form_error('sf_guard_user{password_old}', array('class' => 'form-error-msg')) ?>
    <?php endif; ?>

    <?php $value = get_partial('password_old', array('type' => 'edit', 'sf_guard_user' => $sf_guard_user)); echo $value ? $value : '&nbsp;' ?>
    </td>
  </tr>
<?php endif; ?>
<tr>
  <td width="100" class="key"><?php if($pass) { echo __('New Password'); } else { echo __('Password'); } ?>:</td>
  <td>
<?php if ($sf_request->hasError('sf_guard_user{password}')): ?>
    <?php echo form_error('sf_guard_user{password}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('password', array('type' => 'edit', 'sf_guard_user' => $sf_guard_user)); echo $value ? $value : '&nbsp;' ?>
  </td>
</tr>
<tr>
  <td width="100" class="key"><?php if($pass) { echo __('New Password bis'); } else { echo __('Password bis'); } ?>:</td>
  <td>
  <?php if ($sf_request->hasError('sf_guard_user{password_bis}')): ?>
    <?php echo form_error('sf_guard_user{password_bis}', array('class' => 'form-error-msg')) ?>
  <?php endif; ?>

  <?php $value = get_partial('password_bis', array('type' => 'edit', 'sf_guard_user' => $sf_guard_user)); echo $value ? $value : '&nbsp;' ?>
  </td>
</tr>