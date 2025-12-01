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
            margin: 20px;
            border: none;
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 8px rgba(0, 0, 0, 0.1);
        }

        table{
            border-collapse: separate;
            border-spacing: 10px 25px;
            margin: 20px;
        }

        th{
          font-size: 1.5rem;
        }

        td{
          font-size: 1.2rem;
        }

        tbody tr{
          text-align: center
        }
        
        td button{
          padding: 15px;
          font-size: 1rem;
          cursor: pointer;
          background: #A2BFF5;
          border: none;
          border-radius: 25px;
          color: #2e2e2eff;
          margin-left: 5px;
        }

        .estado-gris{
          background: #cfe0ffff;
          font-weight: bold;
          padding: 15px;
          border-radius: 25px;
          cursor: auto;
        }

        .estado-verde{
          background-color: #A2F5A2;
          font-weight: bold;
          padding: 15px;
          border-radius: 25px;
          cursor: auto;
        }

        .estado-rechazado{
          background-color: #F5A2A2;
          font-weight: bold;
          padding: 15px;
          border-radius: 25px;
          cursor: auto;
        }

    </style>


  <!-- Navegación -->
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
        </ul>
      </div>
    </div>
  </nav>

  <!-- Cuerpo -->
  <section id="sistema-escolar" class="sistema-escolar">
    <div class="container">
      <h2>Alumnos de nuevo ingreso</h2>

      <!-- aqui empieza la tabla y el php -->
      <div class="cont-user"> 

      <table class="table table-bordered" id="tabla">

        <colgroup>
          <col style="width: 44%;">
          <col style="width: 20%;">
          <col style="width: 45%;">
        </colgroup>

        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Estado</th>
          </tr>
        </thead>

        <?php
          $conexion = new mysqli("localhost", "root", "", "sistema_inc");
          if ($conexion->connect_error) {
              die("Error de conexión: " . $conexion->connect_error);
          }
          $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.estado, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 6";
          $resultado = $conexion->query($sql_verificar);
          //la condicion while es para recorrer todas las filas del resultado y mostrarlas
          while ($row = $resultado->fetch_assoc()){ //mientras haya filas en el resultado, el fetch_assoc las va obteniendo una por una
              echo "<tbody>";
              echo "<tr>";
              echo "<td>". $row["nombre"] . "</td>";
              echo "<td>". $row["apellido"] . "</td>";
              $estado = strtolower($row["estado"]);
              $clase_estado = "";

                if ($estado === "aceptado") {
                    $clase_estado = "estado-verde";
                } elseif ($estado === "rechazado") {
                    $clase_estado = "estado-rechazado";
                } else {
                    $clase_estado = "estado-gris";
                }
                echo "<td><button class='estado " . $clase_estado . "'>". $row["estado"] . "</button></td>";
                
              echo "</tr>";
              echo "</tbody>";
          }
      ?>

      </table>

      </div>
      
    </div>
  </section>

</body>
</html>
