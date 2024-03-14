<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Verificar si se ha proporcionado un ID de reporte en la URL
if (!isset ($_GET['id_reporte'])) {
    // Si no se proporciona el ID del reporte, redirigir al usuario a la página de ver reportes
    header("location: reportes.php");
    exit;
}

// Obtener el ID del reporte de la URL
$idReporte = $_GET['id_reporte'];

// Incluir la conexión a la base de datos
include '../includes/conexion.php';

// Consulta para obtener los datos del reporte
$sql = "SELECT * FROM reportes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idReporte);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Si no se encuentra el reporte con el ID proporcionado, redirigir al usuario a la página de ver reportes
    header("location: reportes.php");
    exit;
}

// Obtener los datos del reporte
$reporte = $result->fetch_assoc();

// Generar el contenido del PDF
$html = "<h1>Reporte #" . $reporte['id'] . "</h1>";
$html .= "<p>Equipo: " . $reporte['nombre_equipo'] . "</p>";
// Agregar más datos del reporte según sea necesario

// Crear una instancia de Dompdf
$dompdf = new Dompdf();

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);

// Establecer el tamaño del papel y la orientación
$dompdf->setPaper('A4', 'portrait');

// Renderizar el contenido del PDF
$dompdf->render();

// Mostrar el PDF en una vista previa usando un iframe
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa del PDF</title>
</head>

<body>
    <h2>Vista previa del Reporte #
        <?php echo $idReporte; ?>
    </h2>
    <iframe srcdoc="<?php echo $dompdf->output(); ?>" width="100%" height="600"></iframe>
</body>

</html>