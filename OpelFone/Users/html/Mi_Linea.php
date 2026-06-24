<?php
session_start();
require_once __DIR__ . '/../../Sesion/php/conexion.php';

// 1. LÓGICA DE PROCESAMIENTO (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $id = $_POST['idTelefono'] ?? null;

    if ($accion === 'agregar' && !empty($_POST['numero'])) {
        $stmt = $pdo->prepare("INSERT INTO telefono (Numero, Saldo, Estado_activo, Desvio_activo) VALUES (?, 0, 0, 0)");
        $stmt->execute([trim($_POST['numero'])]);
        $idTelefono = $pdo->lastInsertId();
        $pdo->prepare("INSERT INTO cliente_telefono (ID_cliente, ID_Telefono) VALUES (?, ?)")->execute([$_SESSION['ID_cliente'], $idTelefono]);
        exit('OK');
    }

    if ($accion === 'eliminar' && $id) {
        $pdo->prepare("DELETE FROM desvio_telefono WHERE ID_Telefono = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM cliente_telefono WHERE ID_Telefono = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM telefono WHERE ID_Telefono = ?")->execute([$id]);
        exit('OK');
    }
}

// 2. LÓGICA DE VISTA (GET)
$nombreUsuario = 'Invitado';
if (isset($_SESSION['ID_cliente'])) {
    $stmt = $pdo->prepare("SELECT Nombre FROM cliente WHERE ID_cliente = ?");
    $stmt->execute([$_SESSION['ID_cliente']]);
    $user = $stmt->fetch();
    if ($user) $nombreUsuario = $user['Nombre'];
}

$telefonos = [];
if (isset($_SESSION['ID_cliente'])) {
    $stmt = $pdo->prepare("SELECT t.* FROM telefono t INNER JOIN cliente_telefono ct ON t.ID_Telefono = ct.ID_Telefono WHERE ct.ID_cliente = ?");
    $stmt->execute([$_SESSION['ID_cliente']]);
    $telefonos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/css.css">
    <title>OpelFone — Mi Línea</title>
</head>
<body>
    <div class="nab_div">
        <div><h1>OpelFone</h1></div>
        <div><a href="../html/perfil.php"><button class="user"><?= htmlspecialchars($nombreUsuario) ?></button></a>            <a href="../../Sesion/Inicio_sesión_usuario.html" class="sesion"  >Cerrar Sesion</a>    </div>
    </div>
    <nav>
        <div class="nab_div2">
            <ul class="navbar">
                <li><a href="index.php">Inicio</a></li>
                <li class="navbarselected"><a href="Mi_Linea.php">Mi Linea</a></li>
                <li><a href="Recarga_Saldo.php">Recarga de Saldo</a></li>
                <li><a href="Mi_Saldo.php">Mi Saldo</a></li>
            </ul>
        </div>
    </nav>

    <div class="contenedor">
        <div class="con1">
            <h1 class="sub_int">Agregar número</h1>
            <input type="text" id="telefono" placeholder="Ingresa un teléfono" class="texto">
            <button onclick="agregarTelefono()" class="boton">Agregar nuevo número</button>
            <h2 class="sub_int">Mis teléfonos</h2>
            <div id="lista"> 
                <?php foreach($telefonos as $tel): ?>
                    <button class="telefono-btn" data-id="<?= $tel['ID_Telefono'] ?>" data-numero="<?= $tel['Numero'] ?>">
                        <?= htmlspecialchars($tel['Numero']) ?>
                    </button><br>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="con2">
            <h1 class="sub_int" id="titulo-linea">Selecciona una línea</h1>
            <div class="centrar"><h1 class="sub" id="det-numero">--</h1></div>
            <div class="estado">
                <div><h1 id="estado-texto">Línea</h1></div>
                <div><button class="apaen">Encender Linea</button></div>
            </div>
            <button class="estado2" id="abrirModal">Eliminar Linea</button>
            <button class="estado3">Recargar saldo</button>
            <button class="estado4" id="abrirModal2">Desvio de llamadas</button>
        </div>
    </div>

    <dialog id="miVentana" class="contenedor dialogo">
        <h3 class="sub">¿Estás seguro de eliminar este número?</h3>
        <button class="boton" onclick="ejecutarEliminar()">Aceptar</button>
        <button class="boton" id="cerrarModal1">Cancelar</button>
    </dialog>

    <dialog id="miVentana2" class="modal">
        <h1 class="sub_int">Desvío de llamadas</h1>
        <input type="text" id="input-desvio" class="texto" placeholder="Nuevo número">
        <button class="boton">Guardar desvío</button>
        <button class="botoncan" id="cerrarModal2">Cancelar</button>
    </dialog>

    <script>
        let idSeleccionado = null;

        // Lógica de botones y modales
        document.getElementById("abrirModal").addEventListener("click", () => document.getElementById("miVentana").showModal());
        document.getElementById("abrirModal2").addEventListener("click", () => document.getElementById("miVentana2").showModal());
        document.getElementById("cerrarModal1").addEventListener("click", () => document.getElementById("miVentana").close());
        document.getElementById("cerrarModal2").addEventListener("click", () => document.getElementById("miVentana2").close());

        // Selección de línea
        document.addEventListener("click", function(e){
            if(e.target.classList.contains("telefono-btn")){
                document.getElementById("det-numero").textContent = e.target.dataset.numero;
                idSeleccionado = e.target.dataset.id;
            }
        });

        // Funciones POST
        function agregarTelefono() {
            let num = document.getElementById("telefono").value;
            let fd = new FormData();
            fd.append('accion', 'agregar');
            fd.append('numero', num);
            fetch('Mi_Linea.php', { method: 'POST', body: fd }).then(() => location.reload());
        }

        function ejecutarEliminar() {
            if(!idSeleccionado) return;
            let fd = new FormData();
            fd.append('accion', 'eliminar');
            fd.append('idTelefono', idSeleccionado);
            fetch('Mi_Linea.php', { method: 'POST', body: fd }).then(() => location.reload());
        }
    </script>
</body>
</html>