<?php
require_once '..\vendor\autoload.php';

// Conectar a la base de datos (reemplaza con tus propios datos de conexión)
$host = '127.0.0.1';
$nombre_bd = 'centrocomercial';
$usuario_bd = 'root';
$contraseña_bd = '';

try {

    $pdo = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8", $usuario_bd, $contraseña_bd);
    // Establecer el modo de error de PDO en excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultar datos desde la base de datos (reemplaza con tu propia consulta)
    $sql = "SELECT locales.id,locales.nombre,locales.ubicacion,locales.estado,locales.categoria,locales.subcategoria, CONCAT(usuarios.nombre, ' ',usuarios.apellido) AS propietario, usuarios.telefono, usuarios.cedula FROM centrocomercial.locales inner join centrocomercial.usuarios on locales.usuarios_Cedula = usuarios.cedula;";
    $result = $pdo->query($sql);   
    // Agregar filas al PDF
    if ($result->rowCount() > 0) {
        $html = '<div>
        <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
        
                th, td {
                    border: 1px solid #dddddd;
                    text-align: center;
                    padding: 8px;
                }
        
                th {
                    background-color: #f2f2f2;
                }
            </style>
        
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>UBICACIÓN</th>
                <th>ESTADO</th>
                <th>CATEGORIA</th>
                <th>SUBCATEGORIA</th>
                <th>PROPIETARIO</th>
                <th>TELEFONO</th>
                <th>CEDULA</th>
            </tr>
            </thead>
            <tbody>';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $html .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['nombre'] . '</td>
                    <td>' . $row['ubicacion'] . '</td>
                    <td>' . $row['estado'] . '</td>
                    <td>' . $row['categoria'] . '</td>
                    <td>' . $row['subcategoria'] . '</td>
                    <td>' . $row['propietario'] . '</td>
                    <td>' . $row['telefono'] . '</td>
                    <td>' . $row['cedula'] . '</td>
                </tr>';
        };
        $html .= '</tbody>
             </table>
        </div>';
        $mpdf = new \Mpdf\Mpdf();
         $mpdf->WriteHTML($html);
        ob_clean(); 
         $mpdf->Output();  
    } else {
        echo  "no hay nada";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar conexión a la base de datos
$pdo = null;

// // Encabezado para indicar que se trata de un PDF
// header('Content-Type: application/pdf');
// // Salida del contenido del PDF al navegador
// echo $pdf->Output('s');
?>
<!-- <div>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>UBICACIÓN</th>
                <th>ESTADO</th>
                <th>CATEGORIA</th>
                <th>SUBCATEGORIA</th>
                <th>PROPIETARIO</th>
                <th>TELEFONO</th>
                <th>CEDULA</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>A</td>
                <td>B</td>
                <td>C</td>
                <td>E</td>
                <td>F</td>
                <td>G</td>
                <td>H</td>
                <td>I</td>
                <td>J</td>
            </tr>
        </tbody>
    </table>
</div> -->