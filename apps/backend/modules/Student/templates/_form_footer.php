<script>
<!--

jQuery(function($){
   $(".jqG1 input").click(function() {
 $(".jqG2 input").removeAttr('checked', false);
 $(".jqG3 input").removeAttr('checked', false);
   });
   
   $(".jqG2 input").click(function() {
 $(".jqG1 input").removeAttr('checked', false);
 $(".jqG3 input").removeAttr('checked', false);
   });
   
   $(".jqG3 input").click(function() {
 $(".jqG1 input").removeAttr('checked', false);
 $(".jqG2 input").removeAttr('checked', false);
   });
});

jQuery(function($){
	$(":radio").dblclick(function(){
		$(this).removeAttr("checked");
	});

	$("#discapacidad_sensorial_group :radio").click(function(){
		$self = $(this);
		discapacidad_groups($self);
	});
	$("#discapacidad_motriz_group :radio").click(function(){
		$self = $(this);
		discapacidad_groups($self);
	});
	$("#discapacidad_mental_group :radio").click(function(){
		$self = $(this);
		discapacidad_groups($self);
	});

	$("#point_524 :radio").dblclick(function(){
		$("#discapacidad_sensorial_group :radio").removeAttr("checked");
		$("#discapacidad_motriz_group :radio").removeAttr("checked");
		$("#discapacidad_mental_group :radio").removeAttr("checked");

		$("#point_524 :radio").attr("disabled", "disabled");
	});
	
	
   $("form").submit(function(){
      window.onbeforeunload = function(){}
   });
   
   
   p = <?php echo json_encode(DataSource::$MUNICIPIOS) ?>;
   selected_value = '';
   <?php if(isset($form['estudiante_direccion_session_municipio'])): ?>
      selected_value = "<?php echo $form['estudiante_direccion_session_municipio']->getValue(); ?>";
   <?php endif; ?>

   $("#student_estudiante_direccion_provincia").change(function(){
      val = $(this).val();
      el = document.getElementById("student_estudiante_direccion_session_municipio");
      el.options.length = 0;
      
      if(val)
      {
	 h = p[val];
	 
	 el.options.add(new Option("", ""));
	 for(i in h)
	 {
	    s = false;
	    if(selected_value == h[i])
	       s = true;
	    el.options.add(new Option(h[i], h[i], s));
	 }
      }
   });
   
   $("#student_estudiante_direccion_provincia").change();
});


function discapacidad_groups($el)
{
	$found = $("#discapacidad_sensorial_group :radio, #discapacidad_motriz_group :radio, #discapacidad_mental_group :radio");

	if($found.size() > 0)
	{
		flag = false;
		$found.each(function(index, obj){
			if($(obj).val() == "si" && $(obj).attr("checked"))
			{
				flag = true;
			}
		});

		if(flag)
		{
			$("#point_524 :radio").removeAttr("disabled");
		}
		else
		{
			$("#point_524 :radio").attr("disabled", "disabled");
			$("#point_524 :radio").removeAttr("checked");
		}
	}
	else
	{
		$("#point_524 :radio").removeAttr("disabled");
	}
}

window.onbeforeunload = bunload;

function bunload(){
	dontleave = "Esta seguro de querer salir?";
	return dontleave;
}
//-->
</script>
