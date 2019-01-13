<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('discount_collection', array('action' => 'filter')) ?>" method="post">
     <table cellspacing="0">
      <tbody>
       <tr>
          <td>
             <?php echo $form->renderHiddenFields() ?>	       
             <?php echo $form['id_state']->render()?>
          </td>
          <td>
             <?php echo $form['name']->render()?>
          </td>
          <td>
             <?php echo $form['discount']->render()?>
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
             Nombre
          </td>
          <td>
             Descuento
          </td>
          <td>
             <?php echo link_to(__('Limpiar', array(), 'sf_admin'), 'discount_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
          </td>
       </tr>
      </tbody>
    </table>         
  </form>
</div>
