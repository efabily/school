<?php use_helper('I18N', 'Date') ?>
<?php include_partial('NightAudit/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit NightAudit', array(), 'messages') ?></h1>

  <?php include_partial('NightAudit/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('NightAudit/form_header', array('NightAudit' => $NightAudit, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('NightAudit/form', array('NightAudit' => $NightAudit, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('NightAudit/form_footer', array('NightAudit' => $NightAudit, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
