<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

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
            $stmt = $conexion->prepare("SELECT usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE usuarios.pk_usuario = ?");
            $stmt->bind_param("i", $pk_usuario);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc(); //obtener datos del usuario
                echo "<h1>Perfil de usuario</h1>";
                echo "<h2>Nombre: " . $row['nombre'] . "</h2>";
                echo "<h2>Apellido: " . $row['apellido'] . "</h2>";
                echo "<h2>Rol: " . $row['nombre_rol'] . "</h2>";
            } 

        } else {
            echo "ID de usuario no proporcionado.";
            exit;
        }
            

    ?>

</body>
</html>