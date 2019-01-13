<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Colegio Rene Moreno</title>
<link rel="shortcut icon" href="/favicon.ico" />

<link rel="stylesheet" type="text/css" href="/css/print_recibo.css" media="print">
<?php use_stylesheet('cssmenu') ?>
<?php use_stylesheet('cineschema') ?>
<?php use_stylesheet('general') ?>
   

<?php // include_javascripts() ?>
<?php include_stylesheets() ?>
<?php use_javascript('jquery-1.6.2.min.js') ?>
<?php include_javascripts() ?>
<?php use_helper('Menu') ?>

<link rel="stylesheet" type="text/css" media="screen" href="/css/sfJQueryUIPlugin/css/ui-lightness/jquery-ui-1.8.14.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/sfJQueryUIPlugin/css/ui-lightness/jquery-ui.css" />
<script type="text/javascript" src="/sfJQueryUIPlugin/js/jquery-ui.js"></script>
<script type="text/javascript" src="/sfJQueryUIPlugin/js/i18n/ui.datepicker-es.js"></script>

<style>
   #tbl_title td {
      border: 0;
      padding: 0;
      margin: 0;
   }
   
   #tbl_menu td{
      border: 0;
      padding: 0;
      margin: 0;       
   }
   
   #ul_menu li {
      float: left;
   }
   #header-box_menu  { border: 1px solid #3787B6; background-color:#045686}
</style>
</head>
<body>
<div id="container">
<div id="header" style="height: 30px;padding-top: 40px;">
    <?php if ($sf_user->isAuthenticated()): ?>
   <table id="tbl_title" style="width: 800px;margin-bottom: 5px;">
      <tr>
	 <td style="vertical-align: bottom;color:#fff;font-weight: bold;font-size: 15px;">
	       <?php include_component('NightAudit', 'systemDate') ?>
	 </td>
	 <td style="vertical-align: bottom;color:#fff;font-weight: bold;font-size: 15px;">
	    <?php echo $sf_user->getUsername(); ?>  
	    <?php echo link_to('SALIR', '@sf_guard_signout') ?>
	 </td>
	 <td align="left" style="vertical-align: bottom;color:#fff;font-weight: bold;font-size: 15px;">
            <?php  include_component('Period', 'currentPeriod') ?>  
	 </td>
      </tr>
   </table>
<?php endif; ?>
</div>
<?php if ($sf_user->isAuthenticated()): ?>   
<div id="header-box_menu">
    <div id="module-menu">
        <?php echo menu_build() ?>        
    </div>
</div>
   
<!--<div id="menu">

   <table id="tbl_menu" >
      <tr>
	 <td valign="top" align="left" style="width: 900px;">
	   <ul id="ul_menu">
	       <li>
	       <?php // echo link_to('ALUMNOS', '@student') ?>
	       </li>
	       <li>
	       <?php // echo link_to('VENTA DIRECTA', 'Sales/pago') ?>
	       </li>
	       <li>
	       <?php // echo link_to('TRANSFERENCIA', 'transfer/createTransfer') ?>
	       </li>
	       <li>
	        <?php // echo link_to('CAJAS', '@cashbox') ?>
	       </li>
	       <li>
		  <?php // echo link_to('CIERRES', 'NightAudit/index') ?>            
	       </li>
	       <li>
		  <?php // echo link_to('ITEM', '@item') ?>
	       </li>
	       <li>
	       <?php // echo link_to('TIPO DE ITEM', '@type_item') ?>            
	       </li>	       
	       <li>
	       <?php // echo link_to('DESCUENTO', '@discount') ?>
	       </li>
	       <li>
	       <?php // echo link_to('PERIODOS', '@period') ?>
	       </li>
	       <li>
	       <?php // echo link_to('TIPO DE CAMBIO', '@currency_price') ?>
	       </li>
	       <li>
	       <?php // echo link_to('Tutor', '@tutor') ?>
	       </li>
	       <li>
	       <?php // echo link_to('Categories', '@jobeet_category') ?>
	       </li> 
	       <li>
	       <?php // echo link_to('Users', '@sf_guard_user') ?>
	       </li>
	       <li></li>
	       <li>
		  	     
	       </li>
	       <li></li>
	       <li><?php // echo link_to('SALIR', '@sf_guard_signout') ?></li>	       
	    </ul>
	 </td>
	 <td valign="top" align="right" >
	    
	 </td>
      </tr>
   </table>         
   
</div>-->
<?php endif; ?>
<div id="content">
<?php echo $sf_content ?>
</div>
<div id="footer">
powered by <a href="http://www.symfony-project.org/">
<img src="/images/symfony.gif" alt="symfony framework" /></a>
</div>
</div>
</body>
</html>

