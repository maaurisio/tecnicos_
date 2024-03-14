<?php
// Verificar sesión de usuario
include '../includes/verificar_sesion.php';

// Incluir la conexión a la base de datos
include '../includes/conexion.php';

// Inicializar variables para almacenar los datos del cliente
$nombreCliente = "";
$direccionCliente = "";
$telefonoCliente = "";
$cifCliente = "";

// Verificar si se ha enviado el formulario de búsqueda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_cliente'])) {
    // Obtener el CIF del cliente a buscar
    $cifCliente = $_POST['cif_cliente'];

    // Consulta SQL para buscar el cliente por su CIF
    $sql = "SELECT * FROM clientes WHERE cif = '$cifCliente'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Cliente encontrado, cargar los datos en las variables
        $row = $result->fetch_assoc();
        $nombreCliente = $row['nombre_cliente'];
        $direccionCliente = $row['direccion'];
        $telefonoCliente = $row['telefono'];
    } else {
        echo "Cliente no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Búsqueda de Cliente</h2>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Tabs para dispositivos móviles y tabletas -->
                    <ul class="nav d-lg-none flex-column">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="buscar-tab" data-bs-toggle="tab"
                                data-bs-target="#buscar" type="button" role="tab" aria-controls="buscar"
                                aria-selected="true">Buscar Cliente</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="equipo-tab" data-bs-toggle="tab" data-bs-target="#equipo"
                                type="button" role="tab" aria-controls="equipo" aria-selected="false">Equipo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tipo-servicio-tab" data-bs-toggle="tab"
                                data-bs-target="#tipo-servicio" type="button" role="tab" aria-controls="tipo-servicio"
                                aria-selected="false">Tipo Servicio</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="frecuencia-servicio-tab" data-bs-toggle="tab"
                                data-bs-target="#frecuencia-servicio" type="button" role="tab"
                                aria-controls="frecuencia-servicio" aria-selected="false">Frecuencia Servicio</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="parametros-tab" data-bs-toggle="tab"
                                data-bs-target="#parametros" type="button" role="tab" aria-controls="parametros"
                                aria-selected="false">Parámetros</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="baterias-tab" data-bs-toggle="tab" data-bs-target="#baterias"
                                type="button" role="tab" aria-controls="baterias"
                                aria-selected="false">Baterías</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="revision-elementos-tab" data-bs-toggle="tab"
                                data-bs-target="#revision-elementos" type="button" role="tab"
                                aria-controls="revision-elementos" aria-selected="false">Revisión de Elementos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="revision-baterias-tab" data-bs-toggle="tab"
                                data-bs-target="#revision-baterias" type="button" role="tab"
                                aria-controls="revision-baterias" aria-selected="false">Revisión de Baterías</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reportes-tab" data-bs-toggle="tab" data-bs-target="#reportes"
                                type="button" role="tab" aria-controls="reportes"
                                aria-selected="false">Reportes</button>
                        </li>
                    </ul>
                    <!-- Tabs para escritorio -->
                    <ul class="nav d-none d-lg-flex nav-tabs">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="buscar-tab" data-bs-toggle="tab"
                                data-bs-target="#buscar" type="button" role="tab" aria-controls="buscar"
                                aria-selected="true">Buscar Cliente</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="equipo-tab" data-bs-toggle="tab" data-bs-target="#equipo"
                                type="button" role="tab" aria-controls="equipo" aria-selected="false">Equipo</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tipo-servicio-tab" data-bs-toggle="tab"
                                data-bs-target="#tipo-servicio" type="button" role="tab" aria-controls="tipo-servicio"
                                aria-selected="false">Tipo Servicio</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="frecuencia-servicio-tab" data-bs-toggle="tab"
                                data-bs-target="#frecuencia-servicio" type="button" role="tab"
                                aria-controls="frecuencia-servicio" aria-selected="false">Frecuencia Servicio</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="parametros-tab" data-bs-toggle="tab"
                                data-bs-target="#parametros" type="button" role="tab" aria-controls="parametros"
                                aria-selected="false">Parámetros</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="baterias-tab" data-bs-toggle="tab" data-bs-target="#baterias"
                                type="button" role="tab" aria-controls="baterias"
                                aria-selected="false">Baterías</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="revision-elementos-tab" data-bs-toggle="tab"
                                data-bs-target="#revision-elementos" type="button" role="tab"
                                aria-controls="revision-elementos" aria-selected="false">Revisión de Elementos</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="revision-baterias-tab" data-bs-toggle="tab"
                                data-bs-target="#revision-baterias" type="button" role="tab"
                                aria-controls="revision-baterias" aria-selected="false">Revisión de Baterías</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reportes-tab" data-bs-toggle="tab" data-bs-target="#reportes"
                                type="button" role="tab" aria-controls="reportes"
                                aria-selected="false">Reportes</button>
                        </li>
                        <!-- Agrega aquí los demás tabs -->
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="myTabsContent">
            <!-- Pestaña de búsqueda de cliente -->
            <div class="tab-pane fade show active" id="buscar" role="tabpanel" aria-labelledby="buscar-tab">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="cif_cliente" class="form-label">CIF del Cliente:</label>
                        <input type="text" id="cif_cliente" name="cif_cliente" class="form-control" required>
                    </div>
                    <button type="submit" name="buscar_cliente" class="btn btn-primary">Buscar Cliente</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </form>
                <?php
                // Verificar si se ha enviado el formulario de búsqueda
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar_cliente'])) {
                    if ($result->num_rows > 0) {
                        // Cliente encontrado, mostrar los datos
                        echo "<h3>Datos del Cliente</h3>";
                        echo "<p><strong>Nombre:</strong> $nombreCliente</p>";
                        echo "<p><strong>Dirección:</strong> $direccionCliente</p>";
                        echo "<p><strong>Teléfono:</strong> $telefonoCliente</p>";
                    } else {
                        echo "<p>Cliente no encontrado.</p>";
                    }
                }
                ?>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>