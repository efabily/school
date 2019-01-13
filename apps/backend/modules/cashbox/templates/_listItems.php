<?php use_helper('Date', 'Pager', 'I18N', 'jQuery', 'MyJavascript') ?>
<table class="adminlist">
<thead>
<tr>
  <th>
     Item
  </th>
  <th>
     Cantidad
  </th>
  <th>
     Precio
  </th>
  <th>
     Sub Total
  </th>
</tr>
</thead>
<tbody id="f_1">
   <tr><td colspan="4"><a href="javascript:;" onclick="$('.e_1').toggle();$('#f_1').toggle();"><b>MOSTRAR DETALLES</b></a></td></tr>
</tbody>
<tbody>
<?php $total = 0; ?>
<?php foreach ($items_for_sales as $items_for_sale): ?>
  <tr class="<?php echo "row1"; ?> e_1" style="display:none">
      <td style="text-align: left;">
          <?php echo $items_for_sale->getName() ?>
      </td>
      <td>
	<?php echo $items_for_sale->getQuantity() ?>
      </td>
      <td style="text-align: left">
          <?php echo $items_for_sale->getPrice() ?>
      </td>
      <td style="text-align: left">
	 <?php $sub_total = $items_for_sale->getQuantity() * $items_for_sale->getPrice();?>
	 <?php $total += $sub_total;?>
          <?php echo $sub_total;?>
      </td>  
  </tr>
  
<?php endforeach; ?>
  <tr>
     <td colspan="3" style="text-align: right">
	Total:
     </td>
     <td>
	<?php echo numbers::my_format_number($total); ?>
     </td>
  </tr>
  <tr class="e_1" style="display:none"><td colspan="4"><a href="javascript:;" onclick="$('.e_1').toggle();$('#f_1').toggle();"><b>OCULTAR DETALLES</b></a></td></tr>
</tbody>
</table>
