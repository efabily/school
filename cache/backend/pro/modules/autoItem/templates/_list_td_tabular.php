<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Item->getId(), 'item_edit', $Item) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Item->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Item->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Item->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_price">
  <?php echo $Item->getPrice() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_alter_price">
  <?php echo $Item->getAlterPrice() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_quantity_load">
  <?php echo $Item->getQuantityLoad() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name_load">
  <?php echo $Item->getNameLoad() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_type_item_id">
  <?php echo $Item->getTypeItemId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $Item->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Item->getCreatedAt()) ? format_date($Item->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Item->getUpdatedAt()) ? format_date($Item->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
