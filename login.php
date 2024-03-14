<?php
// Incluir el archivo de conexión
include 'includes/conexion.php';

// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión, si es así, redirigirlo a la página de inicio adecuada
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    if ($_SESSION["rol"] == 1) {
        header("Location: admin/index.php");
    } elseif ($_SESSION["rol"] == 2) {
        header("Location: tecnicos/index.php");
    }
    exit;
}

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Usuario encontrado, verificar la contraseña
        $row = $result->fetch_assoc();
        if ($password == $row["contrasena"]) {
            // Contraseña válida, iniciar sesión y guardar el ID de usuario en la sesión
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["rol"] = $row["id_rol"];
            $_SESSION["id"] = $row["id"]; // Asignar el ID de usuario a la sesión

            // Redirigir según el rol del usuario
            if ($row["id_rol"] == 1) {
                // Si es admin, redirigir al dashboard de admin
                header("Location: admin/index.php");
            } elseif ($row["id_rol"] == 2) {
                // Si es técnico, redirigir al index de técnico
                header("Location: tecnicos/index.php");
            }
            exit;
        } else {
            // Contraseña incorrecta
            $error = "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario no encontrado.";
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form action="" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
