<?php include '_main.php' ?>
<?php
$is_post = $_SERVER['REQUEST_METHOD'] == 'POST';
$rsPeriodo = select("SELECT * FROM sch_period order by id desc");
$rsItems = select("SELECT * FROM `sch_item` WHERE type_item_id != 2");

if($is_post)
{
   $gestion = $_POST['gestion'];
   $inicio = $_POST['inicio'];
   $fin = $_POST['fin'];
   
   
   
}
?>

<?php openTable() ?>

<form method="post" action="">
   <select name="gestion">
      <?php foreach ($rsPeriodo as $row) : ?>
	 <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
      <?php endforeach; ?>
   </select>

   <table>
      <tr>
	 <td>Fecha inicio</td>
	 <td>Fecha fin</td>
      </tr>
      <tr>
	 <td>
	    <input type="text" name="inicio" /><br>
	    dd-mm
	 </td>
	 <td>
	    <input type="text" name="fin" /><br>
	    dd-mm
	 </td>
      </tr>
   </table>
   
   <input type="submit" />
   
   <hr>
   <table border="1">
      <tr>
	 <th>COBRO MENSUALIDAD</th>
	 
	 <?php foreach ($rsItems as $row) : ?>
	 <th><?php echo $row->name?></th>
	 <?php endforeach; ?>
      </tr>
      
      
      <tr>
	 <td>
	    
	 </td>
	 
	 <?php foreach ($rsItems as $row) : ?>
	 <td><?php echo $row->name?></td>
	 <?php endforeach; ?>
      </tr>
      
   </table>
   
   
   
</form>







<?php closeTable() ?>