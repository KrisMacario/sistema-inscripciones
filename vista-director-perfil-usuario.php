<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link href="css/GlobalStyle.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/vista-director-perfil-usuario.css">
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

    <!-- Botón de salir -->
    <div id="btn-salir">
        <button onclick="window.location.href='pruebaVerUsuarios-director.php'"><</button>
    </div>
    

    <main>

        <h1>Perfil de usuario</h1>

        <!--Aqui va el php-->
        <?php

            //identificar el usuario cuyo perfil se quiere ver
            

            $conexion = new mysqli("localhost", "root", "", "sistema_inc");

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            //verificar datos del usuario
            if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];

                //consultas preparadas
                $stmt = $conexion->prepare("SELECT usuarios.pk_usuario, usuarios.telefono, usuarios.email, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol, usuarios.foto_perfil FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE usuarios.pk_usuario = ?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario

                    // 🔍 Verificar si el archivo existe
                    $foto = !empty($row["foto_perfil"]) ? $row["foto_perfil"] : "icon-7797704_640.png";
                    $rutaServidor = __DIR__ . "/fotos_perfil/" . $foto;
                    $rutaWeb = "fotos_perfil/" . $foto;

                    echo "<div class='container-perfil'>". //se muestra el id del usuario
                    "<div id='subgroup'>".
                        "<img src='" . htmlspecialchars($rutaWeb) . "' alt='usuario'>".
                        "<div id='NyE'>".
                            "<h2 class='name'>". $row['nombre']." ". $row['apellido']."</h2>".
                            "<button id='edit-user' onclick=\"window.location.href='vista-director-edituser.php?pk_usuario=" . $row['pk_usuario'] . "'\">Editar usuario</button>".
                        "</div>".
                    "</div>".
                    "<hr>".
                    "<div id='otroGrupo'>".
                        "<h3> ID de usuario: ".$row['pk_usuario']."</h3>".
                        "<h3>Rol asignado: ". $row['nombre_rol']."</h3>".
                        "<h3>Telefono: ". $row['telefono']."</h3>".
                        "<h3>E-mail: ". $row['email']."</h3>".
                        "<h3>Estado: ". $row['estado']."</h3>".
                    "</div>".
                    "</div>";
                } 

            } else {
                echo "ID de usuario no proporcionado.";
                exit;
            }
                

        ?>

    </main>

</body>
</html>