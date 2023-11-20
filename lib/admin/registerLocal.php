<?php
session_start();

$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '';
$estado = isset($_POST['estado']) ? htmlspecialchars($_POST['estado']) : '';
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : '';
$subcategoria = isset($_POST['subcategoria']) ? htmlspecialchars($_POST['subcategoria']) : '';
$imgUrl = isset($_POST['imgUrl']) ? htmlspecialchars($_POST['imgUrl']) : '';


$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';


try {
    if ($_SESSION['usuario_rol'] == "Administrador") {
        $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmtVerificar = $pdo->prepare("SELECT COUNT(*) as cant FROM usuarios WHERE cedula = :cedula");        
        $stmtVerificar->bindParam(':cedula', $cedula);
        $stmtVerificar->execute();

        $resultado = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

        if ($resultado['cant'] == 0) {
            $respuesta = array('itsOk' => 0, 'msg' => 'No existe propietario');
            response($respuesta, 200);
        } else {
            $stmtInsertar = $pdo->prepare("INSERT INTO locales (nombre, ubicacion, estado, categoria, subcategoria,imgUrl,usuarios_Cedula) VALUES
         (:nombre, :ubicacion, :estado, :categoria, :subcategoria, :imgUrl, :usuarios_Cedula)");
            $stmtInsertar->bindParam(':nombre', $nombre);
            $stmtInsertar->bindParam(':ubicacion', $direccion);
            $stmtInsertar->bindParam(':estado', $estado);
            $stmtInsertar->bindParam(':categoria', $categoria);
            $stmtInsertar->bindParam(':subcategoria', $subcategoria);
            $stmtInsertar->bindParam(':imgUrl', $imgUrl);
            $stmtInsertar->bindParam(':usuarios_Cedula', $cedula);

            if ($stmtInsertar->execute()) {
                $respuesta = array('itsOk' => 1, 'msg' => 'Local insertado correctamente');
                response($respuesta, 200);
            } else {
                $respuesta = array('itsOk' => 0, 'msg' => 'Error al insertar el Local');
                response($respuesta, 200);
            }
        }
    } else {
        $respuesta = array('itsOk' => 2, 'msg' => 'Impostor');
        response($respuesta, 200);
    }
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
