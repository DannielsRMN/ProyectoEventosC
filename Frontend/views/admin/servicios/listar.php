<?php
$servicioModel = new Servicio();
$servicios = $servicioModel->listarServicios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Servicios - EventosC</title>
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
        .servicios-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; margin-bottom: 40px; }
        .servicio-card { background: rgba(20, 20, 20, 0.8); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 30px; transition: all 0.3s ease; }
        .servicio-card:hover { transform: translateY(-5px); border-color: #39ff14; }
        .servicio-icon { font-size: 3rem; color: #39ff14; margin-bottom: 15px; }
        .servicio-nombre { font-family: 'Orbitron', sans-serif; font-size: 1.6rem; color: #ffffff; margin-bottom: 10px; font-weight: 700; }
        .servicio-proveedor { color: rgba(255, 255, 255, 0.6); font-size: 1rem; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }
        .servicio-info { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0; padding: 15px; background: rgba(255, 255, 255, 0.03); border-radius: 10px; }
        .info-item { display: flex; flex-direction: column; gap: 5px; }
        .info-label { font-size: 0.9rem; color: rgba(255, 255, 255, 0.5); text-transform: uppercase; }
        .info-value { font-family: 'Orbitron', sans-serif; font-size: 1.3rem; color: #39ff14; font-weight: 700; }
        .servicio-acciones { display: flex; gap: 10px; margin-top: 20px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.1); }
        .btn-editar, .btn-eliminar { font-family: 'Orbitron', sans-serif; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; text-transform: uppercase; transition: all 0.3s ease; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; flex: 1; justify-content: center; border: 1px solid; }
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
                <h1 class="page-title">🛠️ Gestión de Servicios</h1>
                <a href="index.php?view=crear_servicio" class="btn-crear">
                    <span class="material-symbols-rounded">add_circle</span>
                    Nuevo Servicio
                </a>
            </div>

            <?php if (!empty($servicios) && is_array($servicios)): ?>
                <div class="servicios-grid">
                    <?php foreach ($servicios as $servicio): ?>
                        <div class="servicio-card">
                            <div class="servicio-icon">🛠️</div>
                            <h2 class="servicio-nombre"><?php echo htmlspecialchars($servicio['nombre_servicio']); ?></h2>
                            
                            <div class="servicio-proveedor">
                                <span class="material-symbols-rounded">business</span>
                                Proveedor: <?php echo htmlspecialchars($servicio['nombre_empresa']); ?>
                            </div>
                            
                            <div class="servicio-info">
                                <div class="info-item">
                                    <span class="info-label">Costo</span>
                                    <span class="info-value">S/ <?php echo number_format($servicio['costo'], 2); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Usado</span>
                                    <span class="info-value"><?php echo htmlspecialchars($servicio['veces_usado']); ?>x</span>
                                </div>
                            </div>
                            
                            <div class="servicio-acciones">
                                <a href="index.php?view=editar_servicio&id=<?php echo $servicio['id_servicio']; ?>" class="btn-editar">
                                    <span class="material-symbols-rounded">edit</span>
                                    Editar
                                </a>
                                <a href="index.php?view=eliminar_servicio&id=<?php echo $servicio['id_servicio']; ?>" 
                                   class="btn-eliminar"
                                   onclick="return confirm('⚠️ ¿ELIMINAR ESTE SERVICIO?\n\n🛠️ Servicio: <?php echo addslashes($servicio['nombre_servicio']); ?>\n\n⚡ Esta acción no se puede deshacer.');">
                                    <span class="material-symbols-rounded">delete</span>
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 80px 20px; background: rgba(20, 20, 20, 0.8); border-radius: 15px;">
                    <div style="font-size: 8rem; color: rgba(255, 255, 255, 0.1); margin-bottom: 20px;">🛠️</div>
                    <h2 style="font-family: 'Orbitron', sans-serif; color: #ffffff; font-size: 2rem;">No hay servicios registrados</h2>
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