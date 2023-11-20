<div class="localesMain">
    <h2>Nuestros Locales</h2>
<div class="localesContainer">
<?php 
include "..\lib\localesList\getLocales.php";
include  "..\components\localCard\localCard.php";
echo "<script>var cedula =" .$_SESSION['usuario_cedula'] .";</script>";
$locales = getLocales();
foreach($locales as $local){
   echo cardContainer($local['id'],$local['nombre_local'],$local['ubicacion'],$local['telefono'],$local['categoria'],$local['subcategoria'],$local['imgUrl']);
}

?>
</div>
<script src="..\lib\localesList\locales.js"></script>
</div>