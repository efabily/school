<?php use_helper('Date', 'jQuery', 'MyJavascript') ?>
<?php $carrier = 0 ?>
<table  class="admintable" border="0">
<tr>
  <td class="font_bold font_16" style="text-align: center; background-color: #F6F6F6;" >
      Lista de Tipos de Pago
  </td>
</tr>
<tr>
<?php foreach ($payment_list as $payment): ?>
<?php $carrier++; ?>
     <td style="text-align: center;">
      <?php if($sf_user->getAttribute('current_payment_type') == $payment->getId()): ?>
       <div class="button-menu-a" style="margin-left: 30px;">
      <?php else: ?>
       <div class="button-menu" style="margin-left: 30px;" >
      <?php endif; ?>

	<div class="page">
	   <span>
	    <?php include_partial('cashbox/list_payment_type', array('payment' => $payment, 'cashbox_id' => $cashbox_id)) ?>
	   </span>
	</div>
	  
        </div>
     </td>
<?php if($carrier == 1){ ?>
</tr><tr>
<?php $carrier = 0;} ?>
<?php endforeach; ?>
</tr>
</table>