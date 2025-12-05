<!-- PHP para manejar la búsqueda -->
<?php
$buscar = "";
$resultado_a_mostrar = null;

$conexion = new mysqli("localhost", "root", "", "sistema_inc");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['buscar']) && !empty(trim($_POST['buscar']))) {
    $buscar = trim($_POST['buscar']);

    $sql_buscar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE (usuarios.nombre LIKE ? OR usuarios.apellido LIKE ?) AND rol.pk_rol = 6";
    
    $stmt = $conexion->prepare($sql_buscar);
    $like_buscar = "%" . $buscar . "%";
    $stmt->bind_param("ss", $like_buscar, $like_buscar);
    $stmt->execute();
    
    $resultado_a_mostrar = $stmt->get_result(); 
    $stmt->close();

} else {
    $sql_todos = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 6";
    $resultado_a_mostrar = $conexion->query($sql_todos);
    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escuela Primaria Rosalinda Guerrero Gamboa</title>
  <meta name="description" content="Escuela Primaria Rosalinda Guerrero Gamboa - Educación de calidad para niños">
  <link href="css/GlobalStyle.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/vista-director-inscripciones.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
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

      <!--buscar alumno-->
      <form action="" method="POST">
      <input type="search" name="buscar" id="buscar" placeholder="Buscar usuario..." value="<?php echo htmlspecialchars($buscar); ?>">
      <button type="submit" id="buscar-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>

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
                
          if ($resultado_a_mostrar && $resultado_a_mostrar->num_rows > 0) {
              
              // Bucle que usa la variable que contiene los resultados (búsqueda O todos)
              while ($row = $resultado_a_mostrar->fetch_assoc()){ 
                  echo "<tbody>";
                  echo "<tr>";
                  echo "<td>". $row["nombre"] . "</td>";
                  echo "<td>". $row["apellido"] . "</td>";
                  
                  // Lógica para determinar la clase del estado (Estado está incluido en $row)
                  $estado = strtolower($row["estado"]);
                  $clase_estado = "";

                  if ($estado === "aceptado") {
                      $clase_estado = "estado-verde";
                  } elseif ($estado === "rechazado") {
                      $clase_estado = "estado-rechazado";
                  } else {
                      $clase_estado = "estado-gris";
                  }
                  
                  echo "<td><button class='estado " . $clase_estado . "'>". htmlspecialchars($row["estado"]) . "</button></td>";
                  
                  echo "</tr>";
                  echo "</tbody>";
              }
          } else {
              // Si no hay resultados para mostrar
              echo "<tbody><tr><td colspan='4' style='text-align: center;'>No se encontraron alumnos";
              if (!empty($buscar)) {
                  echo " para el término **" . htmlspecialchars($buscar) . "**.";
              }
              echo "</td></tr></tbody>";
          }
          // Cierre de la conexión
          $conexion->close();
          ?>

      </table>

      </div>
      
    </div>
  </section>

</body>
</html>
