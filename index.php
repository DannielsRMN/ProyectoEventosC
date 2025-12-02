<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
define('BASE_PATH', __DIR__);

// Incluir archivos necesarios
require_once 'Backend/config/Conexion.php';
require_once 'Backend/models/Usuario.php'; 
require_once 'Backend/models/Sede.php';
require_once 'Backend/models/Reserva.php';
require_once 'Backend/models/Admin.php'; 

$view = isset($_GET['view']) ? $_GET['view'] : 'home';

switch ($view) {
    case 'home':
        require_once 'Frontend/views/client/home.php';
        break;

    case 'login':
        require_once 'Frontend/views/login.php';
        break;
        
    case 'logout':
        session_destroy();
        header('Location: index.php?view=login');
        exit;
        break;

   
    case 'dashboard':
        
        $adminModel = new Admin();
        
        
        $reservas = $adminModel->listarReservas();
        
       
        require_once 'Frontend/views/admin/dashboard.php';
        break;

    case 'cancelar_reserva':
        require_once 'Frontend/views/admin/cancelar_reserva.php';
        break;
    
    case 'reactivar_reserva':
        require_once 'Frontend/views/admin/reactivar_reserva.php';
        break;
    
    case 'reservas':
        $sedeModel = new Sede();
        $listaSedes = $sedeModel->listar();
        require_once 'Frontend/views/client/reservas.php';
        break;

    case 'configReserva':
        if (!isset($_GET['id_sede'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        
        $id_sede = $_GET['id_sede'];
        $sedeModel = new Sede();
        $sedeInfo = $sedeModel->obtener($id_sede);

        if (!$sedeInfo) {
            header('Location: index.php?view=reservas');
            exit;
        }

        require_once 'Frontend/views/client/configReserva.php';
        break;

    case 'procesar_reserva':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['reserva_temp'] = [
                'nombre_evento' => $_POST['nombre_evento'],
                'id_sede' => $_POST['id_sede'],
                'nombre_sede' => $_POST['nombre_sede_hidden'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'costo_estimado' => 600.00 
            ];
            header('Location: index.php?view=pagos');
        }
        break;

    case 'pagos':
        if (!isset($_SESSION['reserva_temp'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        require_once 'Frontend/views/client/pagos.php';
        break;

    case 'confirmar_pago':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['reserva_temp'])) {
            
            $data = $_SESSION['reserva_temp'];
            
            $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 1; 

            $datosInsertar = [
                'id_usuario' => $id_usuario,
                'id_sede'    => $data['id_sede'],
                'nombre_evento' => $data['nombre_evento'],
                'fecha'      => $data['fecha'],
                'hora_inicio'=> $data['hora_inicio'],
                'hora_fin'   => $data['hora_fin'],
                'costo'      => $data['costo_estimado']
            ];

            $reservaModel = new Reserva();
            $id_reserva = $reservaModel->registrar($datosInsertar);

            if ($id_reserva) {
                unset($_SESSION['reserva_temp']);
                header("Location: index.php?view=detalles&id=$id_reserva");
            } else {
                echo "<h1>Error Fatal: No se pudo guardar la reserva.</h1>";
            }
        } else {
            header('Location: index.php?view=reservas');
        }
        break;

    case 'detalles':
        $id_reserva = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $ticket = $reservaModel->obtenerDetalle($id_reserva);
        
        require_once 'Frontend/views/client/detallesreserva.php';
        break;
        
    case 'historial':
        require_once 'Frontend/views/client/historialreserva.php';
        break;

    default:
        require_once 'Frontend/views/client/home.php';
        break;
}
?>