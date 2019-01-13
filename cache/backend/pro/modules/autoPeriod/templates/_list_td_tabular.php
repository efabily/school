<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Period->getId(), 'period_edit', $Period) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Period->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Period->getName() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_from_date">
  <?php echo false !== strtotime($Period->getFromDate()) ? format_date($Period->getFromDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_to_date">
  <?php echo false !== strtotime($Period->getToDate()) ? format_date($Period->getToDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $Period->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Period->getCreatedAt()) ? format_date($Period->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Period->getUpdatedAt()) ? format_date($Period->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
