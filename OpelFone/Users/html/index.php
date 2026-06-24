<?php
session_start();
require_once '../../Sesion/php/conexion.php';

$nombreUsuario = 'Invitado';

if (isset($_SESSION['ID_cliente'])) {
    // 2. Consultamos el nombre del usuario
    $sql = "SELECT Nombre FROM cliente WHERE ID_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['ID_cliente']]);
    $user = $stmt->fetch();
    
    if ($user) {
        $nombreUsuario = $user['Nombre'];
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\css.css">
    <title>OpelFone</title>
</head>
<body>
    <div class="nab_div">
        <div><h1 href="../"> OpelFone</h1></div>
        <div><a href="../html/perfil.php"><button class="user"><?php echo htmlspecialchars($nombreUsuario); ?></button></a> 
            <a href="../../Sesion/Inicio_sesión_usuario.html" class="sesion"  >Cerrar Sesion</a>    
    </div>
    </div>
    <nav>
            <div class="nab_div2">
                <ul class="navbar">
                <li  class="navbarselected"><a href="index.php">Inicio</a></li>
                <li><a href="Mi_Linea.php">Mi Linea</a></li>
                <li><a href="Recarga_Saldo.php">Recarga de Saldo</a></li>
                <li><a href="Mi_Saldo.php">Mi Saldo</a></li>
            </ul>
            </div>
        </nav>

    <div class="main">
    <article class="info">
        <h1 class="sub_int">Opel Amigo</h1>
        <h3 class="inter">+52 55 3976 6557</h3>

        <a href="../html/Mi_Linea.php"><button class="boton">Ver mas detalles</button></a>

    </article>

    <article class="info2">
        <h1 class="sub_int">Mi Saldo</h1>
        <hr class="linea">
            <div class="Saldo">
                <div>
                    <h2>Acumulado</h2>
                    <h2>Vencimiento</h2>
                </div>

                <div>
                    <h2>$154.00</h2>
                    <h2>25/05/2026</h2>
                </div>

            </div>
            <a href="../html/Mi_Saldo.php"><button class="boton" >Ver mas detalles</button> </a>
    </article>
    </div>



</body>
</html>