<?php if($total_price > 0 && ($total_pay >= $total_price)):?>  
   <?php include_partial('Sales/preClose', array('sales' => $sales)) ?>
<?php else: ?>
   <?php include_partial('Sales/pay', array()) ?>
<?php endif; ?>
