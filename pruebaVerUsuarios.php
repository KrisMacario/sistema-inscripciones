<!-- PHP para manejar la búsqueda -->
<?php
$resultado_busqueda = null;
$buscar = "";
$mostrar_todos = true;
$resultado_a_mostrar = null; // Inicializamos la variable principal para mostrar resultados

$conexion = new mysqli("localhost", "root", "", "sistema_inc");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['buscar']) && !empty(trim($_POST['buscar']))) {
    $buscar = trim($_POST['buscar']);
    $mostrar_todos = false;

    // Consulta SQL para buscar usuarios por nombre o apellido
    $sql_buscar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE (usuarios.nombre LIKE ? OR usuarios.apellido LIKE ?) AND rol.pk_rol = 1";
    
    $stmt = $conexion->prepare($sql_buscar);
    $like_buscar = "%" . $buscar . "%";
    $stmt->bind_param("ss", $like_buscar, $like_buscar);
    $stmt->execute();
    $resultado_busqueda = $stmt->get_result();
    $stmt->close();
    
    // Si se hizo búsqueda, $resultado_a_mostrar es el resultado de la búsqueda
    $resultado_a_mostrar = $resultado_busqueda;

} else {
    // Si NO se hizo búsqueda (o se cargó por primera vez), obtenemos TODOS
    $sql_todos = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 1";
    $resultado_todos = $conexion->query($sql_todos);
    
    // Si no se hizo búsqueda, $resultado_a_mostrar es el resultado de todos
    $resultado_a_mostrar = $resultado_todos;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link href="css/GlobalStyle.css" rel="stylesheet">
    <link rel="stylesheet" href="css/pruebaVerUsuarios.css">
    <script src="https://kit.fontawesome.com/13cae7644c.js" crossorigin="anonymous"></script>
</head>
<body>

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

    <section id="sistema-escolar" class="sistema-escolar">
        <div class="container">
            <h1>Usuarios</h1>

            <!--el buscador-->
            <form action="" method="POST">
            <input type="search" name="buscar" id="buscar" placeholder="Buscar usuario..." value="<?php echo htmlspecialchars($buscar); ?>">
            <button type="submit" id="buscar-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <main>

      <!-- Mostrar resultados de búsqueda si existen -->
       <?php

        // 1. Verifica si hay resultados para mostrar Y si el objeto no es nulo
        if ($resultado_a_mostrar && $resultado_a_mostrar->num_rows > 0) {
            
            
            // La condición while es para recorrer todas las filas del resultado y mostrarlas
            while ($row = $resultado_a_mostrar->fetch_assoc()) {
                echo '<div class="card-container-user">';
                
                // Verificar si el archivo existe
                $foto = !empty($row["foto_perfil"]) ? $row["foto_perfil"] : "icon-7797704_640.png";
                $rutaWeb = "fotos_perfil/" . $foto;

                // Mostrar imagen
                echo '<img src="' . htmlspecialchars($rutaWeb) . '" alt="usuario">';

                // Asegúrate de incluir el apellido que ahora estás seleccionando
                echo '<h2>' . htmlspecialchars($row["nombre"]) .'</h2>'; 
                echo '<h3 class="roli">' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
                
                // Bloque de botones
                echo '<div class="group-buttons">';
                echo '<a id="consultar" href="vista-admin-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';
                echo '</div>';
                echo '</div>';
            }
            
        } elseif (!$mostrar_todos) {
            // Caso: Se buscó, pero no se encontró nada
            echo '<p style="text-align: center; width: 100%;">No se encontraron usuarios que coincidan con "' . htmlspecialchars($buscar) . '".</p>';
        } else {
            // Caso: No se hizo búsqueda y $resultado_a_mostrar no tenía filas (la tabla está vacía)
            echo '<p style="text-align: center; width: 100%;">No hay usuarios registrados en este momento.</p>';
        }
      ?>

    </main>
  </div>
    </section>


  <?php
$conexion->close();
?>

</body>