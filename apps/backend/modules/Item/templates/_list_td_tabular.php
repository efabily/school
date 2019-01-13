<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Item->getId(), 'item_edit', $Item) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Item->getNameState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Item->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Item->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_price">
  <?php echo numbers::my_format_number($Item->getPrice()) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_type_item_id">
  <?php echo $Item->getTypeItem()->getName() ?>
</td>
