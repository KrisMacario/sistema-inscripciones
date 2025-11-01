<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f7f1c9ff;
        }

        main{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 20px;
        }

        h1{
            text-align: center;
            margin-top: 20px;
        }

        .container-perfil{
            text-align: center;
            background: #f5f5f5ff;
            max-width: 350px;
            height: 500px;
            margin: 80px 50px;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
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
    </style>

    <!-- Botón de salir -->
    <div id="btn-salir">
        <button onclick="window.location.href='pruebaVerUsuarios.php'">X</button>
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
                $stmt = $conexion->prepare("SELECT usuarios.pk_usuario, usuarios.telefono, usuarios.email, usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE usuarios.pk_usuario = ?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario

                    echo "<div class='container-perfil'>". //se muestra el id del usuario
                    "<h2>Nombre: ". $row['nombre']."</h2>". //el htmlspecialchars es para evitar inyecciones de codigo, como <script>
                    "<h2>Apellido: ". $row['apellido']."</h3>".
                    "<h2>Rol: ". $row['nombre_rol']."</h3>".
                    "<h2>Telefono: ". $row['telefono']."</h3>".
                    "<h2>E-mail: ". $row['email']."</h3>".
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