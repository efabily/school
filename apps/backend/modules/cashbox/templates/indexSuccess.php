<?php use_helper('I18N', 'Date', 'jQuery') ?>

<?php include_partial('cashbox/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000" ><?php echo __('Lista de Cajas', array(), 'messages') ?></h1>

  <?php include_partial('cashbox/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('cashbox/list_header', array('pager' => $pager)) ?>
  </div>
  
  <table style="width:100%;">
     <tr>
	<td>
	      <div id="sf_admin_bar">
		<?php include_partial('cashbox/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
	      </div>
	</td>
     </tr>
     <tr>
	<td>
	   
	   <div id="sf_admin_content">
    <form action="<?php echo url_for('cashbox_collection', array('action' => 'batch')) ?>" method="post">

       <div class="sf_admin_list">
  <?php if (!$pager->getNbResults()): ?>
    <p><?php echo __('No result', array(), 'sf_admin') ?></p>
  <?php else: ?>
    <table cellspacing="0" style="width:100%;">
      <thead>
        <tr>
	  <?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_text sf_admin_list_th_id">
	      <?php if ('id' == $sort[0]): ?>
		<?php echo link_to(__('Id', array(), 'messages'), '@cashbox', array('query_string' => 'sort=id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Id', array(), 'messages'), '@cashbox', array('query_string' => 'sort=id&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>
	    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_text sf_admin_list_th_id_state">
	      <?php if ('id_state' == $sort[0]): ?>
		<?php echo link_to(__('Estado', array(), 'messages'), '@cashbox', array('query_string' => 'sort=id_state&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Estado', array(), 'messages'), '@cashbox', array('query_string' => 'sort=id_state&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>
            
            <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_date sf_admin_list_th_created_at">
                <?php echo __('Fecha'); ?>
	    </th>
	    <?php end_slot(); ?>
            
	    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_date sf_admin_list_th_created_at">
	      <?php if ('created_at' == $sort[0]): ?>
		<?php echo link_to(__('Fecha de Apertura', array(), 'messages'), '@cashbox', array('query_string' => 'sort=created_at&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Fecha de Apertura', array(), 'messages'), '@cashbox', array('query_string' => 'sort=created_at&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>

	    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_date sf_admin_list_th_closing_date">
	      <?php if ('closing_date' == $sort[0]): ?>
		<?php echo link_to(__('Fecha de Cierre', array(), 'messages'), '@cashbox', array('query_string' => 'sort=closing_date&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Fecha de Cierre', array(), 'messages'), '@cashbox', array('query_string' => 'sort=closing_date&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>
	    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_text sf_admin_list_th_comment">
	      <?php if ('comment' == $sort[0]): ?>
		<?php echo link_to(__('Observación', array(), 'messages'), '@cashbox', array('query_string' => 'sort=comment&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Observación', array(), 'messages'), '@cashbox', array('query_string' => 'sort=comment&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>
	    <?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
	    <th class="sf_admin_foreignkey sf_admin_list_th_cashier_id">
	      <?php if ('cashier_id' == $sort[0]): ?>
		<?php echo link_to(__('Cajero', array(), 'messages'), '@cashbox', array('query_string' => 'sort=cashier_id&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
		<?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
	      <?php else: ?>
		<?php echo link_to(__('Cajero', array(), 'messages'), '@cashbox', array('query_string' => 'sort=cashier_id&sort_type=asc')) ?>
	      <?php endif; ?>
	    </th>
	    <?php end_slot(); ?>
	    <?php include_slot('sf_admin.current_header') ?>

          <th id="sf_admin_list_th_actions"><?php echo __('Actions', array(), 'sf_admin') ?></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="11">
            <?php if ($pager->haveToPaginate()): ?>
              <?php include_partial('cashbox/pagination', array('pager' => $pager)) ?>
            <?php endif; ?>

            <?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
            <?php if ($pager->haveToPaginate()): ?>
              <?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
            <?php endif; ?>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($pager->getResults() as $i => $Cashbox): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?>
          <tr class="sf_admin_row <?php echo $odd ?>">
            <?php // include_partial('cashbox/list_td_batch_actions', array('Cashbox' => $Cashbox, 'helper' => $helper)) ?>	     
	       <td class="sf_admin_text sf_admin_list_td_id">
		 <?php echo link_to($Cashbox->getId(), 'cashbox_edit', $Cashbox) ?>
	       </td>
	       <td class="sf_admin_text sf_admin_list_td_id_state">
		 <?php echo $Cashbox->getNameState() ?>
	       </td>
               <?php // hoy ?>
               <td class="sf_admin_date sf_admin_list_td_created_at">
		 <?php echo false !== strtotime($Cashbox->getNightAudit()->getDate()) ? format_date($Cashbox->getNightAudit()->getDate(), "f") : '&nbsp;' ?>
	       </td>
               <?php // hoy ?>
	       <td class="sf_admin_date sf_admin_list_td_created_at">
		 <?php echo false !== strtotime($Cashbox->getCreatedAt()) ? format_date($Cashbox->getCreatedAt(), "f") : '&nbsp;' ?>
	       </td>
	       <td class="sf_admin_date sf_admin_list_td_closing_date">
		 <?php echo false !== strtotime($Cashbox->getClosingDate()) ? format_date($Cashbox->getClosingDate(), "f") : '&nbsp;' ?>
	       </td>
	       <td class="sf_admin_text sf_admin_list_td_comment">
		 <?php echo $Cashbox->getComment() ?>
	       </td>
	       <td class="sf_admin_foreignkey sf_admin_list_td_cashier_id">
		 <?php echo $Cashbox->getCashierName() ?>
	       </td>
	     
	     
            <?php include_partial('cashbox/list_td_actions', array('Cashbox' => $Cashbox, 'helper' => $helper)) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
       
       
    <ul class="sf_admin_actions">
      <?php // include_partial('cashbox/list_batch_actions', array('helper' => $helper)) ?>
      <?php // include_partial('cashbox/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>
	   
	   
	</td>
     </tr>
   </table>
     

  

  

  <div id="sf_admin_footer">
    <?php include_partial('cashbox/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
