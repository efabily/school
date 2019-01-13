<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Reports/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('Lista de Alumnos', array(), 'messages') ?></h1>

  <?php include_partial('Reports/flashes') ?>
  
  <table style="width:100%;" >
     <tr>
	<td>
	   <div id="sf_admin_bar">
	     <?php include_partial('Reports/filters', array('form' => $filters)) ?>
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
			  <th colspan="12" class="sf_admin_text sf_admin_list_th_codigo" style="padding-left: 200px;">
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
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >LU</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >MA</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >MI</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >JU</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >VI</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >SA</th>
			 <th class="sf_admin_text sf_admin_list_th_codigo" style="border-left: 1px solid #000" >OBSERVACIONES</th>
		      </tr>
		    </thead>
		    <tfoot>
		      <tr>
			<th colspan="12">

			</th>
		      </tr>
		    </tfoot>
		    <tbody>
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
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000"></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			   <td class="sf_admin_date sf_admin_list_td_created_at" style="border-left: 1px solid #000" ></td>
			</tr>
		      <?php endforeach; ?>
		    </tbody>
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