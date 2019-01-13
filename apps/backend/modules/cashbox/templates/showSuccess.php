<?php use_helper('Date', 'Pager', 'I18N') ?>
<?php include_partial('Student/assets') ?>

<script>
   function openTransfer()
   {
      var params = {};
      params.cashbox_id = <?php echo $cashbox->getId(); ?>;
      $.get('/transfer/open', params, function(reponse){
	 $('#add_transferencia').html(reponse);
      });
   }
   
   function obs()
   {
      var comment = $('#comment').val();
      
      if(comment != "")
      {
	  $('#prodfrm').submit();
      }
   }
</script>

<?php if ($cashbox->getIdState() == 1): ?>
<link rel="stylesheet" type="text/css" href="/css/print_comprobante.css" media="print">
<?php endif; ?>

<div id="sf_admin_container">
<table class="toolbar" style="width: 100%;">
   <tr>
      <td>
	 <h1 style="color:#0B67DE;">Detalle de la caja</h1>
      </td>
      <td>
	 
      </td>
      <td>
	 
      </td>
      <td>
	 
      </td>
      <td>
	 
      </td>
      <td>
	 
      </td>
       <td class="button" id="toolbar-edit" style="width: 100px;">	   
	  <?php if ($cashbox->getIdState() == 1): ?>	  
	  <a id="transferencia" class="toolbar" title="Transferencia" onClick="openTransfer()">
	     <img src="/images/transferencia.jpg" title="Transferencia" /><br />
	     Transferencia
	  </a>
	  <?php endif; ?>
       </td>
       <?php if ($cashbox->getIdState() == 1): ?>
	 <td class="button" id="toolbar-edit" style="width: 100px;">
	    <a href="/cashbox/close/id/<?php echo $cashbox->getId(); ?>" class="toolbar" title="Cerrar">
	     <img src="/images/cerrar.jpg" title="Cerrar" /><br />
	     Cerrar
	    </a>
	 </td>
       <?php endif; ?>
       <td class="button" id="toolbar-cancel" style="width: 100px;">       
	  <a href="/cashbox/index" class="toolbar" title="Lista de Cajas">
	     <img src="/images/lista.jpg" title="Lista de Cajas" /><br />
	     Lista de caja
	  </a>
       </td>
   </tr>
</table>

<?php include_partial('cashbox/flashes') ?>

<fieldset class="caja">
<legend>Datos de la caja</legend>
   <?php
   $can_print_caja = $cashbox->getIdState() > 1;
   ?>
    <div id="t" style="font-weight:bold">Comprobante de Caja</div>
	 <table class="admintable">
	    <tr>
	       <td width="100" class="key">
		  Cajero(a):
		</td>
		<td>
		  <strong><?php echo $cashbox->getsfGuardUser()->getUserName() ?></strong> 
		  <?php if($can_print_caja) :?>
		  <a id="print_link" href="javascript:;" onclick="window.print()">[Imprimir]</a>
		  <?php endif;?>
		</td>
	     </tr>
             <tr>
	       <td width="100" class="key">
                   <strong style="font-size: 14px; color: #045686">Fecha del sistema:</strong>
	       </td>
	       <td>  
                   <?php $aDate = explode(' ', $cashbox->getNightAudit()->getDate());?>                   
                   <strong style="font-size: 14px; color: #045686"><?php echo format_date($aDate[0], 'f') ?></strong>
	       </td>
	    </tr>
	     <tr>
	       <td width="100" class="key">
		  Hora de apertura:  
	       </td>
	       <td>
		  <strong><?php echo format_date($cashbox->getCreatedAt(), 'r') ?></strong>
	       </td>
	    </tr>
	    <?php if ($cashbox->getIdState() > 1): ?>
	     <tr>
	       <td width="100" class="key">
		       Hora del Cierre:
	       </td>
	       <td>
		       <strong><?php echo format_date($cashbox->getClosingDate(), 'r') ?></strong>
	       </td>
  	     </tr>
	 <?php endif; ?>
	    <?php if ($cashbox->getIdState() == 3 ): ?>
	    <tr>
	       <td width="100" class="key">
		  Supervisor:
	       </td>
	       <td>
		  <strong><?php // echo $cashbox->getsfGuardUserProfile()->getName() ?></strong>
	       </td>
	    </tr>
	  <?php endif; ?>          		
	    <?php  include_partial('cashbox/listTotalsAmount', array('cashbox' => $cashbox)) ?>
	    <?php if ($cashbox->getIdState() == 3 ): ?>
	    <tr>
	       <td width="100" class="key">
		  Comentario:
	       </td>
	       <td>
		  <strong><?php echo $cashbox->getComment() ?></strong>
	       </td>
	    </tr>
	  <?php endif; ?>
	  <?php if ($cashbox->getIdState() == 2): ?>
	      <tr>
		<td width="100" class="key">Comentario:</td>
		<td>
		   <form action="/cashbox/updateSupervising" id="prodfrm" name="prodfrm" method="post">
		     <input type="hidden" id="id" name="id" value="<?php echo $cashbox->getId() ?>"  />      
		     <textarea class="no_border" id="comment" name="comment" ><?php echo $cashbox->getComment() ?></textarea> <br />
		     <input class="hide_print" type="button" value="Observar" onClick="obs()" style="margin-left: 40px;" />
		   </form>
		</td>
	      </tr>
        <?php endif; ?>
        
        <?php if($can_print_caja) :?>
        <tr>
         <td>
            <br /><br />
            .........................................................<br />
		       Cajero(a): <?php echo $cashbox->getsfGuardUser()->getUserName() ?>
         </td>
         <td></td>
        </tr>
        <?php endif;?>
	 </table>

</fieldset>
      
<div id="add_transferencia">
   
</div>

  <fieldset class="adminlist">
     <legend>Transferencias</legend>
     <div id="list_transferencia">
	<?php include_component('transfer', 'listOpeningAmount', array('cashbox_id' => $cashbox->getId())) ?>
     </div>
  </fieldset>

  <fieldset class="adminlist">
    <legend>Detalle por Tipo de Pago</legend>
      <?php  include_component('cashbox', 'listAmountForFunction', array('delete' => false,
                                    'cashbox_id' => $cashbox->getId(), 'details' => 1, 'func' => 'contract')) ?>
  </fieldset>
   
   <fieldset class="adminlist">
    <legend>Pagos por Alumnos</legend>
      <?php include_component('cashbox', 'listDeposit', array('cashbox_id' => $cashbox->getId())) ?>
  </fieldset>
   
   <fieldset class="adminlist">
    <legend>Ventas directas</legend>
      <?php include_component('cashbox', 'listItems', array('cashbox_id' => $cashbox->getId())) ?>
  </fieldset>
      
</div>
