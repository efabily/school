<td colspan="9">
  <?php echo __('%%id%% - %%id_state%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%closing_date%% - %%comment%% - %%cashier_id%% - %%night_audit_id%%', array('%%id%%' => link_to($Cashbox->getId(), 'cashbox_edit', $Cashbox), '%%id_state%%' => $Cashbox->getIdState(), '%%deleted_by%%' => $Cashbox->getDeletedBy(), '%%created_at%%' => false !== strtotime($Cashbox->getCreatedAt()) ? format_date($Cashbox->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($Cashbox->getUpdatedAt()) ? format_date($Cashbox->getUpdatedAt(), "f") : '&nbsp;', '%%closing_date%%' => false !== strtotime($Cashbox->getClosingDate()) ? format_date($Cashbox->getClosingDate(), "f") : '&nbsp;', '%%comment%%' => $Cashbox->getComment(), '%%cashier_id%%' => $Cashbox->getCashierId(), '%%night_audit_id%%' => $Cashbox->getNightAuditId()), 'messages') ?>
</td>
