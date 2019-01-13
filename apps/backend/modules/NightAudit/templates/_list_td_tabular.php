<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo $NightAudit->getId() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($NightAudit->getDate()) ? format_date($NightAudit->getDate(), "P") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($NightAudit->getCreatedAt()) ? format_date($NightAudit->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo $NightAudit->getSfGuardUser()->getUsername() ?>
</td>
