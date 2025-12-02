<?php

$id_sede = intval($_GET['id'] ?? 0);

if ($id_sede <= 0) {
    echo "<script>alert('❌ Error: ID de sede no válido.'); window.location.href = 'index.php?view=listar_sedes';</script>";
    exit();
}

$sedeModel = new Sede();
$sede = $sedeModel->obtenerSedePorId($id_sede);

if (!$sede) {
    echo "<script>alert('❌ Error: Sede no encontrada.'); window.location.href = 'index.php?view=listar_sedes';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Sede - EventosC</title>
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body::before { background: rgba(0, 0, 0, 0.95) !important; }
        .form-wrapper { width: 100%; min-height: 100vh; padding-top: 120px; padding-bottom: 50px; z-index: 2; }
        .form-container { width: 90%; max-width: 800px; margin: 0 auto; }
        .form-header { background: linear-gradient(135deg, rgba(0, 200, 255, 0.05), rgba(255, 255, 255, 0.02)); border: 1px solid rgba(0, 200, 255, 0.3); padding: 30px 40px; border-radius: 15px; margin-bottom: 40px; text-align: center; }
        .form-title { font-family: 'Orbitron', sans-serif; font-size: 2.5rem; color: #ffffff; text-transform: uppercase; margin: 0; }
        .form-card { background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 40px; }
        .id-info { background: rgba(0, 200, 255, 0.1); border: 1px solid #00c8ff; padding: 15px 20px; border-radius: 10px; margin-bottom: 30px; color: #00c8ff; font-size: 1.1rem; }
        .form-group { margin-bottom: 30px; }
        .form-label { font-family: 'Orbitron', sans-serif; display: block; color: #ffffff; font-size: 1.2rem; margin-bottom: 10px; font-weight: 600; text-transform: uppercase; }
        .required { color: #00c8ff; }
        .form-input { width: 100%; padding: 15px 20px; font-size: 1.1rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; color: #ffffff; }
        .form-input:focus { outline: none; border-color: #00c8ff; background: rgba(0, 200, 255, 0.05); }
        .form-actions { display: flex; gap: 15px; margin-top: 40px; }
        .btn-submit, .btn-cancel { font-family: 'Orbitron', sans-serif; flex: 1; padding: 18px 35px; border-radius: 10px; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 10px; border: none; transition: all 0.3s ease; }
        .btn-submit { background: linear-gradient(135deg, #00c8ff, #0080ff); color: white; }
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
                <h1 class="form-title">✏️ Editar Sede</h1>
            </div>

            <div class="form-card">
                <div class="id-info">
                    <strong>ID de Sede:</strong> #<?php echo htmlspecialchars($sede['id_sede']); ?>
                </div>

                <form method="POST" action="index.php?view=actualizar_sede">
                    <input type="hidden" name="id_sede" value="<?php echo htmlspecialchars($sede['id_sede']); ?>">

                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre de la Sede <span class="required">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-input" required maxlength="100" value="<?php echo htmlspecialchars($sede['nombre']); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="direccion">Dirección <span class="required">*</span></label>
                        <input type="text" id="direccion" name="direccion" class="form-input" required maxlength="150" value="<?php echo htmlspecialchars($sede['direccion']); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="capacidad">Capacidad <span class="required">*</span></label>
                        <input type="number" id="capacidad" name="capacidad" class="form-input" required min="1" max="10000" value="<?php echo htmlspecialchars($sede['capacidad']); ?>">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <span class="material-symbols-rounded">save</span>
                            Guardar Cambios
                        </button>
                        <a href="index.php?view=listar_sedes" class="btn-cancel">
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