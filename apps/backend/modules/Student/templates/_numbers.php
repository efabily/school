<script>
  jQuery(function($){
    $("#one").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+1)
    });
    $("#two").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+2)
    });
    $("#three").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+3)
    });
    $("#four").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+4)
    });
    $("#five").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+5)
    });
    $("#six").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+6)
    });
    $("#seven").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+7)
    });
    $("#eight").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+8)
    });
    $("#nine").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+9)
    });
    $("#clear").click(function(){      
      $("#numbers_value").val('')
    });
    $("#zero").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+0)
    });
    $("#dot").click(function(){      
      $("#numbers_value").val($("#numbers_value").val()+'.')
    });
    
  });
</script>
<table class="admintable">
  <tr>
    <td class="key_right font_14" style="width: 50px;">
        <?php echo isset($options['text']) ? $options['text'] : 'Value' ?>:
    </td>
    <td colspan="2">
	<strong>        
            <input type="text" name="numbers_value" id="numbers_value" 
                value="<?php echo isset($options['value']) ? $options['value'] : '' ?>"               
                size="<?php echo isset($options['size']) ? $options['size'] : 5 ?>"
                class="<?php echo isset($options['class']) ? $options['class'] : '' ?>"               
            />        
        </strong>
    </td>
  </tr>  
  <tr class="text_right">  
    <td colspan="3" style="padding:5px;">
        <input class="numbers" TYPE="button" id="one" name="one"   value="1"  />
        <input class="numbers" TYPE="button" id="two"  name="two"   value="2" />
        <input class="numbers" TYPE="button" id="three" name="three" value="3" />
        <br>

        <input class="numbers" TYPE="button" id="four" name="four"   value="4" />
        <input class="numbers" TYPE="button" id="five" name="five"   value="5" />
        <input class="numbers" TYPE="button" id="six" name="six" value="6" />
        <br>

        <input class="numbers" TYPE="button" id="seven" name="seven"   value="7" />
        <input class="numbers" TYPE="button" id="eight" name="eight"   value="8" />
        <input class="numbers" TYPE="button" id="nine" name="nine" value="9" />
        <br>

        <input class="numbers" TYPE="button" id="clear" name="clear"   value="C" />
        <input class="numbers" TYPE="button" id="zero" name="zero"   value="0" />		
        <input class="numbers" TYPE="button" id="dot" name="dot"   value="." />	
    </td>
  </tr>
  <?php if (isset($options['print']) && $options['print']): ?>
    <tr class="text_right">
      <td colspan="3" style="padding:5px">
          <input style="font-size: 40px; padding:20px; width: 220px; margin:2px;" TYPE="button" name="<?php echo __('print') ?>"   value="Imprimir" OnCLick="document.forms.posfrm.submit()">
      </td>
    </tr>
 <?php endif; ?>
</table>