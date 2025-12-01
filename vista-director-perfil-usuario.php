<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link href="css/GlobalStyle.css" rel="stylesheet"/>
</head>
<body>

    <style>

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f7f1c9ff;
        }

        main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        h1{
            text-align: center;
            margin-top: 20px;
        }

        h3{
            text-align: left;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .container-perfil{
            text-align: center;
            background: #f5f5f5ff;
            width: 700px;
            height: 600px;
            margin: 80px 50px;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
        }

        img{
            object-fit: cover;
            width: 250px;
            height: 250px;
            border-radius: 100%;
            margin-left: 20px;
        }

        #subgroup{
            display: flex;
            flex-direction: row;
        }

        #NyE{
            margin-left: 60px;
        }

        .name{
            font-size: 2rem;
            margin-top: 50px;
        }

        #edit-user{
            border: none;
            padding: 15px;
            background: #d7dee6ff;
            border-radius: 15px;
            cursor: pointer;
            margin-top: 30px;
            font-size: 1rem;
        }

        #otroGrupo{
            margin-top: 45px;
            margin-left: 30px;
        }

        hr{
            margin: 30px;
        }

        #btn-salir{
            position: fixed;
            margin: 0px 10px;
        }

        #btn-salir button{
            font-size: 20px;
            padding: 5px 15px;
            border: none;
            border-radius: 60%;
            background-color: #ff4d4d;
            color: white;
            cursor: pointer;
        }

        .name{
            margin-top: 35%;
        }
    </style>

    <!-- Botón de salir -->
    <div id="btn-salir">
        <button onclick="window.location.href='pruebaVerUsuarios-director.php'">X</button>
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