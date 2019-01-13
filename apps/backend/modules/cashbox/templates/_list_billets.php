<?php use_helper('Date') ?>

<table class="adminlist">
  <tr>
    <?php $cols = 0; $total_billet = 0; ?>
    <?php foreach ($billets as $billet): ?>      
      <?php if ($cols == 3) { $cols = 0; echo '<tr></tr>'; } ?>

        <?php $total_billet += $billet->getQuantity() * $billet->getBillet()->getValue(); ?>
        <td style="text-align: right"><?php echo $billet->getBillet()->getName(); ?>:</td>
        <td style="text-align: left"><strong><?php echo $billet->getQuantity() ?></strong></td>

      <?php $cols ++ ?>      
    <?php endforeach; ?>
    <?php if ($cols < 3): ?>
        <td></td><td></td>
      <?php if ($cols == 1): ?>
        <td></td><td></td>
      <?php endif; ?>
    <?php endif; ?>
  </tr>
  <tr>
    <td colspan="5" style="text-align: right"><strong>Total:</strong></td>
    <td colspan="1" style="text-align: left"><strong><?php echo numbers::my_format_number($total_billet) ?></strong></td>
  </tr>
</table>				