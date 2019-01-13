<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Student/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000">
      <?php echo __('EDITAR DATOS DEL ALUMNO', array(), 'messages') ?>
  </h1>
  
  <h2 style="font-size:20px;margin-bottom:10px">
     <a style="background-color:#ccc;padding:5px;color:#000" href="/Student/edit/id/<?php echo $Student->getId()?>"  class="class_suffix">
	EDICION CORTA</a> | 
     <a href="/Student/recordShortEdit/id/<?php echo $Student->getId()?>" class="class_suffix">
	EDICION COMPLETA
     </a>
  </h2>

  <?php include_partial('Student/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Student/form_header', array('form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php use_stylesheets_for_form($form) ?>
    <?php use_javascripts_for_form($form) ?>

<style>
   #tbl_nivel td{
      padding: 2px;
      margin: 2px;
   }
</style>
<div class="sf_admin_form">
  <?php echo form_tag_for($form, 'Student/saveRecordSortEdit', array('method' => 'POST')) ?>
    <?php // echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
   
   <?php echo $form['id']->render(); ?>
   <?php echo $form['contract_id']->render(); ?>
      	  
      <fieldset style="">
	<legend>II. DATOS DE LA O EL ESTUDIANTE</legend>
	
	<table border="1">
	   <tr>
	      <td colspan="2" style="vertical-align: top;">
		 <h3>2.1. APELLIDO (S) Y NOMBRE (S)</h3>
	      </td>
	      <td style="vertical-align: top;">
		 <h3>2.6. SEXO</h3>
	      </td>
	      <td style="vertical-align: top;text-align: left;">
		 <?php echo $form['estudiante_genero']->render(); ?>
	      </td>
	   </tr>
	   <tr>
	      <td style="vertical-align: top;">
		Apellido Paterno: 
	      </td>
	      <td style="vertical-align: top;">
		 <?php echo $form['estudiante_apellido_paterno']->render(); ?>
	      </td>
	      <td style="vertical-align: top;">
		
	      </td>
	      <td style="vertical-align: top;">
		
	      </td>
	   </tr>
	   <tr>
	      <td style="vertical-align: top;">
		 Apellido Materno:
	      </td>
	      <td style="vertical-align: top;">
		 <?php echo $form['estudiante_apellido_materno']->render(); ?>
	      </td>	      	      
	   </tr>
	   <tr>
	      <td style="vertical-align: top;">
		 Nombre (s):
	      </td>
	      <td style="vertical-align: top;">		 
		 <?php echo $form['estudiante_nombre']->render(); ?>
	      </td>
	      <td style="vertical-align: top;">
		 
	      </td>
	      <td style="vertical-align: top;">		 
		 
	      </td>
	   </tr>	   
	</table>			 
     </fieldset>
     
     <fieldset style="border:1px solid #adbcc3">
	<legend>III. DATOS DE INSCRIPCIÓN EN LA GESTIÓN ACTUAL</legend>
	<table id="tbl_nivel">
	   <tr>
	      <td style="vertical-align: top;">
		 <h3>3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE</h3>
	      </td>
	   </tr>
	   <tr>
	      <?php if(isset($form['nivel_m'])):?>
	      <td style="vertical-align: top;text-align: center;" >
		MAÑANA
	      </td>
	      <?php endif; ?>
	      <?php if(isset($form['nivel_t'])):?>
	      <td style="vertical-align: top;text-align: center;"  >
		TARDE
	      </td>
	      <?php endif; ?>
	   </tr>
	   <tr>
	      <?php if(isset($form['nivel_m'])):?>
	      <td style="vertical-align: top;" class="jqG1">
		 <?php echo $form['nivel_m']->render(); ?>
	      </td>
	      <?php endif; ?>
	      <?php if(isset($form['nivel_t'])):?>
	      <td style="vertical-align: top;" class="jqG2">
		 <?php echo $form['nivel_t']->render(); ?>
	      </td>	      
	      <?php endif; ?>
	   </tr>
	   <?php if(isset($form['nivel_n'])):?>
	   <tr>
	      <td style="vertical-align: top;text-align: center;"  >
		NOCHE
	      </td>
	      <td> </td>
	   </tr>
	   <tr>
	      <td style="vertical-align: top;" class="jqG2">
		 <?php echo $form['nivel_n']->render(); ?>
	      </td>
	      <td> </td>
	   </tr>
	   <?php endif; ?>
	</table>
	
     </fieldset>
      
     <fieldset>
          <legend>VI. DATOS DEL PADRE, MADRE O TUTOR (a) DE LA O EL ESTUDIANTE</legend>
          <table>
          	<tr valign="top">
          		<td>
          			<h3>6.1. DATOS DEL PADRE O TUTOR </h3>
          			<table>
          				<tr>
							<td>Cédula de Identidad</td>
							<td><?php echo $form['padre_tutor_cedula_identidad']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Apellido Paterno</td>
							<td><?php echo $form['padre_tutor_apellido_paterno']->render(); ?></td>
          				</tr>
					<tr>
							<td>Apellido Materno</td>
							<td><?php echo $form['padre_tutor_apellido_materno']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Nombre(s)</td>
							<td><?php echo $form['padre_tutor_nombre']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Idioma que habla frecuentemente</td>
							<td><?php echo $form['padre_tutor_idioma_frecuente']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Mayor grado de instrucción alcanzado</td>
							<td><?php echo $form['padre_tutor_grado_instruccion']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Ocupación laboral actual</td>
							<td><?php echo $form['padre_tutor_ocupacion']->render(); ?></td>
          				</tr>
          				<tr>
							<td>En caso de tutor(a) ¿Cuál es el parentesco?</td>
							<td><?php echo $form['padre_tutor_parentesco']->render(); ?></td>
          				</tr>
          				<tr>
							<td>E-Mail</td>
							<td><?php echo $form['padre_email']->render(); ?></td>
          				</tr>
          			</table>
          		</td>
          		<td>
          		<h3>6.2. DATOS DE LA MADRE</h3>
					<table style="border:1px solid red">
					<tr>
						<td>Cédula de Identidad</td>
						<td><?php echo $form['madre_cedula_identidad']->render(); ?></td>
					</tr>
					<tr>
						<td>Apellido Paterno</td>
						<td><?php echo $form['madre_apellido_paterno']->render(); ?></td>
					</tr>
					<tr>
						<td>Apellido Materno</td>
						<td><?php echo $form['madre_apellido_materno']->render(); ?></td>
					</tr>
					<tr>
						<td>Nombre(s)</td>
						<td><?php echo $form['madre_nombre']->render(); ?></td>
					</tr>
					<tr>
						<td>Idioma que habla frecuentemente</td>
						<td><?php echo $form['madre_idioma_frecuente']->render(); ?></td>
					</tr>
					<tr>
					   
					        <td>Mayor grado de instrucción alcanzado</td>
						<td><?php echo $form['madre_grado_instruccion']->render(); ?></td>
					</tr>
					<tr>
						<td>Ocupación laboral actual</td>
						<td><?php echo $form['madre_ocupacion']->render(); ?></td>
					</tr>
					<tr>
						<td>E-Mail</td>
						<td><?php echo $form['madre_email']->render(); ?></td>
					</tr>
				</table>
          		</td>
          	</tr>
          </table>
      </fieldset> 
	<table style="width: 100%">
	   <tr>
	     <td style="vertical-align: top;">
		Lugar:
		<?php echo $form['lugar_registro']->render(); ?>
	     </td>
	     <td>
		Fecha de registro Día <?php echo $form['fecha_registro_dia']->render(array('style' => 'width: 40px;')); ?>
		Mes <?php echo $form['fecha_registro_mes']->render(array('style' => 'width: 40px;')); ?>
		Año <?php echo $form['fecha_registro_anio']->render(array('style' => 'width: 80px;')); ?>
	     </td>
	  </tr>
       </table>	  
  </div>

    <?php include_partial('Student/form_actions', array('form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
     
     

  <div id="sf_admin_footer">
    <?php include_partial('Student/form_footer', array('form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
