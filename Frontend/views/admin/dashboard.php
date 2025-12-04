<?php
// ============================================
// UBICACIÓN: Frontend/views/admin/dashboard.php
// DESCRIPCIÓN: Panel administrativo completo con gestión de eventos y CRUDs
// ============================================
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - EventosC</title>
    <link rel="stylesheet" href="Frontend/assets/css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        
        body::before {
            backdrop-filter: none !important;
            -webkit-backdrop-filter: none !important;
            background: rgba(0, 0, 0, 0.95) !important;
        }
        
        .admin-wrapper {
            width: 100%;
            min-height: 100vh;
            padding-top: 120px;
            padding-bottom: 50px;
            position: relative;
            z-index: 2;
        }
        
        .admin-container {
            width: 95%;
            max-width: 1600px;
            margin: 0 auto;
        }
        
        .admin-header {
            background: linear-gradient(135deg, rgba(57, 255, 20, 0.05), rgba(255, 255, 255, 0.02));
            border: 1px solid rgba(57, 255, 20, 0.3);
            backdrop-filter: blur(20px);
            color: white;
            padding: 30px 40px;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.05);
        }
        
        .admin-header h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.5rem;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 20px rgba(57, 255, 20, 0.3); 
            margin: 0;
        }
        
        .admin-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.3rem;
            margin-top: 10px;
        }

        /* NAVEGACIÓN DE GESTIÓN */
        .admin-nav {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .btn-nav {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, rgba(57, 255, 20, 0.1), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(57, 255, 20, 0.3);
            color: #39ff14;
            padding: 20px 25px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-nav:hover {
            background: #39ff14;
            color: black;
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
        }

        /* BOTÓN CREAR EVENTO */
        .btn-crear-evento {
            font-family: 'Orbitron', sans-serif;
            background: linear-gradient(135deg, #39ff14, #00ff88);
            color: black;
            padding: 15px 35px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.2rem;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(57, 255, 20, 0.3);
        }

        .btn-crear-evento:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.5);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #39ff14;
            box-shadow: 0 0 30px rgba(57, 255, 20, 0.1);
        }
        
        .stat-card:hover::before {
            animation: shine 1s forwards;
        }
        
        @keyframes shine {
            0% { left: -50%; }
            100% { left: 150%; }
        }
        
        .stat-icon {
            font-size: 3.5rem;
            margin-bottom: 15px;
            color: #39ff14;
            text-shadow: 0 0 15px rgba(57, 255, 20, 0.4);
        }
        
        .stat-card h3 {
            font-family: 'Orbitron', sans-serif;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .stat-number {
            font-family: 'Orbitron', sans-serif;
            font-size: 3rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .alert {
            padding: 20px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .alert-success {
            background: rgba(57, 255, 20, 0.1);
            border: 1px solid #39ff14;
            color: #39ff14;
        }
        
        .alert-error {
            background: rgba(255, 85, 85, 0.1);
            border: 1px solid #ff5555;
            color: #ff5555;
        }
        
        .table-container {
            background: rgba(15, 15, 15, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(57, 255, 255, 0.1);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
        }
        
        .table-header {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.01));
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .table-header h2 {
            font-family: 'Orbitron', sans-serif;
            color: #ffffff;
            font-size: 1.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }
        
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .admin-table thead {
            background: rgba(255, 255, 255, 0.02);
            border-bottom: 2px solid rgba(57, 255, 20, 0.3);
        }
        
        .admin-table th {
            font-family: 'Orbitron', sans-serif;
            padding: 18px 20px;
            text-align: left;
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .admin-table td {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #eeeeee;
            font-size: 1.3rem;
        }
        
        .admin-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .admin-table tbody tr:hover {
            background: rgba(57, 255, 20, 0.05);
            transform: scale(1.002);
        }
        
        .id-badge {
            font-family: 'Orbitron', sans-serif;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 5px;
            font-weight: bold;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: inline-block;
        }
        
        .client-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .client-name {
            font-weight: 600;
            color: #ffffff;
            font-size: 1.1em;
        }
        
        .client-email {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .event-name {
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.5px;
        }
        
        .date-time {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .date-text {
            font-weight: 600;
            color: #fff;
        }
        
        .time-text {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
        }
        
        .amount {
            font-family: 'Orbitron', sans-serif;
            font-weight: bold;
            font-size: 1.4rem;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        
        .status-badge {
            font-family: 'Orbitron', sans-serif;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            border: 1px solid;
        }
        
        .status-confirmado, .status-Confirmado {
            background: rgba(57, 255, 20, 0.1);
            color: #39ff14;
            border-color: #39ff14;
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.2);
        }
        
        .status-borrador, .status-Borrador {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border-color: #ffc107;
        }
        
        .status-cancelado, .status-Cancelado {
            background: rgba(255, 85, 85, 0.1);
            color: #ff5555;
            border-color: #ff5555;
        }
        
        .status-pagado, .status-Pagado {
            background: rgba(0, 200, 255, 0.1);
            color: #00c8ff;
            border-color: #00c8ff;
        }
        
        .status-pendiente, .status-Pendiente {
            background: rgba(255, 85, 85, 0.1);
            color: #ff5555;
            border-color: #ff5555;
        }
        
        .status-parcial, .status-Parcial {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border-color: #ffc107;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-action {
            font-family: 'Orbitron', sans-serif;
            background: transparent;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid;
        }

        .btn-edit {
            color: #00c8ff;
            border-color: #00c8ff;
        }

        .btn-edit:hover {
            background: #00c8ff;
            color: black;
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(0, 200, 255, 0.4);
        }
        
        .btn-cancel {
            color: #ff5555;
            border-color: #ff5555;
        }
        
        .btn-cancel:hover {
            background: #ff5555;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(255, 85, 85, 0.4);
        }
        
        .btn-reactivar {
            color: #39ff14;
            border-color: #39ff14;
        }
        
        .btn-reactivar:hover {
            background: #39ff14;
            color: black;
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(57, 255, 20, 0.4);
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        .empty-icon {
            font-size: 8rem;
            color: rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .empty-state h2 {
            font-family: 'Orbitron', sans-serif;
            color: #ffffff;
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .btn-back {
            font-family: 'Orbitron', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-top: 40px;
            padding: 15px 35px;
            background: transparent;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-back:hover {
            background: white;
            color: black;
            border-color: white;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.2);
            transform: translateX(-5px);
        }
    </style>
</head>
<body>

    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div class="admin-wrapper">
        <div class="admin-container">
            
            <!-- HEADER -->
            <div class="admin-header">
                <h1>⚡ Panel de Administración</h1>
                <p>Gestión y control de eventos y reservas del sistema</p>
            </div>

            <!-- NAVEGACIÓN DE GESTIÓN -->
            <div class="admin-nav">
                <a href="index.php?view=listar_sedes" class="btn-nav">
                    <span class="material-symbols-rounded">business</span>
                    Gestionar Sedes
                </a>
                
                <a href="index.php?view=listar_clientes" class="btn-nav">
                    <span class="material-symbols-rounded">group</span>
                    Gestionar Clientes
                </a>

                <a href="index.php?view=listar_recursos" class="btn-nav">
                    <span class="material-symbols-rounded">inventory_2</span>
                    Gestionar Recursos
                </a>

                <a href="index.php?view=listar_proveedores" class="btn-nav">
                    <span class="material-symbols-rounded">local_shipping</span>
                    Gestionar Proveedores
                </a>

                <a href="index.php?view=listar_servicios" class="btn-nav">
                    <span class="material-symbols-rounded">build</span>
                    Gestionar Servicios
                </a>
            </div>

            <!-- BOTÓN CREAR NUEVO EVENTO -->
            <div style="margin-bottom: 30px; text-align: right;">
                <a href="index.php?view=crear_evento" class="btn-crear-evento">
                    <span class="material-symbols-rounded">add_circle</span>
                    Crear Nuevo Evento
                </a>
            </div>

            <!-- MENSAJES -->
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <span class="material-symbols-rounded">check_circle</span>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <span class="material-symbols-rounded">error</span>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($reservas) && is_array($reservas) && count($reservas) > 0): ?>
                
                <!-- ESTADÍSTICAS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📋</div>
                        <h3>Total Eventos</h3>
                        <div class="stat-number"><?php echo isset($estadisticas['total_reservas']) ? $estadisticas['total_reservas'] : count($reservas); ?></div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <h3>Confirmados</h3>
                        <div class="stat-number">
                            <?php 
                            if (isset($estadisticas['eventos_activos'])) {
                                echo $estadisticas['eventos_activos'];
                            } else {
                                echo count(array_filter($reservas, function($r) { 
                                    return strtolower($r['estado_evento']) == 'confirmado'; 
                                })); 
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <h3>Ingresos Total</h3>
                        <div class="stat-number">
                            S/ <?php 
                            if (isset($estadisticas['ingresos_totales'])) {
                                echo number_format($estadisticas['ingresos_totales'], 2);
                            } else {
                                echo number_format(array_sum(array_column($reservas, 'monto_pagado')), 2);
                            }
                            ?>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <h3>Total Clientes</h3>
                        <div class="stat-number">
                            <?php 
                            if (isset($estadisticas['total_clientes'])) {
                                echo $estadisticas['total_clientes'];
                            } else {
                                $clientes_unicos = array_unique(array_column($reservas, 'id_cliente'));
                                echo count($clientes_unicos);
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- TABLA DE RESERVAS -->
                <div class="table-container">
                    <div class="table-header">
                        <h2>🎯 Gestión de Eventos y Reservas</h2>
                    </div>
                    
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Evento</th>
                                <th>Sede</th>
                                <th>Fecha & Hora</th>
                                <th>Monto</th>
                                <th>Estado Pago</th>
                                <th>Estado Evento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservas as $row): ?>
                                <tr>
                                    <td>
                                        <span class="id-badge">#<?php echo htmlspecialchars($row['id_reserva']); ?></span>
                                    </td>
                                    
                                    <td>
                                        <div class="client-info">
                                            <span class="client-name"><?php echo htmlspecialchars($row['cliente']); ?></span>
                                            <span class="client-email"><?php echo htmlspecialchars($row['email_cliente'] ?? 'Sin email'); ?></span>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <span class="event-name"><?php echo htmlspecialchars($row['nombre_evento']); ?></span>
                                    </td>
                                    
                                    <td><?php echo htmlspecialchars($row['nombre_sede']); ?></td>
                                    
                                    <td>
                                        <div class="date-time">
                                            <span class="date-text"><?php echo date('d/m/Y', strtotime($row['fecha_evento'])); ?></span>
                                            <span class="time-text">
                                                <?php echo date('H:i', strtotime($row['hora_inicio'])); ?> - 
                                                <?php echo date('H:i', strtotime($row['hora_fin'])); ?>
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <span class="amount">S/ <?php echo number_format($row['monto_pagado'], 2); ?></span>
                                    </td>
                                    
                                    <td>
                                        <?php 
                                        $estado_pago = isset($row['estado_pago']) ? $row['estado_pago'] : 'Pendiente';
                                        ?>
                                        <span class="status-badge status-<?php echo $estado_pago; ?>">
                                            <?php echo htmlspecialchars($estado_pago); ?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="status-badge status-<?php echo $row['estado_evento']; ?>">
                                            <?php echo htmlspecialchars($row['estado_evento']); ?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <div class="action-buttons">
                                            <!-- BOTÓN EDITAR -->
                                            <a href="index.php?view=editar_evento&id=<?php echo $row['id_evento']; ?>" 
                                               class="btn-action btn-edit"
                                               title="Editar evento">
                                                <span class="material-symbols-rounded">edit</span>
                                                Editar
                                            </a>

                                            <?php if(strtolower($row['estado_evento']) == 'cancelado'): ?>
                                                <a href="index.php?view=reactivar_reserva&id=<?php echo $row['id_reserva']; ?>" 
                                                   class="btn-action btn-reactivar"
                                                   onclick="return confirm('✅ ¿REACTIVAR ESTE EVENTO?\n\n🎯 Evento: <?php echo addslashes($row['nombre_evento']); ?>\n👤 Cliente: <?php echo addslashes($row['cliente']); ?>\n📅 Fecha: <?php echo date('d/m/Y', strtotime($row['fecha_evento'])); ?>');">
                                                    <span class="material-symbols-rounded">check_circle</span>
                                                    Reactivar
                                                </a>
                                            <?php else: ?>
                                                <a href="index.php?view=cancelar_reserva&id=<?php echo $row['id_reserva']; ?>" 
                                                   class="btn-action btn-cancel"
                                                   onclick="return confirm('⚠️ ¿CANCELAR ESTE EVENTO?\n\n🎯 Evento: <?php echo addslashes($row['nombre_evento']); ?>\n👤 Cliente: <?php echo addslashes($row['cliente']); ?>\n📅 Fecha: <?php echo date('d/m/Y', strtotime($row['fecha_evento'])); ?>');">
                                                    <span class="material-symbols-rounded">cancel</span>
                                                    Cancelar
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            <?php else: ?>
                
                <!-- ESTADO VACÍO -->
                <div class="table-container">
                    <div class="empty-state">
                        <div class="empty-icon">📭</div>
                        <h2>No hay eventos registrados</h2>
                        <p>Aún no se han creado eventos en el sistema.</p>
                        <p>Los nuevos eventos aparecerán aquí automáticamente.</p>
                    </div>
                </div>

            <?php endif; ?>

            <!-- BOTÓN VOLVER -->
            <a href="index.php?view=home" class="btn-back">
                <span class="material-symbols-rounded">arrow_back</span>
                Volver al Inicio
            </a>
            
        </div>
    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>

</body>
</html>