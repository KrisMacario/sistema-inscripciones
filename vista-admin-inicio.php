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
          <li><a href="vista-admin-inicio.php">INICIO</a></li>
          <li><a href="vista-admin-inscripciones.php">INSCRIPCIONES</a></li>
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
  </section>

  <!-- mostrar tablon de anuncios -->
  <section id="sistema-escolar" class="sistema-escolar">
      <div class="container">
        <h2>Últimos anuncios</h2>
      </div>
      <div class="anuncios-grid">
        <?php
          $conexion = new mysqli("localhost", "root", "", "sistema_inc");
          if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
          }
          $sql_get_anuncios = "SELECT * FROM anuncios";
          $resultado = $conexion->query($sql_get_anuncios);
          //la condicion while es para recorrer todas las filas del resultado y mostrarlas
          $x = 0;
          while ($row = $resultado->fetch_assoc() and $x < 10){ //mientras haya filas en el resultado
            echo "<div class = 'anuncio-card'>".
              "<h3>".htmlspecialchars($row["titulo"])."</h3>".
              "<p>".htmlspecialchars($row["anuncio"])."</p>".
              "</div>";
            $x = $x + 1; 
          }
        ?>
      </div>
    </div>
  </section>

  <!-- agregar anuncio -->
  <section id="sistema-escolar" class="sistema-escolar">
      <div class="container">
        <h2>Agregar Anuncio</h2>
      </div>
      <div class="form-container">
        <form method="post" action="publicar-anuncio.php" enctype="multipart/form-data">
          <div class="form-grid">
            <div class="form-group">
              <label>Titulo del anuncio</label>
              <input type="text" name="anuncio-titulo" placeholder="Titulo">
            </div>
            <div class="form-group">
              <label>Anuncio</label>
              <input type="text" name="anuncio-mensaje" placeholder="Mensaje">
            </div>
          </div>
          
          <button type="submit" class="btn-primary" style="width: 100%;" style="text-align: center;"> Publicar anuncio</a>
          
        </form>
      </div>
    </div>
  </section>
</body>
</html>