<?php
include '..\fpdf\fpdf.php';

class PDF extends FPDF {
    function Header() {
        
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, 'ID', 1);
        $this->Cell(40, 10, 'Nombre', 1);
        $this->Cell(40, 10, 'Ubicacion', 1);
        $this->Cell(40, 10, 'Estado', 1);
        $this->Cell(40, 10, 'Categoria', 1);
        $this->Cell(40, 10, 'Subcategoria', 1);
        $this->Cell(40, 10, 'Propietario', 1);
        $this->Cell(40, 10, 'Telefono', 1);
        $this->Cell(40, 10, 'Cedula', 1);
        $this->Ln(); 
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear instancia de PDF
$pdf = new PDF();
$pdf->AddPage();

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
echo print_r($result);
    // Agregar filas al PDF
    if ($result->rowCount() > 0) {
        $pdf->SetFont('Arial', '', 12);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(30, 10, $row["id"], 1);
            $pdf->Cell(40, 10, $row["nombre"], 1);
            $pdf->Cell(40, 10, $row["ubicacion"], 1);
            $pdf->Cell(40, 10, $row["estado"], 1);
            $pdf->Cell(40, 10, $row["categoria"], 1);
            $pdf->Cell(40, 10, $row["subcategoria"], 1);
            $pdf->Cell(40, 10, $row["propietario"], 1);
            $pdf->Cell(40, 10, $row["teledono"], 1);
            $pdf->Cell(40, 10, $row["cedula"], 1);
            $pdf->Ln(); // Salto de línea
        }
    } else {
        $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 0, 'C');
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar conexión a la base de datos
$pdo = null;

// Encabezado para indicar que se trata de un PDF
header('Content-Type: application/pdf');
// Salida del contenido del PDF al navegador
echo $pdf->Output();
?>