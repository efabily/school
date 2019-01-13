<?php use_helper('Date', 'Pager', 'I18N', 'jQuery', 'MyJavascript') ?>
<table class="adminlist">
<thead>
<tr>
  <th style="width: 120px;">Nro.</th>
  <th style="width: 120px;">Tipo de Movimiento</th>
  <th>Comentario</th>
  <th style="width: 120px;" >Tipo de Pago</th>
  <th style="width: 100px;" >Monto</th>
  <th>Aprobado por:</th>  
  <th>Creado el</th>
</tr>
</thead>
<tbody>
<?php foreach ($opening_amount as $opening): ?>
  <tr class="<?php echo "row1"; ?>">
     <td style="text-align: left">
          <?php echo jq_link_to_remote(
			$opening->getTransfer()->getId(),
                        array(                                
			  'url' => '/cashbox/billets?id='.$opening->getTransfer()->getId(),
			  'update' => array('success' => 'movement_'.$opening->getId())
                        )
                  );?>
      </td>
      <td style="text-align: center">
          <?php echo $opening->getTransfer()->getTypeName(); ?>
      </td>
      <td><?php echo $opening->getTransfer()->getComment() ?></td>
      <td style="text-align: left">
          <?php echo $opening->getMovementCashbox()->getPaymentType()->getFullName() ?>
      </td>
      <td style="text-align: left">
          <?php echo jq_link_to_remote(
			numbers::my_format_number($opening->getMovementCashbox()->getSum()),
                        array(                                
			  'url' => '/cashbox/billets?id='.$opening->getTransfer()->getId(),
			  'update' => array('success' => 'movement_'.$opening->getId())
                        )
                  );?>
      </td>
      <td style="text-align: left">
          <?php echo $opening->getTransfer()->getsfGuardUser()->getUsername()?>
      </td>      
      <td style="text-align: left">	 
	 <?php echo format_date($opening->getCreatedAt(), 'g') ?>
      </td>
  </tr>
  <tr>
    <td colspan="7">
      <div id="movement_<?php echo $opening->getId() ?>"></div>
    </td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>