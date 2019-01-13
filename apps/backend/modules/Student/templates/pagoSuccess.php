<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>

<?php if(($total_pay > 0 && $total_price > 0) && $total_pay >= $total_price): ?>
   
  <?php include_partial('Student/closePay', array('deposit' => $deposit, 
                                                  'total_price'=> $total_price, 
                                                  'total_pay'=>$total_pay,                                                  
                                                  'contract_id' => $contract_id,
                                             )) ?>

<?php else: ?>

<script>
   jQuery(function($){
      $(".jq_amount").keyup(function(){
	   $self = $(this);
	   
	   var params = {};
	   params.contract_id = <?php echo $contract_id; ?>;
	   params.sales_id = $self.attr('data-sales');
	   params.amount = $self.val();

	   $.post('/Student/addDeposit', params, function(response){
	      response = json_decode(response);
	      
	      if(response.amount > 0)
	      {
		 $.get('/Student/pago', params, function(response){
		     $("#pago").html(response);
	         });
	      
	      } else {
	        $("#pago").html('');
	      }
	      
	    });
      });
   });
   
   function delDeposit(sales_id)
   {
	var params = {};
	params.contract_id = <?php echo $contract_id; ?>;
	params.sales_id = sales_id;
	
	$.post('/Student/delDeposit', params, function(response){
	   response = json_decode(response);

	   if(response.amount > 0)
	   {
	      $.get('/Student/pago', params, function(response){
	       $("#pago").html(response);
	      });
	   } else {
	      $("#pago").html('');
	   }
	   
	   $("#item_" + sales_id).removeAttr("checked");
        });
   }
   
</script>

<table class="adminlist" >
   <thead>
      <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	    PAGAR <?php include_partial('Student/flashes') ?>
	 </td>
      </tr>
   </thead>   
   <tr>
      <td valign="top">
	 
	      <table class="adminlist">
		  <thead class="noprint">
		     <tr class="shortprint">
                        <th colspan="4" style="color: #2C55C4; font-weight: bold;vertical-align: center;">ITEMS A PAGAR </th>
                     </tr>
		     <tr class="shortprint">
			<th> </th>
			<th>Nombre </th>
			<th>Saldo </th>
                        <th> </th>
                     </tr>
                  </thead>
	         <tbody>
<?php  $k = 0;  $a = 2;?>
<?php foreach ($array_sales_item as $item): ?>
     <?php
     $saldo = 0;
     $sales = SalesPeer::retrieveByPK($item['sales_id']);
     
     if(is_object($sales))
     {
	$saldo = numbers::my_format_number($sales->getSaldoByDeposit());
     }
     
     ?>
    <tr class="<?php echo "row".$k+$a ?>">          
       <td>
	  <a href="javascript:;" onClick="delDeposit(<?php echo $item['sales_id']; ?>)" >
	     <img  src="/images/actions/remove_one_big.png" title="delete" />
	  </a>
       </td>
       <td>
	<?php  echo $item['name'] ?>
       </td>
       <td>
	   <?php echo $saldo ?>
       </td>
       <td>
	  <input type="text" class="jq_amount" value="<?php echo $item['saldo'] ?>" data-sales="<?php echo $item['sales_id'] ?>" style="width:50px" >
       </td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>    
</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" colspan="3">Totales</th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($deposit->getAmount()) ?></th>  
</tfoot>
</table>
        
      </td>
      <td>	   
	 <div id="div_pay" >
	    <?php include_partial('Student/pay', array('contract_id' => $contract_id)) ?>
	 </div>        
      </td>
    </tr>
</table>
    
<?php endif; ?>
<input type="hidden" id="deposit_id" name="deposit_id" value="<?php echo $deposit->getId() ?>" />