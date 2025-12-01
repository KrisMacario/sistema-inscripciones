<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripcion del alumno</title>
</head>
<body>

<style>

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f7f1c9ff;
        text-align: center;
        margin: 0;
    }

    /*estilo del main*/
    main{
        margin: 0;
    }

    /*estilo de la barra de navegación*/

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    nav {
      background: #4A90A4;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
    }

    .nav-brand {
      color: #fff;
      font-weight: 700;
      font-size: 1.25rem;
      line-height: 1.3;
    }

    .nav-menu {
      display: flex;
      gap: 2rem;
      align-items: center;
      list-style: none;
    }

    .nav-menu a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .nav-menu a:hover {
      color: #F4E4A6;
    }

    .btn-sistema {
      background: #F4E4A6;
      color: #2c3E50;
      padding: 0.5rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s;
    }

    .btn-sistema:hover {
      background: #e8d890;
    }

    /*boton regresar*/
    .bak{
        position: fixed;
        top: 15%;
        left: 20px;
        background-color: #4A90A4;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 1.5rem;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
        font-weight: 800;
    }

    /*estilo de la ficha de inscripción*/

    #ficha{
        width: 90%;
        height: auto;
        margin: auto;
        border: none;
        padding: 20px;
        background-color: #fff;
        border-radius: 25px;
        text-align: center;
        box-shadow: 0 10px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 5%;
        margin-top: 5%
    }

    img{
        object-fit: cover;
        width: 15%;
        height: 15%;
        margin-top: 3%;
        margin-left: 15%;
    }

    .dib{
        display: flex;
        flex-direction: wrap;
        justify-content: center;
        margin-left: 24%;
    }

    h1{
        text-align: center;
        margin-bottom: 10px;
        color: #4d3030ff;
        font-size: 3.5rem;
    }

    h2{
        font-weight: 400;
    }

    #separator{
        background: #c4c4c4ff;
        border: none;
        margin-left: -1.2%;
        height: 55px;
        width: 1705px;
    }

    #datos_alumno{
        font-size: 2.3rem;
        background: #E2CFCF;
        padding: 20px;
        border-radius: 40px;
        border: none;
        font-weight: 600;
        width: 50%;
        margin: 30px;
        color: #4d3030ff;
    }

    h3{
        font-size: 1.5rem;
    }


    #nombre{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1330px;
        border-radius: 10px;
        margin-left: 0%;
        font-weight: 300;
        color: #666161ff;
    }

    #curpp{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1465px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #fecha{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 130px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #gradop{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 110px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #direccionp{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 605px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #nom{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1335px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #parentezco{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 250px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #emaill{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 985px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #tel-personal{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 550px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #tel-fijo{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 550px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #group1{
        text-align: justify;
        padding: 0 25px;
    }

    #group2{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #group3{
        text-align: justify;
        padding: 0 25px;
    }

    #group4{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    #group5{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 30px;
    }

    #black{
        margin-top: 2%;
        width: 90%;
    }

    #datos_padre{
        font-size: 2.3rem;
        background: #E2CFCF;
        padding: 20px;
        border-radius: 40px;
        border: none;
        font-weight: 600;
        width: 50%;
        margin: 30px;
        color: #4d3030ff;
    }

    /* parte de los documentos requeridos */
    .certificado{
        background: #ebe3abff;
        width: 85%;
        height: auto;
        margin: auto;
        border: none;
        padding: 40px;
        border-radius: 25px;
        text-align: center;
        margin-top: 5%;
    }

    .grupo{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    h4{
        font-size: 2.5rem;
        font-weight: 400;
        margin-right: 30%;
    }

    .ver-doc{
        background: #A2BFF5;
        border: none;
        padding: 40px;
        font-size: 1.8rem;
        border-radius: 25px;
        margin-left: 20%;
        cursor: pointer;
        text-decoration: none;
        color: #000;
    }

    .boones{
        margin-top: 5%;
        display: flex;
        justify-content: center;
        gap: 50%;
        margin-bottom: 80px;
        margin-right: 10%;
    }

    .aceptar{
        background: #aceea7ff;
        border: none;
        border-radius: 50px;
        padding: 20px;
        font-size: 1.8rem;
        font-weight: 600;
        width: 250%;
        cursor: pointer;
    }

    .rechazar{
        background: #FFADAD;
        border: none;
        border-radius: 50px;
        padding: 20px;
        font-size: 1.8rem;
        font-weight: 600;
        width: 250%;
        cursor: pointer;
    }

    @media (max-width: 768px) {

        /* --- GLOBAL --- */
        
        /* Asegura que el cuerpo no tenga márgenes que causen scroll lateral */
        body {
            padding: 0 10px; /* Un poco de padding en los lados */
        }

        /* Ajusta el padding general de los contenedores */
        .container {
            padding: 0 10px;
        }

        /* --- NAVEGACIÓN (nav-menu) --- */
        
        /* Ocultar el menú horizontal y mostrarlo como columna */
        .nav-menu {
            display: none; /* Oculta el menú grande por defecto */
            flex-direction: column;
            width: 100%;
            text-align: center;
            background: #4A90A4; /* Fondo del menú */
            position: absolute;
            top: 60px; /* Justo debajo de la barra de navegación */
            left: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Mostrar el menú si el usuario decide implementar un botón de "menú hamburguesa" */
        /* Por ahora, solo lo preparamos para que se muestre como columna. */
        .nav-container {
            flex-direction: column; /* Apila el logo y el menú (si se muestra) */
            align-items: flex-start;
            padding: 10px;
        }
        
        /* El botón del sistema debe ocupar todo el ancho */
        .btn-sistema {
            width: 90%;
            margin-top: 10px;
            text-align: center;
        }
        
        /* --- GRID DE TARJETAS (como en pruebaVerUsuarios_direcor.php) --- */

        /* Cambia la vista de 3 columnas a 1 columna para que las tarjetas se apilen */
        main {
            grid-template-columns: 1fr !important; /* !important es para asegurar que anule el grid existente */
            gap: 30px !important;
            margin: 20px 0 !important;
        }
        
        /* Ajusta el tamaño de la imagen del perfil en las tarjetas */
        .card-container-user img, #card-add-user img {
            width: 80px !important;
            height: 80px !important;
        }
        
        /* Ajusta el tamaño de los botones en las tarjetas de usuario */
        .group-buttons {
            flex-direction: column;
            gap: 10px;
        }
        
        .group-buttons a, .group-buttons button {
            width: 100%;
        }


        /* --- TABLAS (como en mostrar-usuarios-sistema.php) --- */

        /* Hace que la tabla no se salga de la pantalla forzando un scroll horizontal solo para ella */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Las tablas de Bootstrap se vuelven responsivas con una clase en un div contenedor */
        /* Para esto, envuelve tu tabla en un div con esta clase: */
        /* <div class="table-responsive">
            <table class="table table-dark table-striped">...</table>
        </div> */
        
        /* --- FORMULARIOS --- */
        
        /* Ajusta el ancho de los elementos de formulario y botones para que sean más grandes */
        .form-group, button {
            width: 100%;
            max-width: 400px; /* Ancho máximo para que no se extienda demasiado en tabletas */
        }
        
        /* Ajusta el ancho de botones grandes */
        #regresar_btn, button {
            width: 80%; 
            margin: 10px auto;
            padding: 15px;
            font-size: 1.1rem;
        }
        
        /* --- ANUNCIOS (en nosotros.php) --- */

        /* Cambia el grid de anuncios a una sola columna */
        .anuncios-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        /* --- Ficha de Inscripción Específica (Para este archivo) --- */

        /* Apila los grupos de datos en la ficha */
        .datos-grupo {
            flex-direction: column;
            gap: 10px;
        }

        /* Las tarjetas de documentos ocupan todo el ancho, no el 45% */
        #documentos-container {
            flex-direction: column;
            gap: 15px;
        }

        .documento-card {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        /* Apila los botones de Aceptar/Rechazar */
        .boones {
            flex-direction: column;
            gap: 15px;
            width: 90%;
        }

        .aceptar, .rechazar {
            width: 100%;
        }
    }
</style>

<!--navegación-->
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
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--boton para regresar-->
  <button class="bak" onclick="history.back()"><</button>

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

    <h1>Documentos requeridos</h1>

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