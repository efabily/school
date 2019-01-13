<?php echo $form->renderFormTag(url_for('NightAudit/config'), array('method'  => 'post')) ?>
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

<?php if ($form->isCSRFProtected()): ?>
    <?php echo $form['_csrf_token'] ?>
<?php endif; ?> 

<style>

ul
{
  list-style-type: none;
  padding: 0px;
  margin: 0px;
}

</style>
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
            <td class="button" id="--edit" style="padding-right: 20px;">
                <?php echo link_to('<span class="icon-32-cancel" title="Cerrar"></span>Cancelar', 'nightAudit/show', array('class'=>'toolbar')) ?>
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
  
  <?php include_partial('Student/flashes') ?>
  
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

    <legend style="color:#3A78BD; font-weight: bold; font-size: 14px">Cambiar Datos del Cierre</legend> 
    <table class="admintable">
      <tbody>
	   <tr>
             <td class="key" style="text-align: right;font-size: 13px;" >Hora del Cierre:</td>
             <td style="text-align: left;font-size: 13px;">
              <?php echo $form['night_audit_hour'] ?>
             </td>		       
           </tr>           
           <tr>
              <td colspan="2" style="padding-left: 380px">
                <input type="submit" value="Cambiar" />   
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

</form>