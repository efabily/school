<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Cashbox->getId(), 'cashbox_edit', $Cashbox) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Cashbox->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $Cashbox->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Cashbox->getCreatedAt()) ? format_date($Cashbox->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Cashbox->getUpdatedAt()) ? format_date($Cashbox->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_closing_date">
  <?php echo false !== strtotime($Cashbox->getClosingDate()) ? format_date($Cashbox->getClosingDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_comment">
  <?php echo $Cashbox->getComment() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_superviser_id">
  <?php echo $Cashbox->getSuperviserId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_cashier_id">
  <?php echo $Cashbox->getCashierId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_night_audit_id">
  <?php echo $Cashbox->getNightAuditId() ?>
</td>
