<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/28 22:29:39
?>
<?php use_stylesheet('/sf/sf_admin/css/main') ?>
<?php use_helper('Date') ?>
<?php use_helper('I18N') ?>
<?php use_helper('MyPager') ?>

<div id="toolbar-box">

  <div class="t">
    <div class="t">
      <div class="t"></div>
    </div>
  </div>
  
  <div class="m">
  
    <div class="toolbar" id="toolbar">
    
    <table class="toolbar">
      <tr>
      <td class="button" id="toolbar-new">
        <a href="/sfGuardUser/create" class="toolbar">
        <span class="icon-32-new" title="<?php echo __('Create') ?>">
        </span> <?php echo __('Create') ?> </a>
      </td>
      </tr>
    </table>
    
    </div>
    <div class="header icon-48-users">
      <?php echo __('Users') ?>
    </div>
    <div class="clr"></div>
  
  </div>

  
  <div class="b">
	   <div class="b">
	     <div class="b"></div>
	   </div>
	</div>
	
</div>

<div class="clr"></div>

<div id="toolbar-box">

  <div class="t">
    <div class="t">
      <div class="t"></div>
    </div>
  </div>

  <div class="m">

    <div class="toolbar" id="toolbar">

          <?php include_partial('filters', array('filters' => $filters)) ?>

    </div>
    <div class="header icon-48-filters">
      <?php echo __('Filters') ?>
    </div>
    <div class="clr"></div>

  </div>

  <div class="b">
	   <div class="b">
	     <div class="b"></div>
	   </div>
	</div>

</div>

<div class="clr"></div>

<?php include_partial('sfGuardUser/list_messages', array('pager' => $pager)) ?>

<div id="element-box">

			<div class="t">
		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>
			<div class="m">
        <table class="adminlist">
          <thead>
          <tr>
          <?php include_partial('list_th_tabular') ?>
          </tr>
          </thead>
          <?php if (!$pager->getNbResults()): ?>
            <?php echo __('no result') ?>
          <?php else: ?>
            <?php include_partial('sfGuardUser/list', array('pager' => $pager)) ?>
          <?php endif; ?>
          </table>
        <?php include_partial('sfGuardGroup/list_footer', array('pager' => $pager)) ?>
			
			<div class="clr"></div>
			</div>
			
			<div class="b">
				<div class="b">

					<div class="b"></div>
				</div>
			</div>

</div>