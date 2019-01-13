<script>
  jQuery(function($){
    $("#business_entity").change(function(){
      $("#change_business_entity").submit();
    });
  });
</script>

<form id="change_business_entity" method="post" action="<?php echo url_for('change_business_entity') ?>" >
  <?php echo $form ?>
</form>