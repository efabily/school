<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Student/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" >
      <?php echo __('NUEVO ALUMNO', array(), 'messages') ?>
  </h1>
  
	<h2 style="font-size:20px;margin-bottom:10px">
	   <a href="/Student/recordShort"  class="class_suffix">REGISTRO CORTO</a> | 
	   <a style="background-color:#ccc;padding:5px;color:#000" href="/Student/new" class="class_suffix">REGISTRO COMPLETO</a>
	</h2>

  <?php include_partial('Student/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Student/form_header', array('form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php  include_partial('Student/form', array('form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
     
     

  <div id="sf_admin_footer">
    <?php include_partial('Student/form_footer', array('form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>