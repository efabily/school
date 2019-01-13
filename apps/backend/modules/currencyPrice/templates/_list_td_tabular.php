<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($CurrencyPrice->getId(), 'currency_price_edit', $CurrencyPrice) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $CurrencyPrice->getNameState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_reference">
  <?php echo $CurrencyPrice->getReference() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_currency_id">
  <?php echo $CurrencyPrice->getCurrency()->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sale">
  <?php echo $CurrencyPrice->getSale() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_purchase">
  <?php echo $CurrencyPrice->getPurchase() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_since_date">
  <?php echo false !== strtotime($CurrencyPrice->getSinceDate()) ? format_date($CurrencyPrice->getSinceDate(), "D") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_until_date">
  <?php echo false !== strtotime($CurrencyPrice->getUntilDate()) ? format_date($CurrencyPrice->getUntilDate(), "D") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_user_id">
  <?php echo $CurrencyPrice->getSfGuardUser()->getUsername() ?>
</td>
