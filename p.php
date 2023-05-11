<!DOCTYPE html>
<html>
<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="archivo">
    <br><br>
    <label for="columna">Filtrar por columna:</label>
    <select id="columna" name="columna">
      <option value="">-- Seleccionar --</option>
      <option value="0">Columna 1</option>
      <option value="1">Columna 2</option>
      <option value="2">Columna 3</option>
    </select>
    <br><br>
    <input type="submit" value="Subir archivo">
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
    $archivo = $_FILES["archivo"]["tmp_name"];  

    // Leer el contenido del archivo
    $contenido = file_get_contents($archivo);

    // Encontrar la posición de la cadena de búsqueda
    $posicion = strpos($contenido, "Volcado de datos para la tabla");

    // Obtener el contenido a partir de la posición
    $contenido = substr($contenido, $posicion);

    // Dividir el contenido en líneas
    $lineas = explode("\n", $contenido);

    // Obtener los nombres de las columnas
    $columnas = str_getcsv($lineas[0], ",");

    // Filtrar los datos si se ha seleccionado una columna
    if (isset($_POST['columna']) && $_POST['columna'] != '') {
      $columna = $_POST['columna'];
      $lineas_filtradas = array();
      foreach ($lineas as $linea) {
        $campos = str_getcsv($linea, ",");
        if (count($campos) > $columna && $campos[$columna] != '') {
          $lineas_filtradas[] = $linea;
        }
      }
      $lineas = $lineas_filtradas;
    }

    // Imprimir una tabla HTML con el contenido del archivo y agregar un atributo de clase
    echo "<table class='mi-tabla'>";
    foreach($lineas as $i => $linea) {
      $campos = str_getcsv($linea, ",");
      echo "<tr>";
      foreach($campos as $j => $campo) {
        if ($i === 0) {
          echo "<th>" . htmlspecialchars($campo) . "</th>";
        } else {
          echo "<td>" . htmlspecialchars(stripcslashes($campo)) . "</td>";
        }
      }
      echo "</tr>";
    }
    echo "</table>";
  }
  ?>

</body>
</html>
