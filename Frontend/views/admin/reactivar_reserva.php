<?php



if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('❌ Error: No se especificó el ID de la reserva.');
            window.location.href = 'index.php?view=dashboard';
          </script>";
    exit();
}

$id_reserva = intval($_GET['id']);

try {
    
    $admin = new Admin();
    
    /
    $resultado = $admin->reactivarEvento($id_reserva);
    
    if ($resultado) {
        echo "<script>
                alert('✅ ¡Evento reactivado correctamente!\\n\\nLa reserva #$id_reserva ha sido CONFIRMADA nuevamente.');
                window.location.href = 'index.php?view=dashboard';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error: No se pudo reactivar el evento.\\n\\nPor favor, intenta nuevamente.');
                window.location.href = 'index.php?view=dashboard';
              </script>";
    }
    
} catch (Exception $e) {
    error_log("Error en reactivar_reserva.php: " . $e->getMessage());
    echo "<script>
            alert('❌ Error del sistema: " . addslashes($e->getMessage()) . "');
            window.location.href = 'index.php?view=dashboard';
          </script>";
}
?>