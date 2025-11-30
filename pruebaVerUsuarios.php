<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/GlobalStyle.css" rel="stylesheet">
    <style>

        #sistema-escolar .container {
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Estilos del contenedor principal */
        main {
            display: grid;
            gap: 10px;
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
            max-width: 350px;
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
            max-width: 350px;
            height: 570px;
            margin: 30px ;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
            margin-top: 50px;

        }

        #link-add-user {
            text-decoration: none;
            color: black;
            text-align: center;
            background: rgba(245, 245, 245, 0.2); /* Fondo claro para la tarjeta */
            max-width: 350px;
            height: 570px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
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
    </style>
</head>
<body>


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


    // 🔍 Verificar si el archivo existe
    $foto = !empty($row["foto_perfil"]) ? $row["foto_perfil"] : "icon-7797704_640.png";
    $rutaServidor = __DIR__ . "/fotos_perfil/" . $foto;
    $rutaWeb = "fotos_perfil/" . $foto;

    // 🔍 Mostrar imagen
    echo '<img src="' . htmlspecialchars($rutaWeb) . '" alt="usuario">';

    echo '<h2>' . htmlspecialchars($row["nombre"]) . '</h2>';
    echo '<h3>' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
    echo '<div class="group-buttons">';
    echo '<a id="consultar" href="vista-admin-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';
    echo '<button id="editar">Editar</button>';
    echo '<a id="eliminar" href="eliminar_usuario.php?id=' . $row['pk_usuario'] . '" onclick="return confirm(\'¿Estás seguro de eliminar a ' . htmlspecialchars($row['nombre']) . '?\')">Eliminar</a>';
    echo '</div>';
    echo '</div>';
}

                ?>
                
                <a href="vista-admin-adduser.html" id="link-add-user">
                    <div id="card-add-user">
                        <img src="https://cdn-icons-png.flaticon.com/512/7794/7794550.png" alt="plus" id="plus">
                        <h3>Agregar usuario</h3>
                    </div>
                </a>

            </main>
        </div>
    </section>
</body>
</html>