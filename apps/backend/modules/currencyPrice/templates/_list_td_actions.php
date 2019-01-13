<td>
  <ul class="sf_admin_td_actions">
     <?php if($CurrencyPrice->getIdState() == 1): ?>
        <?php echo $helper->linkToEdit($CurrencyPrice, array(  'params' =>   array(  ),  'class_suffix' => 'edit',  'label' => 'Edit',)) ?>
        <?php echo link_to('Activar', '/currencyPrice/change/id/'.$CurrencyPrice->getId().'/s/2', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>
     <?php if($CurrencyPrice->getIdState() == 2): ?>
        <?php echo link_to('Inactivar', '/currencyPrice/change/id/'.$CurrencyPrice->getId().'/s/3', array('confirm' => 'Esta seguro(a)?', 'class_suffix' => 'delete', 'label' => 'Delete',)) ?>
     <?php endif; ?>     
  </ul>
</td>
