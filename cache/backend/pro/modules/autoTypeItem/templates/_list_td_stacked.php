<td colspan="7">
  <?php echo __('%%id%% - %%id_state%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%name%% - %%description%%', array('%%id%%' => link_to($TypeItem->getId(), 'type_item_edit', $TypeItem), '%%id_state%%' => $TypeItem->getIdState(), '%%deleted_by%%' => $TypeItem->getDeletedBy(), '%%created_at%%' => false !== strtotime($TypeItem->getCreatedAt()) ? format_date($TypeItem->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($TypeItem->getUpdatedAt()) ? format_date($TypeItem->getUpdatedAt(), "f") : '&nbsp;', '%%name%%' => $TypeItem->getName(), '%%description%%' => $TypeItem->getDescription()), 'messages') ?>
</td>
