<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Reports/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('Resumen Servicios por Curso', array(), 'messages') ?></h1>

  <?php include_partial('Reports/flashes') ?>
  
  <table style="width:100%;" >
     <tr>
	<td>
	   <div id="sf_admin_bar">
	     <?php include_partial('Reports/filters_resumen_servicios', array('form' => $filters)) ?>
	   </div>
	</td>
     </tr>
     <tr>
	<td>
	   <div id="sf_admin_content">
	     <div class="sf_admin_list">
		  <table cellspacing="0" style="width:100%;">
		    <thead>
		       <tr>
			  <th colspan="10" class="sf_admin_text sf_admin_list_th_codigo" style="padding-left: 200px;">
			     <?php echo $cadena; ?>
			 </th>
		      </tr>
		      <tr>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="width: 60px;" >
			    TURNO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="width: 90px;" >
			    CICLO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_father_name" style="width: 80px;" >
			    CURSO
			  </th>
			  
			  <?php foreach ($items as $item): ?>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >
			    <?php echo $item->getName() ?>
			    <table style="width: 100%" >
			       <tr>
				  <th style="border-right:1px solid #DDDDDD;width:40px;" >Credito</th>
				  <th style="border-right:1px solid #DDDDDD;color: #045686;width:40px;" >Cobro</th>
                                  <th style="color: #045686;width:40px;" >Saldo</th>
			       </tr>
			    </table>
			  </th>			  
			  <?php endforeach;?>
			  <th class="sf_admin_text sf_admin_list_th_father_name" style="border-left: 1px solid #DDDDDD" >
			    TOTAL CREDITO<br />POR CURSO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_father_name" style="border-left: 1px solid #DDDDDD;color: #045686;" >
			    TOTAL COBRO<br />POR CURSO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_father_name" style="border-left: 1px solid #DDDDDD;color: #045686;" >
			    TOTAL SALDO<br />POR CURSO
			  </th>
		      </tr>
		    </thead>		    
		    <tbody>
		      <?php $total_total_credito = $total_total_cobro = $total_total_saldo = 0; ?>
		      <?php $array_total_item = array();?>
		      <?php foreach ($grades as $i => $grade): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
			<tr class="sf_admin_row <?php echo $odd ?>">
			   <td class="sf_admin_date sf_admin_list_td_created_at">
			      <?php echo $grade->getTimetable(); ?>
			   </td>            
			   <td class="sf_admin_text sf_admin_list_td_codigo">
			     <?php echo $grade->getDegree() ?>
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_father_name">
			     <?php echo $grade->getCurso() ?>
			   </td>
			   <?php $total_credito = $total_cobro = $total_saldo = 0;?>
			   <?php foreach ($items as $item): ?>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD">
			      <table style="width: 100%">
			       <tr>
				  <td style="border-left:1px solid #DDDDDD;border-right:1px solid #DDDDDD; width:40px;text-align: left;" > 
				  <?php $credito = SalesPeer::getTotalItemReporte($period_id, $grade->getId(), $nro_mes, $item->getId())?>
				  <?php $total_credito += $credito;?>
				     
				  <?php if(!isset($array_total_item[$item->getId()]['credito'])):?>
				     <?php $array_total_item[$item->getId()]['credito'] = $credito;?>
				     <?php else:?>
				     <?php $array_total_item[$item->getId()]['credito'] += $credito;?>
				  <?php endif;?>
				  
				     
				  <?php echo numbers::my_format_number($credito); ?>
				  </td>
				  <td style="border-right:1px solid #DDDDDD;width:40px;text-align: left;" > 
				  <?php $cobro = SalesPeer::getTotalItemReportePagada($period_id, $grade->getId(), $nro_mes, $item->getId(), $from_date, $to_date);?>
				  <?php $total_cobro += $cobro;?>
				     
				  <?php if(!isset($array_total_item[$item->getId()]['cobro'])):?>
				  <?php $array_total_item[$item->getId()]['cobro'] = $cobro;?>
				     <?php else:?>
				     <?php $array_total_item[$item->getId()]['cobro'] += $cobro;?>
				  <?php endif;?>
				  

				  <?php echo numbers::my_format_number($cobro); ?>
				  </td>
				  <td style="border-right:1px solid #DDDDDD;width:40px;text-align: left;" >
				     <?php $saldo = ($credito - $cobro) ?>
				     <?php $total_saldo += $saldo;?>
				     
				     <?php if(!isset($array_total_item[$item->getId()]['saldo'])):?>
				     <?php $array_total_item[$item->getId()]['saldo'] = $saldo;?>
				     <?php else:?>
				     <?php $array_total_item[$item->getId()]['saldo'] += $saldo;?>
				     <?php endif;?>
				     <?php echo numbers::my_format_number($saldo);?>
				  </td>
			       </tr>
			    </table>
			   </td>
			   <?php endforeach;?>
			   <td class="sf_admin_text sf_admin_list_td_father_name" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;">
			     <?php $total_total_credito += $total_credito;?>
			     <?php echo numbers::my_format_number($total_credito); ?> 
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_father_name" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;">
			     <?php $total_total_cobro += $total_cobro; ?>
			     <?php echo numbers::my_format_number($total_cobro); ?> 
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_father_name" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;">
			     <?php $total_total_saldo += $total_saldo; ?>
			     <?php echo numbers::my_format_number($total_saldo); ?> 
			   </td>
			</tr>
		      <?php endforeach; ?>
		    </tbody>
		    <tfoot>
		      <tr>
			 <th colspan="3">
			    <span style="margin-left: 150px;">TOTAL:</span>
			 </th>
			 
			 <?php foreach ($array_total_item as $array_total): ?>
			<th class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			    <table style="width: 100%">
			       <tr>
				  <td style="border-right:1px solid #DDDDDD;width: 40px;text-align: left;" >
				  <?php echo numbers::my_format_number($array_total['credito']); ?>
				  </td>
				  <td style="border-right:1px solid #DDDDDD;width: 40px;text-align: left;" > 
				  <?php echo numbers::my_format_number($array_total['cobro']); ?>
				  </td>
				  <td style="width: 40px;text-align: left;" >
				     <?php echo numbers::my_format_number($array_total['saldo']); ?>
				  </td>
			       </tr>
			    </table>
			</th>
			<?php endforeach;?>
			<th class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;" >
			   <?php echo numbers::my_format_number($total_total_credito); ?>
			</th>
			<th class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;" >
			   <?php echo numbers::my_format_number($total_total_cobro); ?>
			</th>
			<th class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;text-align: left;" >
			   <?php echo numbers::my_format_number($total_total_saldo); ?>
			</th>
		      </tr>
		    </tfoot>
		  </table>
	      </div>
	   </div>	   
	</td>
     </tr>
  </table>
  <div id="sf_admin_footer">
    <?php // include_partial('Reports/list_footer', array('Students' => $Students)) ?>
  </div>
</div>