<?php 
session_start();
if ($_SESSION['usuario_rol'] !== "Administrador") {
    header("Location: ..\public\index.php");
    exit;
}
include("../components/layout.php");
function getContent(){
    include "../sections/adminSection/admin.php";
};
?>