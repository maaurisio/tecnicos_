<?php
// Incluir la conexión a la base de datos
include '../includes/conexion.php';
include '../includes/verificar_sesion.php';

// Obtener el ID de usuario de la sesión
$id_usuario = $_SESSION['id'];

// Lógica de guardar reporte
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['guardar_reporte'])) {
    // Obtener datos del formulario
    $id_usuario = $_SESSION['id']; // Obtener el ID de usuario de la sesión
    $id_equipo = $_POST['id_equipo'];
    $cif_cliente = $_POST['cif_cliente'];
    $id_tipo_servicio = $_POST['id_tipo_servicio'];
    $id_frecuencia_servicio = $_POST['id_frecuencia_servicio'];
    $id_parametros_electricos = $_POST['id_parametros_electricos'];
    $id_baterias = $_POST['id_baterias'];
    $id_revision_elementos = $_POST['id_revision_elementos'];
    $id_revision_baterias = $_POST['id_revision_baterias'];
    $fecha = $_POST['fecha'];

    // Verificar si el cliente existe antes de intentar guardar el reporte
    $sqlVerificarCliente = "SELECT * FROM clientes WHERE cif = '$cif_cliente'";
    $resultVerificarCliente = $conn->query($sqlVerificarCliente);

    if ($resultVerificarCliente->num_rows > 0) {
        // Insertar el reporte
        $sqlGuardarReporte = "INSERT INTO reportes (id_usuario, id_equipo, cif_cliente, id_tipo_servicio, id_frecuencia_servicio, id_parametros_electricos, id_baterias, id_revision_elementos, id_revision_baterias, fecha) 
                              VALUES ('$id_usuario', '$id_equipo', '$cif_cliente', '$id_tipo_servicio', '$id_frecuencia_servicio', '$id_parametros_electricos', '$id_baterias', '$id_revision_elementos', '$id_revision_baterias', '$fecha')";

        if ($conn->query($sqlGuardarReporte) === TRUE) {
            echo "Reporte guardado correctamente.";
        } else {
            echo "Error al guardar el reporte: " . $conn->error;
        }
    } else {
        echo "Error: Cliente con CIF $cif_cliente no encontrado.";
    }

    // Cerrar la conexión
    $conn->close();
}

// Lógica de buscar cliente por CIF
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST['buscar_cliente'])) {
    // Obtener el CIF del formulario de búsqueda
    $cif_cliente_busqueda = $_POST['cif_cliente_busqueda'];

    // Buscar el cliente por su CIF
    $sqlBuscarCliente = "SELECT * FROM clientes WHERE cif = '$cif_cliente_busqueda'";
    $resultBuscarCliente = $conn->query($sqlBuscarCliente);

    if ($resultBuscarCliente->num_rows > 0) {
        // Obtener la información del cliente
        $clienteEncontrado = $resultBuscarCliente->fetch_assoc();
    } else {
        echo "Cliente no encontrado.";
    }

    // Cerrar la conexión
    $conn->close();
}
?>