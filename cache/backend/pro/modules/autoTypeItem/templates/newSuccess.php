<?php use_helper('I18N', 'Date') ?>
<?php include_partial('TypeItem/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New TypeItem', array(), 'messages') ?></h1>

  <?php include_partial('TypeItem/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('TypeItem/form_header', array('TypeItem' => $TypeItem, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('TypeItem/form', array('TypeItem' => $TypeItem, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('TypeItem/form_footer', array('TypeItem' => $TypeItem, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
