<?php
session_start();

if (!isset($_SESSION["archivo"])) {
  // Si el identificador del archivo no est� en la sesi�n, redirigir de vuelta a la p�gina de carga
  header("Location: upload.php");
  exit;
}

// Obtener el identificador del archivo de la sesi�n
$identificador = $_SESSION["archivo"];

// Obtener la ruta del archivo temporal en el servidor
$ruta_archivo = "tmp/" . $identificador;

// Leer el contenido del archivo
$contenido = file_get_contents($ruta_archivo);

// Resto del c�digo para analizar el archivo
// ...

// Limpiar la sesi�n para que se pueda cargar otro archivo


  // Encontrar la posici�n de la cadena de b�squeda
  $posicion = strpos($contenido, "Volcado de datos para la tabla");

  // Obtener el contenido a partir de la posici�n
  $contenido = substr($contenido, $posicion);

  // Dividir el contenido en l�neas
  $lineas = explode("\n", $contenido);

  // Obtener los nombres de las columnas
  $columnas = str_getcsv($lineas[0], ",");

  // Obtener el �ndice de la columna seleccionada por el usuario
  $columna_seleccionada = $_POST['columna'];

  // Imprimir una tabla HTML con los datos de la columna seleccionada
  echo "<table class='mi-tabla'>";
  echo "<tr>";
  echo "<th>" . htmlspecialchars($columnas[$columna_seleccionada]) . "</th>"; 
  echo "</tr>";
  foreach($lineas as $i => $linea) {
    $campos = str_getcsv($linea, ",");
    if (isset($campos[$columna_seleccionada])) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars(stripcslashes($campos[$columna_seleccionada])) . "</td>";
      echo "</tr>";
    }
  }
  echo "</table>";

?>