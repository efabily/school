<?php

mysql_connect('localhost', 'root', 'profesionales');
mysql_select_db('school');


function select($sql)
{
   $res = mysql_query($sql);
   $rowset = array();
   while ($row = mysql_fetch_object($res))
   {
      $rowset[] = $row;
   }
   
   return $rowset;
}



function getTotal($rowset, $col)
{
   $n = 0;
   foreach ($rowset as $row)
   {
      $n += $row[$col];
   }
   
   return $n;
}


function openTable()
{
   ?>
<table border="1">
   <tr valign="top">
      <td width="150">
	 <a href="listas.php">Listas</a><br>
	 <a href="ing.p.dia.php">ING. P.DIA</a><br>
      </td>
      <td>
<?php
}


function closeTable()
{
   ?>
</td>
   </tr>
</table>
<?php
}


?>
