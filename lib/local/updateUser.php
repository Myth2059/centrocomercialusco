<?php 

$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$telefono = isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : '';
$cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';



$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);

        $stmt = $pdo->prepare("UPDATE centrocomercial.usuarios SET Nombre = :nombre, Apellido = :apellido, Telefono = :telefono WHERE (Cedula = :cedula);");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();

        $respuesta = array('itsOk' => 1, 'msg' => 'Actualizado Correctamente');
        response($respuesta, 200);
   

} catch (PDOException $e) {
    $respuesta = array('itsOk' => 3, 'msg' => $e->getMessage());
    response($respuesta, 200);
}
function response($response, $code)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    http_response_code($code);
    exit;
}
?>

