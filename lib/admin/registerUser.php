<?php 


$cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$telefono = isset($_POST['telefono']) ? htmlspecialchars($_POST['telefono']) : '';
$usuario = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
$rol = isset($_POST['rol']) ? htmlspecialchars($_POST['rol']) : '';

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$host = '127.0.0.1'; 
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);

    $stmtVerificar = $pdo->prepare("SELECT COUNT(*) as cant FROM usuarios WHERE cedula = :cedula");
    $stmtVerificar->bindParam(':cedula', $cedula);
    $stmtVerificar->execute();

    $resultado = $stmtVerificar->fetch(PDO::FETCH_ASSOC);

    if ($resultado['cant'] > 0) {
        $respuesta = array('itsOk'=>0,'msg'=>'El usuario ya existe');
      response($respuesta,200); 
    }else{
        $stmtInsertar = $pdo->prepare("INSERT INTO usuarios (cedula, nombre, apellido, telefono,rol) VALUES (:cedula, :nombre, :apellido, :telefono,:rol)");
        $stmtInsertar->bindParam(':cedula', $cedula);
        $stmtInsertar->bindParam(':nombre', $nombre);
        $stmtInsertar->bindParam(':apellido', $apellido);
        $stmtInsertar->bindParam(':telefono', $telefono);
        $stmtInsertar->bindParam(':rol', $rol);
        $stmtInsertar->execute();

        $stmtInsertar = $pdo->prepare("INSERT INTO login (usuario, contraseña, fk_usuarios_cedula) VALUES (:usuario,:password , :cedula)");
        $stmtInsertar->bindParam(':cedula', $cedula);
        $stmtInsertar->bindParam(':password', $hashedPassword);
        $stmtInsertar->bindParam(':usuario', $usuario);
        if ($stmtInsertar->execute()) {
            $respuesta = array('itsOk' => 1, 'msg' => 'Registro insertado correctamente');
            response($respuesta, 200);
        } else {
            $respuesta = array('itsOk' => 0, 'msg' => 'Error al insertar el registro');
            response($respuesta, 200);
        }
    }




    // $stmt = $pdo->prepare("INSERT INTO usuarios (cedula, nombre, apellido,tel,usuario) VALUES (:nombre, :edad, :correo)");



} catch (PDOException $e) {
    // Manejar errores de conexión
    $respuesta = array('itsOk' => 3, 'msg' => $e->getMessage());
    response($respuesta,200);
    
}

function response($response,$code){
    header('Content-Type: application/json');
echo json_encode($response);
http_response_code($code);
exit;
}
?>

