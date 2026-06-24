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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="nab_div">
        <div><h1> OpelFone</h1></div>
        <div><button class="user">OswaldoHdz</button></div>
    </div>
    <nav>
            <div class="nab_div2">
                <ul class="navbar">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="Mi_Linea.html">Mi Linea</a></li>
                <li class="navbarselected"><a href="Recarga_Saldo.html">Recarga de Saldo</a></li>
                <li><a href="Mi_Saldo.html">Mi Saldo</a></li>
            </ul>
            </div>
        </nav>



        <div style="padding: 35px;">
            <div class="flex">
                <div>
                    <h1 class="sub_int">Recargar Saldo</h1>
                </div>
                <div><h1 class="sub">saldo actual: $145.00</h1></div>
            </div>

            <button class="estado3">Realizar recarga adicional</button>

            <div class="flex">
                <div>
                    <h1 class="sub_int">Recargar Créditos</h1>
                </div>
                <div><h1 class="sub">Créditos Disponibles: 596</h1></div>
            </div>

            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$10</h1><h1 class="tartextsub">45 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$15</h1><h1 class="tartextsub">60 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$30</h1><h1 class="tartextsub">130 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>
            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$50</h1><h1 class="tartextsub">200 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$75</h1><h1 class="tartextsub">350 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$85</h1><h1 class="tartextsub">450 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>
            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$100</h1><h1 class="tartextsub">600 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$150</h1><h1 class="tartextsub">850 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$200</h1><h1 class="tartextsub">1000 Créditos</h1></div>
                    <div><button class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>


            <div></div>
        </div>

</body>
</html>