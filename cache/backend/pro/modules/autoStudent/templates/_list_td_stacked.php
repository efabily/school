<td colspan="13">
  <?php echo __('%%id%% - %%id_state%% - %%first_name%% - %%father_name%% - %%mother_name%% - %%rude%% - %%codigo%% - %%birth_date%% - %%email%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%person_id%%', array('%%id%%' => link_to($Student->getId(), 'student_edit', $Student), '%%id_state%%' => $Student->getIdState(), '%%first_name%%' => $Student->getFirstName(), '%%father_name%%' => $Student->getFatherName(), '%%mother_name%%' => $Student->getMotherName(), '%%rude%%' => $Student->getRude(), '%%codigo%%' => $Student->getCodigo(), '%%birth_date%%' => false !== strtotime($Student->getBirthDate()) ? format_date($Student->getBirthDate(), "f") : '&nbsp;', '%%email%%' => $Student->getEmail(), '%%deleted_by%%' => $Student->getDeletedBy(), '%%created_at%%' => false !== strtotime($Student->getCreatedAt()) ? format_date($Student->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($Student->getUpdatedAt()) ? format_date($Student->getUpdatedAt(), "f") : '&nbsp;', '%%person_id%%' => $Student->getPersonId()), 'messages') ?>
</td>
