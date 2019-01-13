<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($Student->getId(), 'student_edit', $Student) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_id_state">
  <?php echo $Student->getIdState() ?>
</td>
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
<td class="sf_admin_date sf_admin_list_td_birth_date">
  <?php echo false !== strtotime($Student->getBirthDate()) ? format_date($Student->getBirthDate(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $Student->getEmail() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_deleted_by">
  <?php echo $Student->getDeletedBy() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($Student->getCreatedAt()) ? format_date($Student->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($Student->getUpdatedAt()) ? format_date($Student->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_person_id">
  <?php echo $Student->getPersonId() ?>
</td>
