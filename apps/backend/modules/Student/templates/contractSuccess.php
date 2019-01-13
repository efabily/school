<?php if($to_print) : ?>
<script>
jQuery(function(){
   window.print();
});
</script>
<?php endif;?>

<style type="text/css">
@media print{
  body{background-color:#FFFFFF; background-image:none;color:#000000;font-size:12px}
}
</style>

<?php
$contenido = nl2br($contenido);
//$contenido = str_replace('{c}', '<div style="float:right;font-weight:bold">', $contenido);
//$contenido = str_replace('{/c}', '</div>', $contenido);

echo $contenido;
?>
