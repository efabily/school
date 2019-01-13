<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Student->getId(), 'student_edit', $Student) ?>
</td>
<!--<td class="sf_admin_text sf_admin_list_td_id_state">-->
  <?php // echo $Student->getStateName() ?>
<!--</td>-->
<td class="sf_admin_text sf_admin_list_td_first_name">
  <?php echo $Student->getFirstName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_father_name">
  <?php echo $Student->getFatherName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_mother_name">
  <?php echo $Student->getMotherName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_rude">
  <?php echo $Student->getRude() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_codigo">
  <?php echo $Student->getCodigo() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">   
   <?php echo false !== strtotime($Student->getCreatedAt()) ? format_date($Student->getCreatedAt(), "I") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Student->getUpdatedAt()) ? format_date($Student->getUpdatedAt(), "I") : '&nbsp;' ?>
</td>
