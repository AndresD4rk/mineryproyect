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
    echo "<div style='max-height: 300px;overflow-y: auto;'>
    <table class='table table-dark table-hover'>";
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
