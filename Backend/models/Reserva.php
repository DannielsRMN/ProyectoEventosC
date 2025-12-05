<?php
require_once __DIR__ . '/../config/Conexion.php';

class Reserva {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->iniciar();
    }

    public function registrar($datos) {
        try {
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $this->conn->beginTransaction();

            $sqlEvento = "INSERT INTO evento (id_cliente, id_sede, nombre_evento, fecha_evento, hora_inicio, hora_fin, estado) 
                          VALUES (:id_cliente, :id_sede, :nombre, :fecha, :inicio, :fin, 'Confirmado')";
            
            $stmt = $this->conn->prepare($sqlEvento);
            
            $stmt->execute([
                ':id_cliente' => $datos['id_usuario'],
                ':id_sede'    => $datos['id_sede'],
                ':nombre'     => $datos['nombre_evento'],
                ':fecha'      => $datos['fecha'],
                ':inicio'     => $datos['hora_inicio'],
                ':fin'        => $datos['hora_fin']
            ]);

            $idEventoCreado = $this->conn->lastInsertId();

            $sqlReserva = "INSERT INTO reserva (id_evento, fecha_reserva, costo_total, monto_pagado, estado_pago) 
                           VALUES (:id_evento, CURDATE(), :total, :pagado, 'Pagado')";
            
            $stmt2 = $this->conn->prepare($sqlReserva);
            $stmt2->execute([
                ':id_evento' => $idEventoCreado,
                ':total'     => $datos['costo'],
                ':pagado'    => $datos['costo']
            ]);

            $idReservaCreada = $this->conn->lastInsertId();

            $this->conn->commit();
            return $idReservaCreada;

        } catch (Exception $e) {
            $this->conn->rollBack();
            
            echo '<div style="background: #222; color: #ff4444; padding: 20px; font-family: monospace; z-index: 9999; position: relative;">';
            echo '<h2>ERROR SQL DETECTADO:</h2>';
            echo '<strong>Mensaje:</strong> ' . $e->getMessage() . '<br><br>';
            echo '<strong>Archivo:</strong> ' . $e->getFile() . ' (Línea ' . $e->getLine() . ')<br><br>';
            echo '<strong>Datos recibidos:</strong><pre>';
            print_r($datos);
            echo '</pre>';
            echo '</div>';
            die();
            
            return false;
        }
    }
    
    public function obtenerDetalle($id_reserva) {
        $sql = "SELECT r.*, e.nombre_evento, e.fecha_evento, e.hora_inicio, e.hora_fin, s.nombre as nombre_sede, s.direccion 
                FROM reserva r
                JOIN evento e ON r.id_evento = e.id_evento
                JOIN sede s ON e.id_sede = s.id_sede
                WHERE r.id_reserva = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id_reserva]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>