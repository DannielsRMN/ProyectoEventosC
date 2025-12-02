<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('❌ Error: No se especificó el ID del proveedor.'); window.location.href = 'index.php?view=listar_proveedores';</script>";
    exit();
}

$id_proveedor = intval($_GET['id']);

try {
    $proveedorModel = new Proveedor();
    $resultado = $proveedorModel->eliminarProveedor($id_proveedor);
    
    if ($resultado) {
        echo "<script>alert('✅ ¡Proveedor eliminado correctamente!'); window.location.href = 'index.php?view=listar_proveedores';</script>";
    } else {
        echo "<script>alert('❌ Error: No se pudo eliminar el proveedor. Puede tener servicios asociados.'); window.location.href = 'index.php?view=listar_proveedores';</script>";
    }
} catch (Exception $e) {
    error_log("Error en eliminar_proveedor.php: " . $e->getMessage());
    echo "<script>alert('❌ Error del sistema.'); window.location.href = 'index.php?view=listar_proveedores';</script>";
}
?>