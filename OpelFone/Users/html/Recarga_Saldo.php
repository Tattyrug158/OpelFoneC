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
                <li class="navbarselected"><a href="Recarga_Saldo.php">Recarga de Saldo</a></li>
                <li><a href="Mi_Saldo.php">Mi Saldo</a></li>
            </ul>
            </div>
        </nav>



        <div style="padding: 35px;">
            <div class="flex">
                <div>
                    <h1 class="sub_int">Recargar Saldo</h1>
                </div>
                <div><h1 class="sub">Monto a Recargar: $<span>
                    <select id="montos" name="montos" class="texto">
                        <option value="0">Seleccione una cantidad</option>
                    <option value="10">$10</option>
                    <option value="15">$15</option>
                    <option value="30">$30</option>
                    <option value="50">$50</option>
                    <option value="75">$75</option>
                    <option value="85">$85</option>
                    <option value="100">$100</option>
                    <option value="150">$150</option>
                    <option value="200">$200</option>
                    </select>
                </span></h1></div>
            </div>

            <div class="flex " style="align-items: center; border: rgb(83, 126, 68) solid; border-radius: 25px; padding: 25px;" >
                <div><h1 class="sub_int">Método de pago: </h1></div>
                <div><h1 id="tardig" class="sub">Oswaldo Hernandez: <span id="tarnum">5986</span></h1></div>
                <button class="boton" id="abrirModal">Agregar método de pago</button>
            </div><br><br>
            <div class="flex contenedor" style="align-items: center;" >
                <div><h1 class="sub_int">Usted paga: </h1></div>
                <div><h1 id="tardig" class="sub">$ <span id="tarnum">200</span></h1></div>
                <button class="boton" id="abrirAce2">Realizar pago</button>
            </div><br><br>

                <hr class="linea">

            <div class="flex">
                <div>
                    <h1 class="sub_int">Recargar Créditos</h1>
                </div>
                <div><h1 class="sub">Créditos Disponibles: 596</h1></div>
            </div>

            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$10</h1><h1 class="tartextsub">45 Créditos</h1></div>
                    <div><button class="tarboton" data-titulo="p1" data-texto="$10">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$15</h1><h1 class="tartextsub">60 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$15" class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$30</h1><h1 class="tartextsub">130 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$30" class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>
            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$50</h1><h1 class="tartextsub">200 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$50" class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$75</h1><h1 class="tartextsub">350 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$75" class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$85</h1><h1 class="tartextsub">450 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$65" class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>
            <div class="flex2">
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$100</h1><h1 class="tartextsub">600 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$100" class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$150</h1><h1 class="tartextsub">850 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$150" class="tarboton">¡Lo quiero!</button></div>
                </div>
                <div class="tarjeta flex2">
                    <div><h1 class="tartext">$200</h1><h1 class="tartextsub">1000 Créditos</h1></div>
                    <div><button data-titulo="p1" data-texto="$200" class="tarboton">¡Lo quiero!</button></div>
                </div>
            </div>


            <div></div>
        </div>


    <dialog id="modal" class="modal">
        <h1 class="sub_int" style="justify-content: left;">Comprar paquete: <span id="textoModal"></span></h1><br>
        <div class="flex">
            <div style="border-right: black solid; width: 50%;">
                <h3 class="sub">Recargar a:</h3>
                <input type="text" name="" id="telefono" class="texto"><br>
                <button class="boton" onclick="agregarTelefono()">Guardar número de telefono</button><br><br><br><br>
                <h1 class="sub_int">Total: </h1>
                <span id="total" class="sub">$900</span>
            </div>
            <div style="width: 100%;" >
                <h1 class="sub_int" >Mis telefonos</h1>
                <div id="lista" ></div>
                <button class="botoneli">Borrar telefono</button>
            </div>
        </div>
        <button class="botoncan" id="cerrar">Cancelar Acción</button>
    </dialog>

    <dialog id="miVentana" class="modal">
        <div class="contenedor2 " style="padding: 25px;" >
            <h1 class="sub">Nuevo método de pago</h1>


            <div class="flex">
            <div>
            <label class="label" id="nombre_titular">Nombre del titular</label><br>
            <input class="texto" type="name"><br>
            
            <label class="label" id="num_tarjeta">Numero de Tarjeta</label><br>
            <input class="texto" type="number"><br>

            </div>

            <div>
                <div>
            <label class="label" id="cvv">CVV</label><br>
            <input class="texto" type="number"><br>
            
            <label class="label" id="fecha">Fecha de vencimiento</label><br>
            <input class="texto" type="date"><br>

            </div>
            </div>
            </div>

            <button id="abrirAce" class="boton">Confirmar nuevo metodo de pago</button><br>
            <br><br><br><br>
            <button class="botoncan" id="cerrarModal1">Cancelar</button>
            

            
        </div>
    </div>


    </dialog>


    <dialog id="ace" class="contenedor flex">
        <h1 class="sub_int">Se confirmo el metodo de pago</h1>
        <button class="boton" id="cerrarAce">Aceptar</button>
    </dialog>

    <dialog id="ace2" class="contenedor flex">
        <h1 class="sub_int">Se realizo el pago</h1>
        <a href="../html/Mi_Saldo.html"><button class="boton" id="cerrarAce2">Aceptar</button></a>
    </dialog>
        
    <script>
        


         function agregarTelefono() {
            let telefono = document.getElementById("telefono").value;

            if (telefono.trim() !== "") {
                // Crear botón
                let boton = document.createElement("button");

                // Texto del botón
                boton.textContent = telefono;
                boton.classList.add("telefono-btn");

                // Salto de línea después del botón
                document.getElementById("lista").appendChild(boton);
                document.getElementById("lista").appendChild(document.createElement("br"));

                // Limpiar campo
                document.getElementById("telefono").value = "";
            }
        }



        const modal = document.getElementById("modal");
        const textoModal = document.getElementById("textoModal");

        document.querySelectorAll(".tarboton").forEach(boton => {

            boton.addEventListener("click", () => {

                textoModal.textContent = boton.dataset.texto;

                modal.showModal();
            });

        });

        document.getElementById("cerrar").addEventListener("click", () => {
            modal.close();


        });
        const ventana1 = document.getElementById("miVentana");

        document.getElementById("abrirModal").addEventListener("click", () => {
            ventana1.showModal();
        });

        document.getElementById("cerrarModal1").addEventListener("click", () => {
            ventana1.close();
        });

        const aceptar = document.getElementById("ace");

        document.getElementById("abrirAce").addEventListener("click", () => {
            aceptar.showModal();
        });

        document.getElementById("cerrarAce").addEventListener("click", () => {
            aceptar.close();
        });

        const aceptar2 = document.getElementById("ace2");

        document.getElementById("abrirAce2").addEventListener("click", () => {
            aceptar2.showModal();
        });

        document.getElementById("cerrarAce2").addEventListener("click", () => {
            aceptar2.close();
        });
        
        

        



    </script>









</body>
</html>