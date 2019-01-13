<script>
  jQuery(function($){
    $("#period").change(function(){
      $("#change_period").submit();
    });
  });
</script>

<form id="change_period" method="post" action="<?php echo url_for('change_period') ?>" >
   <table>
      <tbody>
	 <tr>
	    <td>
	       <?php echo $form['period']->renderLabel(); ?>
	    </td>
	    <td>
	       <?php echo $form["period"]->render(); ?>
	       <?php echo $form["_csrf_token"]->render(); ?>
	    </td>
	 </tr>
      </tbody> 
   </table>  
</form>