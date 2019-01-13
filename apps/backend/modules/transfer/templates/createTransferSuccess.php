<?php include_partial('transfer/assets') ?>

<?php include_partial('transfer/flashes') ?>

<div id="sf_admin_container">
   <?php include_component('transfer', 'open', array('cashbox_id' => $cashbox_id)) ?>
   
   <fieldset class="adminlist">
     <legend>Transferencias relizadas</legend>
     <div id="list_transferencia">
	<?php include_component('transfer', 'listOpeningAmount', array('cashbox_id' => $cashbox_id)) ?>
     </div>
  </fieldset>

</div>
