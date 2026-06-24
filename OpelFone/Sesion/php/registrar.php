<?php



$host = 'localhost';
$db   = 'opelfone';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    // Aquí se crea la variable $pdo
    $pdo = new PDO($dsn, $user, $pass);
    
    // 2. DESPUÉS: Ejecutar la lógica de inserción
    $sql = "INSERT INTO cliente (Nombre, Apellidos, Domicilio, Email_C, Contrasena_cliente) 
            VALUES (?, ?, ?, ?, ?)";
    
    // Ahora $pdo sí existe aquí y podrá llamar a prepare()
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        $_POST['nombre'], 
        $_POST['apellidos'], 
        $_POST['domicilio'], 
        $_POST['email'], 
        password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    echo "exito"; 

} catch (PDOException $e) {
    // Si hay un error de conexión o de SQL, se mostrará aquí
    echo "Error de conexión o base de datos: " . $e->getMessage();
}
?>