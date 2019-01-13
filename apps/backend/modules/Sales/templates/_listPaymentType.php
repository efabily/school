<?php use_helper('I18N') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>
<?php use_helper('MyJavascript') ?>

<fieldset class="adminform">
  <legend><?php echo 'Formas de Pago' ?></legend>
				
<?php $carrier = 0 ?>
  
<table>
<?php foreach ($payment_list as $payment): ?>
  <tr>
    <td>
      <?php if($sf_user->getAttribute('current_payment_type') == $payment->getId()): ?>
      	<div class="button-menu-a">
      <?php else: ?>
      	<div class="button-menu">
      <?php endif; ?>
	   	    
	 <div class="page">
	    <span>	 		
		<?php echo link_to_remote_multiple($payment->getFullName(), array(
		     'url'      => '/Sales/editPaymentType?id='.$payment->getId(),
		     'update'   => array('success' => 'payment_type_list')
		  ),
		   array(
		   'url' => '/Sales/uploadPay',
		   'update'   => array('success' => 'upload_amount'),
		   )) ?> 	       	    	       	    
	    </span>
	 </div>
	</div>
   </td>	  
<tr>
<?php endforeach; ?>
</tr>
</table>
</fieldset>