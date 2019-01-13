<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Item/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Item', array(), 'messages') ?></h1>

  <?php include_partial('Item/flashes') ?>

  <div id="sf_admin_content">
    <?php echo form_tag_for($form, 'Item/update', array('method' => 'POST')) ?>    
    <?php echo $form['id']->render(); ?>
     
    <?php if ($form->isCSRFProtected()) : ?>
      <?php echo $form['_csrf_token'] ?>
    <?php endif; ?>
     
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
     
	
    	<table style="width:100%">
    		<tr>
    			<td style="width:300px">
    				<table>
				       <tr>
					     <td>Tipo de Item: </td>
					     <td>
						<?php echo $form['type_item_id']->render(); ?>
					     </td>
			    		</tr>
    					<tr>
					     <td>Nombre: </td>
					     <td>
						<?php echo $form['name']->render(); ?>
					     </td>
			    		</tr>			    		
			    		<tr>
					  <td>Precio: </td>
					  <td>
					     <?php echo $form['price']->render(); ?>						
					  </td>
			    		</tr>
					<tr>
					  <td>Descripti&oacute;n: </td>
					  <td>
					     <?php echo $form['description']->render(); ?>
					  </td>
			    		</tr>
			    		<tr>
					   <td colspan="2">
						   <table id="tbl_nivel">
						     <tr>
							<td style="vertical-align: top;" colspan="2"> 
							   <h3>NIVEL/GRADO ESCOLAR PARA LOS QUE ESTARA DISPONIBLE</h3>
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
						   
						   
						  
						</td>			    			
			    		</tr>
    				</table>
    			</td>
    			<td>
			     <table>
				  <tr>
				     <td>Meses Disponibles</td>
				  </tr>
				  <tr>
				     <td style="width:150px; ">
					<?php echo $form['month']->render(); ?>
				     </td>
				  </tr>
				  <tr>
				     <td>Descuentos Soportados</td>
				  </tr>
				  <tr>
				     <td style="width:160px; ">
					<?php echo $form['discount']->render(); ?>
				     </td>
				  </tr>
			     </table>
    			</td>
    		</tr>
    	</table>
    	    	
	<?php include_partial('Item/form_actions', array('form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </form>
  </div>
</div>
