<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Discount->getId(), 'discount_edit', $Discount) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Discount->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Discount->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_discount">
  <?php echo $Discount->getDiscount() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Discount->getDescription() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Discount->getCreatedAt()) ? format_date($Discount->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Discount->getUpdatedAt()) ? format_date($Discount->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $Discount->getDeletedBy() ?>
</td>
