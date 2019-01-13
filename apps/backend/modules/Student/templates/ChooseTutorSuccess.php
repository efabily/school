
<h1 style="color:#000">Seleccione el nombre de la persona que va a firmar el contrato</h1>

<form method="post" ation="/Student/ChooseTutor/do/<?php echo $do?>/contract/<?php echo $contract?>">
   <select name="tutor">
      <option>-------></option>
      <?php foreach($rowset as $row) : ?>
         <option value="<?php echo $row->getId()?>"><?php echo $row->getFatherName()?> <?php echo $row->getMotherName()?>, <?php echo $row->getFirstName()?></option>
      <?php endforeach; ?>
   </select>

   <br><br>
   <input type="submit" value="Seleccionar" style="padding:5px">

</form>
