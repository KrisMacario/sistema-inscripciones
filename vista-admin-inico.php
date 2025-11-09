<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escuela Primaria Rosalinda Guerrero Gamboa</title>
  <meta name="description" content="Escuela Primaria Rosalinda Guerrero Gamboa - Educación de calidad para niños">
  <link href="css/GlobalStyle.css" rel="stylesheet"/>
</head>
<body>
  <!-- Navegación -->
  <nav id="inicio">
    <div class="container">
      <div class="nav-container">
        <div class="nav-brand">
          ROSALINDA<br>
          GUERRERO<br>
          GAMBOA
        </div>
        <ul class="nav-menu">
          <li><a href="vista-admin-inicio.html">INICIO</a></li>
          <li><a href="vista-admin-inscripciones.html">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios.php">USUARIOS</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Cuerpo -->
  <section id="sistema-escolar" class="sistema-escolar">
    <div class="container">
      <h2>Bienvenid@, usuario*</h2>
      
    </div>
    <div>
        <?php
                $conexion = new mysqli("localhost", "root", "", "sistema_inc");
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $sql_get_anuncios = "SELECT * FROM anuncios";
                $resultado = $conexion->query($sql_get_anuncios);
                //la condicion while es para recorrer todas las filas del resultado y mostrarlas
                while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado
                    echo "<h3>a</h3>";
                }
            ?>
    </div>
  </section>

</body>
</html>