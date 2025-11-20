<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escuela Primaria Rosalinda Guerrero Gamboa</title>
  <meta name="description" content="Escuela Primaria Rosalinda Guerrero Gamboa - Educación de calidad para niños">
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

        a{
            text-decoration: none;
            color: #4d4c4cff;
        }

        .cont-user{
            margin-top: 30px;
            border: solid 1px #000;
            
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
      <h2>Alumnos de nuevo ingreso</h2>

      <div class="cont-user">
      <?php
        $conexion = new mysqli("localhost", "root", "", "sistema_inc");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }
        $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 6";
        $resultado = $conexion->query($sql_verificar);
        //la condicion while es para recorrer todas las filas del resultado y mostrarlas
        while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado
            echo "<table class='table table-bordered' id='tabla'>".
            "<thead>".
            "<tr>".
              "<th scope='col'>Nombre</th>".
              "<th scope='col'>Apellido</th>".
              "<th scope='col'>Estado</th>".
            "</tr>".
          "</thead>".
          "<tbody>".
            "<tr>".
              "<td>". $row["nombre"] . "</td>".
              "<td>". $row["apellido"] . "</td>".
              "<td>". $row["estado"] . "</td>".
            '<td><button onclick="window.location.href=\'vista-admin-perfil-usuario.php?pk_usuario='. $row["pk_usuario"] . '\'"> Ver perfil </button></td>'.
            "</tr>".
          "</tbody>".
            "</table>";
        }
    ?>
    </div>
      
    </div>
  </section>

</body>
</html>
