<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Period->getId(), 'period_edit', $Period) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Period->getNameState() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $Period->getName() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_from_date">
  <?php echo false !== strtotime($Period->getFromDate()) ? format_date($Period->getFromDate(), "P") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_to_date">
  <?php echo false !== strtotime($Period->getToDate()) ? format_date($Period->getToDate(), "P") : '&nbsp;' ?>
</td>
