<?php 

$nombreLocal = isset($_POST['nombreLocal']) ? htmlspecialchars($_POST['nombreLocal']) : '';
$ubicacion = isset($_POST['ubicacion']) ? htmlspecialchars($_POST['ubicacion']) : '';
$estado = isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$subcategoria = isset($_POST['subcategoria']) ? htmlspecialchars($_POST['subcategoria']) : '';
$id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';


$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);

        $stmt = $pdo->prepare("UPDATE centrocomercial.locales SET nombre = :nombreLocal, ubicacion = :ubicacion, estado = :estado, categoria = :categoria, subcategoria = :subcategoria WHERE id = :id");
        $stmt->bindParam(':nombreLocal', $nombreLocal);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':subcategoria', $subcategoria);
        $stmt->bindParam(':id', $id);
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

