<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Period/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000;"><?php echo __('Editando un Periodo', array(), 'messages') ?></h1>

  <?php include_partial('Period/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Period/form_header', array('Period' => $Period, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('Period/form', array('Period' => $Period, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('Period/form_footer', array('Period' => $Period, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
