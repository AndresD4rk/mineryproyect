<!DOCTYPE html>

<html>
<head>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      max-height: 300px;
        overflow-y: auto;
      
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
    div {
 max-height: 300px;
  overflow-y: auto;
}
  </style>
</head>
<body>
 

  <?php
 session_start();
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

    // Imprimir una tabla HTML con el contenido del archivo y agregar un atributo de clase
    echo "<div><table class='mi-tabla'>";
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
    echo "</table></div>";
  }

  $identificador = uniqid();
 move_uploaded_file($_FILES["archivo"]["tmp_name"], "tmp/" . $identificador);
 $_SESSION["archivo"] = $identificador;
  ?>

  
  <div>
  <a href="http://localhost/mineryproyect">Regresar</a>
  <form action="analisis.php" method="post" enctype="multipart/form-data">
    <label for="columna">Campo a analizar:</label>
    <select id="columna" name="columna">
      <?php foreach($columnas as $i => $columna): ?>
        <option value="<?php echo $i ?>"><?php echo $columna ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Enviar</button>
  </form>
</div>
</body>
</html>
