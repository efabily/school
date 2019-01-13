<?php use_helper('Date') ?>
<table class="print_recibo adminlists" style="width: 700px;" border="0">
 <thead>
   <th colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;text-align: center;" >
      RECIBO <a id="print_link" href="javascript:window.print()">[IMPRIMIR]</a>
   </th>
   <tr>
      <th colspan="2" style="text-align: right;padding-right: 100px;">NRO. <?php echo $receipt->getId(); ?></th>
   </tr>
 </thead>
 <tbody>
    <tr>
	<td style="width: 900px;">
	   <b>Hemos recibido de :</b>
           <?php echo $receipt->getName(); ?>
	</td>
	<td >
	   <b>CI:</b> 
	   <?php echo $receipt->getNit() ?>
	   <b>Telf:</b>
	   <?php echo $receipt->getTelefon() ?>
	</td>
   </tr>
   <tr>
	<td style="width: 900px;">
	   <?php if(isset($contract)): ?>
	       <b>A favor del alumno(a):</b> <?php echo $contract->getStudent()->getFullName(); ?>
	   <?php endif; ?>
	</td>
	<td >
	   <b>Fecha de pago:</b> <?php echo format_date($receipt->getCreatedAt(), "g"); ?>
	</td>
   </tr>
   <tr>
      <td> 
	 <?php if(isset($contract)): ?>
	    <b>Del: </b> <?php echo $contract->getCursoNivelTurno(); ?>
	 <?php endif; ?>
      </td>
	<td>
	   <?php if(isset($contract)): ?>
	       <b>Nro. Reg.:</b> <?php echo $contract->getStudent()->getCodigo()?>
	   <?php endif; ?>
	</td>
   </tr>		  
   <tr>
      <td> 
         <b>La suma de:</b>  <?php echo numbers::my_format_number($receipt->getTotal()).' BS.' ?><br>
         <?php
         $total_net = $receipt->getTotal();
         $decimales = explode('.', $total_net);

         if (!isset($decimales[1]) || $decimales[1] == 0)
         {
	         $decim = '00';
         } else {
	         $decim = $decimales[1];
         }
         
         $num2String = new Num2String();
         echo 'Son: ' . ucwords($num2String->convertir($total_net)) .'  '.$decim . '/100 BOLIVIANOS';
         ?>
      </td>
	<td >
	   
	</td>
   </tr>
   <tr>		       
      <td colspan="2" >
	 <b>Por el siguiente concepto:</b>
      </td>
   </tr>
   <tr>		       
      <td colspan="2" >			   
	 <?php if(isset($contract)): ?>
	    <?php $array_items = $receipt->getItemForSaleForReceiptDeposit() ?>
	 <?php else: ?>
	    <?php $array_items = $receipt->getItemForSaleBySellDirect() ?>
	 <?php endif; ?>
			   
	 
<table class="" style="width: 300px;margin-left: 100px;" border="0">
<thead class="noprint">
<tr class="shortprint">
  <th> </th>
  <th> </th>    
</tr>
</thead>
<tbody>
<?php  $k = 0;  $total = 0; $a = 2;?>

<?php  foreach ($array_items as $item): ?>
    <tr class="<?php echo "row".$k+$a ?>">          
       <td>
	  <?php echo $item['name'] ?>
       </td>
       <td style="text-align: right; width:15%">
	  <?php $total += $item['amount'];?>
	 <?php echo numbers::my_format_number($item['amount']) ?>
       </td>
    </tr>
  <?php  $k = 1 - $k ?>
<?php endforeach; ?>    
</tbody>
<tfoot class="font_bold font_14">
  <th style="text-align: right;" ><?php echo 'Total Pagado' ?></th>
  <th style="text-align: right;"><?php echo numbers::my_format_number($total) ?></th>  
</tfoot>
</table>
			   
		     </td>
		  </tr>
		  <tr>		       
		       <td style="text-align: left; width:15%" colspan="2" >
			  <?php if(isset($contract)): ?>
			     <?php echo 'Saldo mensualidades adeudadas: '.numbers::my_format_number($receipt->getSaldoMensualidadAdeudada()).'<br />'; ?>
			     <?php echo 'Proximo Vencimiento: '.$receipt->getProximoVenciento().'<br />'; ?>
			     <?php echo 'Cuotas Vencidas: '.$receipt->getCantidadCuotasVencidas(); ?>
			  <?php endif; ?>
		       </td>
		  </tr>
		  
		  <tr>		       
		       <td style="text-align: left; width:15%" colspan="2" > 
			Verifique los datos contenidos antes de firmar su conformidad.
		       </td>
		  </tr>
		  <tr style="text-align: right;" >
		    <td style="padding-left: 100px; height: 50px;vertical-align: bottom;text-align: center;" >
		       .........................................................<br />
		       Cajero(a)
		    </td>
		    <td style="padding-right: 100px; height: 50px;vertical-align: bottom;text-align: center;">
		       .........................................................<br />
		       Entregue conforme
		    </td>
		 </tr>		
	       </tfoot>
		
		</tbody>          
		<tfoot class="font_bold font_14">
		 <tr style="text-align: right;" >
		    <td colspan="2">
		     
		    </td>
		 </tr>		
	       </tfoot>
	      </table>