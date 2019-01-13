<?php use_helper('Date') ?>
<?php if(isset($night_audit) && is_object($night_audit)):?>
<?php  echo ' '.$msg.' '.format_date($night_audit->getDate(), 'P');?>
<?php else:?>
<?php echo $msg?>
<?php endif;?>