<?php use_helper('I18N', 'Date') ?>
<?php include_partial('cashbox/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Cashbox', array(), 'messages') ?></h1>

  <?php include_partial('cashbox/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('cashbox/form_header', array('Cashbox' => $Cashbox, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('cashbox/form', array('Cashbox' => $Cashbox, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('cashbox/form_footer', array('Cashbox' => $Cashbox, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
