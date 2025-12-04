<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('❌ Error: No se especificó el ID del servicio.'); window.location.href = 'index.php?view=listar_servicios';</script>";
    exit();
}

$id_servicio = intval($_GET['id']);

try {
    $servicioModel = new Servicio();
    $resultado = $servicioModel->eliminarServicio($id_servicio);
    
    if ($resultado) {
        echo "<script>alert('✅ ¡Servicio eliminado correctamente!'); window.location.href = 'index.php?view=listar_servicios';</script>";
    } else {
        echo "<script>alert('❌ Error: No se pudo eliminar el servicio. Puede estar en uso.'); window.location.href = 'index.php?view=listar_servicios';</script>";
    }
} catch (Exception $e) {
    error_log("Error en eliminar_servicio.php: " . $e->getMessage());
    echo "<script>alert('❌ Error del sistema.'); window.location.href = 'index.php?view=listar_servicios';</script>";
}
?>