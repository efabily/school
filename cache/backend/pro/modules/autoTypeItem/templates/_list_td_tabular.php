<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($TypeItem->getId(), 'type_item_edit', $TypeItem) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $TypeItem->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $TypeItem->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($TypeItem->getCreatedAt()) ? format_date($TypeItem->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($TypeItem->getUpdatedAt()) ? format_date($TypeItem->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $TypeItem->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $TypeItem->getDescription() ?>
</td>
