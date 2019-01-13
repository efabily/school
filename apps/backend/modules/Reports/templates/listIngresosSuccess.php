<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Reports/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('Lista de Ingresos por Dia', array(), 'messages') ?></h1>

<?php include_partial('Reports/flashes') ?>
  
  <?php 
  function getSumItem($monthNumber, $gradeId, $typeId, $rowset)
  {
        $sum = 0;
        foreach ($rowset as $item)
        {
            if($item['number'] == $monthNumber && $item['grade_id'] == $gradeId && $item['type_item_id'] == $typeId)
            {
                $sum += $item['amount'];
                // $GLOBALS['totales'] += $item['amount'];
            }
        }

        return $sum;
  }
  
  function getSumExtraItem($monthNumber, $gradeId, $itemId, $rowset)
  {
        $sum = 0;
        foreach ($rowset as $item)
        {
            if($item['number'] == $monthNumber && $item['grade_id'] == $gradeId && $item['item_id'] == $itemId)
            {
                $sum += $item['amount'];
                // $GLOBALS['totales'] += $item['amount'];
            }
        }

        return $sum;
  }
  
  ?>

  <table style="width:100%;"  >
     <tr>
	<td>
	   <div id="sf_admin_bar">
	     <?php include_partial('Reports/filters_ingresos', array('form' => $filters)) ?>
	   </div>
	</td>
     </tr>
     <tr>
	<td>
	   <div id="sf_admin_content">
	     <div class="sf_admin_list">
		  <table cellspacing="0" style="width:100%;" >
		    <thead>
		       <tr>
			  <?php $colspna_total_items_services = 7 + count($items); ?>
			  <th class="sf_admin_text sf_admin_list_th_codigo" colspan="<?php echo $colspna_total_items_services; ?>>" style="padding-left: 200px;">
			     <?php echo 'DESDE: '.format_date($from_date, "p").'   HASTA: '.format_date($to_date, "p") ?>
			     
			 </th>
		      </tr>
		      <tr>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 70px;">
			    MES
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 60px;" >
			    TURNO
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 90px;" >
			    CICLO
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 80px;" >
			    CURSO
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 90px;" >
			    MENSUALIDAD
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 40px;" >
			    MORA
			 </th>
			 <?php foreach ($items as $item): ?>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;width: 100px;" >
			    <?php echo $item->getName() ?>
			  </th>
			  <?php endforeach;?>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD; width: 100px;" >
			    TOTALES
			 </th>
		      </tr>
		    </thead>		    
		    <tbody>
		      <?php $total_mensualidad = $total_mora = $total = 0; ?>
		      <?php $array_total_items = array(); ?>
		       
		       <?php $total_mensualidad_x_mes = $total_mora_x_mes = $total_x_curso_x_mes = 0; ?>
		      <?php foreach ($accounts as $i => $account): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
			<tr class="sf_admin_row <?php echo $odd ?>">
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="margin-right: 0;padding-right: 0; width: 70px;">
			      <?php echo strtoupper($account->getName()); ?>                               
			   </td>			   
			   <td class="sf_admin_date sf_admin_list_td_created_at" colspan="<?php echo ($colspna_total_items_services -1) ?> ">
			      <?php $grades = GradePeer::getGradeReporteIngresoDia($period_id, $account->getNumber(), $from_date, $to_date); ?>                               
			      <?php $total_mensualidad_x_mes = $total_mora_x_mes = $total_x_curso_x_mes = 0; ?>
			      <?php $array_total_items_x_mes = array(); ?>
			      <table cellspacing="0" spellcheck="0" style="width: 100%" >
				   <tbody>
				   
				   <?php foreach ($grades as $i => $grade): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
				       <?php $total_x_curso = 0; ?>
                                       <?php $mensualidad = $mora = 0; ?>
                                       
				     <tr class="sf_admin_row <?php echo $odd ?>" style="margin-left: 0;">
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD; width: 60px;margin-left: 0;" >
					    <?php echo strtoupper($grade->getTimetable()); ?>                                            
					</td>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD; width: 90px;" >
					   <?php echo strtoupper($grade->getDegree()); ?>
					</td>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD; width: 80px;" >
					   <?php echo strtoupper($grade->getCurso()); ?>
					</td>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 90px;" >
					   <?php // $mensualidad = SalesPeer::getTotalMensualidadReportePagada($period_id, $grade->getId(), $account->getNumber(), 2, $from_date, $to_date);?>
                                            <?php $mensualidad = getSumItem($account->getNumber(), $grade->getId(), 2, $rowset)?>
					   <?php $total_x_curso += $mensualidad; ?>
					   <?php $total_mensualidad_x_mes += $mensualidad; ?>
                                            
					   <?php echo numbers::my_format_number($mensualidad) ?>
					</td>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 40px;" >
					   <?php // $mora = SalesPeer::getTotalMensualidadReportePagada($period_id, $grade->getId(), $account->getNumber(), 1, $from_date, $to_date);?>                                           
                                           <?php $mora = getSumItem($account->getNumber(), $grade->getId(), 1, $rowset)?>
					   <?php $total_x_curso += $mora; ?>
					   <?php $total_mora_x_mes += $mora; ?>					   
                                           
					   <?php echo numbers::my_format_number($mora) ?>
					</td>
					
					<?php foreach ($items as $item): ?>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 100px;">
					   <?php $cobro = 0; ?>
				           <?php // $cobro = SalesPeer::getTotalItemReportePagada($period_id, $grade->getId(), $account->getNumber(), $item->getId(), $from_date, $to_date);?>
					   <?php $cobro = getSumExtraItem($account->getNumber(), $grade->getId(), $item->getId(), $rowset);?>
					   <?php // Total por mes ?>
					   <?php if(!isset($array_total_items_x_mes[$item->getId()]['cobro'])):?>
					   <?php $array_total_items_x_mes[$item->getId()]['cobro'] = $cobro;?>
					     <?php else:?>
					     <?php  $array_total_items_x_mes[$item->getId()]['cobro'] += $cobro;?>
					   <?php endif;?>
					   
					   <?php // Total general ?>
					   <?php if(!isset($array_total_items[$item->getId()]['cobro'])):?>
					   <?php $array_total_items[$item->getId()]['cobro'] = $cobro;?>
					     <?php else:?>
					     <?php  $array_total_items[$item->getId()]['cobro'] += $cobro;?>
					   <?php endif;?>
					   
					   <?php $total_x_curso += $cobro; ?>
					   <?php echo numbers::my_format_number($cobro); ?>
					</td>
					<?php endforeach;?>
					<td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 100px;">
					   <?php $total_x_curso_x_mes += $total_x_curso; ?>
					   <?php echo numbers::my_format_number($total_x_curso); ?>
					</td>
				     </tr>
				   <?php endforeach; ?>
				   </tbody>
				   <tfoot>
				     <tr style="margin-left: 0;">
					<th style="border-left: 1px solid #DDDDDD;width: 230px;" colspan="3" >
					   <span style="margin-left: 100px;">TOTAL POR MES:</span>
					</th>
					<th style="border-left: 1px solid #DDDDDD;width: 90px;" >
					   <?php $total_mensualidad += $total_mensualidad_x_mes; ?>
					   <?php echo numbers::my_format_number($total_mensualidad_x_mes) ?>
					</th>
					<th style="border-left: 1px solid #DDDDDD;width: 40px;" >
					   <?php $total_mora += $total_mora_x_mes; ?>
					   <?php echo numbers::my_format_number($total_mora_x_mes) ?>
					</th>
					<?php foreach ($array_total_items_x_mes as $total_items_x_mes): ?>
					<th style="border-left: 1px solid #DDDDDD;width: 100px;" >
					   <?php echo numbers::my_format_number($total_items_x_mes['cobro']); ?>
					</th>
					<?php endforeach;?>
					<th style="border-left: 1px solid #DDDDDD" >
					   <?php $total += $total_x_curso_x_mes; ?>
					   <?php echo numbers::my_format_number($total_x_curso_x_mes); ?>
					</th>
				     </tr>
				     </tfoot>
				   </table>
				</td>
			</tr>
		      <?php endforeach; ?>
		    </tbody>
		    <tfoot>
		      <tr>
			 <th style="border-left: 1px solid #DDDDDD;width: 300px;" colspan="4" >
			    <span style="margin-left: 250px;">TOTALES:</span>
			 </th>
			 <th style="border-left: 1px solid #DDDDDD;width: 90px;" >
                             <?php echo numbers::my_format_number($total_mensualidad); ?>
                         </th>
			 <th style="border-left: 1px solid #DDDDDD;width: 40px;" >
                             <?php echo numbers::my_format_number($total_mora); ?>
                         </th>

			<?php foreach ($array_total_items as $total_item): ?>
			<th style="border-left: 1px solid #DDDDDD;width: 100px;" >
			   <?php echo numbers::my_format_number($total_item['cobro']); ?>
			</th>
			<?php endforeach;?>

			 <th style="border-left: 1px solid #DDDDDD" >
                             <?php echo numbers::my_format_number($total); ?>
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
    <?php include_partial('Reports/list_footer', array()) ?>
  </div>
</div>