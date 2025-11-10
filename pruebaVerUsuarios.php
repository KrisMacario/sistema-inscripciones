<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/GlobalStyle.css" rel="stylesheet"/>
</head>
<body>

    <style>


        main{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px;
        }

        
        .card{
            text-align: center;
            background: #f5f5f5ff;
            max-width: 350px;
            height: 500px;
            margin: 80px 50px;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
        }

        #card-add-user{
            text-align: center;
            background: rgba(199, 197, 197, 0.3);
            width: 350px;
            height: 500px;
            margin: 80px 50px;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        #add{
            margin-top: 10px;
            text-align: center;
            display: block;
            font-size: 1.7rem;
        }

        #plus{
            width: 180px;
            height: 180px;
            margin-top: 70px;
        }

        h1{
            text-align: center;
            margin-top: 20px;
        }

        h2, h3{
            text-align: center;
        }

        h3{
            margin-top: -25px;
        }

        img{
            object-fit: cover;
            width: 300px;
            height: 300px;
            border-radius: 45%;
        }

        .container-user button{
            display: block;
            width: 60%;
            padding: 10px;
            margin: 20px auto;
            font-size: 16px;
            color: #3b3939ff;
            background-color: #D9D9D9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            margin-top: 10px;
        }

        a{
            text-decoration: none;
            color: #4d4c4cff;
        }

    </style>
    <!-- Navegación -->
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

    <!-- Cuerpo -->
    <section id="sistema-escolar" class="sistema-escolar">
        <div class="container">
            <h1>Usuarios</h1>
        </div>
        <main>
            <?php
                $conexion = new mysqli("localhost", "root", "", "sistema_inc");
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }
                $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 1";
                $resultado = $conexion->query($sql_verificar);
                //la condicion while es para recorrer todas las filas del resultado y mostrarlas
                while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado
                    echo "<div class='container-user'>". //se muestra el id del usuario
                    "<div class='card'>".
                    "<img src='https://bcw-media.s3.ap-northeast-1.amazonaws.com/large_Realistic_255556586487996_2736534a2a.jpg' alt='usuario'>".
                    "<h2>". htmlspecialchars($row["nombre"])."</h2>". //el htmlspecialchars es para evitar inyecciones de codigo, como <script>
                    "<h3>". htmlspecialchars($row["nombre_rol"])."</h3>".
                    '<button onclick="window.location.href=\'vista-admin-perfil-usuario.php?pk_usuario='. $row["pk_usuario"] . '\'"> Ver perfil </button>'.
                    "</div>".
                    "</div>";
                }
            ?>

            <a href="vista-admin-adduser.html">
            <div id="card-add-user">
                <img src="https://cdn-icons-png.flaticon.com/512/7794/7794550.png" alt="" id="plus">
                <h3 id="add">Agregar usuario</h3>
            </div>
            </a>

        </main>
    </section>

    


</body>
</html>