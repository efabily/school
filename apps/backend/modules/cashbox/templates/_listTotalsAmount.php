<?php $currencys = $cashbox->getAllCurrencys(); $total_net = 0 ;?>

  <?php foreach ($currencys as $currency): ?>
    <tr>
      <td width="100" class="key">
	 <?php if($currency->getId() == 2): ?>
	    <?php echo __('Total %1%:', array('%1%' => $currency->getName().' ( T/C '.$currency->getActivePurchase().')')) ?>
	 <?php else: ?>
	    <?php echo __('Total %1%:', array('%1%' => $currency->getName())) ?>
	 <?php endif; ?>
      </td>
      <td align="right">
	 <?php $array = $cashbox->getTotalCurrency($currency->getId()); ?>
        
	<strong><?php echo 'Ingreso: '.numbers::my_format_number($array[1]) ?></strong><br />
	<strong><?php echo 'Retiro: - '.numbers::my_format_number($array[2]) ?></strong><br />
	<strong><?php echo 'Diferencia: '.numbers::my_format_number($array[0]) ?></strong>
      </td>
    </tr>
    <?php $total_net = $total_net + ($array[0] * $currency->getActivePurchase()) ?>
  <?php endforeach; ?>

  <?php if ($cashbox->getIdState() == 1): ?>
    <tr>
      <td width="100" class="key">
         Total Neto Bs:
      </td>
      <td align="right">
        <strong><?php echo numbers::my_format_number($total_net) ?></strong>
      </td>
    </tr>
  <?php else: ?>
    <?php if ($total_net > 0): ?>
      <tr>
        <td width="100" class="key">          
          Faltante:          
        </td>
        <td align="right" >
          <strong><?php echo numbers::my_format_number($total_net) ?></strong>
        </td>
      </tr>
    <?php elseif ($total_net <= 0): ?>
      <tr>
        <td width="100" class="key">      
            Sobrante:
            </td>
            <td align="right">
            <strong><?php echo numbers::my_format_number(-1 * $total_net) ?></strong>      
        </td>
      </tr>
    <?php endif; ?>
  <?php endif; ?>