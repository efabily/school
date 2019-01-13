<?php if(is_object($discount_contract) && $discount_contract->getIdState() == 2): ?>

   Descuento Actual: 
   <?php  echo $discount_contract->getDiscount()->getName().' ('.$discount_contract->getDiscount()->getDiscount().' % )'; ?>
   <a href="javascript:;" onclick="addDiscount(this)" data-contract="<?php echo $discount_contract->getContractId() ?>" style="color: #0B55C9;" >
      Cambiar Descuento
   </a>
<?php else: ?>
   <a href="javascript:;" onclick="addDiscount(this)" data-contract="<?php echo $contract_id ?>" style="color: #0B55C9;" >
      Adicionar Descuento
   </a>
<?php endif; ?>