<?php


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('❌ Error: No se especificó el ID del cliente.'); window.location.href = 'index.php?view=listar_clientes';</script>";
    exit();
}

$id_usuario = intval($_GET['id']);

try {
    $clienteModel = new Cliente();
    $resultado = $clienteModel->eliminarCliente($id_usuario);
    
    if ($resultado) {
        echo "<script>alert('✅ ¡Cliente eliminado correctamente!'); window.location.href = 'index.php?view=listar_clientes';</script>";
    } else {
        echo "<script>alert('❌ Error: No se pudo eliminar el cliente. Puede tener eventos asociados.'); window.location.href = 'index.php?view=listar_clientes';</script>";
    }
} catch (Exception $e) {
    error_log("Error en eliminar_cliente.php: " . $e->getMessage());
    echo "<script>alert('❌ Error del sistema.'); window.location.href = 'index.php?view=listar_clientes';</script>";
}
?>