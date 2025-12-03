<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escuela Primaria Rosalinda Guerrero Gamboa</title>
  <meta name="description" content="Escuela Primaria Rosalinda Guerrero Gamboa - Educación de calidad para niños">
  <link href="css/GlobalStyle.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/vista-director-inscripciones.css">
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
          <li><a href="vista-director-inicio.php">INICIO</a></li>
          <li><a href="vista-director-inscripciones.php">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios-director.php">USUARIOS</a></li>
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Cuerpo -->
  <section id="sistema-escolar" class="sistema-escolar">
    <div class="container">
      <h2>Alumnos de nuevo ingreso</h2>

      <!-- aqui empieza la tabla y el php -->
      <div class="cont-user"> 

      <table class="table table-bordered" id="tabla">

        <colgroup>
          <col style="width: 44%;">
          <col style="width: 20%;">
          <col style="width: 45%;">
        </colgroup>

        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>

        <?php
          $conexion = new mysqli("localhost", "root", "", "sistema_inc");
          if ($conexion->connect_error) {
              die("Error de conexión: " . $conexion->connect_error);
          }
          $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 6";
          $resultado = $conexion->query($sql_verificar);
          //la condicion while es para recorrer todas las filas del resultado y mostrarlas
          while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado, el fetch_assoc las va obteniendo una por una
              echo "<tbody>";
              echo "<tr>";
              echo "<td>". $row["nombre"] . "</td>";
              echo "<td>". $row["apellido"] . "</td>";
              $estado = strtolower($row["estado"]);
              $clase_estado = "";

                if ($estado === "aceptado") {
                    $clase_estado = "estado-verde";
                } elseif ($estado === "rechazado") {
                    $clase_estado = "estado-rechazado";
                } else {
                    $clase_estado = "estado-gris";
                }
                echo "<td><button class='estado " . $clase_estado . "'>". $row["estado"] . "</button></td>";
                
              echo "</tr>";
              echo "</tbody>";
          }
      ?>

      </table>

      </div>
      
    </div>
  </section>

</body>
</html>
