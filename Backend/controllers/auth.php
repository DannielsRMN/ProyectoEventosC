<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $modelo = new Usuario();
    $usuarioEncontrado = $modelo->login($email, $password);

    if ($usuarioEncontrado) {
        $_SESSION['id_usuario'] = $usuarioEncontrado['id_usuario'];
        $_SESSION['nombre'] = $usuarioEncontrado['nombre_completo'];
        $_SESSION['rol'] = $usuarioEncontrado['rol'];

        header("Location: /ProyectoEventosC/views/dashboard.php");
        exit();
    } else {
        header("Location: /ProyectoEventosC/views/login.php?error=Datos incorrectos");
        exit();
    }
}
?>