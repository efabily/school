<?php use_helper('I18N', 'jQuery', 'Date') ?>
<script>
  jQuery(function($){
    $('#submit').click(function(){            

       var params = {};            
       
       params.numbers_value = $('#numbers_value').val();

       $.post('/Sales/addPay',params,function(response){       
	  
	  $.get('/Sales/pay', params, function(response){
	    $("#div_pay").html(response);
	  });
          
       })
         
    });
  });          
</script>

<form method="POST" id="posfrm" >
<fieldset class="adminform">

  <legend><?php echo 'Realizar Pagos' ?></legend>   

  <table  class="admintable" style="width: 150px; border-color: #000;" borde="1">
    <tr>
        <td class="key_right font_14" style="width: 80px;">
                <?php echo 'Por Pagar' ?>:
        </td>
        <td colspan="2" class="font_16">
	   <?php 
	       $for_pay = $total_price - $total_pay; 
	       if($for_pay <= 0)
	       {
		  $for_pay = 0;
	       }	       
	   ?>
            <strong><?php echo numbers::my_format_number($for_pay) ?></strong>
        </td>
    </tr>
	<?php $cup = 1 ?>
	<?php if (is_object($payment_type) && $payment_type->getId() > 0): ?>
	           
		<?php $cup = $payment_type->getCupOfChange() ?>
      
		<?php if ($cup != 1): ?>
			<tr>
                            <td width="100" class="key font_14">
                                    <?php echo 'T/C' ?>:
                            </td>
                            <td colspan="2" class="font_16">
                              <strong><?php echo numbers::my_format_number($cup) ?></strong>
                            </td>
			</tr>
		<?php endif; ?>			
	<?php endif; ?>	
</table>  
  <?php include_partial('Sales/numbers', array('options' => array(
                'dot' => 1, 'value'=> numbers::my_format_number_calc($for_pay / $cup), 
                'text'=>'Monto', 'size' => '7', 'class' => 'font_bold font_16'))) ?>  
</fieldset>
<div style="text-align: center">       
<?php if (is_object($payment_type) && $payment_type->getId() > 0 && $for_pay > 0): ?>
    <div style="text-align: center; width:100px; height: 22px;background-color: #B5B5B5;padding-top: 8px; font-weight: bold;margin-left: 40px;" >
      <a href="#" id="submit"  style="text-align: center;" >
	Guardar
      </a>
    </div>		   
<?php endif; ?>                     
</div>
</form>