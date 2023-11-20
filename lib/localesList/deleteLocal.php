<?php
$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';

$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("DELETE FROM locales WHERE (id = :id);");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $stmt = $pdo->prepare("INSERT INTO centrocomercial.eliminados (cedula, id_tienda) VALUES ( :cedula, :id); ");
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $respuesta = array('itsOk' => 1, 'msg' => 'Local Eliminado!');
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