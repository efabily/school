<table width="100%">
  <tr>			
   <td width="20%" valign="top" align="right">      
      <div id="payment_type_list">
        <?php include_component('Student', 'listPaymentType', array('contract_id' => $contract_id)) ?>
      </div>
   </td>
   <td width="33%" valign="top">     
     <div id="upload_amount" align="center">        
         <?php include_component('Student', 'uploadPay', array('contract_id' => $contract_id)) ?>
     </div>
   </td>	
   <td width="47%" valign="top" align="left">
      <div id="indicator_2" class="indicator" style="display: none;"></div>
      <div id="list_pay">
        <?php include_component('Student', 'listPayAmount', array('contract_id' => $contract_id, 'delete' => true)) ?>	  
      </div>
    </td>	
   </tr>
</table>