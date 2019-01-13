<?php use_helper('Date') ?>

<script>
  jQuery(function($){
    $('#close').click(function(){      
      $(this).attr("disabled", "disabled");
      var params = {};
                     
      params.sales_id = $('#sales_id').val();
      params.name = $('#recibido_de').val();
      params.nit = $('#recibido_ci').val();
      params.telefon = $('#recibido_telf').val();
       
       $.post('/Sales/close', params, function(response){
         $("#div_pay").html(response);
	 
	 $.post('/Sales/listItemsCharged', '', function(response1){
	    $("#list_items_charged").html(response1);
	 });
	 
       });
       
    });
  });
</script>

<table class="adminlist" >
   <tr>
      <td valign="top" style="vertical-align: top;">	 
	   <input type="hidden" id="sales_id" name="sales_id" value="<?php echo $sales->getId(); ?>" />
	 
	        
	      <table class="adminlist">
		<thead>    
		  <tr>             
		     <th colspan="2">Detalles para el recibo</th>		    
		  </tr>
		</thead>
		<tbody>		
		  <tr>
		     <td style="text-align: right;">
			Hemos recibido de:
		     </td>
		     <td style="text-align: left;">
			<input type="text" id="recibido_de" name="recibido_de" value="Sin Nombre" style="width: 200px;" />
		     </td>
		  </tr>
		  <tr>
		     <td style="text-align: right;" >
			CI.:
		     </td>
		     <td style="text-align: left;">
			<input type="text" id="recibido_ci" name="recibido_ci" value="0" style="width: 100px;" />
		     </td>
		  </tr>
		  <tr>
		     <td style="text-align: right;">			
			Telf.
		     </td>
		     <td style="text-align: left;">
			<input type="text" id="recibido_telf" name="recibido_telf" style="width: 100px;" />
		     </td>
		  </tr>
		  <tr>
		     <td colspan="2" style="text-align: center;">

<?php $array_items = $sales->getItemForSaleBySales(); ?>

<table class="adminlist" style="width: 300px;margin-left: 10px;">
<thead class="noprint">
<tr class="shortprint">
   <th colspan="2" >
      Lista de Item   
   </th>  
</tr>
</thead>
<tbody>
<?php  $k = 0;  $total = 0; $a = 2;?>

<?php  foreach ($array_items as $item): ?>
    <tr class="<?php echo "row".$k+$a ?>">          
       <td>
	  <?php echo $item['name'] ?>
       </td>
       <td style="text-align: right; width:15%">
	  <?php $total += $item['amount'];?>
	 <?php echo numbers::my_format_number($item['amount']) ?>
       </td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>    
</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" >Total</th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>  
</tfoot>
</table>
   </td>
</tr>	  
	       </tbody>          
	       <tfoot class="font_bold font_14">
	       <th colspan="2" style="text-align: left;">

	       </th> 
	       </tfoot>
	      </table>

        
      </td>
      <td style="vertical-align: top;">
	 <div id="list_pay" >
	    <?php include_component('Sales', 'listPayAmount', array('delete' => true)) ?>
         </div>
      </td>
    </tr>
    <tfoot>
       <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	       <div style="text-align: center;" >
	       <input type="button" value="Finalizar Pago" id="close" style="padding:10px" />
		  <!--a href="#" id="close" style="text-align: center;" >
		    Finalizar Pago
		  </a-->
               </div>
	    
	 </td>
       </tr>       
    </tfoot>    
</table>
