<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripcion del alumno</title>
    <link rel="stylesheet" href="css/inscripcion-alumno.css">
</head>
<body>

<!--navegación-->
<nav id="inicio">
    <div class="container">
      <div class="nav-container">
        <div class="nav-brand">
          ROSALINDA<br>
          GUERRERO<br>
          GAMBOA
        </div>
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

  <!--boton para regresar-->
    <div id="cerrar">
        <button class="cerrar" onclick="window.location.href='vista-admin-inscripciones.php'"><</button>
    </div>

<main>



    <!-- Aquí va el contenido de la ficha de inscripción, que sera como una hoja -->
    <div id="ficha">

        <div class="dib">
            <h1>Ficha de inscripción</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/SEP_Logo_2019.svg/1200px-SEP_Logo_2019.svg.png" alt="logo de la escuela">
        </div>

        <h2>Escuela primaria <br>
        Rosalinda Guerrero Gamboa</h2>

        <hr id="separator">

        <button id="datos_alumno">Datos del alumno</button>

        <!-- aqui se muestran los datos del alumno -->
         <?php
            $conexion = new mysqli("localhost", "root", "", "sistema_inc");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            //como es un usuario individual, verificamos el pk_usuario
            if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];
                    
                //consultas preparadas
                //en la cinsulta hacemos un join con el usuario, rol y alumno para obtener todos los datos necesarios
                //el ? es un marcador de posición para el pk_usuario que se pasará más adelante
                $stmt = $conexion->prepare("SELECT alumno.pk_usuario, alumno.nombre AS alumno_nombre, alumno.apellido AS alumno_apellido, padre.nombre AS padre_nombre, padre.apellido AS padre_apellido, padre.pk_usuario AS pk_padre, padre.telefono AS padre_telefono, padre.telefonoFijo AS telefono_fijo, padre.parentezco AS parentezco, padre.email AS padre_email, alumno.direccion AS alumno_direccion, alumno.estado AS alumno_estado, alumno_datos.fecha_nacimiento, alumno_datos.CURP, alumno_datos.fk_grado, alumno_datos.fk_usuarios FROM usuarios AS alumno JOIN rol ON alumno.fk_rol = rol.pk_rol JOIN alumno_datos ON alumno.pk_usuario = alumno_datos.fk_usuarios LEFT JOIN padre_alumno ON padre_alumno.fk_alumno = alumno.pk_usuario LEFT JOIN usuarios AS padre ON padre.pk_usuario = padre_alumno.fk_padre WHERE alumno.pk_usuario = ?");
                $stmt->bind_param("i", $pk_usuario); // "i" indica que el parámetro es un entero. y el parametro representa el pk_usuario
                $stmt->execute(); // Ejecuta la consulta
                $resultado = $stmt->get_result(); // Obtiene el resultado de la consulta

                if($resultado->num_rows > 0) { //si el resultado tiene filas
                    $row = $resultado->fetch_assoc(); //obtiene los datos del usuario
                    //mostrar los datos del alumno en la ficha de inscripción
                    echo "<div id='group1'>";
                    echo "<h3>Nombre completo:     ". "<label id='nombre'>". $row['alumno_nombre'] . " " . $row['alumno_apellido'] . "</label>" . "</h3>";
                    echo "<h3>CURP:    ". "<label id='curpp'>". $row['CURP']. "</label>" . "</h3>";
                    echo "</div>";

                    echo "<div id='group2'>";
                    echo "<h3>Fecha nacimiento:    </h3>". "<label id='fecha'>". $row['fecha_nacimiento'] . "</label>";
                    echo "<h3>Grado a inscribir:   </h3>". "<label id='gradop'>". $row['fk_grado'] . "er grado </label>";
                    echo "<h3>Direccion:</h3>". "<label id='direccionp'>". $row['alumno_direccion'] . " </label>";
                    echo "</div>";

                    echo "<hr id='black'>";

                    echo "<button id='datos_padre'>Datos del padre o tutor</button>";

                    echo "<div id='group3'>";
                    echo "<h3>Nombre completo:   ". "<label id='nom'>". $row['padre_nombre']. " ". $row['padre_apellido']. "</label>"."</h3>";
                    echo "</div>";
                    echo "<div id='group4'>";
                    echo "<h3>Parentezco:    </h3>". "<label id='parentezco'>". $row['parentezco'] . "</label>";
                    echo "<h3>Correo:   </h3>". "<label id='emaill'>". $row['padre_email'] . "</label>";
                    echo "</div>";
                    echo "<div id='group5'>";
                    echo "<h3>Teléfono personal:    </h3>". "<label id='tel-personal'>". $row['padre_telefono'] . "</label>";
                    echo "<h3>Teléfono fijo:   </h3>". "<label id='tel-fijo'>". $row['telefono_fijo'] . "</label>";
                    echo "</div>";
                }

            } else {
                die("No se proporcionó un usuario válido.");
            }

                
        ?>

    </div>

    <h1 class="docs">Documentos requeridos</h1>

    <!-- aqui van los documentos requeridos -->
    <?php
        $conexion = new mysqli("localhost", "root", "", "sistema_inc");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        //consulta para obtener las rutas de los documentos del alumno
        $consulta = $conexion->prepare("SELECT tipo_documento.nombre, tipo_documento.ruta_doc FROM tipo_documento JOIN alumno_datos ON tipo_documento.fk_alumno = alumno_datos.pk_alumno WHERE alumno_datos.fk_usuarios = ?");
        $consulta->bind_param("i", $pk_usuario);
        $consulta->execute();
        $resultado_docs = $consulta->get_result();

        while ($doc = $resultado_docs->fetch_assoc()) {
            echo '<div class="certificado">
                <div class="grupo">
                <h4>' . htmlspecialchars($doc['nombre']) . '</h4>';

            $ruta_fisica = __DIR__ . '/' . $doc['ruta_doc'];
            if (!empty($doc['ruta_doc']) && file_exists($ruta_fisica)) {
                echo '<a href="ver-documento.php?doc=' . urlencode($doc['ruta_doc']) . '" class="ver-doc" target="_blank">Ver documento</a>';
            } else {
                echo '<span style="color:red;">Documento no disponible</span>';
            }

            echo '</div></div>';
        }

    ?>

    <!--Aqui van los botones para aceptar o rechazar-->
    <div class="boones">
        <form action="validar-ficha.php" method="post">
            <input type="hidden" name="pk_usuario_alumno" value="<?= $pk_usuario ?>">
            <input type="hidden" name="pk_padre" value="<?= $row['pk_padre'] ?>">
            <input type="hidden" name="padre_email" value="<?= $row['padre_email'] ?>">
            <input type="hidden" name="accion" value="aceptar">
            <button type="submit" class="aceptar">Aceptar</button>
        </form>

        <form action="rechazar-ficha.php" method="post">
            <input type="hidden" name="pk_usuario_alumno" value="<?= $pk_usuario ?>">
            <input type="hidden" name="pk_padre" value="<?= $row['pk_padre'] ?>">
            <input type="hidden" name="padre_email" value="<?= $row['padre_email'] ?>">
            <input type="hidden" name="accion" value="rechazar">
            <button type="submit" class="rechazar">Rechazar</button>
        </form>
    </div>

</main>
    
</body>
</html>