<?php
session_start();
require_once '../../Sesion/php/conexion.php'; // Ajusta la ruta a tu archivo conexion.php

$nombreUsuario = 'Invitado'; // Valor por defecto

// 1. Verificamos si hay sesión activa
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
        <div><h1> OpelFone</h1></div>
        <div><a href="../html/perfil.php"><button class="user"><?php echo htmlspecialchars($nombreUsuario); ?></button></a>            <a href="../../Sesion/Inicio_sesión_usuario.html" class="sesion"  >Cerrar Sesion</a>    </div>
    </div>
    <nav>
            <div class="nab_div2">
                <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="Mi_Linea.php">Mi Linea</a></li>
                <li><a href="Recarga_Saldo.php">Recarga de Saldo</a></li>
                <li  class="navbarselected"><a href="Mi_Saldo.php">Mi Saldo</a></li>
            </ul>
            </div>
        </nav>

        <div style="padding: 35px;">
            <div class="flex">
                <div>
                    <h1 class="sub_int">Mis Saldos</h1>
                </div>
                <div><h1 class="sub">Costo por Mensaje: 2 Créditos</h1></div>
            </div>
            <hr class="linea">
            
            <div class="contenedorc flex">
                <h1>Saldo general de la cuenta: $154</h1>
                <button class="tarboton">Recargar</button>
            </div><br>
            <div class="contenedorc">
                <div class="flex">
                    <h1>1. 52 5539766557</h1>
                    <h1>45 Créditos</h1>
                    <button class="tarboton">Recargar</button>
                    
                </div>
                <div class="flex">
                    <h1>2. 52 5539766557</h1>
                    <h1>0 Créditos</h1>
                    <button class="tarboton">Recargar</button>
                </div>
                <div class="flex">
                    <h1>3. 52 5539766557</h1>
                    <h1>0 Créditos</h1>
                    <button class="tarboton">Recargar</button>
                </div>
                <div class="flex">
                    <h1>4. 52 5539766557</h1>
                    <h1>0 Créditos</h1>
                    <button class="tarboton">Recargar</button>
                </div><div class="flex">
                    <h1>5. 52 5539766557</h1>
                    <h1>0 Créditos</h1>
                    <button class="tarboton">Recargar</button>
                </div>
            </div>
            
        </div>

        

        </div>

</body>
</html>