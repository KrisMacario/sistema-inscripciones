<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link href="css/GlobalStyle.css" rel="stylesheet">
    <style>

        #sistema-escolar .container {
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Estilos del contenedor principal */
        main {
            display: grid;
            gap: 50px;
            margin: 30px -40px; /* Centrar y margen superior/inferior */
            grid-template-columns: repeat(3, 1fr);
            
        }

        .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        }

        h3{
            margin-top: -20px;
            color: black;

        }

        #sistema-escolar .container h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 2.5rem;
            
        }

        /* Estilos de la tarjeta de usuario */
        .card-container-user {
            text-align: center;
            background: #f5f5f5ff; /* Fondo claro para la tarjeta, */
            max-width: 450px;
            height: 570px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
            margin: 50px 0;
        }

        /* Estilos para la imagen de perfil */
        img {
            object-fit: cover;
            width: 300px;
            height: 300px;
            border-radius: 45%;
        }

        /* Contenedor de botones */
        .group-buttons {
            display: flex;
            flex-direction: row;
            gap: 15px;
            margin-top: 40px;
            justify-content: center;
        }

        /* Estilos base de los botones */
        .group-buttons button, .group-buttons a {
            padding: 10px 15px;
            border-radius: 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none; /* Quitar subrayado a los enlaces */
            color: white; /* Color de texto blanco por defecto */
            display: inline-block; /* Permitir padding y width/height en 'a' */
        }

        .card-add-user {
            text-align: center;
            background: #f5f5f5ff; /* Fondo claro para la tarjeta, */
            max-width: 450px;
            height: 570px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
            margin: 50px 0;

        }

        #link-add-user {
            text-align: center;
            background: rgba(245, 245, 245, 0.2); /* Fondo claro para la tarjeta, */
            max-width: 450px;
            height: 570px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
            margin: 50px 0;
            text-decoration: none;
            color: black;

        }

        .kk{
            font-size: 1.5rem
        }

        #plus {
            margin-top: 70px;
        }

        /* Estilo para el botón de eliminar (rojo) */
        #eliminar {
            background-color: #ce6868ff;
        }

        /* Estilo para el botón de editar (azul) */
        #editar {
            background-color: #94a5e7ff;
        }

        /* Estilo para el botón de consultar (verde) */
        #consultar {
            background-color: #77cfa3ff;
        }

        a{
            text-decoration: none;
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
</html>