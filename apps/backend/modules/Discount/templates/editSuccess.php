<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Discount/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Editando un Descuento', array(), 'messages') ?></h1>

  <?php include_partial('Discount/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Discount/form_header', array('Discount' => $Discount, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('Discount/form', array('Discount' => $Discount, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('Discount/form_footer', array('Discount' => $Discount, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
