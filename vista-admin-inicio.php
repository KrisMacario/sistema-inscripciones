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

<!-- Agregar estilos específicos para esta página -->
<style>

  body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background: #F4E4A6 !important;
  }

  .anuncios-grid {
    text-align: center;
  }

  /*estilos para la tarjeta de cupos */
  .cupos {
    margin: 20px;
    font-size: 1.2rem;
    width: 40%;
    height: auto;
    text-align: center;
    margin-left: 10%;
  }

  .cupos h3 {
    margin-bottom: 10px;
    font-size: 1.5rem;
  }

  .cupos-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  justify-content: center;
  margin-top: 10px;
}

.tarjeta-cupo {
  background-color: #f5f5f5;
  border: 2px solid #ccc;
  border-radius: 10px;
  padding: 15px;
  width: 200px;
  text-align: center;
  box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
  transition: transform 0.2s ease;
}

.tarjeta-cupo:hover {
  transform: scale(1.05);
}

.tarjeta-cupo h4 {
  margin-bottom: 10px;
  font-size: 1.2rem;
  color: #333;
}

.tarjeta-cupo p {
  margin: 5px 0;
  font-size: 1rem;
}

/*total inscritos*/
.total {
    margin: 20px;
    font-size: 1.2rem;
    width: 30%;
    height: auto;
    text-align: center;
    margin-right: 10%;
    float: right;
    background: #f5f5f5;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
    margin-top: 6%;
  transition: transform 0.2s ease;
  }

  .total:hover {
  transform: scale(1.05);
}

  .total h3 {
    margin-bottom: 10px;
    font-size: 1.5rem;
  }

  .divisor {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
  }


</style>

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

  <div class="total">
    <h3>Total de inscritos:</h3>
    <?php
      $sql_total = "SELECT COUNT(pk_alumno) AS total_inscritos FROM alumno_datos";
      $resultado_total = $conexion->query($sql_total);
      $row_total = $resultado_total->fetch_assoc();
      echo "<p style='font-size: 2rem;'><strong>" . $row_total['total_inscritos'] . "</strong> inscritos en total</p>";
    ?>
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