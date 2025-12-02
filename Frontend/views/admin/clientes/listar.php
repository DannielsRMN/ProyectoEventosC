<?php
$clienteModel = new Cliente();
$clientes = $clienteModel->listarClientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes - EventosC</title>
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body::before { background: rgba(0, 0, 0, 0.95) !important; }
        .admin-wrapper { width: 100%; min-height: 100vh; padding-top: 120px; padding-bottom: 50px; z-index: 2; }
        .admin-container { width: 95%; max-width: 1600px; margin: 0 auto; }
        .page-header { background: linear-gradient(135deg, rgba(57, 255, 20, 0.05), rgba(255, 255, 255, 0.02)); border: 1px solid rgba(57, 255, 20, 0.3); padding: 30px 40px; border-radius: 15px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; }
        .page-title { font-family: 'Orbitron', sans-serif; font-size: 2.5rem; color: #ffffff; text-transform: uppercase; margin: 0; }
        .btn-crear { font-family: 'Orbitron', sans-serif; background: linear-gradient(135deg, #39ff14, #00ff88); color: black; padding: 15px 35px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; display: inline-flex; align-items: center; gap: 10px; transition: all 0.3s ease; }
        .btn-crear:hover { transform: translateY(-3px); }
        .clientes-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 30px; margin-bottom: 40px; }
        .cliente-card { background: rgba(20, 20, 20, 0.8); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 30px; transition: all 0.3s ease; }
        .cliente-card:hover { transform: translateY(-5px); border-color: #39ff14; }
        .cliente-header { display: flex; align-items: center; gap: 20px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .cliente-avatar { width: 70px; height: 70px; border-radius: 50%; background: linear-gradient(135deg, #39ff14, #00ff88); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: black; font-weight: bold; }
        .cliente-nombre { font-family: 'Orbitron', sans-serif; font-size: 1.4rem; color: #ffffff; margin-bottom: 5px; font-weight: 700; }
        .cliente-email { color: rgba(255, 255, 255, 0.6); font-size: 1rem; }
        .cliente-stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0; padding: 20px; background: rgba(255, 255, 255, 0.03); border-radius: 10px; }
        .stat-label { font-size: 0.85rem; color: rgba(255, 255, 255, 0.5); text-transform: uppercase; }
        .stat-value { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; color: #39ff14; font-weight: 700; }
        .cliente-acciones { display: flex; gap: 10px; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-editar, .btn-eliminar { font-family: 'Orbitron', sans-serif; padding: 10px 15px; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; text-transform: uppercase; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; flex: 1; justify-content: center; border: 1px solid; }
        .btn-editar { background: transparent; color: #00c8ff; border-color: #00c8ff; }
        .btn-editar:hover { background: #00c8ff; color: black; }
        .btn-eliminar { background: transparent; color: #ff5555; border-color: #ff5555; }
        .btn-eliminar:hover { background: #ff5555; color: white; }
        .btn-back { font-family: 'Orbitron', sans-serif; display: inline-flex; align-items: center; gap: 10px; padding: 15px 35px; background: transparent; color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 1.3rem; text-transform: uppercase; transition: all 0.3s ease; }
        .btn-back:hover { background: white; color: black; transform: translateX(-5px); }
    </style>
</head>
<body>
    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div class="admin-wrapper">
        <div class="admin-container">
            
            <div class="page-header">
                <h1 class="page-title">👥 Gestión de Clientes</h1>
                <a href="index.php?view=crear_cliente" class="btn-crear">
                    <span class="material-symbols-rounded">person_add</span>
                    Nuevo Cliente
                </a>
            </div>

            <?php if (!empty($clientes) && is_array($clientes)): ?>
                <div class="clientes-grid">
                    <?php foreach ($clientes as $cliente): ?>
                        <div class="cliente-card">
                            <div class="cliente-header">
                                <div class="cliente-avatar">
                                    <?php echo strtoupper(substr($cliente['nombre_completo'], 0, 1)); ?>
                                </div>
                                <div>
                                    <h2 class="cliente-nombre"><?php echo htmlspecialchars($cliente['nombre_completo']); ?></h2>
                                    <p class="cliente-email"><?php echo htmlspecialchars($cliente['email']); ?></p>
                                </div>
                            </div>
                            
                            <div class="cliente-stats">
                                <div>
                                    <div class="stat-label">Eventos</div>
                                    <div class="stat-value"><?php echo htmlspecialchars($cliente['total_eventos']); ?></div>
                                </div>
                                <div>
                                    <div class="stat-label">Total Gastado</div>
                                    <div class="stat-value">S/ <?php echo number_format($cliente['total_gastado'], 2); ?></div>
                                </div>
                            </div>
                            
                            <div class="cliente-acciones">
                                <a href="index.php?view=editar_cliente&id=<?php echo $cliente['id_usuario']; ?>" class="btn-editar">
                                    <span class="material-symbols-rounded">edit</span>
                                    Editar
                                </a>
                                <a href="index.php?view=eliminar_cliente&id=<?php echo $cliente['id_usuario']; ?>" 
                                   class="btn-eliminar"
                                   onclick="return confirm('⚠️ ¿ELIMINAR ESTE CLIENTE?\n\n👤 Cliente: <?php echo addslashes($cliente['nombre_completo']); ?>\n\n⚡ Esta acción no se puede deshacer.');">
                                    <span class="material-symbols-rounded">delete</span>
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 80px 20px; background: rgba(20, 20, 20, 0.8); border-radius: 15px;">
                    <div style="font-size: 8rem; color: rgba(255, 255, 255, 0.1); margin-bottom: 20px;">👥</div>
                    <h2 style="font-family: 'Orbitron', sans-serif; color: #ffffff; font-size: 2rem;">No hay clientes registrados</h2>
                </div>
            <?php endif; ?>

            <a href="index.php?view=dashboard" class="btn-back">
                <span class="material-symbols-rounded">arrow_back</span>
                Volver al Dashboard
            </a>
            
        </div>
    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>
</body>
</html>