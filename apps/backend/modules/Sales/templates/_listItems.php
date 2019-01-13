<?php use_helper('Date') ?>
<?php use_helper('jQuery'); ?>
<?php use_helper('MyJavascript') ?>

<?php 
$k = 0; 
$carr = 1; 
$carrier = 0
?>

<table>
<tr>
<?php foreach ($item_list as $item): ?>
<?php $carrier++; ?>
   
  <td>	  
      <?php if($sf_user->getAttribute('current_item') == $item['id']): ?>
        <div class="button-cine-a" style="border-color:#<?php echo $item['color'] ?>">
      <?php else: ?>
      	<div class="button-cine" style="border-color:#<?php echo $item['color'] ?>">
      <?php endif; ?>
	<div class="page">
          <span>
              <?php  echo link_to_remote_multiple(
		   '<span class="font_bold">'.$item['name']
                   .'</span><br><br><span class="font_bold font_14">'.numbers::my_format_number($item['price']).'</span>',
              array(
                'url' => '/Sales/addItem?id='.$item['id'],
                'update'   => array('success' => 'list_items_charged'),
                 )
		 ,
               array(
                 'url' => '/Sales/pay',
		 'update'   => array('success' => 'div_pay')
                    ) 
		 )
	    ?>
          </span>
        </div>
    </div>
  </td>
<?php if($carrier == $carr){ ?>
</tr><tr>
<?php $carrier = 0;} ?>
<?php endforeach; ?>
</tr>
</table>