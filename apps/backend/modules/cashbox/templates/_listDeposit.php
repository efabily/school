<?php use_helper('Date', 'Pager', 'I18N', 'jQuery', 'MyJavascript') ?>
<table class="adminlist">
<thead>
<tr>
  <th>
     Alumno
  </th>
  <th>
     Monto
  </th>
  <th>
     Moneda
  </th>
  <th>
     Nro. Recibo
  </th>
</tr>
</thead>
<tbody id="c_1">
   <tr><td colspan="4"><a href="javascript:;" onclick="$('#c_1').toggle();$('.d_1').toggle();"><b>MOSTRAR DETALLES</b></a></td></tr>
</tbody>
<tbody>
<?php $total = 0; ?>
<?php foreach ($deposits as $deposit): ?>
   <?php $total += $deposit->getAmount(); ?>
  <tr class="<?php echo "row1"; ?> d_1" style="display:none">
      <td style="text-align: center">
          <?php echo $deposit->getStudentName();?>
      </td>
      <td>
          <?php echo $deposit->getAmount() ?>
      </td>
      <td style="text-align: left">          
	 <?php echo $deposit->getCurrency()->getName() ?>
      </td>
      <td style="text-align: left">
          <a href="/receipt/show/id/<?php echo $deposit->getReceiptId(); ?>/idc/<?php echo $deposit->getContractId() ?>" >
	   <?php echo $deposit->getReceiptId(); ?>
	  </a>
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
<tr class="d_1" style="display:none"><td colspan="4"><a href="javascript:;" onclick="$('#c_1').toggle();$('.d_1').toggle();"><b>OCULTAR DETALLES</b></a></td></tr>
</tbody>
</table>
