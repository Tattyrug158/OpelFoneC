<?php
session_start();
require_once 'conexion.php'; // Asegúrate de definir $pdo aquí

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT ID_cliente, Contrasena_cliente FROM cliente WHERE Email_C = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Contrasena_cliente'])) {
        $_SESSION['ID_cliente'] = $user['ID_cliente'];
        echo "exito"; 
    } else {
        echo "usuario_no_encontrado";
    }
}
?>