<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>

<table class="adminlist">
<thead class="noprint">
<tr class="shortprint">  
  <th >Fecha </th>
  <th style="width:60%;" >Nro. Recibo</th>
  <th >Monto</th>  
</tr>
</thead>
<tbody>
<?php  $k = 0;  $total = 0; $a = 2;?>
<?php  foreach ($receipts as $receipt): ?>  
    <tr class="<?php echo "row".$k+$a ?>">
     <td >
	<?php echo format_date($receipt->getCreatedAt(), "d") ?>
     </td>
     <td class="font_bold font_14" style="text-align: center;">
	<a href="/receipt/show/id/<?php echo $receipt->getId(); ?>/idc/<?php echo $contract->getId() ?>" >
	   <?php echo $receipt->getId(); ?>
	</a>
     </td>
     <td style="text-align: right;">
	<?php $total += $receipt->getTotal();?>
	<?php echo numbers::my_format_number($receipt->getTotal())?>
     </td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>

</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" ><?php echo 'Total' ?></th>
  <th style="text-align: right;"> </th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>  
</tfoot>
</table>