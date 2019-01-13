<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>
<?php if(count($items_charged) > 0): ?>

<table class="adminlist">
<thead class="noprint">
<tr class="shortprint">
  <th> Pagar </th>
  <th> </th>
  <th> </th>
  <th style="width: 150px;">Item </th>
  <th>Fecha</th>
  <th>Cantidad</th>
  <th>Precio</th>
  <th>Descuento</th>
  <th>Sub Total</th>
  <th>Pagado</th>
  <th>Deuda</th>
</tr>
</thead>
<tbody>
<?php  $total_cantidad = $total_descuento = $total_precio = $total_pagado = $total_deuda = 0;?>
<?php  $k = 0;  $total = 0; $a = 2;?>
<?php
   foreach ($items_charged as $item):
      $q = (double)$item->getQuantity();
      $p = (double)$item->getPrice();
      $d = (double)$item->getDiscount();
      $pago = (double) $item->getSales()->getTotalSaleDeposit();
      $deuda = (double) $item->getSales()->getSaldoByDeposit();

      $total_cantidad += $q;
      $total_precio += $p;
      $total_descuento += $d;
      $total_pagado += $pago;
      $total_deuda += $deuda;

      $td = ($q * ($p - $d));

      $total += $td;

      $isPayAccount = $item->getSales()->getIsPayAccount(); // Verificamos si el item no esta pagado

      if($isPayAccount)
      {
	 if($item->getItem()->getTypeItemId() == 2) // si es mensualidad
	 {
	    // Obtengo el año del periodo del contrato actual
	    $period_year = $account->getContract()->getPeriod()->getFromDate('Y');

	    // este metodo nos devuelve el total en mora, dias y fecha
	    // comment $arr_mora 14-01-2014

	    if($account->getContract()->getPeriod()->getId() == 1)
	    {
	    	$arr_mora = mora::calcMora($account->getNumber(), $period_year, $item->getSales()->getSaldoByDeposit());
	    }
	    else
	    {
	    	$arr_mora = array();
	    }

	    if(count($arr_mora) > 0)
	    {
	    	$precio = $arr_mora[0];
	    	$dias = $arr_mora[1];
	    	$expiration_date = $arr_mora[2];

	    	if($precio > 0 && $dias > 0)
	    	{
	    		// devuelte todas las moras que ya han sido pagadas
	    		$item_for_sale_completados = AccountPeer::getMora($account->getId(), 3, 1);
	    		foreach ($item_for_sale_completados as $item_for_sale_completado)
	    		{
	    			$arr_name = explode(' ', $item_for_sale_completado->getName());
	    			$dias = $dias - $arr_name[1];
	    			$precio = $precio - $item_for_sale_completado->getSales()->getTotalPrice();
	    		}

	    		if($precio > 0 && $dias > 0)
	    		{
	    			$account->saveMora($precio, $dias);

	    			$array['expiration_date'] = $expiration_date;
	    			$json_aditionali_information = json_encode($array);
	    			$item->setAdditionalInformation($json_aditionali_information);
	    			$item->save();
	    		}
	    	}
	    }

	 }
      }
   ?>
    <tr class="<?php echo "row".$k+$a ?>">
       <td>
	  <?php if($isPayAccount): ?>
	      <input class="jq_item"
		 onclick="toPay(this)"
		 name="item_<?php echo $account->getId();?>"
		 id="item_<?php echo $item->getSalesId();?>"
		 type="checkbox"
		 value="<?php echo $item->getSalesId() ?>"
		 data-account="<?php echo $account->getId(); ?>"
		 />
	  <?php  endif; ?>
       </td>
       <td>

       </td>
      <td style="width: 20px;">
	  <?php if($item->getSales()->getIsNotPay()): ?>

	     <?php echo link_to_remote_multiple(image_tag('actions/remove_one_big.png'), array(
	      'url'      => '/Student/delItem?id='.$item->getId().'&ida='.$account->getId(),
	      'update'   => array('success' => 'items_list'),
	      ),
	     array(
	       'url' => '/Student/listItemsCharged?ida='.$account->getId(),
	       'update'   => array('success' => 'totals')
	     ))  ?>

	 <?php  endif; ?>
     </td>

     <td style="width:55%"><?php  echo $item->getName() ?></td>
     <td style="text-align: right; width:15%"><?php echo format_date($item->getCreatedAt(), "d") ?></td>
     <td class="font_bold font_14" style="text-align: center;  width:15%"><?php echo $q ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($p) ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($d) ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($td); ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($pago); ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($deuda); ?></td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>
</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" colspan="4">Totales</th>
  <th style="text-align: center;" > </th>
  <th style="text-align: center;"><?php echo $total_cantidad ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total_precio) ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total_descuento) ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total_pagado) ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total_deuda) ?></th>
</tfoot>
</table>
<?php endif; ?>