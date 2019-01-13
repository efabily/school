<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Reports/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('SALDO DEUDAS POR MENSUALIDAD', array(), 'messages') ?></h1>

  <?php include_partial('Reports/flashes') ?>
  
  <table style="width:100%;" >
     <tr>
	<td>
	   <div id="sf_admin_bar">
	     <?php include_partial('Reports/filters_ctas_ctes', array('form' => $filters)) ?>
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
			  <th colspan="16" class="sf_admin_text sf_admin_list_th_codigo" style="padding-left: 200px;">
			     <?php echo $cadena; ?>
			 </th>
		      </tr>
		      <tr>
			  <th class="sf_admin_text sf_admin_list_th_codigo">
			    NRO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_codigo">
			    CODIGO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_father_name">
			    APELLIDO PATERNO
			  </th>
			  <th class="sf_admin_text sf_admin_list_th_mother_name">
			    APELLIDO MATERNO
			  </th>	    
			  <th class="sf_admin_text sf_admin_list_th_first_name">
			    NOMBRE
			  </th>	    
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >ENERO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >FEBRERO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >MARZO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >ABRIL</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >MAYO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >JUNIO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >JULIO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >AGOSTO</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >SEPTIEMBRE</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >OCTUBRE</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #DDDDDD" >TOTAL</th>
		      </tr>
		    </thead>
		    <tbody>
		       <?php $total_total_alumno = $total_enero = $total_febrero =  $total_marzo = $total_abril = $total_mayo = $total_junio = $total_julio = $total_agosto = $total_septiembre = $total_obtubre = 0;?>
		      <?php foreach ($Students as $i => $Student): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
			<tr class="sf_admin_row <?php echo $odd ?>">
			   <td class="sf_admin_date sf_admin_list_td_created_at"><?php echo $i; ?></td>            
			   <td class="sf_admin_text sf_admin_list_td_codigo">
			     <?php echo $Student->getCodigo() ?>
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_father_name">
			     <?php echo $Student->getFatherName() ?>
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_mother_name">
			     <?php echo $Student->getMotherName() ?>
			   </td>
			   <td class="sf_admin_text sf_admin_list_td_first_name">
			     <?php echo $Student->getFirstName() ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD">
			      <?php $enero =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 1); ?>
			      <?php $total_enero += $enero; ?>
			      <?php echo numbers::my_format_number($enero); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $febrero =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 2); ?>
			      <?php  $total_febrero += $febrero; ?>
			      <?php  echo numbers::my_format_number($febrero); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $marzo =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 3); ?>
			      <?php  $total_marzo += $marzo; ?>
			      <?php  echo numbers::my_format_number($marzo); ?>			      
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $abril =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 4); ?>
			      <?php  $total_abril += $abril; ?>
			      <?php  echo numbers::my_format_number($abril); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $mayo =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 5); ?>
			      <?php  $total_mayo += $mayo; ?>
			      <?php  echo numbers::my_format_number($mayo); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD">
			      <?php  $junio =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 6); ?>
			      <?php  $total_junio += $junio; ?>
			      <?php  echo $junio; ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $julio =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 7); ?>
			      <?php  $total_julio += $julio; ?>
			      <?php  echo numbers::my_format_number($julio); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $agosto =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 8); ?>
			      <?php  $total_agosto += $agosto; ?>
			      <?php  echo numbers::my_format_number($agosto); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $septiembre =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 9); ?>
			      <?php  $total_septiembre += $septiembre; ?>
			      <?php  echo numbers::my_format_number($septiembre); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $obtubre =  AccountPeer::getTotalDeudaReports($period_id, $Student->getId(), 10); ?>
			      <?php  $total_obtubre += $obtubre; ?>
			      <?php  echo numbers::my_format_number($obtubre); ?>
			   </td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #DDDDDD" >
			      <?php  $total_alumno = $enero + $febrero + $marzo + $abril + $mayo + $junio + $julio + $agosto + $septiembre + $obtubre; ?>
			      <?php  $total_total_alumno += $total_alumno; ?>
			      <?php  echo numbers::my_format_number($total_alumno); ?>
			   </td>
			</tr>
		      <?php endforeach; ?>
			
		    </tbody>
		    <tfoot>
		      <tr>
			<tr>
			   <th colspan="5">
			      <span style="margin-left: 200px;">TOTALES</span>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_enero); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_febrero); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_marzo); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_abril); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_mayo); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_junio); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_julio); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_agosto); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_septiembre); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_obtubre); ?>
			   </th>
			   <th>
			      <?php  echo numbers::my_format_number($total_total_alumno); ?>
			   </th>
		        </tr>
			</tr>
		    </tfoot>
		  </table>
	      </div>
	   </div>	   
	</td>
     </tr>
  </table>
  <div id="sf_admin_footer">
    <?php include_partial('Reports/list_footer', array('Students' => $Students)) ?>
  </div>
</div>