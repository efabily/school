<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>

<table cellspacing="0">
   <thead>
     <tr>       
       <th class="sf_admin_text sf_admin_list_th_mes">
	  Mes
       </th>
       <th class="sf_admin_text sf_admin_list_th_items">
	  Items Cargados
       </th>       
       <th class="sf_admin_text sf_admin_list_th_id">
	 Pagos Realizados
       </th>       
     </tr>
   </thead>   
   <tbody>
      <tr>	 
	 <td colspan="2">
	    <table style="margin: 0;padding: 0;border: 0; ">
	    <?php  foreach ($accounts as $i => $account): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
	     <tr class="sf_admin_row <?php echo $odd ?>">
		<td class="sf_admin_text sf_admin_list_td_id">
		  <b><?php echo $account->getName() ?> </b>
		</td>
		<td class="sf_admin_text sf_admin_list_td_id">
		  <?php include_component('Student', 'listItemsCharged', array('account' => $account, 'deposit' => $deposit)) ?> 
		</td>
	     </tr>
	   <?php endforeach; ?>
	    </table>
	 </td>
	  <td class="sf_admin_text sf_admin_list_td_id">
	    <?php include_component('Student', 'paymentsMade', array('contract' => $contract)) ?>
	  </td>	 
       </tr>
   </tbody>
   <tfoot>
     <tr>
       <th colspan="3">
	 
       </th>
     </tr>
   </tfoot>
</table>