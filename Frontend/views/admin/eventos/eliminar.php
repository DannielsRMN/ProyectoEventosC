<?php

if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['id_reserva']) || empty($_GET['id_reserva'])) {
    echo "<script>alert('❌ Error: Datos incompletos.'); window.location.href = 'index.php?view=dashboard';</script>";
    exit();
}

$id_evento = intval($_GET['id']);
$id_reserva = intval($_GET['id_reserva']);

try {
    $conexion = (new Conexion())->iniciar();
    
    // Iniciar transacción
    $conexion->beginTransaction();
    
    // Eliminar primero los detalles de recursos y servicios
    $sqlDetalleRecurso = "DELETE FROM detalle_recurso WHERE id_evento = :id_evento";
    $stmtDetalleRecurso = $conexion->prepare($sqlDetalleRecurso);
    $stmtDetalleRecurso->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
    $stmtDetalleRecurso->execute();
    
    $sqlDetalleServicio = "DELETE FROM detalle_servicio WHERE id_evento = :id_evento";
    $stmtDetalleServicio = $conexion->prepare($sqlDetalleServicio);
    $stmtDetalleServicio->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
    $stmtDetalleServicio->execute();
    
    // Eliminar reserva
    $sqlReserva = "DELETE FROM reserva WHERE id_reserva = :id_reserva";
    $stmtReserva = $conexion->prepare($sqlReserva);
    $stmtReserva->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
    $stmtReserva->execute();
    
    // Eliminar evento
    $sqlEvento = "DELETE FROM evento WHERE id_evento = :id_evento";
    $stmtEvento = $conexion->prepare($sqlEvento);
    $stmtEvento->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
    $stmtEvento->execute();
    
    // Confirmar transacción
    $conexion->commit();
    
    echo "<script>
            alert('✅ ¡Evento eliminado exitosamente!\\n\\nEl evento #$id_evento y su reserva #$id_reserva han sido eliminados del sistema.');
            window.location.href = 'index.php?view=dashboard';
          </script>";
    
} catch (Exception $e) {
    // Revertir transacción en caso de error
    if ($conexion->inTransaction()) {
        $conexion->rollBack();
    }
    error_log("Error en eliminar_evento.php: " . $e->getMessage());
    echo "<script>
            alert('❌ Error del sistema: " . addslashes($e->getMessage()) . "');
            window.location.href = 'index.php?view=dashboard';
          </script>";
}
?>