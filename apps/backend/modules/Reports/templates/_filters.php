<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="/Reports/FilterListStudents" method="post">
    <table cellspacing="0">      
      <tbody>
	 <tr>
	    <td>
	       <?php // echo $form->renderHiddenFields() ?>
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
	       <?php echo $form['first_name']->render()?>
	    </td>
	    <td>
	       <?php echo $form['father_name']->render()?>
	    </td>
	    <td>
	       <?php echo $form['mother_name']->render()?>
	    </td>
	    <td>
	       <?php echo $form['codigo']->render()?>
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
	       Nombre
	    </td>
	    <td>
	       Apellido Paterno
	    </td>
	    <td>
	       Apellido Materno
	    </td>
	    <td>
	       Codigo
	    </td>
	    <td>
	       <?php echo link_to('Limpiar', '/Reports/FilterListStudents', array('query_string' => '_reset', 'method' => 'post')) ?>
	       
	    </td>
	 </tr>
      </tbody>
    </table>
  </form>
</div>

<link rel="stylesheet" type="text/css" href="/css/print_reportes.css" media="print">
<input type="button" value="IMPIMIR" onclick="window.print()" style="padding:5px">