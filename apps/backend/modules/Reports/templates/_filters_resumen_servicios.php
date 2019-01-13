<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="/Reports/FilterResumenServicios" method="post">
    <table cellspacing="0">      
      <tbody>
	 <tr>
            <td>
                 <div style="font-style: italic;font-size: 11; color:#045686;">
                    El rango de fecha es para sacar los cobros
                </div>
            </td>
	    <td>
	       <?php echo $form['timetable_id']->render()?>
	    </td>
	    <td>
	       <?php echo $form['degree_id']->render()?>
	    </td>
	    <td>
	       <?php echo $form['curso_id']->render()?>
	    </td>
	    <td>
	       <?php echo $form['item_id']->render()?>
	    </td>
	    <td>
	       <?php echo $form['nro_mes']->render()?>
	    </td>
	    <td>
	       <?php echo $form['from_date']->render()?>
	    </td>
	    <td>
	       <?php echo $form['to_date']->render()?>
	    </td>
	    <td>
	       <input type="submit" value="<?php echo __('Buscar', array(), 'sf_admin') ?>" />
	    </td>
	 </tr>
	 <tr>
             <td>
                 
             </td>
	    <td>
	       Turno
	    </td>
	    <td>
	       Ciclo
	    </td>
	    <td>
	       Curso
	    </td>
	    <td>
	       Item
	    </td>
	    <td>
	       Mes
	    </td>
	    <td>
	       Desde
	    </td>
	    <td>
	       Hasta
	    </td>
	    <td>
	       <?php echo link_to('Limpiar', '/Reports/FilterResumenServicios', array('query_string' => '_reset', 'method' => 'post')) ?>
	       
	    </td>
	 </tr>
      </tbody>
    </table>
  </form>
</div>
<link rel="stylesheet" type="text/css" href="/css/print_reportes.css" media="print">
<input type="button" value="IMPIMIR" onclick="window.print()" style="padding:5px">