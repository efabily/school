<?php use_helper('Date', 'Pager', 'I18N') ?>
<?php include_partial('transfer/assets') ?>


<?php if($transfer) : ?>

   <div id="sf_admin_container">

   <table  class="admintable">
      <tr>
	<td class="key font_bold font_16" style="text-align: center;" colspan="2">
	   Comprobante de Transferencia <a href="javascript:window.print()">[Imprimir]</a>
	</td>
      </tr> 
      <tr>
	<td class="key font_bold font_16" style="text-align: right;">Nro:</td>
	<td class="font_bold font_16" style="text-align: left;">
	   <?php echo $transfer->getId()?>
	</td>
      </tr> 
      <tr>
	<td class="key font_bold font_16" style="text-align: right;">Movimiento:</td>
	<td class="font_bold font_16" style="text-align: left;">
	   <?php echo $transfer->getTypeName()?>
	</td>
      </tr>
      <tr>
	<td class="key font_bold font_16" style="text-align: right;">Moneda:</td>
	<td class="font_bold font_16" style="text-align: left;">
	   <?php echo $transfer->getCurrencyByMovement();?>
	</td>
      </tr>
      <tr>
	<td class="key font_bold font_16" style="text-align: right;">Monto:</td>
	<td class="font_bold font_16" style="text-align: left;">
	   <?php echo $transfer->getAmount();?>
	</td>
      </tr>
      <tr>
	<td class="key font_bold font_16" style="text-align: right;">Fecha:</td>
	<td class="font_bold font_16" style="text-align: left;">	
	   <?php echo format_date($transfer->getCreatedAt(), 'g') ?>
	</td>
      </tr>
      <tr>
	<td class="key font_bold font_16" style="text-align: center;" colspan="2">Comentario:</td>
      </tr>
      <tr>     
	 <td class="font_bold font_16" style="text-align: center;" colspan="2">
	   <?php echo $transfer->getComment();?>
	</td>
      </tr>
      <tr>
	<td class="key font_bold font_16" style="text-align: right;" colspan="2">

	</td>
      </tr>
      <tr style="text-align: right;" >
	<td style="padding-left: 100px; height: 50px;vertical-align: bottom;text-align: center;" >
	.........................................................<br />
	    Cajero(a):<?php echo ' '.$transfer->getNameCashier() ?>
      </td>
      <td style="padding-right: 100px; height: 50px;vertical-align: bottom;text-align: center;">
	   .....................................................<br />
	     Aprobado por: <?php echo ' '.$transfer->getAprobadoPor() ?>
	 </td>
       </tr>
   </table>
   </div>
<?php endif;?>
