<?php
// =======================================================================================
//  ARCHIVO PRINCIPAL (FRONT CONTROLLER)
// =======================================================================================
//  Este archivo es el cerebro de nuestra aplicación. Actúa como un "Controlador Frontal".
//  ¿Qué significa eso? Que TODAS las peticiones pasan por aquí primero.
//  En lugar de tener muchos archivos dispersos (login.php, dashboard.php, reservas.php...),
//  este archivo recibe la orden y decide a quién pasarle el trabajo.
// =======================================================================================

// 1. CONFIGURACIÓN DE ERRORES
// ---------------------------------------------------------------------------------------
//  Para desarrollo, queremos ver todos los errores.
//  En producción (cuando la web es pública), esto debería desactivarse por seguridad.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. INICIO DE SESIÓN
// ---------------------------------------------------------------------------------------
//  Arrancamos la sesión del usuario. Esto es esencial para saber quién está navegando,
//  recordar si ya se logueó, y guardar datos temporales (como el carrito o mensajes).
session_start();

// Definimos la ruta base del proyecto para evitar problemas con rutas relativas.
define('BASE_PATH', __DIR__);

// 3. INCLUSIÓN DE ARCHIVOS CLAVE
// ---------------------------------------------------------------------------------------
//  Requerimos la conexión a la base de datos, que es la base de todo.
require_once 'Backend/config/Conexion.php';

//  AUTOLOADER (CARGA AUTOMÁTICA):
//  En lugar de hacer "require_once" por cada modelo (Usuario.php, Reserva.php, etc.),
//  esta función busca automáticamente el archivo cuando intentamos usar una clase.
//  Si escribes "new Usuario()", PHP buscará en 'Backend/models/Usuario.php'.
spl_autoload_register(function ($class_name) {
    $file = 'Backend/models/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// 4. EL ENRUTADOR (ROUTER)
// ---------------------------------------------------------------------------------------
//  Aquí ocurre la magia. Capturamos la variable 'view' de la URL (ej: index.php?view=login).
//  Si no viene nada, asumimos que el usuario quiere ver la página de inicio ('home').
$view = isset($_GET['view']) ? $_GET['view'] : 'home';

//  EL SWITCH EMPIEZA A DIRIGIR EL TRÁFICO
//  Dependiendo de qué pida el usuario ($view), cargamos una vista directa o llamamos a un controlador.
switch ($view) {

    // ===========================================
    //  ZONA PÚBLICA (Cualquiera puede ver esto)
    // ===========================================
    case 'home':
        // Carga la página principal (Landing Page).
        require_once 'Frontend/views/client/home.php';
        break;

    // ===========================================
    //  ZONA DE AUTENTICACIÓN
    // ===========================================
    case 'login':
        // Muestra el formulario de inicio de sesión.
        require_once 'Frontend/views/login.php';
        break;

    case 'register':
        // Muestra el formulario de registro.
        require_once 'Frontend/views/register.php';
        break;

    case 'logout':
        // Destruye la sesión (olvida quién es el usuario) y lo manda al login.
        session_destroy();
        header('Location: index.php?view=login');
        exit; // Detenemos el script para asegurar que no se ejecute nada más.

    // ===========================================
    //  ZONA DE CLIENTES (RESERVAS)
    // ===========================================
    //  Aquí usamos el patrón MVC completo. No cargamos la vista directamente.
    //  Instanciamos un CONTROLADOR (ReservaControlador) y le pedimos que ejecute una acción.
    //  El controlador procesa la lógica y luego él decide qué vista mostrar.

    case 'reservas':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->index(); // Muestra el catálogo de sedes/reservas
        break;

    case 'configReserva':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->configurar(); // Configura fechas y detalles
        break;

    case 'procesar_reserva':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->procesar(); // Guarda la reserva en la BD
        break;

    case 'pagos':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->pagos(); // Muestra la pasarela de pago o instrucciones
        break;

    case 'confirmar_pago':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->confirmarPago(); // Valida el pago realizado
        break;

    case 'detalles':
        require_once 'Backend/controllers/ReservaControlador.php';
        $controller = new ReservaControlador();
        $controller->detalles(); // Muestra el ticket final
        break;

    case 'historial':
        // (Pendiente) Aquí iría el historial de reservas del usuario.
        break;

    // ===========================================
    //  ZONA DE ADMINISTRACIÓN (BACKOFFICE)
    // ===========================================
    //  Estas vistas gestionan los datos del sistema (CRUDs).
    //  Están protegidas (lógica de permisos debería estar en la vista o controlador).

    case 'dashboard':
        require_once 'Frontend/views/admin/dashboard.php';
        break;

    case 'clientes':
        require_once 'Frontend/views/admin/crudClientes.php';
        break;

    case 'proveedores':
        require_once 'Frontend/views/admin/crudProveedores.php';
        break;

    case 'recursos':
        require_once 'Frontend/views/admin/crudRecursos.php';
        break;

    case 'servicios':
        require_once 'Frontend/views/admin/crudServicios.php';
        break;

    case 'sedes':
        require_once 'Frontend/views/admin/crudSedes.php';
        break;

    case 'eventos':
        require_once 'Frontend/views/admin/crudEventos.php';
        break;

    // ===========================================
    //  RUTA POR DEFECTO (EL LIMBO)
    // ===========================================
    //  Si el usuario escribe algo raro en la URL (?view=loquesea),
    //  lo mandamos a la página segura: el home o un error 404 personalizado.
    default:
        require_once 'Frontend/views/client/home.php';
        break;
}
?>