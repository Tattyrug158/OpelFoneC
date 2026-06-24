<?php
// Prueba de conexión
$ruta = '../../Sesion/php/conexion.php';
if (file_exists($ruta)) {
    echo "Ruta correcta, archivo encontrado.";
} else {
    echo "ERROR: No se encuentra el archivo en: " . realpath($ruta);
}
?>