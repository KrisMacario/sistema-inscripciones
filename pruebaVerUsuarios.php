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

        .container{
            text-align: center;
            background: #f5f5f5ff;
            max-width: 350px;
            height: 500px;
            margin: 80px 50px;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 3px 8px 8px rgba(0, 0, 0, 0.3);
        }

        h1{
            text-align: center;
            margin-top: 20px;
        }

        h2, h3{
            text-align: center;
        }

        img{
            object-fit: cover;
            width: 100%;
            height: 300px;
            border-radius: 45%;
        }

        .container button{
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
        <button onclick="window.location.href='vista-admin-usuarios.html'"> X </button>
    </div>

    <h1>Lista de usuarios</h1>

    <main>

        <?php

            $conexion = new mysqli("localhost", "root", "", "sistema_inc");

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol";
            $resultado = $conexion->query($sql_verificar);

            //la condicion while es para recorrer todas las filas del resultado y mostrarlas
            while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado
                echo "<div class='container'>". //se muestra el id del usuario
                "<img src='https://bcw-media.s3.ap-northeast-1.amazonaws.com/large_Realistic_255556586487996_2736534a2a.jpg' alt='usuario'>".
                "<h2>". htmlspecialchars($row["nombre"])."</h2>". //el htmlspecialchars es para evitar inyecciones de codigo, como <script>
                "<h3>". htmlspecialchars($row["nombre_rol"])."</h3>".
                '<button onclick="window.location.href=\'vista-admin-perfil-usuario.php?pk_usuario='. $row["pk_usuario"] . '\'"> Ver perfil </button>'.
                "</div>";
            }

        ?>

    </main>


</body>
</html>