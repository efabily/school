
<?php use_helper('Date') ?>

<script>
  jQuery(function($){
    $('#close').click(function(){      
      $(this).attr("disabled", "disabled");

      var params = {};
              
       params.contract_id = <?php echo $contract_id ?>;
       params.deposit_id = $('#deposit_id').val();       
       params.comment = $('#comment').val();
       params.name = $('#recibido_de').val();
       params.nit = $('#recibido_ci').val();
       params.telefon = $('#recibido_telf').val();
       
       $.post('/Student/close', params, function(response){
         $("#pago").html(response);
         
	 $.post('/Student/listAccount', params, function(response_account){
	    $("#items_list").html(response_account);
	 });

       });
       
    });
  });          
</script>


<table class="adminlist" >
   <thead>    
      <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	   
	 </td>
      </tr>
      <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	    PAGAR
	 </td>
      </tr>
   </thead>   
   <tr>
      <td valign="top" style="vertical-align: top;">
	 <?php $comm = ''; // trim('Pago de mensualidad del mes de '.$account->getName()); ?>
	     <input type="hidden" id="contract_id" name="id" value="<?php echo $contract_id ?>" />
	      <input type="hidden" id="deposit_id" name="deposit_id" value="<?php echo $deposit->getId(); ?>" />
	 
	   <fieldset class="adminform" style="border: 1px solid #ffffff;">
	    <legend>Detalles del recibo por el deposito</legend>        
	      <table class="adminlist">
		<thead>    
		  <tr>             
		     <th colspan="2">Descripción</th>		    
		  </tr>
		</thead>
		<tbody>
		<?php $k = 0;?>		
		  <tr class="<?php echo "row$k"; ?>">
		       <td style="width:55%;text-align: right;">Esta realizando un deposito de:</td>
		       <td style="text-align: left; width:15%">
			  <?php echo numbers::my_format_number($deposit->getAmount()).' Bs.' ?>
		       </td>
		  </tr>
		<?php $k = 1 - $k ?>
		  <tr class="<?php echo "row$k"; ?>">
		     <td colspan="2">
			Hemos recibido de:<input type="text" id="recibido_de" name="recibido_de" value="Sin Nombre" /> 
			CI.:<input type="text" id="recibido_ci" name="recibido_ci" style="width: 70px;" value="0" />
			Telf.<input type="text" id="recibido_telf" name="recibido_telf" />
		     </td>
		  </tr>
		
		</tbody>          
		<tfoot class="font_bold font_14">
		 <th style="text-align: right;" >
		    Comentario:
		 </th>
		 <th style="text-align: left;">
		     <textarea id="comment" name="comment" rows="5" cols="50" style="padding: 0;" > 
			<?php echo $comm ?>
		     </textarea>
		 </th> 
	       </tfoot>
	      </table>        
        </fieldset>
        
      </td>
      <td style="vertical-align: top;">
	 <div id="list_pay" >
	    <?php include_component('Student', 'listPayAmount', array('contract_id' => $contract_id, 'delete' => true)) ?>
         </div>
      </td>
    </tr>
    <tfoot>
       <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	       <div style="text-align:center;" >
		  <input type="button" value="Finalizar Pago" id="close" style="padding:10px" />
               </div>
	 </td>
       </tr>       
    </tfoot>    
</table>
