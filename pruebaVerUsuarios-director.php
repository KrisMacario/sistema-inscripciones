<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de usuarios</title>
<link href="css/GlobalStyle.css" rel="stylesheet">
<link rel="stylesheet" href="css/pruebaVerUsuarios-director.css">
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
          <li><a href="vista-director-inicio.php">INICIO</a></li>
          <li><a href="vista-director-inscripciones.php">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios-director.php">USUARIOS</a></li>
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
        </ul>
      </div>
    </div>
  </nav>

<section id="sistema-escolar" class="sistema-escolar">
<div class="container">
    <h1>Usuarios</h1>
    <main>
    <?php
    $conexion = new mysqli("localhost", "root", "", "sistema_inc");
    if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
    }

    $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 1";
    $resultado = $conexion->query($sql_verificar);

    // La condición while es para recorrer todas las filas del resultado y mostrarlas
    while ($row = $resultado->fetch_assoc()) {
    echo '<div class="card-container-user">';


    // Verificar si el archivo existe
    $foto = !empty($row["foto_perfil"]) ? $row["foto_perfil"] : "icon-7797704_640.png";
    $rutaServidor = __DIR__ . "/fotos_perfil/" . $foto;
    $rutaWeb = "fotos_perfil/" . $foto;

    // Mostrar imagen
    echo '<img src="' . htmlspecialchars($rutaWeb) . '" alt="usuario">';

    echo '<h2>' . htmlspecialchars($row["nombre"]) . '</h2>';
    echo '<h3>' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
    echo '<div class="group-buttons">';
    echo '<a id="consultar" href="vista-director-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';
    echo '<a id="editar" href="vista-director-edituser.php?pk_usuario=' . $row["pk_usuario"] . '">Editar</a>';
    echo '<a id="eliminar" href="#" onclick="eliminarUsuario(' . $row['pk_usuario'] . '); return false;">Eliminar</a>';
    echo '</div>';
    echo '</div>';
    }

    ?>

    <a href="vista-director-adduser.html" id="link-add-user">
    <div id="card-add-user">
    <img src="https://cdn-icons-png.flaticon.com/512/7794/7794550.png" alt="plus" id="plus">
    <h3 class="kk">Agregar usuario</h3>
    </div>
    </a>

    </main>
    </div>
    </section>

    <script>
    function eliminarUsuario(id) {
    if (confirm("¿Estás seguro de eliminar este usuario?")) {
    fetch("eliminar_usuario.php?id=" + id)
    .then(() => {
    location.reload(); //recargar
    })
    .catch(error => {
    alert("Error al eliminar: " + error);
    });
    }
    }
</script>
</body>