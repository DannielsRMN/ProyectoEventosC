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
    
   
    $resultado = $admin->cancelarEvento($id_reserva);
    
    if ($resultado) {
        echo "<script>
                alert('✅ ¡Evento cancelado correctamente!\\n\\nLa reserva #$id_reserva ha sido cancelada.');
                window.location.href = 'index.php?view=dashboard';
              </script>";
    } else {
        echo "<script>
                alert('❌ Error: No se pudo cancelar el evento.\\n\\nPor favor, intenta nuevamente.');
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