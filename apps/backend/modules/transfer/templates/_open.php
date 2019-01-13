<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/general.css" />
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>

<?php use_helper('Date', 'jQuery', 'MyJavascript') ?>
<?php include_partial('Student/assets') ?>

<script>
  function submit()
  {
      if($("#username").val() == "")
      {
         alert("Debe proporcionar el nombre de usuario")
         return;
      }
      
      if($("#password").val() == "")
      {
         alert("Debe proporcionar la contrasena")
         return;
      }
      
      if(!$("#type_movement_1").attr("checked") && !$("#type_movement_2").attr("checked"))
      {
         alert("Debe seleccionar el tipo de movimiento")
         return;
      }
      
      if($("#comment").val() == "")
      {
         alert("Debe introducir un comentario")
         return;
      }
      
      if($('.bbb input[value!=""]').length == 0)
      {
         alert("Debe ingresar la cantidad de cada corte de dinero")
         return;
      }
      
      $("#submit").attr("disabled", "disabled");
      $("#loading").show();
      
     jQuery(function($){
	
	var billets = new Array();
	
	$(".billet").each(function(index, $obj){
	  var val = $(this).val();
	  if(val > 0)
	  {
	     billets.push({'id':$(this).attr('data-billet'), 'value':$(this).val()}) ;
	  }
	});
	
	var params = {};
	params.username = $('#username').val();
	params.password = $('#password').val();
	params.cashbox_id = $('#cashbox_id').val();
	params.type_movement = $('input[name=type_movement]:checked').val();
 	params.billets = billets;
	params.comment = $('#comment').val();
	params.monto = $('#monto').val();
	
	$.post('/transfer/addAmount',params,function(response){
	     $('#show_transfer').html(response);
		
	     $.post('/transfer/listTransfer',params, function(respTransfer){
		$('#list_transferencia').html(respTransfer);
	     });
	  	
	     $.post('/transfer/uploadAmount', '', function(resp){
		$('#upload_amount').html(resp);
	     });
	     
	     $.post('/transfer/paymentTypeList', params, function(respPayment){
		$('#payment_type_list').html(respPayment);
	     });
	     
	    $("#submit").removeAttr("disabled");
	    $("#loading").hide();
	  
       });	
     });
  }
  
  function cal(obj)
  {
	  m = 0;
	  $(".bbb input").each(function(index, obj) {
			$curr = $(obj);
			var value = $curr.val();
	       	var data_value = $curr.attr('data-value');

	       	if(value)
	       	{
	       		data_value = parseFloat(data_value);
	       		value = parseFloat(value);
		       	if(!isNaN(data_value) && !isNaN(value))
		       	{
		       		m += data_value * value;
		       	}
	       	}
	   });

	  m = Math.round(m*100)/100
	  $("#monto").val(m);
  }

</script>


<h1 style="color:#000;">Depositos y Retiros de Dinero</h1>
 
<input type="hidden" id="cashbox_id" name="cashbox_id" value="<?php echo $cashbox->getId(); ?>" />
<table width="100%">
   <tr>
      <td width="20%" valign="top">         
	 <div id="payment_type_list">
	    <?php include_component('cashbox', 'listPaymentType', array('cashbox_id' => $cashbox->getId())) ?>
	 </div>
         </td>
         <td width="30%" valign="top">
	    <div id="upload_amount">
	       <?php include_component('transfer', 'uploadAmount', array('cashbox_id' => $cashbox->getId())) ?>
	    </div>
	 </td>
	 <td width="50%" valign="top">
	 <div id="show_transfer">

	 </div>
      </td>
   </tr>
</table>
