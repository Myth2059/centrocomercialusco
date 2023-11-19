

<?php 
/**
 * Este custom me permite ahorrar varias lineas de codigo y aparte manipular todos los input generados
 * por esta funcion
 */
function customInput(string $title,string $name,string $type){
$allowedTypes = array("text","password","email","tel","number");
$currentType = in_array($type,$allowedTypes) ? $type : "text";

return '<div class="customInput">
<label for="' . $name . '">' . $title . '</label>
<input required  id="'.$name.'" name="' . $name . '" type="' . $currentType . '">
</div>';



};
?>

