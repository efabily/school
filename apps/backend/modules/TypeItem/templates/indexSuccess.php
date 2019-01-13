<?php use_helper('I18N', 'Date') ?>
<?php include_partial('TypeItem/assets') ?>

<div id="sf_admin_container">
  <h1 style="color:#000;" ><?php echo __('Tipo de Item', array(), 'messages') ?></h1>

  <?php include_partial('TypeItem/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('TypeItem/list_header', array('pager' => $pager)) ?>    
  </div>
  
  <table style="width:100%;" >
     <tr>
      <td>
        <div id="sf_admin_bar">

            <ul class="sf_admin_actions">
             <?php // include_partial('Student/list_batch_actions', array('helper' => $helper)) ?>
             <?php include_partial('TypeItem/list_actions', array('helper' => $helper)) ?>
           </ul>

           <?php include_partial('TypeItem/filters', array('form' => $filters, 'configuration' => $configuration)) ?>  

        </div>
      </td>
     </tr>
     <tr>
      <td>
        <div id="sf_admin_content">
          <form action="<?php echo url_for('type_item_collection', array('action' => 'batch')) ?>" method="post">
            <?php include_partial('TypeItem/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>

          </form>    
        </div>
      </td>
     </tr>
  </table>
  <div id="sf_admin_footer">
    <?php include_partial('TypeItem/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
