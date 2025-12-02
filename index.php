<?php
// ============================================
// UBICACIÓN: index.php (RAÍZ DEL PROYECTO)
// DESCRIPCIÓN: Router principal completo con todos los CRUDs + Eventos
// ============================================

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
define('BASE_PATH', __DIR__);

// ============ INCLUIR ARCHIVOS BASE ============
require_once 'Backend/config/Conexion.php';
require_once 'Backend/models/Usuario.php'; 
require_once 'Backend/models/Reserva.php';

// ============ OBTENER LA VISTA ============
$view = isset($_GET['view']) ? $_GET['view'] : 'home';

// ============ CARGAR MODELOS SEGÚN LA VISTA ============
// Cargar Admin para dashboard y reservas
if (in_array($view, ['dashboard', 'cancelar_reserva', 'reactivar_reserva'])) {
    require_once 'Backend/models/Admin.php';
}

// Cargar Sede para gestión de sedes y reservas de clientes
if (in_array($view, ['reservas', 'configReserva', 'listar_sedes', 'crear_sede', 'editar_sede', 'eliminar_sede', 'actualizar_sede', 'guardar_sede', 'crear_evento', 'editar_evento', 'actualizar_evento', 'guardar_evento', 'eliminar_evento'])) {
    require_once 'Backend/models/Sede.php';
}

// Cargar Cliente para gestión de clientes
if (in_array($view, ['listar_clientes', 'crear_cliente', 'editar_cliente', 'eliminar_cliente', 'actualizar_cliente', 'guardar_cliente', 'crear_evento', 'editar_evento'])) {
    require_once 'Backend/models/Cliente.php';
}

// Cargar Recurso para gestión de recursos
if (in_array($view, ['listar_recursos', 'crear_recurso', 'editar_recurso', 'eliminar_recurso', 'actualizar_recurso', 'guardar_recurso'])) {
    require_once 'Backend/models/Recurso.php';
}

// Cargar Proveedor para gestión de proveedores
if (in_array($view, ['listar_proveedores', 'crear_proveedor', 'editar_proveedor', 'eliminar_proveedor', 'actualizar_proveedor', 'guardar_proveedor'])) {
    require_once 'Backend/models/Proveedor.php';
}

// Cargar Servicio para gestión de servicios
if (in_array($view, ['listar_servicios', 'crear_servicio', 'editar_servicio', 'eliminar_servicio', 'actualizar_servicio', 'guardar_servicio'])) {
    require_once 'Backend/models/Servicio.php';
}

// ============ ROUTER PRINCIPAL ============
switch ($view) {

    // ==================== VISTAS CLIENTE ====================
    case 'home':
        require_once 'Frontend/views/client/home.php';
        break;

    case 'login':
        require_once 'Frontend/views/login.php';
        break;
        
    case 'logout':
        session_destroy();
        header('Location: index.php?view=login');
        exit;
        break;

    // ==================== DASHBOARD ADMIN ====================
    case 'dashboard':
        $adminModel = new Admin();
        $reservas = $adminModel->listarReservas();
        $estadisticas = $adminModel->obtenerEstadisticas();
        require_once 'Frontend/views/admin/dashboard.php';
        break;

    case 'cancelar_reserva':
        require_once 'Frontend/views/admin/cancelar_reserva.php';
        break;
    
    case 'reactivar_reserva':
        require_once 'Frontend/views/admin/reactivar_reserva.php';
        break;

    // ==================== RESERVAS CLIENTE ====================
    case 'reservas':
        $sedeModel = new Sede();
        $listaSedes = $sedeModel->listar();
        require_once 'Frontend/views/client/reservas.php';
        break;

    case 'configReserva':
        if (!isset($_GET['id_sede'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        
        $id_sede = $_GET['id_sede'];
        $sedeModel = new Sede();
        $sedeInfo = $sedeModel->obtener($id_sede);

        if (!$sedeInfo) {
            header('Location: index.php?view=reservas');
            exit;
        }

        require_once 'Frontend/views/client/configReserva.php';
        break;

    case 'procesar_reserva':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['reserva_temp'] = [
                'nombre_evento' => $_POST['nombre_evento'],
                'id_sede' => $_POST['id_sede'],
                'nombre_sede' => $_POST['nombre_sede_hidden'],
                'fecha' => $_POST['fecha'],
                'hora_inicio' => $_POST['hora_inicio'],
                'hora_fin' => $_POST['hora_fin'],
                'costo_estimado' => 600.00 
            ];
            header('Location: index.php?view=pagos');
        }
        break;

    case 'pagos':
        if (!isset($_SESSION['reserva_temp'])) {
            header('Location: index.php?view=reservas');
            exit;
        }
        require_once 'Frontend/views/client/pagos.php';
        break;

    case 'confirmar_pago':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['reserva_temp'])) {
            $data = $_SESSION['reserva_temp'];
            $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 1; 

            $datosInsertar = [
                'id_usuario' => $id_usuario,
                'id_sede'    => $data['id_sede'],
                'nombre_evento' => $data['nombre_evento'],
                'fecha'      => $data['fecha'],
                'hora_inicio'=> $data['hora_inicio'],
                'hora_fin'   => $data['hora_fin'],
                'costo'      => $data['costo_estimado']
            ];

            $reservaModel = new Reserva();
            $id_reserva = $reservaModel->registrar($datosInsertar);

            if ($id_reserva) {
                unset($_SESSION['reserva_temp']);
                header("Location: index.php?view=detalles&id=$id_reserva");
            } else {
                echo "<h1>Error Fatal: No se pudo guardar la reserva.</h1>";
            }
        } else {
            header('Location: index.php?view=reservas');
        }
        break;

    case 'detalles':
        $id_reserva = $_GET['id'] ?? 0;
        $reservaModel = new Reserva();
        $ticket = $reservaModel->obtenerDetalle($id_reserva);
        require_once 'Frontend/views/client/detallesreserva.php';
        break;
        
    case 'historial':
        require_once 'Frontend/views/client/historialreserva.php';
        break;

    // ==================== CRUD SEDES ====================
    case 'listar_sedes':
        require_once 'Frontend/views/admin/sedes/listar.php';
        break;

    case 'crear_sede':
        require_once 'Frontend/views/admin/sedes/crear.php';
        break;

    case 'guardar_sede':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sedeModel = new Sede();
            $datos = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
                'capacidad' => intval($_POST['capacidad'] ?? 0)
            ];

            if (empty($datos['nombre']) || empty($datos['direccion']) || $datos['capacidad'] <= 0) {
                echo "<script>alert('❌ Error: Todos los campos son obligatorios.'); window.location.href = 'index.php?view=crear_sede';</script>";
                exit();
            }

            if ($sedeModel->crearSede($datos)) {
                echo "<script>alert('✅ ¡Sede creada exitosamente!'); window.location.href = 'index.php?view=listar_sedes';</script>";
            } else {
                echo "<script>alert('❌ Error al crear la sede.'); window.location.href = 'index.php?view=crear_sede';</script>";
            }
        }
        break;

    case 'editar_sede':
        require_once 'Frontend/views/admin/sedes/editar.php';
        break;

    case 'actualizar_sede':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sedeModel = new Sede();
            $id_sede = intval($_POST['id_sede'] ?? 0);
            $datos = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
                'capacidad' => intval($_POST['capacidad'] ?? 0)
            ];

            if ($sedeModel->actualizarSede($id_sede, $datos)) {
                echo "<script>alert('✅ ¡Sede actualizada exitosamente!'); window.location.href = 'index.php?view=listar_sedes';</script>";
            } else {
                echo "<script>alert('❌ Error al actualizar la sede.'); window.location.href = 'index.php?view=editar_sede&id=$id_sede';</script>";
            }
        }
        break;

    case 'eliminar_sede':
        require_once 'Frontend/views/admin/sedes/eliminar.php';
        break;

    // ==================== CRUD CLIENTES ====================
    case 'listar_clientes':
        require_once 'Frontend/views/admin/clientes/listar.php';
        break;

    case 'crear_cliente':
        require_once 'Frontend/views/admin/clientes/crear.php';
        break;

    case 'guardar_cliente':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteModel = new Cliente();
            $datos = [
                'nombre_completo' => trim($_POST['nombre_completo'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => trim($_POST['password'] ?? '')
            ];

            if (empty($datos['nombre_completo']) || empty($datos['email']) || empty($datos['password'])) {
                echo "<script>alert('❌ Error: Todos los campos son obligatorios.'); window.location.href = 'index.php?view=crear_cliente';</script>";
                exit();
            }

            if ($clienteModel->crearCliente($datos)) {
                echo "<script>alert('✅ ¡Cliente creado exitosamente!'); window.location.href = 'index.php?view=listar_clientes';</script>";
            } else {
                echo "<script>alert('❌ Error al crear el cliente. El email puede estar duplicado.'); window.location.href = 'index.php?view=crear_cliente';</script>";
            }
        }
        break;

    case 'editar_cliente':
        require_once 'Frontend/views/admin/clientes/editar.php';
        break;

    case 'actualizar_cliente':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteModel = new Cliente();
            $id_usuario = intval($_POST['id_usuario'] ?? 0);
            $datos = [
                'nombre_completo' => trim($_POST['nombre_completo'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'password' => trim($_POST['password'] ?? '')
            ];

            if ($clienteModel->actualizarCliente($id_usuario, $datos)) {
                echo "<script>alert('✅ ¡Cliente actualizado exitosamente!'); window.location.href = 'index.php?view=listar_clientes';</script>";
            } else {
                echo "<script>alert('❌ Error al actualizar el cliente.'); window.location.href = 'index.php?view=editar_cliente&id=$id_usuario';</script>";
            }
        }
        break;

    case 'eliminar_cliente':
        require_once 'Frontend/views/admin/clientes/eliminar.php';
        break;

    // ==================== CRUD RECURSOS ====================
    case 'listar_recursos':
        require_once 'Frontend/views/admin/recursos/listar.php';
        break;

    case 'crear_recurso':
        require_once 'Frontend/views/admin/recursos/crear.php';
        break;

    case 'guardar_recurso':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recursoModel = new Recurso();
            $datos = [
                'nombre_recurso' => trim($_POST['nombre_recurso'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'costounidad' => floatval($_POST['costounidad'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0)
            ];

            if ($recursoModel->crearRecurso($datos)) {
                echo "<script>alert('✅ ¡Recurso creado exitosamente!'); window.location.href = 'index.php?view=listar_recursos';</script>";
            } else {
                echo "<script>alert('❌ Error al crear el recurso.'); window.location.href = 'index.php?view=crear_recurso';</script>";
            }
        }
        break;

    case 'editar_recurso':
        require_once 'Frontend/views/admin/recursos/editar.php';
        break;

    case 'actualizar_recurso':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recursoModel = new Recurso();
            $id_recurso = intval($_POST['id_recurso'] ?? 0);
            $datos = [
                'nombre_recurso' => trim($_POST['nombre_recurso'] ?? ''),
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'costounidad' => floatval($_POST['costounidad'] ?? 0),
                'stock' => intval($_POST['stock'] ?? 0)
            ];

            if ($recursoModel->actualizarRecurso($id_recurso, $datos)) {
                echo "<script>alert('✅ ¡Recurso actualizado exitosamente!'); window.location.href = 'index.php?view=listar_recursos';</script>";
            } else {
                echo "<script>alert('❌ Error al actualizar el recurso.'); window.location.href = 'index.php?view=editar_recurso&id=$id_recurso';</script>";
            }
        }
        break;

    case 'eliminar_recurso':
        require_once 'Frontend/views/admin/recursos/eliminar.php';
        break;

    // ==================== CRUD PROVEEDORES ====================
    case 'listar_proveedores':
        require_once 'Frontend/views/admin/proveedores/listar.php';
        break;

    case 'crear_proveedor':
        require_once 'Frontend/views/admin/proveedores/crear.php';
        break;

    case 'guardar_proveedor':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedorModel = new Proveedor();
            $datos = [
                'nombre_contacto' => trim($_POST['nombre_contacto'] ?? ''),
                'nombre_empresa' => trim($_POST['nombre_empresa'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? '')
            ];

            if ($proveedorModel->crearProveedor($datos)) {
                echo "<script>alert('✅ ¡Proveedor creado exitosamente!'); window.location.href = 'index.php?view=listar_proveedores';</script>";
            } else {
                echo "<script>alert('❌ Error al crear el proveedor.'); window.location.href = 'index.php?view=crear_proveedor';</script>";
            }
        }
        break;

    case 'editar_proveedor':
        require_once 'Frontend/views/admin/proveedores/editar.php';
        break;

    case 'actualizar_proveedor':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proveedorModel = new Proveedor();
            $id_proveedor = intval($_POST['id_proveedor'] ?? 0);
            $datos = [
                'nombre_contacto' => trim($_POST['nombre_contacto'] ?? ''),
                'nombre_empresa' => trim($_POST['nombre_empresa'] ?? ''),
                'direccion' => trim($_POST['direccion'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? '')
            ];

            if ($proveedorModel->actualizarProveedor($id_proveedor, $datos)) {
                echo "<script>alert('✅ ¡Proveedor actualizado exitosamente!'); window.location.href = 'index.php?view=listar_proveedores';</script>";
            } else {
                echo "<script>alert('❌ Error al actualizar el proveedor.'); window.location.href = 'index.php?view=editar_proveedor&id=$id_proveedor';</script>";
            }
        }
        break;

    case 'eliminar_proveedor':
        require_once 'Frontend/views/admin/proveedores/eliminar.php';
        break;

    // ==================== CRUD SERVICIOS ====================
    case 'listar_servicios':
        require_once 'Frontend/views/admin/servicios/listar.php';
        break;

    case 'crear_servicio':
        require_once 'Frontend/views/admin/servicios/crear.php';
        break;

    case 'guardar_servicio':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicioModel = new Servicio();
            $datos = [
                'nombre_servicio' => trim($_POST['nombre_servicio'] ?? ''),
                'id_proveedor' => intval($_POST['id_proveedor'] ?? 0),
                'costo' => floatval($_POST['costo'] ?? 0)
            ];

            if ($servicioModel->crearServicio($datos)) {
                echo "<script>alert('✅ ¡Servicio creado exitosamente!'); window.location.href = 'index.php?view=listar_servicios';</script>";
            } else {
                echo "<script>alert('❌ Error al crear el servicio.'); window.location.href = 'index.php?view=crear_servicio';</script>";
            }
        }
        break;

    case 'editar_servicio':
        require_once 'Frontend/views/admin/servicios/editar.php';
        break;

    case 'actualizar_servicio':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicioModel = new Servicio();
            $id_servicio = intval($_POST['id_servicio'] ?? 0);
            $datos = [
                'nombre_servicio' => trim($_POST['nombre_servicio'] ?? ''),
                'id_proveedor' => intval($_POST['id_proveedor'] ?? 0),
                'costo' => floatval($_POST['costo'] ?? 0)
            ];

            if ($servicioModel->actualizarServicio($id_servicio, $datos)) {
                echo "<script>alert('✅ ¡Servicio actualizado exitosamente!'); window.location.href = 'index.php?view=listar_servicios';</script>";
            } else {
                echo "<script>alert('❌ Error al actualizar el servicio.'); window.location.href = 'index.php?view=editar_servicio&id=$id_servicio';</script>";
            }
        }
        break;

    case 'eliminar_servicio':
        require_once 'Frontend/views/admin/servicios/eliminar.php';
        break;

    // ==================== CRUD EVENTOS (ADMIN) ====================
    case 'crear_evento':
        require_once 'Frontend/views/admin/eventos/crear.php';
        break;

    case 'guardar_evento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conexion = (new Conexion())->iniciar();
            
            try {
                $conexion->beginTransaction();
                
                // Insertar evento
                $sqlEvento = "INSERT INTO evento (id_cliente, id_sede, nombre_evento, fecha_evento, hora_inicio, hora_fin, estado) 
                              VALUES (:id_cliente, :id_sede, :nombre_evento, :fecha_evento, :hora_inicio, :hora_fin, 'Confirmado')";
                $stmtEvento = $conexion->prepare($sqlEvento);
                $stmtEvento->bindParam(':id_cliente', $_POST['id_cliente'], PDO::PARAM_INT);
                $stmtEvento->bindParam(':id_sede', $_POST['id_sede'], PDO::PARAM_INT);
                $stmtEvento->bindParam(':nombre_evento', $_POST['nombre_evento'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':fecha_evento', $_POST['fecha_evento'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':hora_inicio', $_POST['hora_inicio'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':hora_fin', $_POST['hora_fin'], PDO::PARAM_STR);
                $stmtEvento->execute();
                
                $id_evento = $conexion->lastInsertId();
                
                // Insertar reserva
                $costo_total = floatval($_POST['costo_total'] ?? 0);
                $monto_pagado = floatval($_POST['monto_pagado'] ?? 0);
                $estado_pago = ($monto_pagado >= $costo_total && $costo_total > 0) ? 'Pagado' : (($monto_pagado > 0) ? 'Parcial' : 'Pendiente');
                
                $sqlReserva = "INSERT INTO reserva (id_evento, fecha_reserva, costo_total, monto_pagado, estado_pago) 
                               VALUES (:id_evento, CURDATE(), :costo_total, :monto_pagado, :estado_pago)";
                $stmtReserva = $conexion->prepare($sqlReserva);
                $stmtReserva->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
                $stmtReserva->bindParam(':costo_total', $costo_total, PDO::PARAM_STR);
                $stmtReserva->bindParam(':monto_pagado', $monto_pagado, PDO::PARAM_STR);
                $stmtReserva->bindParam(':estado_pago', $estado_pago, PDO::PARAM_STR);
                $stmtReserva->execute();
                
                $conexion->commit();
                
                echo "<script>alert('✅ ¡Evento creado exitosamente!'); window.location.href = 'index.php?view=dashboard';</script>";
            } catch (Exception $e) {
                $conexion->rollBack();
                echo "<script>alert('❌ Error al crear el evento: " . addslashes($e->getMessage()) . "'); window.location.href = 'index.php?view=crear_evento';</script>";
            }
        }
        break;

    case 'editar_evento':
        require_once 'Frontend/views/admin/eventos/editar.php';
        break;

    case 'actualizar_evento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $conexion = (new Conexion())->iniciar();
            
            try {
                $conexion->beginTransaction();
                
                // Actualizar evento
                $sqlEvento = "UPDATE evento 
                              SET id_sede = :id_sede,
                                  nombre_evento = :nombre_evento,
                                  fecha_evento = :fecha_evento,
                                  hora_inicio = :hora_inicio,
                                  hora_fin = :hora_fin,
                                  estado = :estado_evento
                              WHERE id_evento = :id_evento";
                $stmtEvento = $conexion->prepare($sqlEvento);
                $stmtEvento->bindParam(':id_evento', $_POST['id_evento'], PDO::PARAM_INT);
                $stmtEvento->bindParam(':id_sede', $_POST['id_sede'], PDO::PARAM_INT);
                $stmtEvento->bindParam(':nombre_evento', $_POST['nombre_evento'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':fecha_evento', $_POST['fecha_evento'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':hora_inicio', $_POST['hora_inicio'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':hora_fin', $_POST['hora_fin'], PDO::PARAM_STR);
                $stmtEvento->bindParam(':estado_evento', $_POST['estado_evento'], PDO::PARAM_STR);
                $stmtEvento->execute();
                
                // Actualizar reserva
                $sqlReserva = "UPDATE reserva 
                               SET costo_total = :costo_total,
                                   monto_pagado = :monto_pagado,
                                   estado_pago = :estado_pago
                               WHERE id_reserva = :id_reserva";
                $stmtReserva = $conexion->prepare($sqlReserva);
                $stmtReserva->bindParam(':id_reserva', $_POST['id_reserva'], PDO::PARAM_INT);
                $stmtReserva->bindParam(':costo_total', $_POST['costo_total'], PDO::PARAM_STR);
                $stmtReserva->bindParam(':monto_pagado', $_POST['monto_pagado'], PDO::PARAM_STR);
                $stmtReserva->bindParam(':estado_pago', $_POST['estado_pago'], PDO::PARAM_STR);
                $stmtReserva->execute();
                
                $conexion->commit();
                
                echo "<script>alert('✅ ¡Evento actualizado exitosamente!'); window.location.href = 'index.php?view=dashboard';</script>";
            } catch (Exception $e) {
                $conexion->rollBack();
                $id_evento = intval($_POST['id_evento'] ?? 0);
                echo "<script>alert('❌ Error al actualizar el evento: " . addslashes($e->getMessage()) . "'); window.location.href = 'index.php?view=editar_evento&id=$id_evento';</script>";
            }
        }
        break;

    case 'eliminar_evento':
        require_once 'Frontend/views/admin/eventos/eliminar.php';
        break;

    // ==================== PÁGINA 404 ====================
    default:
        require_once 'Frontend/views/client/home.php';
        break;
}
?>