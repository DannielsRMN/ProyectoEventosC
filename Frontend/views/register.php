<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../Backend/controllers/UsuarioControlador.php';
    $controlador = new UsuarioControlador();
    
    $datos = [
        'nombre_completo' => $_POST['name'],
        'email' => $_POST['email'],
        'password_hash' => $_POST['password']
    ];

    if ($controlador->register($datos)) {
        header('Location: login.php');
        exit;
    } else {
        $error = "No se pudo registrar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventosC | Registro de Usuario</title>
</head>
<body>

    <form action="" method="post">
        <h2>Nombre Completo</h2>
        <input type="text" name="name" placeholder="Ingrese su nombre completo">
        <h2>Correo Electrónico</h2>
        <input type="text" name="email" placeholder="Ingrese su correo electrónico">
        <h2>Contraseña</h2>
        <input type="text" name="password" placeholder="Ingrese su contraseña"> <br>
        <input type="text" placeholder="Repita su contraseña"> <br>

        <input type="submit" value="Registrarse">
    </form>
    
</body>
</html>