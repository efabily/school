<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($CurrencyPrice->getId(), 'currency_price_edit', $CurrencyPrice) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $CurrencyPrice->getIdState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $CurrencyPrice->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($CurrencyPrice->getCreatedAt()) ? format_date($CurrencyPrice->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($CurrencyPrice->getUpdatedAt()) ? format_date($CurrencyPrice->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference">
  <?php echo $CurrencyPrice->getReference() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sale">
  <?php echo $CurrencyPrice->getSale() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_purchase">
  <?php echo $CurrencyPrice->getPurchase() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_since_date">
  <?php echo false !== strtotime($CurrencyPrice->getSinceDate()) ? format_date($CurrencyPrice->getSinceDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_until_date">
  <?php echo false !== strtotime($CurrencyPrice->getUntilDate()) ? format_date($CurrencyPrice->getUntilDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_currency_id">
  <?php echo $CurrencyPrice->getCurrencyId() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo $CurrencyPrice->getUserId() ?>
</td>
