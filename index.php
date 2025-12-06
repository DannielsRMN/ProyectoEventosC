<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
define('BASE_PATH', __DIR__);

require_once 'Backend/config/Conexion.php';

spl_autoload_register(function ($class_name) {
    $file = 'Backend/models/' . $class_name . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$view = isset($_GET['view']) ? $_GET['view'] : 'home';

switch ($view) {

    case 'home':
        require_once 'Frontend/views/client/home.php';
        break;

    case 'login':
        require_once 'Frontend/views/login.php';
        break;
    
    case 'register':
        require_once 'Frontend/views/register.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?view=login');
        exit;
        break;

    case 'reservas':
        $sedeModel = new Sede();
        $listaSedes = $sedeModel->listarSedes();
        require_once 'Frontend/views/client/reservas.php';
        break;

    case 'configReserva':
        if (!isset($_GET['id_sede'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        $id_sede = $_GET['id_sede'];
        $sedeModel = new Sede();
        $sedeInfo = $sedeModel->obtenerSedePorId($id_sede);
        
        if (!$sedeInfo) {
            header('Location: index.php?view=reservas');
            exit;
        }
        require_once 'Frontend/views/client/configReserva.php';
        break;

    case 'procesar_reserva':
    case 'pagos':
    case 'confirmar_pago':
    case 'detalles':
    case 'historial':
        break;

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

    default:
        require_once 'Frontend/views/client/home.php';
        break;
}

if (in_array($view, ['procesar_reserva', 'pagos', 'confirmar_pago', 'detalles'])) {
    
    if ($view === 'procesar_reserva' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['reserva_temp'] = [
            'nombre_evento' => $_POST['nombre_evento'],
            'id_sede'       => $_POST['id_sede'],
            'nombre_sede'   => $_POST['nombre_sede_hidden'],
            'fecha'         => $_POST['fecha'],
            'hora_inicio'   => $_POST['hora_inicio'],
            'hora_fin'      => $_POST['hora_fin'],
            'costo_estimado'=> 600.00
        ];
        header('Location: index.php?view=pagos');
        exit;
    }

    if ($view === 'pagos') {
        if (!isset($_SESSION['reserva_temp'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        require_once 'Frontend/views/client/pagos.php';
    }

    if ($view === 'confirmar_pago' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['reserva_temp'])) {
            $data = $_SESSION['reserva_temp'];
            $id_usuario = $_SESSION['id_usuario'] ?? 1; 

            $datosInsertar = [
                'id_usuario'    => $id_usuario,
                'id_sede'       => $data['id_sede'],
                'nombre_evento' => $data['nombre_evento'],
                'fecha'         => $data['fecha'],
                'hora_inicio'   => $data['hora_inicio'],
                'hora_fin'      => $data['hora_fin'],
                'costo'         => $data['costo_estimado']
            ];

            $reservaModel = new Reserva();
            $id_reserva = $reservaModel->registrar($datosInsertar);

            if ($id_reserva) {
                unset($_SESSION['reserva_temp']);
                header("Location: index.php?view=detalles&id=$id_reserva");
                exit;
            } else {
                echo "<script>alert('Error fatal al guardar la reserva'); window.history.back();</script>";
            }
        } else {
            header('Location: index.php?view=reservas');
            exit;
        }
    }

    if ($view === 'detalles') {
        $id_reserva = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $ticket = $reservaModel->obtenerDetalle($id_reserva);
        require_once 'Frontend/views/client/detallesreserva.php';
    }
}
?>