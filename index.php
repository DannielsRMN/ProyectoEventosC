<?php
// 1. Capturamos qué controlador y qué acción quiere el usuario
// Si no envía nada, por defecto vamos a 'Usuario' y 'login'
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Usuario';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// 2. Construimos el nombre de la Clase y del Archivo
// Ejemplo: Si controller="usuario", buscamos "UsuarioController"
$controllerName = ucfirst($controller) . 'Controller'; 
$controllerFile = 'controllers/' . $controllerName . '.php';

// 3. Verificamos si el archivo existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        
        $object = new $controllerName();
        if (method_exists($object, $action)) {
            $object->$action();
            
        } else {
            echo "Error 404: La acción '<b>$action</b>' no existe en el controlador $controllerName.";
        }

    } else {
        echo "Error: La clase '<b>$controllerName</b>' no está definida correctamente.";
    }

} else {
    echo "Error 404: El controlador '<b>$controllerName</b>' no existe en la carpeta controllers.";
}
?>