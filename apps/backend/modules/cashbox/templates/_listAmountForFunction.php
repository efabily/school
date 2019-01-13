<?php use_helper('Date') ?>

<table class="adminlist">
<thead>
<tr>
  <th>Tipo de Pago</th>
  <th></th>
</tr>
</thead>
<tbody>
<?php
$_counter = 0;
?>
<?php foreach ($amounts_payment as $amount): 
?>
  <?php if(is_object($amount)): ?>
  <tr>
    <td style="text-align: center;"><?php echo $amount['name'] ?></td>
    <td>
      <?php foreach($amount as $sub_amount): 
      $_counter++;
      ?>
      
      <?php if(is_object($sub_amount)): ?>
       
        <table class="adminlist">
        <thead>
          <tr>
            <th>Tipo de Cambio</th>
            <?php if ($details): ?>
              <th>Detalle de Monto</th>
            <?php endif; ?>
            <th>Sub Total</th>
            <th>Convertido</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: left">
              <?php echo numbers::my_format_number($sub_amount['cup']) ?>              
            </td>
              <?php if ($details): ?>
                <td>
                  <table class="adminlist">
                  <tbody id="a_<?php echo $_counter?>">
                     <tr>
                        <td><a href="javascript:;" onclick="$('#a_<?php echo $_counter?>').toggle();$('#b_<?php echo $_counter?>').toggle();"><b>VER DETALLES</b></a></td>
                      </tr>
                  </tbody>
                  <tbody style="display:none" id="b_<?php echo $_counter?>">
                  <?php foreach ($sub_amount as $sum): ?>
                    <?php if (is_object($sum)): ?>
                      <tr>
                        <td style="text-align: right"><?php echo numbers::my_format_number($sum['sum']) ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                     <tr>
                        <td><a href="javascript:;" onclick="$('#a_<?php echo $_counter?>').toggle();$('#b_<?php echo $_counter?>').toggle();"><b>OCULTAR DETALLES</b></a></td>
                      </tr>
                  </tbody>
                  </table>
                </td>
              <?php endif; ?>
            <td style="text-align: left"><?php echo numbers::my_format_number($sub_amount['total']) ?></td>
            <td style="text-align: left"><?php echo numbers::my_format_number($sub_amount['total'] * $sub_amount['cup']) ?></td>
          </tr>
        </tbody>
        </table>
      <?php  endif; ?>
      <?php endforeach; ?>
    </td>
  </tr>
<?php endif; ?>
<?php endforeach; ?>
</tbody>
</table>
				
