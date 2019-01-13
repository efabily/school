<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_form">
  <?php echo form_tag_for($form, '@currency_price') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php // foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php // include_partial('currencyPrice/form_fieldset', array('CurrencyPrice' => $CurrencyPrice, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php // endforeach; ?>
   <table>
      <tr>
	 <td>
	    <?php echo $form['currency_id']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['currency_id']->render(); ?>
	 </td>
      </tr>
      <tr>
	 <td>
	    <?php echo $form['sale']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['sale']->render(); ?>
	 </td>
      </tr>
      <tr>
	 <td>
	    <?php echo $form['purchase']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['purchase']->render(); ?>
	 </td>
      </tr>
      <tr>
	 <td>
	    <?php echo $form['reference']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['reference']->render(); ?>
	 </td>
      </tr>
      <tr>
	 <td>
	    <?php echo $form['since_date']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['since_date']->render(); ?>
	 </td>
      </tr>
      <tr>
	 <td>
	    <?php echo $form['until_date']->renderLabel(); ?>
	 </td>
	 <td class="content" >
	    <?php echo $form['until_date']->render(); ?>
	 </td>
      </tr>
   </table>
   

    <?php include_partial('currencyPrice/form_actions', array('CurrencyPrice' => $CurrencyPrice, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>