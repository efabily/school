<?php use_helper('I18N', 'Date') ?>
<?php include_partial('Student/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Student', array(), 'messages') ?></h1>

  <?php include_partial('Student/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('Student/form_header', array('Student' => $Student, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('Student/form', array('Student' => $Student, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('Student/form_footer', array('Student' => $Student, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
