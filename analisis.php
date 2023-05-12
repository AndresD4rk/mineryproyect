<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/base.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

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
  echo "<div style='max-height: 300px;overflow-y: auto;'>
  <table class='table table-dark table-hover'>";;
  
  foreach($lineas as $i => $linea) {
    echo "<tr>";
    $campos = str_getcsv($linea, ",");
    if (isset($campos[$columna_seleccionada])) {
      if ($i === 0) {
        echo "<th>" . htmlspecialchars($campos[$columna_seleccionada]) . "</th>"; 
      } else {
        echo "<td>" . htmlspecialchars(stripcslashes($campos[$columna_seleccionada])) . "</td>";

      }
      
    }echo "</tr>";
  }
  echo "</table>";
echo "<br><br>";

$valores = array();

foreach($lineas as $i => $linea) {
  $campos = str_getcsv($linea, ",");
  if (isset($campos[$columna_seleccionada])) {
    if ($i > 0) { // Ignorar la primera fila (encabezados de columna)
      // Agregar el valor al array de valores
      $valores[] = $campos[$columna_seleccionada];
    }
  }
}

// Contar la frecuencia de cada valor en el array de valores
$frecuencias = array_count_values($valores);

// Imprimir una tabla HTML con las frecuencias de los valores en la columna seleccionada
echo "<table>";
echo "<tr><th>Valor</th><th>Frecuencia</th></tr>";
foreach ($frecuencias as $valor => $frecuencia) {
  echo "<tr><td>" . htmlspecialchars($valor) . "</td><td>" . htmlspecialchars($frecuencia) . "</td></tr>";
}
echo "</table>";

?>

</body>
</html>