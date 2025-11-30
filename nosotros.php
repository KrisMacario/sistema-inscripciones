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
        <a href="index.html">  
        <div class="nav-brand">  
          ROSALINDA<br>
          GUERRERO<br>
          GAMBOA
        </div>
        </a>
        <ul class="nav-menu">
          <li><a href="index.html">INICIO</a></li>
          <li><a href="nosotros.php">NOSOTROS</a></li>
          <li><a href="acerca-del-equipo.html">ACERCA DEL EQUIPO</a></li>
          <li><a href="inscripciones.html">INSCRIPCIÓN</a></li>
          <li><a href="sistema_escolar.html" class="btn-sistema">SISTEMA ESCOLAR</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-grid">
        <div>
          <img src="imagenes/principal.jpeg" alt="Estudiantes de primaria">
        </div>
        <div>
          <h1>ACERCA DE LA ESCUELA ROSALINDA GUERRERO GAMBOA</h1>
          <p>Promueve el desarrollo integral del niño, enfocándose en tres planos: formación en valores, y el hábito de aprendizaje.</p>
          <button class="btn-primary">Ver más</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Experiencias Section -->
  <section class="experiencias">
    <div class="container">
      <h2>Experiencias únicas</h2>
      <div class="experiencias-btn">
        <button class="btn-primary">Nuestros momentos</button>
      </div>
      <div class="gallery-grid">
        <img src="imagenes/imagen-1-halloween.jpeg" alt="Momento escolar 1">
        <img src="imagenes/imagen-2-dia-muertos.webp" alt="Momento escolar 2">
        <img src="imagenes/imagen-3-celebracion.jpg" alt="Momento escolar 3">
        <img src="imagenes/imagen-4-viva-mexico.jpg" alt="Momento escolar 4">
      </div>
    </div>
  </section>

  
  <!-- Nosotros Section -->
  <section id="nosotros" class="nosotros">
    <div class="container">
      <h2>Nosotros</h2>
      <div class="nosotros-content">
        <p>La Escuela Primaria Rosalinda Guerrero Gamboa es una institución educativa comprometida con la formación integral de niños y niñas. Nuestro enfoque pedagógico se centra en el desarrollo de valores, habilidades académicas y sociales que preparan a nuestros estudiantes para los retos del futuro.</p>
        <p>Contamos con instalaciones modernas, personal docente calificado y un ambiente seguro que favorece el aprendizaje y el desarrollo personal de cada alumno.</p>
      </div>
    </div>
  </section>

  <!-- Anuncios Section -->
   <section id="sistema-escolar" class="anuncios">
      <div class="container">
        <h2>Tablón de anuncios</h2>
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
  
  <!-- Footer -->
  <footer>
    <div class="container">
      <h3>Escuela Primaria Rosalinda Guerrero Gamboa</h3>
      <p>Valdez Balboa, Americo Villarreal Guerra I<br>Reynosa, Tamaulipas, México</p>
      <p>© 2025 Escuela Primaria Rosalinda Guerrero Gamboa. Todos los derechos reservados.</p>
    </div>
  </footer>
</body>
</html>
