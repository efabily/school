<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/28 22:29:40
?>
  <th id="sf_admin_list_th_firstname">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'first_name'): ?>
    <?php echo link_to(__('First Name'), 'sfGuardUser/list?sort=first_name&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
    (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
    <?php else: ?>
    <?php echo link_to(__('First Name'), 'sfGuardUser/list?sort=first_name&type=asc') ?>
    <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_username">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'username'): ?>
      <?php echo link_to(__('Username'), 'sfGuardUser/list?sort=username&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Username'), 'sfGuardUser/list?sort=username&type=asc') ?>
      <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_username">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'possition'): ?>
      <?php echo link_to(__('Possition'), 'sfGuardUser/list?sort=possition&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Possition'), 'sfGuardUser/list?sort=possition&type=asc') ?>
      <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_username">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'block'): ?>
      <?php echo link_to(__('Blocked'), 'sfGuardUser/list?sort=block&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Blocked'), 'sfGuardUser/list?sort=block&type=asc') ?>
      <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_username">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'is_active'): ?>
      <?php echo link_to(__('Active'), 'sfGuardUser/list?sort=is_active&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Active'), 'sfGuardUser/list?sort=is_active&type=asc') ?>
      <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_last_login">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'last_login'): ?>
      <?php echo link_to(__('Last login'), 'sfGuardUser/list?sort=last_login&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Last login'), 'sfGuardUser/list?sort=last_login&type=asc') ?>
      <?php endif; ?>
          </th>
  <?php if($sf_user->getAttribute('admin_show')): ?>
  <th id="sf_admin_list_th_created_at">
          <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'created_at'): ?>
      <?php echo link_to(__('Created at'), 'sfGuardUser/list?sort=created_at&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
      <?php else: ?>
      <?php echo link_to(__('Created at'), 'sfGuardUser/list?sort=created_at&type=asc') ?>
      <?php endif; ?>
          </th>
  <th id="sf_admin_list_th_updated_at">
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'updated_at'): ?>
    <?php echo link_to(__('Updated at'), 'sfGuardUser/list?sort=updated_at&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
    (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
    <?php else: ?>
    <?php echo link_to(__('Updated at'), 'sfGuardUser/list?sort=updated_at&type=asc') ?>
    <?php endif; ?>
  </th>
  <th id="sf_admin_list_th_id">
     <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort') == 'id'): ?>
    <?php echo link_to(__('Id'), 'sfGuardUser/list?sort=id&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort') == 'asc' ? 'desc' : 'asc')) ?>
    (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/sf_guard_user/sort')) ?>)
    <?php else: ?>
    <?php echo link_to(__('Id'), 'sfGuardUser/list?sort=id&type=asc') ?>
    <?php endif; ?>
  </th>
  <?php endif; ?>
