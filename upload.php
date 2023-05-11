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
    <input type="submit" value="Subir archivo">


    
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["archivo"]) && !empty($_FILES["archivo"]["tmp_name"])) {
    $archivo = $_FILES["archivo"]["tmp_name"]; ?>
    <label for="filtro">Filtrar por valor:</label>
    <select name="filtro" id="filtro">
      <option value="">Selecciona un valor</option>
      <?php
        // Obtener los valores únicos de la columna a filtrar
        $valores = array_unique(array_column(array_map('str_getcsv', file($archivo)), $columna_filtro));
        foreach ($valores as $valor) {
          echo "<option value='" . htmlspecialchars($valor) . "'";
          if (isset($_POST['filtro']) && $_POST['filtro'] === $valor) {
            echo " selected";
          }
          echo ">" . htmlspecialchars($valor) . "</option>";
        }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Filtrar"><label for="filtro">Filtrar por valor:</label>
    <input type="text" id="filtro" name="filtro" value="<?php echo isset($_POST['filtro']) ? $_POST['filtro'] : ''; ?>">
    <br><br>
    <input type="button" value="Filtrar" onclick="filtrar()">

    <?php } ?>


    
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

  <script>
    function filtrar() {
      const filtro = document.getElementById('filtro').value;
      const tabla = document.querySelector('.mi-tabla');
      const filas = tabla.querySelectorAll('tr:not(:first-child)');

      filas.forEach(fila => {
        const celdas = fila.querySelectorAll('td');
        let coincide = false;

        celdas.forEach(celda => {
          if (celda.innerHTML.includes(filtro)) {
            coincide = true;
          }
        });

        if (coincide) {
          fila.style.display = '';
        } else {
          fila.style.display = 'none';
        }
      });
    }
  </script>

</body>
</html>
