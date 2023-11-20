<?php 
$id = isset($_GET['id']) ? $_GET['id'] : "";


include("../components/layout.php");
function getContent(){
    include "..\sections\local\localSection.php";
};
?>