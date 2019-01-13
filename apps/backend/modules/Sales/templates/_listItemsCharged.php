<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>
<fieldset class="adminform">
  <legend><?php echo 'Items cargados' ?></legend>

<table class="adminlist">
<thead class="noprint">
<tr class="shortprint">  
  <th> </th>
  <th>Item </th>
  <th>Cantidad</th>
  <th>Precio</th>
  <th>Sub Total</th>  
</tr>
</thead>
<tbody>
<?php  $k = 0;  $total = 0; $a = 2;?>
<?php if(count($items_charged) > 0): ?>
<?php  foreach ($items_charged as $item): ?>
    <tr class="<?php echo "row".$k+$a ?>">       
      <td style="width: 20px;">         
	 <?php echo link_to_remote_multiple(image_tag('actions/remove_one_big.png'), array(           
	      'url'      => '/Sales/delItem?id='.$item->getId(),
	      'update'   => array('success' => 'list_items_charged'),	      
	      ),
	     array(
	       'url' => '/Sales/pay',
	       'update' => array('success' => 'div_pay')       
	 ))  ?>
     </td>
     
     <td style="width:55%"><?php  echo $item->getName() ?></td>
     <td class="font_bold font_14" style="text-align: center;  width:15%"><?php  echo $item->getQuantity() ?></td>
     <td style="text-align: right; width:15%"><?php echo numbers::my_format_number($item->getPrice()) ?></td>
     <td style="text-align: right; width:15%"><?php $total += $item->getTotalPrice(); echo numbers::my_format_number($item->getTotalPrice()) ?></td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>    
<?php endif; ?>
</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" colspan="<?php echo '3'; ?>"><?php echo 'Total' ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>
  <th style="text-align: right;"></th>  
</tfoot>
</table>

</fieldset>