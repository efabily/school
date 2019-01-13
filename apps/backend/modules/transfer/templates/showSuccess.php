<?php include_partial('transfer/assets') ?>

<?php include_partial('transfer/flashes') ?>
<?php if($transfer_id > 0):?>
<?php include_component('transfer', 'showTransfer', array('transfer_id' => $transfer_id)) ?>
<?php endif; ?>