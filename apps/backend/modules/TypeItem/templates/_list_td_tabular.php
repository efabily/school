<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($TypeItem->getId(), 'type_item_edit', $TypeItem) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $TypeItem->getNameState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $TypeItem->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $TypeItem->getDescription() ?>
</td>
