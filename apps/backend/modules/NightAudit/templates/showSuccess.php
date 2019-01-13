<?php use_helper('I18N') ?>

<div id="toolbar-box" style="margin-top: 5px;" >

    <div class="t">
      <div class="t">
        <div class="t"></div>
      </div>
    </div>

    <div class="m">
      
      <div class="toolbar" id="toolbar">
        <table class="toolbar" >
            <tr>                   
            <td class="button" id="toolbar-edit">
                <?php echo link_to('<span class="icon-32-edit" title="'.__('Edit').'"> </span>'.__('Edit'), 'NightAudit/config', array('class'=>'toolbar')) ?>
            </td>
            <td class="button" id="--edit" style="padding-right: 20px;">
                <?php echo link_to('<span class="icon-32-forward" title="Listar"></span>Listar', 'NightAudit/index', array('class'=>'toolbar')) ?>
            </td>             
            </tr>
        </table>
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
  
  <?php include_partial('NightAudit/flashes') ?>

  <div class="clr"></div>
  
 <div id="element-box">

  <div class="t">
    <div class="t">
      <div class="t"></div>
    </div>
  </div>
  <div class="m">
 
  <div class="clr"></div>
  
  <fieldset class="adminform">

    <legend style="color:#3A78BD; font-weight: bold; font-size: 14px">
        Datos del Cierre
    </legend> 
      
    <table class="admintable">
      <tbody>
	   <tr>
             <td class="key" style="text-align: right;font-size: 13px;" >Hora del Cierre:</td>
             <td style="text-align: left;font-size: 13px;">              
                 <?php echo $business_entity->getHoraCierre();?>
             </td>		       
           </tr>           
           <tr>
              <td colspan="2" style="padding-left: 380px">
               
              </td>      
           </tr>           
      </tbody>
    </table>  

  </fieldset>
  
  </div>

  <div class="b">
    <div class="b">
      <div class="b"></div>
    </div>
  </div>

</div>