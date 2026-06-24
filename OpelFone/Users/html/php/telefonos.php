<?php
session_start();
header('Content-Type: application/json');

// 2. Ruta corregida para llegar a tu archivo de conexión
require_once __DIR__ . '/../../Sesion/php/conexion.php';

// 3. Verificación de seguridad
if (!isset($_SESSION['ID_cliente'])) {
    echo json_encode(['ok' => false, 'msg' => 'Sesión no iniciada']);
    exit;
}

$id_cliente = $_SESSION['ID_cliente'];
$accion = $_GET['accion'] ?? '';
$data = json_decode(file_get_contents('php://input'), true);

switch ($accion) {
    case 'listar':
        $stmt = $pdo->prepare("SELECT * FROM telefonos WHERE ID_cliente = ?");
        $stmt->execute([$id_cliente]);
        echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        break;

    case 'agregar':
        $num = $data['numero'];
        $stmt = $pdo->prepare("INSERT INTO telefonos (ID_cliente, Numero, Estado_activo) VALUES (?, ?, 1)");
        $stmt->execute([$id_cliente, $num]);
        echo json_encode(['ok' => true, 'id' => $pdo->lastInsertId(), 'msg' => 'Teléfono agregado']);
        break;

    case 'toggle_estado':
        $stmt = $pdo->prepare("UPDATE telefonos SET Estado_activo = ? WHERE ID_Telefono = ? AND ID_cliente = ?");
        $stmt->execute([$data['estado'], $data['id_telefono'], $id_cliente]);
        echo json_encode(['ok' => true]);
        break;

    case 'eliminar':
        $stmt = $pdo->prepare("DELETE FROM telefonos WHERE ID_Telefono = ? AND ID_cliente = ?");
        $stmt->execute([$data['id_telefono'], $id_cliente]);
        echo json_encode(['ok' => true, 'msg' => 'Eliminado correctamente']);
        break;

    case 'actualizar_desvio':
        $stmt = $pdo->prepare("UPDATE telefonos SET Numero_desvio = ? WHERE ID_Telefono = ? AND ID_cliente = ?");
        $stmt->execute([$data['numero_desvio'], $data['id_telefono'], $id_cliente]);
        echo json_encode(['ok' => true, 'msg' => 'Desvío actualizado', 'numero_desvio' => $data['numero_desvio']]);
        break;
}

?>