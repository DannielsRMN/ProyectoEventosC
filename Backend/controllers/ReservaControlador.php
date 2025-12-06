<?php

require_once __DIR__ . '/../models/Sede.php';
require_once __DIR__ . '/../models/Reserva.php';

class ReservaControlador
{
    public function index()
    {
        $sedeModel = new Sede();
        $listaSedes = $sedeModel->listarSedes();
        require_once 'Frontend/views/client/reservas.php';
    }

    public function configurar()
    {
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
    }

    public function procesar()
    {
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
            exit;
        }
    }

    public function pagos()
    {
        if (!isset($_SESSION['reserva_temp'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        require_once 'Frontend/views/client/pagos.php';
    }

    public function confirmarPago()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['reserva_temp'])) {
                $data = $_SESSION['reserva_temp'];
                $id_usuario = $_SESSION['id_usuario'] ?? 1;

                $datosInsertar = [
                    'id_usuario' => $id_usuario,
                    'id_sede' => $data['id_sede'],
                    'nombre_evento' => $data['nombre_evento'],
                    'fecha' => $data['fecha'],
                    'hora_inicio' => $data['hora_inicio'],
                    'hora_fin' => $data['hora_fin'],
                    'costo' => $data['costo_estimado']
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
    }

    public function detalles()
    {
        $id_reserva = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $ticket = $reservaModel->obtenerDetalle($id_reserva);
        require_once 'Frontend/views/client/detallesreserva.php';
    }
}
?>