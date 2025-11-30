<?php
// views/dashboard.php
session_start();

// SEGURIDAD: Si no hay usuario logueado, lo botamos al login
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Administrador</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    
    <h1>Bienvenido, <?= $_SESSION['nombre'] ?></h1>
    <p>Rol: <strong><?= $_SESSION['rol'] ?></strong></p>

    <hr>

    <h3>Tus opciones:</h3>
    <ul>
        <li><a href="#">Gestionar Eventos</a></li>
        <li><a href="#">Ver Reservas</a></li>
    </ul>

    <br>
    <a href="../controllers/logout.php" style="background: red; color: white; padding: 10px; text-decoration: none;">Cerrar Sesión</a>

</body>
</html>