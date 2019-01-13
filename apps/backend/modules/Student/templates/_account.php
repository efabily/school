<?php include_partial('Student/assets') ?>

<script type='text/javascript' src='/js/json_decode.js'></script>
   
<script>
   
   jQuery(function($){
      $(".jq_item").click(function(){
	 $self = $(this);
	 val = $self.val();
	 
	 $("#account_"+val).click();
      });
   });
   
<?php if(is_object($deposit) && $deposit->getAmount() > 0): ?>
      jQuery(function($){
	 var params = {};
	 params.contract_id = $("#contract_id").val();
	 params.check = 1;

	 $.get('/Student/pago', params, function(response){
	     $("#pago").html(response);
	 });	 
	 
      });      
      
<?php endif; ?>
function toPay(obj)
{
   $current = $(obj);
   
   // Obtenemos el identificador de la cuenta
   var account_id = $current.attr('data-account');
   
   // Obtengo  los nombres de los checkboxs que estan seleccionados para esa cuenta
   var name_item = 'item_'+account_id+':checked';   
   
   //$table = $current.parents(".jq_item:checked");
   $table = $(".jq_item:checked");
   
   // Este es el array de los items que se quieren pagar
   var items = new Array();
   
   // A traves del name, obtengo los valores de los checkboxs seleccionados 
   // input[name="'+name_item+'"]
   $table.each(function(index, $obj) {       
       items.push($($obj).val());
   });
   
   var params = {};
   
   params.items = items;
   params.contract_id = $("#contract_id").val();
   
   $.post('/Student/addSalesPay', params, function(response){
      response = json_decode(response);
      
      if(response.amount > 0)
      {
        $.get('/Student/pago', params, function(response) {
          $("#pago").html(response);
        });
      } else {
	 if(response.discount100)
	 {
	       f = confirm("El item tiene un descuento del 100%.\nDesea aplicar el descuento?");
	       if(f)
	       {
		  // llamada ajax para aplicar el 100%		  
		  $.get('/Student/discount100', params, function(response2) {
		     // verificar la respuesta y en caso de que no haya error refrescar la pagina
		     location.reload();
		  });
	       }
	       else
	       {
		  $current.removeAttr("checked");
	       }
	 }
	 
         $("#pago").html('');          
      }
   });  
}


function addDiscount(obj)
{
   var contract = $(obj).attr('data-contract');
   
   var params = {};
   params.contract_id = contract;

  $.post('/Student/addDiscount', params, function(response){
      $("#current_disconunt").html(response);        
   }); 
 
}
</script>  
<div id="sf_admin_container">
   
<h1 style="color:#000">Detalle de cuenta de la <?php echo $contract->getPeriod()->getName() ?></h1>
<input type="hidden" id="contract_id" name="contract_id" value="<?php echo $contract->getId(); ?>" />

<table>
   <tr>
      <td colspan="2">
		 <div style="float:right" id="p_contrato">
		 	<?php if($has_contract) : ?>
		 		<a style="font-size:14px;color: #0B55C9;" href="/Student/contract/id/<?php echo $contract->getId() ?>/do/display">Ver Contrato</a> 
		 		| <a onclick="return confirm('Va a crear un nuevo contrato, desea continuar?')" style="font-size:14px;color: #0B55C9;" href="/Student/contract/id/<?php echo $contract->getId() ?>/do/new">Nuevo Contrato</a>
	 		<?php else: ?>
	 			<a style="font-size:14px;color: #0B55C9;" href="/Student/contract/id/<?php echo $contract->getId() ?>/do/create">Crear Contrato</a>
		 	<?php endif;?> 
		 </div>
	 
	    <table style="border: 2px solid red" id="tbl_descuento">
	    <tr>
	       <td>
		  ALUMNO (A):
	       </td>
	       <td style="font-weight: bold;">
		  <?php echo $student->getFullName()?>
	       </td>
	       <td>
		  
	       </td>
	       <td>
		  CODIGO:
	       </td>
	       <td style="font-weight: bold;">
		  <?php echo $student->getCodigo()?>
	       </td>
	       <td>
		  
	       </td>
	       <td>
		  TURNO:
	       </td>
	       <td style="font-weight: bold;" >
		  <?php echo $turno?>
	       </td>
	       <td>
		  
	       </td>
	       <td>
		  CICLO:
	       </td>
	       <td style="font-weight: bold;" >
		  <?php echo $ciclo?>
	       </td>
	       <td>
		  
	       </td>
	       <td>
		  CURSO:
	       </td>
	       <td style="font-weight: bold;" >
		  <?php echo $nivel?>
	       </td>
	    </tr>
	    <tr>
	       <td colspan="14">
		  <div id="current_disconunt">
		     <?php include_partial('Student/listDiscount', array('discount_contract' => $discount_contract, 'contract_id' => $contract->getId())) ?>
		  </div>		  
	       </td>
	    </tr>
	    <tr>
	       <td colspan="14">
		  
	       </td>
	    </tr>
	 </table>
	 
	 
      </td>
   </tr>
   <tr>
      <td colspan="2">
	 <div id="flashes">
	    <?php include_partial('Student/flashes') ?>
	 </div>
	  <div id="pago" style="margin-left: 70px;">
      
	  </div>
      </td>
   </tr>
   <tr>
      <td colspan="2" align="center">
	 
	 <table id="tbl_deudas" class="adminlist" style="width:400px;">
	    <thead class="noprint">
	       <tr class="shortprint">
		  <th colspan="2">
		    Deudas Pasadas 
		 </th>
	       </tr>
	       <tr class="shortprint">
		 <th> Periodo </th>
		 <th> Total Adeudado</th>		 
	       </tr>
	    </thead>
	    <tbody>
	    <?php  $k = 0;  $total = 0; $a = 2;?>
	       <?php ?>
	       <?php  foreach ($contracts as $i => $contra): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
	       <?php $saldo = $contra->getSaldo(); ?>
	       <?php $total += $saldo; ?>
	       
		<tr class="<?php echo "row".$k+$a ?>">
		 <td style="width:55%" align="center">
		    <?php  echo link_to($contra->getPeriod()->getName(), '/Student/account/id/'.$contra->getStudentId().'/period_id/'.$contra->getPeriodId(), array('class_suffix' => 'edit', 'label' => 'Edit',)) ?>
		 </td>
		 <td style="text-align: right; width:15%;<?php if($saldo>0) echo "color:red;font-weight:bold;font-size:20px"?>">
		     <?php echo numbers::my_format_number($saldo) ?>
		 </td>		 
		</tr>
	        <?php endforeach; ?>
	      <?php  $k = 1 - $k ?>	    
	    </tbody>
	    <tfoot class="font_bold font_14">
	      <th style="text-align:right;<?php if($total>0) echo "color:red;font-weight:bold;font-size:20px"?>" colspan="0"><?php echo 'Total' ?></th>
	      <th style="text-align:right;<?php if($total>0) echo "color:red;font-weight:bold;font-size:20px"?>"><?php echo numbers::my_format_number($total) ?></th>	      
	    </tfoot>
	  </table>	
      </td>
   </tr>
   <tr>
     <td id="i_disponibles" valign="top" style="color:#0B55C9; font-weight: bold;" >
         Items Disponibles
     </td>
     <td id="i_cargados" valign="top" style="color:#0B55C9; font-weight: bold;">
	Items Cargados
     </td>     
  </tr>
  <tr>
     <td valign="top" >		   
	 <div id="indicator_items_switch" class="indicator" style="display: none;"></div>
	 <div id="items_switch">
	     <?php  include_component('Student', 'listItems', array('contract' => $contract)) ?>
	 </div>	   			
     </td>
     <td valign="top">
	   <div id="indicator_items_list" class="indicator" style="display: none;"></div>
	   <div id="items_list">	      	      
	      <?php include_component('Student', 'listAccount', array('contract' => $contract, 'deposit' => $deposit)) ?>
	   </div>
     </td>     
  </tr>
</table>
   
</div>