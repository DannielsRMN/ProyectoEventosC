<?php
$servicioModel = new Servicio();
$proveedores = $servicioModel->obtenerProveedores();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Servicio - EventosC</title>
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body::before { background: rgba(0, 0, 0, 0.95) !important; }
        .form-wrapper { width: 100%; min-height: 100vh; padding-top: 120px; padding-bottom: 50px; z-index: 2; }
        .form-container { width: 90%; max-width: 800px; margin: 0 auto; }
        .form-header { background: linear-gradient(135deg, rgba(57, 255, 20, 0.05), rgba(255, 255, 255, 0.02)); border: 1px solid rgba(57, 255, 20, 0.3); padding: 30px 40px; border-radius: 15px; margin-bottom: 40px; text-align: center; }
        .form-title { font-family: 'Orbitron', sans-serif; font-size: 2.5rem; color: #ffffff; text-transform: uppercase; margin: 0; }
        .form-card { background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 40px; }
        .form-group { margin-bottom: 30px; }
        .form-label { font-family: 'Orbitron', sans-serif; display: block; color: #ffffff; font-size: 1.2rem; margin-bottom: 10px; font-weight: 600; text-transform: uppercase; }
        .required { color: #39ff14; }
        .form-input, .form-select { width: 100%; padding: 15px 20px; font-size: 1.1rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; color: #ffffff; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #39ff14; background: rgba(57, 255, 20, 0.05); }
        .form-select option { background: #1a1a1a; color: #ffffff; }
        .form-actions { display: flex; gap: 15px; margin-top: 40px; }
        .btn-submit, .btn-cancel { font-family: 'Orbitron', sans-serif; flex: 1; padding: 18px 35px; border-radius: 10px; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 10px; border: none; transition: all 0.3s ease; }
        .btn-submit { background: linear-gradient(135deg, #39ff14, #00ff88); color: black; }
        .btn-submit:hover { transform: translateY(-3px); }
        .btn-cancel { background: transparent; color: #ff5555; border: 1px solid #ff5555; }
        .btn-cancel:hover { background: #ff5555; color: white; }
    </style>
</head>
<body>
    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">🛠️ Nuevo Servicio</h1>
            </div>

            <div class="form-card">
                <form method="POST" action="index.php?view=guardar_servicio">
                    <div class="form-group">
                        <label class="form-label" for="nombre_servicio">Nombre del Servicio <span class="required">*</span></label>
                        <input type="text" id="nombre_servicio" name="nombre_servicio" class="form-input" placeholder="Ej: Catering Premium" required maxlength="150">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="id_proveedor">Proveedor <span class="required">*</span></label>
                        <select id="id_proveedor" name="id_proveedor" class="form-select" required>
                            <option value="">-- Seleccionar Proveedor --</option>
                            <?php foreach ($proveedores as $proveedor): ?>
                                <option value="<?php echo $proveedor['id_proveedor']; ?>">
                                    <?php echo htmlspecialchars($proveedor['nombre_empresa']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="costo">Costo del Servicio <span class="required">*</span></label>
                        <input type="number" id="costo" name="costo" class="form-input" placeholder="Ej: 500.00" required min="0" max="99999" step="0.01">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <span class="material-symbols-rounded">save</span>
                            Crear Servicio
                        </button>
                        <a href="index.php?view=listar_servicios" class="btn-cancel">
                            <span class="material-symbols-rounded">cancel</span>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>
</body>
</html>