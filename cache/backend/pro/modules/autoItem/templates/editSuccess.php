<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Item/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Item', array(), 'messages') ?></h1>

  <?php include_partial('Item/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Item/form_header', array('Item' => $Item, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('Item/form', array('Item' => $Item, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('Item/form_footer', array('Item' => $Item, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
