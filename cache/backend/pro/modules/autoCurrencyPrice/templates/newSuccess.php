<?php use_helper('I18N', 'Date') ?>
<?php include_partial('currencyPrice/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New CurrencyPrice', array(), 'messages') ?></h1>

  <?php include_partial('currencyPrice/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('currencyPrice/form_header', array('CurrencyPrice' => $CurrencyPrice, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('currencyPrice/form', array('CurrencyPrice' => $CurrencyPrice, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('currencyPrice/form_footer', array('CurrencyPrice' => $CurrencyPrice, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
