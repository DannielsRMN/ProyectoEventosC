<?php
// ============================================
// UBICACIÓN: Frontend/views/admin/cancelar_reserva.php
// DESCRIPCIÓN: Cancelar un evento
// ============================================

// Validar que se recibió el ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('❌ Error: No se especificó el ID de la reserva.');
            window.location.href = 'index.php?view=dashboard';
          </script>";
    exit();
}

$id_reserva = intval($_GET['id']);

try {
    // Instanciar el modelo Admin
    $adminModel = new Admin();
    
    // Intentar cancelar el evento
    $resultado = $adminModel->cancelarEvento($id_reserva);
    
    if ($resultado) {
        echo "<script>
                alert('✅ ¡Evento cancelado exitosamente!\\n\\nEl evento #" . $id_reserva . " ha sido cancelado.');
                window.location.href = 'index.php?view=dashboard';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error: No se pudo cancelar el evento.\\n\\nIntenta nuevamente.');
                window.location.href = 'index.php?view=dashboard';
              </script>";
    }
    
} catch (Exception $e) {
    error_log("Error en cancelar_reserva.php: " . $e->getMessage());
    echo "<script>
            alert('❌ Error del sistema: " . addslashes($e->getMessage()) . "');
            window.location.href = 'index.php?view=dashboard';
          </script>";
}
?>