<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../../Backend/controllers/UsuarioControlador.php';
        $controlador = new UsuarioControlador();
        
        $datos = [
            'email' => $_POST['email'],
            'password_hash' => $_POST['password']
        ];

        if ($controlador->login($datos)) {
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
    <link rel="stylesheet" href="/proyectoeventosc/Frontend/assets/css/index.css">
    <title>EventosC | Inicio de Sesion</title>
</head>
<body>

    <form action="" method="post">
        <h2>Correo Electrónico</h2>
        <input type="text" name="email" placeholder="Ingrese su correo electrónico">
        <h2>Contraseña</h2>
        <input type="text" name="password" placeholder="Ingrese su contraseña"> <br>

        <input type="submit" value="Iniciar Sesion">
    </form>
    
</body>
</html>