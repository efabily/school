<?php use_helper('I18N') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('MyJavascript') ?>

<script>
  jQuery(function($){
    $('.del_pay').click(function(){          
          
      var params = {};            
            
      params.movement_id = $(this).attr('data-id');      
      params.contract_id = <?php echo $contract_id ?>;
      params.deposit_id = $('#deposit_id').val();
      
      $.post('/Student/delPayAmount', params, function(response){
	
	$.get('/Student/pago', params, function(response_pago){
	     $("#pago").html(response_pago);
	 });
                  
      });
      
    });
  });    
</script>

<fieldset class="adminform" style="border: 1px solid #ffffff;" >

  <legend>Pagos Cargados</legend>
    
  <?php if($delete): ?>
    <?php if($total_price > 0 && ($change_in_local_currency >= 0 || $change_in_dollar >=0) && ($total_pay >= $total_price)): ?>	
      <div id="sf_admin_container">
        <div class="save-ok">
          <?php if($change_in_local_currency == 0 && $change_in_dollar == 0): ?>		
            <h2>'El pago es exacto.'</h2>
          <?php elseif($change_in_local_currency >= 0 || $change_in_dollar >= 0): ?>
		<?php if($change_in_local_currency >= 0): ?> 
		  <h2>
		     <?php echo 'El cambio en BS.: '.'<span class="font_18 font_bold">'.numbers::my_format_number($change_in_local_currency).'</span>'; ?>
		  </h2>
	       <?php endif; ?>
	       <?php if($change_in_dollar > 0): ?> 
		  <h2>
		     <?php echo 'El cambio en U$D: '.'<span class="font_18 font_bold">'.numbers::my_format_number($change_in_dollar).'</span>'; ?>
		  </h2>
	       <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>		
    <?php endif; ?>
  <?php endif; ?>
   
<table class="adminlist" >
<thead>
<tr>
  <th>Tipo de pago</th>  
  <th>Monto</th>
  <th>T/C</th>
  <th>Sub Total</th>
  <?php if($delete): ?>	
  <th></th>  
  <?php endif; ?>  
</tr>
</thead>
<tbody>
<?php $k = 0;  $total = 0; ?>
<?php foreach ($pays as $pay): ?>
  <tr class="<?php echo "row$k"; ?>">
    <td><?php echo $pay['name'] ?></td>    
    <td style="text-align: right"><?php echo numbers::my_format_number($pay['sum']) ?></td>
    <td style="text-align: right"><?php echo numbers::my_format_number($pay['cup']) ?></td>
    <td class="font_14 font_bold" style="text-align: right"><?php $total += $pay['calc_sum']; echo numbers::my_format_number($pay['calc_sum']) ?></td>
    <?php if($delete): ?>
      <td style="width: 44px;" align="center">        
        <a href="#" class="del_pay" data-id="<?php echo $pay['id']; ?>" >
          <img src="/images/toolbar/delete.png" />
        </a>              
      </td>
    <?php endif; ?>
  </tr>
<?php $k = 1 - $k ?>
<?php endforeach; ?>
</tbody>
<tfoot class="font_bold font_16">  
  <th></th>  
  <th style="text-align: right;" colspan="2"><?php echo 'Total' ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>
  <?php if ($delete): ?>
  <th></th>
  <?php endif; ?>
</tfoot>
</table>
  
</fieldset>