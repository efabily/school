<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Reports/assets') ?>

<?php 
  function getSumItem($monthNumber, $gradeId, $typeId, $rowset)
  {
        $sum = 0;
        foreach ($rowset as $item)
        {
            if($item['number'] == $monthNumber && $item['grade_id'] == $gradeId && $item['type_item_id'] == $typeId)
            {
                $sum += $item['amount'];
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
            }
        }

        return $sum;
  }
  
  ?>


<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('Resumen Mensualidad por Curso', array(), 'messages') ?></h1>

  <?php include_partial('Reports/flashes') ?>
  
  <table style="width:100%;" >
     <tr>
	<td>
	   <div id="sf_admin_bar">
	     <?php include_partial('Reports/filters_resumen_mensualidad', array('form' => $filters)) ?>
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
			  <th colspan="11" class="sf_admin_text sf_admin_list_th_codigo" style="padding-left: 200px;">
			     <?php echo $cadena; ?>
			 </th>
		      </tr>
		      <tr>
                          <th class="sf_admin_text sf_admin_list_th_codigo" style="width: 60px;">
			    TURNO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_codigo" style="width: 90px;" >
			    CICLO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_father_name" style="width: 80px;" >
			    CURSO
			  </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			    CREDITO<br />MENSUALIDAD
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			    DESCUENTO
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			    TOTAL CREDITO<br />MENSUALIDAD
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;color: #045686;width: 120px;" >
			    COBRO<br />MENSUALIDAD
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;color: #045686;width: 120px;" >			    
			    SALDO<br />MENSUALIDAD
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;width: 80px;" >
			    MORAS
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;color: #045686;width: 120px;" >
			    COBRO MORAS
			 </th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD;color: #045686;width: 120px;" >
			    SALDOS MORAS
			 </th>
		      </tr>
		    </thead>		    
		    <tbody>
		       <?php 
		       $total_credito_mensualidad = $total_descuento = $total_total_credito_mensualidad = 
		       $total_cobro_mensualidad = $total_saldo_mensualida = 
		       $total_mora = $total_cobro_mora = $total_saldo_mora = 0;
		       ?>
		      <?php foreach ($grades as $i => $grade): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
			<tr class="sf_admin_row <?php echo $odd ?>">
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="width: 60px;" >
			      <?php echo $grade->getTimetable(); ?>
			   </td>            
			   <td class="sf_admin_text sf_admin_list_td_codigo" style="width: 90px;" >
			     <?php echo $grade->getDegree() ?>
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_father_name" style="width: 80px;" >
			     <?php echo $grade->getCurso() ?>
			   </td>
			   <?php $array_mensualidad = SalesPeer::getTotalMensualidadReporte($period_id, $grade->getId(), $nro_mes) ?>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;">
			      <?php $total_credito_mensualidad += $array_mensualidad[0]; ?>
			      <?php echo numbers::my_format_number($array_mensualidad[0]); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			      <?php $total_descuento += $array_mensualidad[1];?>
			      <?php echo numbers::my_format_number($array_mensualidad[1]); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			      <?php $total_total_credito_mensualidad += $array_mensualidad[2];?>			      
			      <?php echo numbers::my_format_number($array_mensualidad[2]); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;">
			      <?php // $mensualidad_pagada = SalesPeer::getTotalMensualidadReportePagada($period_id, $grade->getId(), $nro_mes, 2, $from_date, $to_date);?>
                              <?php $mensualidad_pagada = getSumItem($nro_mes, $grade->getId(), 2, $rowset) ?>
			      <?php $total_cobro_mensualidad += $mensualidad_pagada;?>
			      <?php echo numbers::my_format_number($mensualidad_pagada);?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;">
			      <?php $saldo_mensualidad = ($array_mensualidad[2] - $mensualidad_pagada) ?>
			      <?php $total_saldo_mensualida += $saldo_mensualidad;?>
			      <?php echo numbers::my_format_number($saldo_mensualidad); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 80px;" >
			      <?php $array_mora = SalesPeer::getTotalMoraReporte($period_id, $grade->getId(), $nro_mes);?>
			      <?php $total_mora += $array_mora[0];?>
			      <?php echo numbers::my_format_number($array_mora[0]); ?>
			   </td>			   
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			      <?php // $mora_pagada = SalesPeer::getTotalMensualidadReportePagada($period_id, $grade->getId(), $nro_mes, 1, $from_date, $to_date); ?>
                              <?php $mora_pagada = getSumItem($nro_mes, $grade->getId(), 1, $rowset)?>
			      <?php $total_cobro_mora += $mora_pagada;?>
			      <?php echo numbers::my_format_number($mora_pagada) ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD;width: 120px;" >
			      <?php $saldo_mora = ($array_mora[0] - $mora_pagada); ?>
			      <?php $total_saldo_mora += $saldo_mora;?>
			      <?php echo numbers::my_format_number($saldo_mora) ?>
			   </td>
			</tr>
		      <?php endforeach; ?>
		    </tbody>
		    <tfoot>
		      <tr>
			<th colspan="3" style="width: 230px" >
			   <strong style="margin-left: 170px; "> TOTAL: </strong>
			</th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_credito_mensualidad);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_descuento);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_total_credito_mensualidad);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_cobro_mensualidad);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_saldo_mensualida);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 80px;" ><?php echo numbers::my_format_number($total_mora);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_cobro_mora);?></th>
			<th style="border-left: 1px solid #DDDDDD;width: 120px;" ><?php echo numbers::my_format_number($total_saldo_mora);?></th>
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