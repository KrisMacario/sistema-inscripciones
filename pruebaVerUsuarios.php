<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/GlobalStyle.css" rel="stylesheet">
    <style>
        /* Estilos del contenedor principal */
        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px auto; /* Centrar y margen superior/inferior */
        }

        /* Estilos de la tarjeta de usuario */
        .card {
            text-align: center;
            background: #f5f5f5ff; /* Fondo claro para la tarjeta */
            max-width: 350px;
            height: 570px;
            margin: 50px 50px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
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
            margin-top: 20px;
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

        /* Estilo para el botón de eliminar (rojo) */
        #eliminar {
            background-color: #ee7171ff;
        }

        /* Estilo para el botón de editar (azul) */
        #editar {
            background-color: #6592b6ff;
        }

        /* Estilo para el botón de consultar (verde) */
        #consultar {
            background-color: #68cc79ff;
        }
    </style>
</head>
<body>


    <nav id="inicio">
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

                $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol";
                $resultado = $conexion->query($sql_verificar);

                // La condición while es para recorrer todas las filas del resultado y mostrarlas
                while ($row = $resultado->fetch_assoc()) {
                    //Mientras haya filas en el resultado
                    echo '<div class="card container-user">';
                    // Se muestra el id del usuario
                    echo '<img src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/large_Realistic_255556586487996_2736534a2a.jpg" alt="usuario">';
                    echo '<h2>' . htmlspecialchars($row["nombre"]) . '</h2>'; // El htmlspecialchars es para evitar inyecciones de código.
                    echo '<h3>' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
                    echo '<div class="group-buttons">';
                    
                    // Botón para Ver Perfil/Consultar
                    echo '<a id="consultar" href="vista-admin-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';

                    // Botón para Editar (Se puede dejar el placeholder por ahora)
                    echo '<button id="editar">Editar</button>';

                    // Botón para Eliminar (TU CÓDIGO CORREGIDO)
                    // Usa el enlace que apunta a eliminar_usuario.php con el ID.
                    // El onclick pide confirmación antes de navegar.
                    echo '<a id="eliminar" href="eliminar_usuario.php?id=' . $row['pk_usuario'] . '" onclick="return confirm(\'¿Estás seguro de eliminar a ' . htmlspecialchars($row['nombre']) . '?\')">Eliminar</a>';
                    
                    echo '</div>'; // Cierre de div.group-buttons
                    echo '</div>'; // Cierre de div.card
                }
                ?>
                
                <a href="vista-admin-adduser.html">
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