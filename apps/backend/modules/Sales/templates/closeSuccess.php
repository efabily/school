<?php use_helper('Date') ?>
<div id="toolbar-box">

<div class="t">
 <div class="t">
   <div class="t"></div>
 </div>
</div>
  
<div class="m">
      
      

<table class="adminlist" >
   <thead>    
      <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	   
	 </td>
      </tr>
      <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	    RECIBO
	 </td>
      </tr>
   </thead>   
   <tr>
      <td valign="top" style="vertical-align: top;">
	 	 
	      <table class="adminlist">
		<thead>    
		  <tr>             
		     <th>NRO.</th>
		     <th><?php echo $receipt->getId(); ?></th>
		  </tr>
		</thead>
		<tbody>		
		  <tr>
		       <td style="width:55%;text-align: right;">Fecha:</td>
		       <td style="text-align: left; width:15%">
			  <?php echo $receipt->getCreatedAt(); ?>
		       </td>
		  </tr>		
		  <tr>
		       <td style="width:55%;text-align: right;">Total:</td>
		       <td style="text-align: left; width:15%">
			  <?php echo numbers::my_format_number($receipt->getTotal()); ?>
		       </td>
		  </tr>
		  <tr>		       
		     <td style="text-align: left; width:15%" colspan="2" >
			  Por concepto de:
		       </td>
		  </tr>
		  <tr>		       
		       <td style="text-align: left; width:15%" colspan="2" > 
			<?php echo $receipt->getComment(); ?>
		       </td>
		  </tr>
		</tbody>          
		<tfoot class="font_bold font_14">
		 <tr style="text-align: right;" >
		    <td colspan="2" >
		       
		    </td>
		 </tr>		
	       </tfoot>
	      </table>
      </td>
      
    </tr>
    <tfoot>
       <tr>
	 <td colspan="2" align="center" valign="top" style="color:#666666; font-weight: bold;">
	   
	 </td>
       </tr>       
    </tfoot>    
</table>

   

  <?php // include_partial('list_messages') ?>

    <div class="clr"></div>
  
  </div>
    
  <div class="b">
     <div class="b">
       <div class="b"></div>
     </div>
  </div>
	
</div>

<div class="clr"></div>