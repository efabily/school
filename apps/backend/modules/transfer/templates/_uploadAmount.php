<?php use_helper('Date', 'jQuery', 'MyJavascript') ?>
 <table  class="admintable">
   <tr>
     <td colspan="2" class="key font_bold font_16" style="text-align: center;" >
	 Aprobado por:
     </td>
   </tr>
   <tr>
     <td colspan="2" class="key font_bold font_16" style="text-align: right;" >
	 <?php echo include_partial('sfGuardUser/approved_by', array()) ?>
     </td>
   </tr>
   <tr>
     <td class="key font_bold font_16" style="text-align: right;">Movimiento:</td>
     <td class="font_bold font_16" style="text-align: left;">
	<input type="radio" id="type_movement_1" name="type_movement" value="1" /> Deposito
	<input type="radio" id="type_movement_2" name="type_movement" value="2" /> Retiro
     </td>
   </tr>
   <tr>
     <td class="key font_bold font_16" style="text-align: right;" >
      Comentario:
     </td>
     <td style="text-align: left;">
	<textarea id="comment" rows="5" cols="30"> </textarea>
     </td>
   </tr>
 </table>
	
    <table  class="admintable bbb">
       <?php if(is_object($payment_type) && $payment_type->getId() > 0): ?>
         <tr>
	    <td colspan="2" class="key font_bold font_16" style="text-align: right" >Forma de Pago:</td>
	    <td colspan="2" class="key font_bold font_16" style="text-align: left">
		<strong><?php echo $payment_type->getFullName(); ?></strong>
	    </td>
	 </tr>
       <?php endif; ?>
       <?php if($payment_type->getId() && ($payment_type->getCupOfChange() != 1)): ?>
         <tr>
	    <td colspan="2" class="key font_bold font_16" style="text-align: right;" >Tipo de Cambio:</td>
	    <td colspan="2" class="key font_bold font_16" style="text-align: left;">
		<strong><?php echo $payment_type->getCupOfChange() ?></strong>
	    </td>
	 </tr>
       <?php endif; ?>
      <tr>
	 <td class="key font_bold font_16" style="width: 350px; text-align: right" >
	    Monto:
	 </td>	 
	 <td class="key font_bold font_16" style="width: 150px;">
	    <input type="text" id="monto" name="monto" style="width: 70px; height: 20px;font-size: 12px;background-color:#fffccc;"  readonly="readonly" />
	 </td>
	 <td style="width: 100px;" class="key font_bold font_16" colspan="2">
	 </td>   
      </tr>
      <tr>
        <?php $cols = 0; foreach($billets as $billet): ?>
          <?php if ($cols == 2) { $cols = 0; echo '</tr><tr>'; } ?>
	  
            <td class="key font_bold font_16" style="width: 350px;text-align: right">
	       <?php echo $billet->getName() ?>:
	    </td>
            <td>
	       <input type="text" class="font_bold font_16 billet" style="width: 50px;height: 20px;" 
		      id="<?php echo 'billet_'.$billet->getId(); ?>" 
		      name="<?php echo 'billet_'.$billet->getId(); ?>"
		      onkeyup="cal(this)"
		      data-value="<?php echo $billet->getValue(); ?>"
		      data-billet="<?php echo $billet->getId(); ?>"
                />	
	    </td>
        <?php $cols ++; endforeach; ?>
       </tr>
    </table>
<div style="text-align: center;padding-left: 100px;">
<?php if($payment_type->getId() > 0): ?>
   <input style="padding:8px;float:left" type="button" value="Guardar" onClick="submit()"  id="submit"> 
   <img src="/images/indicator.gif" id="loading" style="float:left;margin-top:6px;margin-left:10px;display:none" />
<?php endif; ?>
</div>