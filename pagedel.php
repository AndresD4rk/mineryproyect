<?php
include "conexion.php";
session_start();
// Obtener el identificador del archivo de la sesi�n
$identificador = $_POST["datid"];
//echo $identificador;

// Obtener la ruta del archivo temporal en el servidor
$file = "tmp/" . $identificador;

if (file_exists($file)) {
    if (unlink($file)) {
        
        $sql = $conexion->query("DELETE FROM reganalisis WHERE idga='$identificador'");
        if ($sql) {
            echo "El archivo ha sido borrado correctamente.";
            echo "<script>window.location.href = 'pagebus.php';</script>";
        }
    } else {
        echo "No se pudo borrar el archivo.";
    }
} else {
    echo "El archivo no existe.";
}


?>