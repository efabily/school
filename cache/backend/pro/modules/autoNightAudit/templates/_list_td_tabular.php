<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($NightAudit->getId(), 'night_audit_NightAudit_edit', $NightAudit) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $NightAudit->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($NightAudit->getCreatedAt()) ? format_date($NightAudit->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($NightAudit->getUpdatedAt()) ? format_date($NightAudit->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_date">
  <?php echo false !== strtotime($NightAudit->getDate()) ? format_date($NightAudit->getDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo $NightAudit->getUserId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_business_entity_id">
  <?php echo $NightAudit->getBusinessEntityId() ?>
</td>
