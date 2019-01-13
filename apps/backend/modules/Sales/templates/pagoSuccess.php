<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>
<?php include_partial('Student/assets') ?>

<div id="sf_admin_container" style="margin-left: 0px;padding-left: 0;">
  <h1 style="color:#000" ><?php echo __('Venta Directa', array(), 'messages') ?></h1>

  <?php include_partial('Sales/flashes') ?>
   
  <div id="sf_admin_content" style="margin-left: 0px;padding-left: 0;">
      <table style="margin-left: 0px;padding-left: 0;">
	 <tr>
	    <td>	 
	       <div id="items_switch">
		  <fieldset>
		     <legend>Items Disponibles</legend>
		     <?php  include_component('Sales', 'listItems', array()) ?>
		  </fieldset>		   
	       </div>
	    </td>
	    <td>
	       <div id="list_items_charged">        
		  <?php  include_component('Sales', 'listItemsCharged', array()) ?>
	       </div>
	    </td>
	    <td>
	       <div id="div_pay" >
		  <?php if($total_price > 0 && ($total_pay >= $total_price)):?>  
		     <?php include_partial('Sales/preClose', array('sales' => $sales)) ?>
		  <?php else: ?>
		     <?php include_partial('Sales/pay', array()) ?>
		  <?php endif; ?>		  
	       </div>	 
	    </td>
	 </tr>
      </table>
   </div>
</div>