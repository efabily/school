<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Student/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('EDITAR DATOS DEL ALUMNO', array(), 'messages') ?></h1>

  <h2 style="font-size:20px;margin-bottom:10px">
     <a href="/Student/edit/id/<?php echo $Student->getId()?>"  class="class_suffix">
	EDICION CORTA</a> | 
     <a style="background-color:#ccc;padding:5px;color:#000" href="/Student/recordShortEdit/id/<?php echo $Student->getId()?>" class="class_suffix">
	EDICION COMPLETA
     </a>
  </h2>
  
  <?php include_partial('Student/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Student/form_header', array('Student' => $Student, 'form' => $form, 'configuration' => $configuration)) ?>
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
  <?php echo form_tag_for($form, 'Student/update', array('method' => 'POST')) ?>
    <?php // echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
   
   <fieldset style="">
	<legend>II. DATOS DE LA O EL ESTUDIANTE</legend>
	
	 <?php echo $form['id']->render(); ?>
	 <?php echo $form['contract_id']->render(); ?>
<table>
	<tr valign="top">
		<td>
			<h3>2.1. APELLIDO (S) Y NOMBRE (S)</h3>
			<table>
				<tr>
					<td>Apellido Paterno:</td>
					<td><?php echo $form['estudiante_apellido_paterno']->render(); ?></td>
				</tr>
				<tr>
					<td>Apellido Materno:</td>
      				<td><?php echo $form['estudiante_apellido_materno']->render(); ?></td>
				</tr>
				<tr>
					<td>Nombre (s):</td>
					<td><?php echo $form['estudiante_nombre']->render(); ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?php echo $form['estudiante_email']->render(); ?></td>
				</tr>
			</table>
			<h3>2.2. LUGAR DE NACIMIENTO</h3>
			<table>
				<tr>
					<td>Pais:</td>
					<td><?php echo $form['estudiante_nacimiento_pais']->render(); ?></td>
				</tr>
				<tr>
					<td>Departamento:</td>
      				<td><?php echo $form['estudiante_nacimiento_departamento']->render(); ?></td>
				</tr>
				<tr>
					<td>Provincia:</td>
					<td><?php echo $form['estudiante_nacimiento_provincia']->render(); ?></td>
				</tr>
				<tr>
					<td>Localidad:</td>
					<td><?php echo $form['estudiante_nacimiento_localidad']->render(); ?></td>
				</tr>
			</table>
		</td>
		<td>
			<h3>2.3. CÓDIGO ESTUDIANTIL RUDE</h3>
			<table>
				<tr>
					<td><?php echo $form['rude']->render(array()); ?></td>
				</tr>
			</table>
			
			<h3>2.4. DOCUMENTO DE IDENTIFICACIÓN</h3>
			<table>
				<tr>
					<td>Tipo del documento de identificación</td>
					<td><?php echo $form['tipo_documento']->render(); ?></td>
				</tr>
				<tr>
					<td>No del documento de identificación</td>
					<td><?php echo $form['estudiante_nro_documento']->render(); ?></td>
				</tr>
			</table>
			
			<table>
				<tr>
					<td>
						<h3>2.5. FECHA DE NACIMIENTO</h3>
						<table>
							<tr>
								<td>
									<table>
										<tr>
											<td><?php echo $form['fecha_nacimiento_dia']->render(array('style' => 'width: 40px;')); ?></td>
											<td><?php echo $form['fecha_nacimiento_mes']->render(array('style' => 'width: 40px;')); ?></td>
											<td><?php echo $form['fecha_nacimiento_anio']->render(array('style' => 'width: 70px;')); ?></td>
										</tr>
										<tr>
											<td>Día</td>
											<td>Mes</td>
											<td>Año</td>
										</tr>
									</table>
								</td>
							</tr> 
						</table>
					</td>
					<td>
						<h3>2.6. SEXO</h3>
						<table>
							<tr>
								<td><?php echo $form['estudiante_genero']->render(); ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			
			<h3>2.7. CERTIFICADO DE NACIMIENTO</h3>
			<table>
				<tr>
					<td>Oficialía No</td>
					<td>Libro No</td>
					<td>Partida No</td>
					<td>Folio No</td>
				</tr>
				<tr>
					<td><?php echo $form['certificado_nacimiento_oficialia']->render(array('style' => 'width: 50px;')); ?></td>
					<td><?php echo $form['certificado_nacimiento_libro']->render(array('style' => 'width: 150px;')); ?></td>
					<td><?php echo $form['certificado_nacimiento_partida']->render(array('style' => 'width: 50px;')); ?></td>
					<td><?php echo $form['certificado_nacimiento_folio']->render(array('style' => 'width: 50px;')); ?></td>
				</tr>
			</table>
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
	<legend>IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE</legend>
	
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td>Provincia</td>
						<td><?php echo $form['estudiante_direccion_provincia']->render(); ?></td>
					</tr>
					<tr>
						<td>Sección / Municipio</td>
						<td><?php echo $form['estudiante_direccion_session_municipio']->render(); ?></td>
					</tr>
					<tr>
						<td>Localidad / Comunidad</td>
						<td><?php echo $form['estudiante_direccion_localidad_comunidad']->render(); ?></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td>Zona / Villa</td>
						<td><?php echo $form['estudiante_direccion_zona_villa']->render(); ?></td>
					</tr>
					<tr>
						<td>Avenida / Calle</td>
						<td><?php echo $form['estudiante_direccion_avenida_calle']->render(array('style' => 'width: 350px;')); ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<table>
								<tr>
									<td>Teléfono/Celular</td>
									<td><?php echo $form['estudiante_direccion_celular']->render(); ?></td>
									<td>Número de vivienda</td>
									<td><?php echo $form['estudiante_direccion_numero_vivienda']->render(); ?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
     </fieldset>
      <fieldset>
          <legend>V. ASPECTOS SOCIALES</legend>
          <table >
              <tr>
                  <td colspan="2" style="vertical-align: top;" >
                      <h3>5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE </h3>
                  </td>
                  <td style="vertical-align: top;" >
                      <h3>5.2. SALUD</h3>                      
                  </td>
              </tr>
              <tr>
                  <td style="text-align: left; vertical-align: top;">
                      <table>
                        <tr>
                          <td style="vertical-align: top;" >
                                5.1.1.¿Cuál es el idioma que
                                aprendió a hablar en su
                                niñez la o el estudiante?
                          </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;" >                                
				<?php echo $form['idioma_nines']->render(); ?>
                            </td>
                        </tr>
                        <tr>
                          <td style="vertical-align: top;" >
                                5.1.2. ¿Qué idiomas habla
                                frecuentemente
                                la o el estudiante?
                          </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;" >                                
								<?php echo $form['idioma_habla_frecuentemente_1']->render(); ?><br /><br />
								<?php echo $form['idioma_habla_frecuentemente_2']->render(); ?><br /><br />
								<?php echo $form['idioma_habla_frecuentemente_3']->render(); ?><br />
                            </td>
                        </tr>                                                                                               
                      </table>
                      
                      
                      
                  </td>
                  <td style="text-align: left; vertical-align: top;">
                      <table>
                          <tr>
                              <td style="vertical-align: top;" >
                                  5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align: left;vertical-align:top">
                              	<div id="point_513">
                              		<?php echo $form['pertenece']->render(); ?>
                              		
                              		<div style="clear:both;margin-top:15px">
				 				    	<?php echo $form['otro_pertenece']->render(); ?>
				 				    </div>
                              	</div>
                              </td>
                          </tr>
                      </table>
                  </td>
                  <td style="width: 350px; text-align: left; vertical-align: top; vertical-align: top;">
                     <table>
			<tr>
			   <td style="text-align: left; vertical-align: top;">
			      5.2.1.¿Existe Centro de Salud / Posta / Hospital en su comunidad?
			   </td>
			   <td style="width: 80px; text-align: right; vertical-align: top;">			       
			       <?php echo $form['hospital']->render(); ?>
			   </td>
			</tr>
			<tr>
			   <td style="text-align: left; vertical-align: top;" colspan="2">
			      5.2.2. ¿Cuántas veces fue la o el estudiante al centro de salud el año pasado?
			   </td>			   
			</tr>
			<tr>
			   <td style="text-align: left; vertical-align: top;" colspan="2">
			   	  <div id="point_522">
			      	<?php echo $form['hospital_veces']->render(); ?>
			      </div>
			   </td>
			</tr>
			<tr>
			   <td style="text-align: left; vertical-align: top;" colspan="2">
			       
			   </td>			   
			</tr>
			<tr>
			   <td style="text-align: left; vertical-align: top;" colspan="2">
			   		<table>
			   			<tr valign="top">
			   				<td>
			   					<h3>5.2.3. Presenta la o el estudiante alguna discapacidad</h3>
			   					<table>
			   						<tr>
			   							<td>
			   								<div id="discapacidad_sensorial_group">
				   								Sensorial y de la comunicación<br>
					       						<?php echo $form['discapacidad_sensorial']->render(); ?>
				       						</div>
			   							</td>
			   						</tr>
			   						<tr>
			   							<td>
			   								<div id="discapacidad_motriz_group">
			   									Motriz<br>
				       							<?php echo $form['discapacidad_motriz']->render(); ?>
				       						</div>
			   							</td>
			   						</tr>
			   						<tr>
			   							<td>
			   								<div id="discapacidad_mental_group">
				   								Mental<br>
					       						<?php echo $form['discapacidad_mental']->render(); ?>
				       						</div>
			   							</td>
			   						</tr>
			   					</table>
			   				</td>
			   				<td>
			   					<h3>5.2.4. Su discapacidad es:</h3>
			   					<table style="width:117px">
			   						<tr>
			   							<td>
			   								<div id="point_524"><?php echo $form['origen_discapacidad']->render() ?></div>
			   							</td>
			   						</tr>
			   					</table>
			   				</td>
			   			</tr>
			   		</table>
			   </td>			   
			</tr>
			
		     </table> 
                  </td>
              </tr>
          </table>
	  
	  <table>
	     <tr>
		<td style="vertical-align: top;" >
		   <h3>5.3. ACCESO A SERVICIOS BÁSICOS </h3>
		</td>
		<td style="vertical-align: top;" >
		   <h3>5.4. EMPLEO </h3>
		</td>
		<td colspan="2" style="vertical-align: top;" >
		   <h3>5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE </h3>
		</td>		
	     </tr>
	     <tr>
		<td style="text-align: left; vertical-align: top;width:275px">
		   <table>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.3.1. El agua de su casa proviene de:
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_531"><?php echo $form['acceso_servicio_basico']->render(); ?></div>
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.3.2. ¿La o el estudiante tiene energía eléctrica en su vivienda?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="text-align: center; vertical-align: top;">
			    <?php echo $form['energia_electrica']->render(); ?>
			 </td>			 
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.3.3. El baño, water o letrina de su casa tiene desagüe a:
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_533"><?php echo $form['bano']->render(); ?></div>
			   
			 </td>			 
		      </tr>		    		      
		   </table>
		</td>
		<td style="text-align: left; vertical-align: top;">
		   <table>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.4.1. ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_541"><?php echo $form['trabajo']->render(); ?></div>
			 </td>
		      </tr>		      
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.4.2. La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    <?php echo $form['cuantos_dias_trabajo']->render(); ?>
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.4.3. ¿Recibió algún pago por el trabajo realizado?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    <?php echo $form['recibio_pago']->render(); ?>
			 </td>
		      </tr>
		   </table>
		</td>
		<td style="text-align: left; vertical-align: top;">
		   <table style="width:240px">
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.5.1. La o el estudiante accede a internet en:
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_551"><?php echo $form['accede_internet']->render(); ?></div>
			 </td>
		      </tr>		      
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.5.2. ¿Con qué frecuencia la o el estudiante accede a internet?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			   <div id="point_552"><?php echo $form['frecuencia_internet']->render(); ?></div>
			 </td>			
		      </tr>
		   </table>
		</td>
		<td style="text-align: left; vertical-align: top;">
		   <table>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.5.3. ¿Cómo llega la o el estudiante a la Unidad Educativa?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_553"><?php echo $form['transporte']->render(); ?></div>
			 </td>			 
		      </tr>		      		      
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			    5.5.4. En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?
			 </td>
		      </tr>
		      <tr>
			 <td colspan="2" style="vertical-align: top;" >
			 	<div id="point_554"><?php echo $form['tiempo_transporte']->render(); ?></div>
			 </td>			 
		      </tr>		      
		   </table>
		</td>
	     </tr>
	  </table>	  	  
      </fieldset>
      <fieldset>
          <legend>VI. DATOS DEL PADRE, MADRE O TUTOR (a) DE LA O EL ESTUDIANTE</legend>
		  <table>
          	<tr valign="top">
          		<td>
          			<h3>6.1. DATOS DEL PADRE O TUTOR (a)</h3>
          			<table>
          				<tr>
							<td>Cédula de Identidad</td>
							<td><?php echo $form['padre_tutor_cedula_identidad']->render(); ?></td>
          				</tr>
          				<tr>
							<td>Apellidos</td>
							<td><?php echo $form['padre_tutor_apellido_paterno']->render(); ?></td>
          				</tr>
					<tr>
							<td>Apellidos</td>
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
						<td>Ocupación laboral actual</td>
						<td><?php echo $form['madre_ocupacion']->render(); ?></td>
					</tr>
					<tr>
						<td>Mayor grado de instrucción alcanzado</td>
						<td><?php echo $form['madre_grado_instruccion']->render(); ?></td>
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
	     <td style="vertical-align: top;" >
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
    <?php include_partial('Student/form_footer', array('Student' => $Student, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
