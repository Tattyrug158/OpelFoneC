<?php
session_start(); // <--- OBLIGATORIO AL INICIO

// Si esto falla, es porque registrar.php no guardó el ID
if (!isset($_SESSION['ID_cliente'])) {
    die("Error: No has iniciado sesión.");
}


try {
    $sql = "INSERT INTO pagos (ID_cliente, Nombre_titular, Numero_tarjeta, CVV, Fecha_vencimiento) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_SESSION['ID_cliente'], // Usamos el ID de la sesión
        $_POST['titular'],
        $_POST['numero'],
        $_POST['cvv'],
        $_POST['fecha']
    ]);

    echo "exito";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>