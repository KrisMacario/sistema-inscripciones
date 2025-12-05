<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escuela Primaria Rosalinda Guerrero Gamboa</title>
  <meta name="description" content="Escuela Primaria Rosalinda Guerrero Gamboa - Educación de calidad para niños">
  <link href="css/GlobalStyle.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/vista-admin-inicio.css">
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
        <input type="checkbox" class="menu" id="menu">
        <label for="menu" class="burger">☰</label>
        <ul class="nav-menu">
          <li><a href="vista-admin-inicio.php">INICIO</a></li>
          <li><a href="vista-admin-inscripciones.php">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios.php">USUARIOS</a></li>
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <?php
    session_start();
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'invitado';
    $apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
  ?>

  <!-- Cuerpo -->
  <section id="sistema-escolar" class="sistema-escolar">
    <div class="container">
      <h2>Bienvenido/a, <?php echo htmlspecialchars($usuario) . ' ' . htmlspecialchars($apellido); ?></h2>
    </div>
  </section>

  <!-- mostrar cupos por grado y el total de inscritos-->

<div class="divisor">

  <div class="cupos">
    <h3>Cupos por grado:</h3>
    <div class="cupos-grid">
  <?php
    $conexion = new mysqli("localhost", "root", "", "sistema_inc");

    $sql = "SELECT g.nombre, g.cupos, COUNT(a.pk_alumno) AS inscritos FROM grado g LEFT JOIN alumno_datos a ON g.pk_grado = a.fk_grado GROUP BY g.pk_grado";

    $resultado = $conexion->query($sql);

    while ($row = $resultado->fetch_assoc()) {
        $disponibles = $row['cupos'] - $row['inscritos'];
        echo "<div class='tarjeta-cupo'>
                  <h4>{$row['nombre']}</h4>
                  <p><strong>{$row['inscritos']}</strong> inscritos</p>
                  <p><strong>{$disponibles}</strong> disponibles</p>
                </div>";
    }
  ?>
    </div>
  </div>

<div class="dip">
  <!-- total inscritos -->

  <div class="total">
    <h3>Total de inscritos:</h3>
    <?php
      $sql_total = "SELECT COUNT(pk_alumno) AS total_inscritos FROM alumno_datos";
      $resultado_total = $conexion->query($sql_total);
      $row_total = $resultado_total->fetch_assoc();
      echo "<p style='font-size: 2rem;'><strong>" . $row_total['total_inscritos'] . "</strong> inscritos en total</p>";
    ?>
  </div>

<!-- alumnos abrobados-->
 <div class="aprove">
    <h3>Alumnos aprobados:</h3>
    <?php
      $sql_aprobados = "SELECT COUNT(pk_usuario) AS total_aprobados FROM usuarios WHERE estado = 'aceptado'";
      $resultado_aprobados = $conexion->query($sql_aprobados);
      $row_aprobados = $resultado_aprobados->fetch_assoc();
      echo "<p style='font-size: 2rem;'><strong>" . $row_aprobados['total_aprobados'] . "</strong> alumnos aprobados</p>";
    ?>
 </div>

 <!-- alunmos rechazados-->
  <div class="rejected">
    <h3>Alumnos rechazados:</h3>
    <?php
      $sql_rechazados = "SELECT COUNT(pk_usuario) AS total_rechazados FROM usuarios WHERE estado = 'rechazado'";
      $resultado_rechazados = $conexion->query($sql_rechazados);
      $row_rechazados = $resultado_rechazados->fetch_assoc();
      echo "<p style='font-size: 2rem;'><strong>" . $row_rechazados['total_rechazados'] . "</strong> alumnos rechazados</p>";
    ?>
 </div>

</div>

</div>

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