<?php
// Verificar sesión de usuario
include '../includes/verificar_sesion.php';

// Incluir la conexión a la base de datos
include '../includes/conexion.php';

// Verificar si se ha proporcionado un ID de usuario en la URL
if (!isset ($_GET['id_usuario'])) {
    // Si no se proporciona el ID del usuario, redirigir al usuario a la página principal
    header("location: index.php");
    exit;
}

// Obtener el ID de usuario de la URL
$id_usuario = $_GET['id_usuario'];

// Consulta SQL para obtener los reportes del usuario específico
$sql = "SELECT * FROM reportes WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Reportes del Usuario
            <?php echo $id_usuario; ?>
        </h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <!-- Agrega más encabezados según tus columnas de reportes -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            // Agrega más columnas según tus columnas de reportes
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No se encontraron reportes para este usuario.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U4s5lMQ0DtGgKpuk+pt/tVADN1q+d9WqPvUzJSvefjJnHLyT1wr7+LxPLv0bZNU7"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>