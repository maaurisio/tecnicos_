<?php
// Verificar sesión de usuario
include '../includes/verificar_sesion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control - Administrador</title>
</head>
<body>
    <h2>Panel de control - Administrador</h2>
    <p>Bienvenido, <?php echo $_SESSION["username"]; ?>!</p>
    <p><a href="../includes/logout.php">Cerrar sesión</a></p>
</body>
</html>
