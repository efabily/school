<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('cashbox_collection', array('action' => 'filter')) ?>" method="post">
     <?php echo $form->renderHiddenFields() ?>
    <table cellspacing="0">      
      <tbody>
	 <tr>
	    <td>
	       <?php echo $form['id_state']; ?>
	    </td>
	    <td>
	       <?php echo $form['cashier_id']; ?>
	    </td>
	    <td>
	       <?php echo $form['from_date']; ?>
	    </td>
	    <td>
	       <?php echo $form['to_date']; ?>
	    </td>
	    <td style="width: 100px;">
	       
	    </td>
	    <td>
	       <input type="submit" value="<?php echo __('Buscar', array(), 'sf_admin') ?>" />
	    </td>
	 </tr>
	 <tr>
	    <td>
	      Estado 
	    </td>
	    <td>
	      Cajero 
	    </td>
	    <td>
	       Desde
	    </td>
	    <td>
	       Hasta
	    </td>
	    <td style="width: 100px;" >
	       
	    </td>
	    <td>
	      <?php echo link_to(__('Limpiar', array(), 'sf_admin'), 'cashbox_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?> 
	    </td>
	 </tr>
	 
        <?php //foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        <?php //if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php //include_partial('cashbox/filters_field', array(
            //'name'       => $name,
            //'attributes' => $field->getConfig('attributes', array()),
            //'label'      => $field->getConfig('label'),
            //'help'       => $field->getConfig('help'),
            //'form'       => $form,
            //'field'      => $field,
           // 'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
         // )) ?>
        <?php //endforeach; ?>
      </tbody>
    </table>
  </form>
</div>
