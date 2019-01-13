<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Discount->getId(), 'discount_edit', $Discount) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Discount->getNameState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Discount->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_discount">
  <?php echo $Discount->getDiscount().' %' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $Discount->getDescription() ?>
</td>
