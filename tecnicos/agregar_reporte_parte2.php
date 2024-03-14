<?php
// Verificar sesión de usuario
include '../includes/verificar_sesion.php';

// Incluir la conexión a la base de datos
include '../includes/conexion.php';

// Inicializar variables para almacenar los datos del cliente
$equipoCapacidad = "";
$marcaEquipo = "";
$modeloEquipo = "";
$numeroSerieUno = "";
$numeroSerieDos = "";
$estadoEquipo = "";
$ubicacionEquipo = "";
$porcentajeCarga = "";
$tiempoRespaldo = "";

// Verificar si se ha enviado el formulario para agregar un equipo y un reporte
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_equipo_reporte'])) {
    // Obtener los datos del formulario para el equipo
    $equipoCapacidad = $_POST['equipo_capacidad'];
    $marcaEquipo = $_POST['marca'];
    $modeloEquipo = $_POST['modelo'];
    $numeroSerieUno = $_POST['numero_serie_uno'];
    $numeroSerieDos = $_POST['numero_serie_dos'];
    $estadoEquipo = $_POST['estado_equipo'];
    $ubicacionEquipo = $_POST['ubicacion_equipo'];
    $porcentajeCarga = $_POST['porcentaje_carga'];
    $tiempoRespaldo = $_POST['tiempo_respaldo'];

    // Obtener el tipo de servicio
    $tipoServicio = $_POST['tipo_servicio'];

    // Consulta SQL para insertar el nuevo equipo
    $sqlEquipo = "INSERT INTO equipos (equipo_capacidad, marca, modelo, numero_serie_uno, numero_serie_dos, estado_equipo, ubicacion_equipo, porcentaje_carga, tiempo_respaldo) 
            VALUES ('$equipoCapacidad', '$marcaEquipo', '$modeloEquipo', '$numeroSerieUno', '$numeroSerieDos', '$estadoEquipo', '$ubicacionEquipo', '$porcentajeCarga', '$tiempoRespaldo')";

    if ($conn->query($sqlEquipo) === TRUE) {
        // Obtener el ID del equipo recién insertado
        $idEquipo = $conn->insert_id;

        // Obtener el ID del usuario de la sesión
        $idUsuario = $_SESSION['id'];

        // Obtener el CIF del cliente
        $cifCliente = $_POST['cif_cliente'];

        // Obtener la fecha actual
        $fecha = date('Y-m-d H:i:s');

        // Consulta SQL para insertar el nuevo reporte
        $sqlReporte = "INSERT INTO reportes (id_usuario, id_equipo, cif_cliente, fecha, id_tipo_servicio) 
            VALUES ('$idUsuario', '$idEquipo', '$cifCliente', '$fecha', '$tipoServicio')";

        if ($conn->query($sqlReporte) === TRUE) {
            echo "Reporte agregado correctamente.";
        } else {
            echo "Error al agregar el reporte: " . $conn->error;
        }
    } else {
        echo "Error al agregar el equipo: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Reporte - Parte 2</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            cursor: pointer;
        }

        .btn-container {
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="form-title">Agregar Reporte - Parte 2: Registrar Equipo y Reporte</h2>

            <!-- Formulario para agregar un equipo y un reporte -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="cif_cliente" value="<?php echo $_POST['cif_cliente']; ?>">

                <!-- Campos para registrar el equipo -->
                <div class="mb-3">
                    <label for="equipo_capacidad" class="form-label">Capacidad del Equipo:</label>
                    <input type="text" id="equipo_capacidad" name="equipo_capacidad" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca del Equipo:</label>
                    <input type="text" id="marca" name="marca" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="modelo" class="form-label">Modelo del Equipo:</label>
                    <input type="text" id="modelo" name="modelo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="numero_serie_uno" class="form-label">Número de Serie (Uno):</label>
                    <input type="text" id="numero_serie_uno" name="numero_serie_uno" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="numero_serie_dos" class="form-label">Número de Serie (Dos):</label>
                    <input type="text" id="numero_serie_dos" name="numero_serie_dos" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="estado_equipo" class="form-label">Estado del Equipo:</label>
                    <select id="estado_equipo" name="estado_equipo" class="form-select" required>
                        <option value="encendido">Encendido</option>
                        <option value="en línea">En línea</option>
                        <option value="operando">Operando</option>
                        <option value="apagado">Apagado</option>
                        <option value="en bypass">En bypass</option>
                        <option value="fuera de servicio">Fuera de servicio</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ubicacion_equipo" class="form-label">Ubicación del Equipo:</label>
                    <input type="text" id="ubicacion_equipo" name="ubicacion_equipo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="porcentaje_carga" class="form-label">Porcentaje de Carga:</label>
                    <input type="number" id="porcentaje_carga" name="porcentaje_carga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tiempo_respaldo" class="form-label">Tiempo de Respaldo (minutos):</label>
                    <input type="number" id="tiempo_respaldo" name="tiempo_respaldo" class="form-control" required>
                </div>

                <!-- Campo para seleccionar el tipo de servicio -->
                <div class="mb-3">
                    <label for="tipo_servicio" class="form-label">Tipo de Servicio:</label>
                    <select id="tipo_servicio" name="tipo_servicio" class="form-select" required>
                        <option value="1">Preventivo</option>
                        <option value="2">Correctivo</option>
                        <option value="3">Arranque</option>
                        <option value="4">Emergencia</option>
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="form-submit">
                    <button type="submit" name="registrar_equipo_reporte" class="btn btn-primary">Registrar Equipo y
                        Reporte</button>
                    <a href="agregar_reporte.php" class="btn btn-secondary">Volver a la Parte 1</a>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U4s5lMQ0DtGgKpuk+pt/tVADN1q+d9WqPvUzJSvefjJnHLyT1wr7+LxPLv0bZNU7"
        crossorigin="anonymous"></script>
</body>

</html>