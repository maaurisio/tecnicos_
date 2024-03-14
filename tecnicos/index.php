<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal - Técnico</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Página principal - Técnico</h2>
        <?php
        // Incluir la verificación de sesión
        include '../includes/verificar_sesion.php';
        ?>
        <p>Bienvenido, <strong>
                <?php echo $_SESSION["username"]; ?>
            </strong>!</p>
        <p>Tu ID de usuario es: <strong>
                <?php echo $_SESSION["id"]; ?>
            </strong></p>

        <!-- Botones para agregar un nuevo reporte y ver los reportes existentes -->
        <div class="row">
            <div class="col-md-6">
                <a href="generar_reporte.php" class="btn btn-primary">Agregar Reporte</a>
            </div>
            <div class="col-md-6">
                <a href="reportes.php?id_usuario=<?php echo $_SESSION['id']; ?>" class="btn btn-secondary">Ver Mis
                    Reportes</a>
            </div>

        </div>

        <!-- Botón para cerrar sesión -->
        <div class="row mt-3">
            <div class="col-md-12">
                <a href="../includes/logout.php" class="btn btn-danger">Cerrar sesión</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U4s5lMQ0DtGgKpuk+pt/tVADN1q+d9WqPvUzJSvefjJnHLyT1wr7+LxPLv0bZNU7"
        crossorigin="anonymous"></script>
</body>

</html>