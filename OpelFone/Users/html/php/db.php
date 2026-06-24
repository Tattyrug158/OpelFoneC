<?php
// db.php — Conexión centralizada a MySQL (XAMPP)

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Usuario por defecto en XAMPP
define('DB_PASS', '');           // Contraseña por defecto en XAMPP (vacía)
define('DB_NAME', 'opelfone');   // Cambia esto al nombre de tu base de datos

function getConexion(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]);
        exit;
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}
?>
