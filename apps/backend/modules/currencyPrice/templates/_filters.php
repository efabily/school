<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('currency_price_collection', array('action' => 'filter')) ?>" method="post">
     
     <table cellspacing="0">
      <tbody>
       <tr>
          <td>
             <?php echo $form->renderHiddenFields() ?>             
          </td>
          <td>
             <?php echo $form['since_date']->render()?>
          </td>          
          <td>
             <?php echo $form['until_date']->render()?>
          </td>   
	  <td>	     
	     <?php echo $form['currency_id']->render()?>
	  </td>
	  <td>	     
	     <?php echo $form['user_id']->render()?>
	  </td>
          <td>
             <input type="submit" value="<?php echo __('Buscar', array(), 'sf_admin') ?>" />
          </td>
       </tr>   
       <tr>
          <td>
             
          </td>
          <td>
             Desde Fecha
          </td>
          <td>
             Hasta Fecha
          </td>
	  <td>
             Moneda
          </td>
          <td>
             Usuario
          </td>
          <td>
             <?php echo link_to(__('Limpiar', array(), 'sf_admin'), 'currency_price_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
          </td>
       </tr>
      </tbody>
    </table>
  </form>
</div>
