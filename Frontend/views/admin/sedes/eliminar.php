<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('❌ Error: No se especificó el ID de la sede.'); window.location.href = 'index.php?view=listar_sedes';</script>";
    exit();
}

$id_sede = intval($_GET['id']);

try {
    $sedeModel = new Sede();
    $resultado = $sedeModel->eliminarSede($id_sede);
    
    if ($resultado) {
        echo "<script>alert('✅ ¡Sede eliminada correctamente!'); window.location.href = 'index.php?view=listar_sedes';</script>";
    } else {
        echo "<script>alert('❌ Error: No se pudo eliminar la sede. Puede tener eventos asociados.'); window.location.href = 'index.php?view=listar_sedes';</script>";
    }
} catch (Exception $e) {
    error_log("Error en eliminar_sede.php: " . $e->getMessage());
    echo "<script>alert('❌ Error del sistema.'); window.location.href = 'index.php?view=listar_sedes';</script>";
}
?>