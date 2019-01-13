<?php echo link_to_remote_multiple($payment->getFullName(),
        array(
	'url' => '/cashbox/editPaymentType?id='.$payment->getId().'&cashbox_id='.$cashbox_id,
        'update'   => array('success' => 'payment_type_list')
	),
         array(
	  'url' => '/transfer/uploadAmount/cashbox_id='.$cashbox_id,
	  'update'   => array('success' => 'upload_amount')
         )
	)
?>