<?php use_helper('I18N') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<script>
  jQuery(function($){
    $('#submit').click(function(){
       var params = {};
              
       params.deposit_id = $('#deposit_id').val();
       params.contract_id = <?php echo $contract_id; ?>;
       params.numbers_value = $('#numbers_value').val();

       $.post('/Student/addPay',params,function(response){
          response = json_decode(response);          
	  
	  $.get('/Student/pago', params, function(response){
	    $("#pago").html(response);
	  });
       })
         
    });
  });          
</script>

<form method="POST" id="posfrm" >
<fieldset class="adminform">
  <legend><?php echo 'Monto a Pagar' ?></legend>   

  <table  class="admintable" style="width: 150px; border-color: #000;" borde="1">
    <tr>
        <td class="key font_14" style="width: 80px;">
                <?php echo 'Por Pagar' ?>:
        </td>
        <td colspan="2" class="font_16">	
            <strong><?php echo numbers::my_format_number($for_pay = ($total_price - $total_pay)) ?></strong>
        </td>
    </tr>
    <?php if($sf_user->getAttribute('discount_id')): ?>
      <?php $discount = DiscountPeer::retrieveByPK($sf_user->getAttribute('discount_id')); ?>
    
      <?php if(is_object($discount)): ?>
	 <tr>
	   <td colspan="3" width="100" class="key font_14">
	       <?php echo 'Descuento' ?>:
	   </td>
	 </tr>
	 <tr>
	   <td colspan="3" class="font_14">
	      <strong>
	       <?php echo $discount->getName().' ('.$discount->getDiscount().' % )' ?>
	      </strong>
	   </td>
	 </tr>
      <?php endif; ?>
    
    <?php endif; ?>

	<?php $cup = 1 ?>
	<?php if (is_object($payment_type) && $payment_type->getId() > 0): ?>
	           
	     <?php $cup = $payment_type->getCupOfChange() ?>      

	     <?php if ($cup != 1): ?>
		  <tr>
		      <td width="100" class="key font_14">
			  T/C:
		      </td>
		      <td colspan="2" class="font_16">
			  <strong><?php echo numbers::my_format_number($cup) ?></strong>
		      </td>
		  </tr>
	     <?php endif; ?>			
	<?php endif; ?>	

  <?php if (isset($comment)): ?>
    <tr>
      <td width="100" class="key font_14">
        <?php echo 'Comentario' ?>:
      </td>
      <td>        
        <textarea id="comment" name="comment"> </textarea>
      </td>
    </tr>
  <?php else: ?>    
    <input type="hidden" name="comment" id="comment" />
  <?php endif; ?>
</table>  
  <?php include_partial('Student/numbers', array('options' => array(
                'dot' => 1, 'value'=> numbers::my_format_number_calc($for_pay / $cup), 
                'text'=>'Monto', 'size' => '7', 'class' => 'font_bold font_16'))) ?>  
</fieldset>
<div style="text-align: center">
<?php if (is_object($payment_type) && $payment_type->getId() > 0): ?>   
     <div style="text-align: center; width:100px; height: 22px;background-color: #B5B5B5;padding-top: 8px; font-weight: bold;margin-left: 40px;" >
      <a href="javascript:;" id="submit"  style="text-align: center;" >
	Guardar
      </a>
    </div>
<?php endif; ?>                     
</div>
</form>