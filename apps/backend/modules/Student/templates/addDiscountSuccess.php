<script>
   jQuery(function($){
       $('#submit').click(function(){

           var params = {};
           params.contract_id = $('#contract_id').val();
           params.discount_id = $('#discount_id').val();

           $.post('/Student/addUpdate', params, function(response){
                $("#current_disconunt").html(response);
		
		$.post('/Student/listAccount', params, function(response_account){
		  $("#items_list").html(response_account);
	        });
           });
       });
   });
</script>
<input type="hidden" id="contract_id" name="contract_id" value="<?php echo $contract_id; ?>" />
<select id="discount_id" >
   <option value="0">Sin Descuento</option>
   <?php foreach ($discounts as $discount): ?>
      <?php $selected = '';?>
      <?php if(is_object($discount_contract)):?>
	 <?php echo 'Entra aqui'; ?>
	 <?php if($discount_contract->getDiscountId() == $discount->getId()): ?>	    
	    <?php $selected = 'selected="selected"';?>
	 <?php endif; ?>
      <?php endif; ?>
      <option value="<?php echo $discount->getId()?>" <?php echo $selected;?> >
	 <?php echo $discount->getName().' ('.$discount->getDiscount().')';?>
      </option>
   <?php endforeach; ?>
</select>
<input type="button" id="submit" name="submit" value="Guardar" />