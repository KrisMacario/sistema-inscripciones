<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


    <h1 class="text-center">Usuarios</h1>

    <table class="table table-dark table-striped">

        <!--Aqui se integra el php-->
        <?php
        $conexion = new mysqli("localhost", "root", "", "sistema_inc");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.direccion, usuarios.telefono, usuarios.email, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol";
        $resultado = $conexion->query($sql_verificar);

        echo " <tr> <th>ID</th> <th>Nombre</th><th>Apellido/s</th><th>Dirección</th><th>Telefono</th><th>Email</th><th>Rol</th></tr>";
        while ($row = $resultado->fetch_assoc()){
            echo "<tr> <th> ".$row["pk_usuario"]."</th>".
            "<th>".$row["nombre"]."</th>".
            "<th>".$row["apellido"]."</th>".
            "<th>".$row["direccion"]."</th>".
            "<th>".$row["telefono"]."</th>".
            "<th>".$row["email"]."</th>".
            "<th>".$row["nombre_rol"]."</th>".
            "</tr>";
        }

        ?>

    </table>


    <!--Los estilos-->

    <style>

        

    </style>

    
</body>
</html>
