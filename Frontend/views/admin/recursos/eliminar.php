<?php


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('❌ Error: No se especificó el ID del recurso.'); window.location.href = 'index.php?view=listar_recursos';</script>";
    exit();
}

$id_recurso = intval($_GET['id']);

try {
    $recursoModel = new Recurso();
    $resultado = $recursoModel->eliminarRecurso($id_recurso);
    
    if ($resultado) {
        echo "<script>alert('✅ ¡Recurso eliminado correctamente!'); window.location.href = 'index.php?view=listar_recursos';</script>";
    } else {
        echo "<script>alert('❌ Error: No se pudo eliminar el recurso. Puede estar en uso.'); window.location.href = 'index.php?view=listar_recursos';</script>";
    }
} catch (Exception $e) {
    error_log("Error en eliminar_recurso.php: " . $e->getMessage());
    echo "<script>alert('❌ Error del sistema.'); window.location.href = 'index.php?view=listar_recursos';</script>";
}
?>