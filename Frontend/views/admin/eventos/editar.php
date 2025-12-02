<?php

$id_evento = intval($_GET['id'] ?? 0);

if ($id_evento <= 0) {
    echo "<script>alert('❌ Error: ID de evento no válido.'); window.location.href = 'index.php?view=dashboard';</script>";
    exit();
}

// Obtener datos del evento
$conexion = (new Conexion())->iniciar();

$sql = "SELECT e.*, r.id_reserva, r.costo_total, r.monto_pagado, r.estado_pago,
               u.nombre_completo, u.email, s.nombre as nombre_sede
        FROM evento e
        INNER JOIN reserva r ON e.id_evento = r.id_evento
        INNER JOIN usuario u ON e.id_cliente = u.id_usuario
        INNER JOIN sede s ON e.id_sede = s.id_sede
        WHERE e.id_evento = :id_evento";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
$stmt->execute();
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    echo "<script>alert('❌ Error: Evento no encontrado.'); window.location.href = 'index.php?view=dashboard';</script>";
    exit();
}

// Obtener lista de sedes para el select
$sedeModel = new Sede();
$sedes = $sedeModel->listarSedes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento - EventosC</title>
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body::before { background: rgba(0, 0, 0, 0.95) !important; }
        .form-wrapper { width: 100%; min-height: 100vh; padding-top: 120px; padding-bottom: 50px; z-index: 2; }
        .form-container { width: 90%; max-width: 900px; margin: 0 auto; }
        .form-header { background: linear-gradient(135deg, rgba(0, 200, 255, 0.05), rgba(255, 255, 255, 0.02)); border: 1px solid rgba(0, 200, 255, 0.3); padding: 30px 40px; border-radius: 15px; margin-bottom: 40px; text-align: center; }
        .form-title { font-family: 'Orbitron', sans-serif; font-size: 2.5rem; color: #ffffff; text-transform: uppercase; margin: 0; }
        .form-card { background: rgba(20, 20, 20, 0.85); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; padding: 40px; }
        .id-info { background: rgba(0, 200, 255, 0.1); border: 1px solid #00c8ff; padding: 15px 20px; border-radius: 10px; margin-bottom: 30px; color: #00c8ff; font-size: 1.1rem; }
        .form-row { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 30px; }
        .form-group { margin-bottom: 30px; }
        .form-label { font-family: 'Orbitron', sans-serif; display: block; color: #ffffff; font-size: 1.2rem; margin-bottom: 10px; font-weight: 600; text-transform: uppercase; }
        .required { color: #00c8ff; }
        .form-input, .form-select { width: 100%; padding: 15px 20px; font-size: 1.1rem; background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 10px; color: #ffffff; }
        .form-input:focus, .form-select:focus { outline: none; border-color: #00c8ff; background: rgba(0, 200, 255, 0.05); }
        .form-select option { background: #1a1a1a; color: #ffffff; }
        .readonly-field { background: rgba(255, 255, 255, 0.02) !important; cursor: not-allowed; }
        .form-actions { display: flex; gap: 15px; margin-top: 40px; }
        .btn-submit, .btn-cancel, .btn-delete { font-family: 'Orbitron', sans-serif; flex: 1; padding: 18px 35px; border-radius: 10px; font-weight: 700; font-size: 1.2rem; text-transform: uppercase; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 10px; border: none; transition: all 0.3s ease; }
        .btn-submit { background: linear-gradient(135deg, #00c8ff, #0080ff); color: white; }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 0 30px rgba(0, 200, 255, 0.5); }
        .btn-cancel { background: transparent; color: #ff5555; border: 1px solid #ff5555; }
        .btn-cancel:hover { background: #ff5555; color: white; }
        .btn-delete { background: transparent; color: #ff0000; border: 1px solid #ff0000; }
        .btn-delete:hover { background: #ff0000; color: white; box-shadow: 0 0 20px rgba(255, 0, 0, 0.5); }
    </style>
</head>
<body>
    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div class="form-wrapper">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">✏️ Editar Evento</h1>
            </div>

            <div class="form-card">
                <div class="id-info">
                    <strong>ID de Evento:</strong> #<?php echo htmlspecialchars($evento['id_evento']); ?> | 
                    <strong>ID Reserva:</strong> #<?php echo htmlspecialchars($evento['id_reserva']); ?>
                </div>

                <form method="POST" action="index.php?view=actualizar_evento" id="formEditarEvento">
                    <input type="hidden" name="id_evento" value="<?php echo htmlspecialchars($evento['id_evento']); ?>">
                    <input type="hidden" name="id_reserva" value="<?php echo htmlspecialchars($evento['id_reserva']); ?>">

                    <!-- Información del Cliente (Solo lectura) -->
                    <div class="form-group">
                        <label class="form-label">Cliente Actual</label>
                        <input type="text" class="form-input readonly-field" 
                               value="<?php echo htmlspecialchars($evento['nombre_completo'] . ' (' . $evento['email'] . ')'); ?>" 
                               readonly>
                    </div>

                    <!-- Nombre del Evento -->
                    <div class="form-group">
                        <label class="form-label" for="nombre_evento">Nombre del Evento <span class="required">*</span></label>
                        <input type="text" id="nombre_evento" name="nombre_evento" class="form-input" 
                               required maxlength="100" 
                               value="<?php echo htmlspecialchars($evento['nombre_evento']); ?>">
                    </div>

                    <!-- Sede -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="id_sede">Sede <span class="required">*</span></label>
                            <select id="id_sede" name="id_sede" class="form-select" required>
                                <?php foreach ($sedes as $sede): ?>
                                    <option value="<?php echo $sede['id_sede']; ?>" 
                                            <?php echo ($sede['id_sede'] == $evento['id_sede']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($sede['nombre']); ?> 
                                        (Cap: <?php echo $sede['capacidad']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Fecha -->
                        <div class="form-group">
                            <label class="form-label" for="fecha_evento">Fecha <span class="required">*</span></label>
                            <input type="date" id="fecha_evento" name="fecha_evento" class="form-input" 
                                   required 
                                   value="<?php echo htmlspecialchars($evento['fecha_evento']); ?>">
                        </div>
                    </div>

                    <!-- Horarios -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="hora_inicio">Hora Inicio <span class="required">*</span></label>
                            <input type="time" id="hora_inicio" name="hora_inicio" class="form-input" 
                                   required 
                                   value="<?php echo htmlspecialchars($evento['hora_inicio']); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="hora_fin">Hora Fin <span class="required">*</span></label>
                            <input type="time" id="hora_fin" name="hora_fin" class="form-input" 
                                   required 
                                   value="<?php echo htmlspecialchars($evento['hora_fin']); ?>">
                        </div>
                    </div>

                    <!-- Costos -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="costo_total">Costo Total <span class="required">*</span></label>
                            <input type="number" id="costo_total" name="costo_total" class="form-input" 
                                   required min="0" step="0.01" 
                                   value="<?php echo htmlspecialchars($evento['costo_total']); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="monto_pagado">Monto Pagado <span class="required">*</span></label>
                            <input type="number" id="monto_pagado" name="monto_pagado" class="form-input" 
                                   required min="0" step="0.01" 
                                   value="<?php echo htmlspecialchars($evento['monto_pagado']); ?>">
                        </div>
                    </div>

                    <!-- Estados -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="estado_evento">Estado del Evento <span class="required">*</span></label>
                            <select id="estado_evento" name="estado_evento" class="form-select" required>
                                <option value="Borrador" <?php echo ($evento['estado'] == 'Borrador') ? 'selected' : ''; ?>>Borrador</option>
                                <option value="Confirmado" <?php echo ($evento['estado'] == 'Confirmado') ? 'selected' : ''; ?>>Confirmado</option>
                                <option value="Cancelado" <?php echo ($evento['estado'] == 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="estado_pago">Estado del Pago <span class="required">*</span></label>
                            <select id="estado_pago" name="estado_pago" class="form-select" required>
                                <option value="Pendiente" <?php echo ($evento['estado_pago'] == 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="Parcial" <?php echo ($evento['estado_pago'] == 'Parcial') ? 'selected' : ''; ?>>Parcial</option>
                                <option value="Pagado" <?php echo ($evento['estado_pago'] == 'Pagado') ? 'selected' : ''; ?>>Pagado</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <span class="material-symbols-rounded">save</span>
                            Guardar Cambios
                        </button>
                        
                        <a href="index.php?view=eliminar_evento&id=<?php echo $evento['id_evento']; ?>&id_reserva=<?php echo $evento['id_reserva']; ?>" 
                           class="btn-delete"
                           onclick="return confirm('⚠️ ¿ELIMINAR ESTE EVENTO?\n\n🎯 Evento: <?php echo addslashes($evento['nombre_evento']); ?>\n👤 Cliente: <?php echo addslashes($evento['nombre_completo']); ?>\n\n⚡ Esta acción eliminará el evento y su reserva. NO SE PUEDE DESHACER.');">
                            <span class="material-symbols-rounded">delete</span>
                            Eliminar
                        </a>
                        
                        <a href="index.php?view=dashboard" class="btn-cancel">
                            <span class="material-symbols-rounded">cancel</span>
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>

    <script>
        // Validación del formulario
        document.getElementById('formEditarEvento').addEventListener('submit', function(e) {
            const horaInicio = document.getElementById('hora_inicio').value;
            const horaFin = document.getElementById('hora_fin').value;

            if (horaFin <= horaInicio) {
                e.preventDefault();
                alert('⚠️ La hora de fin debe ser posterior a la hora de inicio.');
                return false;
            }
        });

        // Actualizar estado de pago automáticamente
        document.getElementById('monto_pagado').addEventListener('input', function() {
            const costoTotal = parseFloat(document.getElementById('costo_total').value) || 0;
            const montoPagado = parseFloat(this.value) || 0;
            const estadoPago = document.getElementById('estado_pago');

            if (montoPagado === 0) {
                estadoPago.value = 'Pendiente';
            } else if (montoPagado >= costoTotal) {
                estadoPago.value = 'Pagado';
            } else {
                estadoPago.value = 'Parcial';
            }
        });
    </script>
</body>
</html>