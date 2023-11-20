<?php 
function getLocales(){
$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
    $consulta = $pdo->query("SELECT locales.id, locales.nombre as nombre_local, locales.ubicacion,usuarios.telefono, locales.categoria, locales.subcategoria, locales.imgUrl FROM locales INNER JOIN usuarios on locales.usuarios_Cedula = usuarios.cedula");
    

    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
   return $resultados;

} catch (PDOException $e) {
echo $e;
}
}
?>