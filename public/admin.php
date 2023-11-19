<?php 
session_start();

$_SESSION['rol'] = "Administrado";
if ($_SESSION['rol'] !== "Administrador") {
    header("Location: ..\public\index.php");
    exit;
}
include("../components/layout.php");
function getContent(){
    include "../sections/adminSection/admin.php";
};
?>