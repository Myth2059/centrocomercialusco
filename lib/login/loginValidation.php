<?php
session_start();
$usuario = isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '';
$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
// Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = '127.0.0.1';
    $nombre_bd = 'centrocomercial';
    $usuario_bd = 'root';
    $contraseña_bd = '';

    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);

    // Obtener el hash de la contraseña desde la base de datos
    $stmt = $pdo->prepare("SELECT usuarios.cedula, usuarios.rol,login.contraseña FROM usuarios inner join login on usuarios.cedula = login.fk_usuarios_cedula WHERE login.usuario = ?");
    $stmt->execute([$usuario]);


    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['contraseña'])) {
        // Login exitoso
        $_SESSION['usuario_cedula'] = $usuario['cedula'];
        $_SESSION['usuario_rol'] = $usuario['rol'];

        header("Location: ..\..\public\locales.php"); // Redirigir a la página de inicio después del login
        exit();
    } else {
        // Usuario no encontrado o contraseña incorrecta
        echo "Usuario o contraseña incorrectos";
    }
}
?>