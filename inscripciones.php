<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción completada</title>
    <link href="css/GlobalStyle.css" rel="stylesheet"/>

</head>
<body>

    <style>

        body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f7f1c9ff;
        text-align: center;
        }

        main{
            display: flex;
            flex-direction: column;
            text-align: center;
            justify-content: center;
        }

        main img{
            width: 15%;
            height: 15%;
            margin-left: 43%;
            margin-top: 5%;
        }

        p{
            margin-top: 5%;
            font-size: 1.5rem;
        }

        #regresar_btn{
            margin-top: 5%;
            background-color: #4A90A4;
            padding: 10px;
            width: 10%;
            text-align: center;
            margin-left: 45%;
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            border-radius: 20px;
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
          <li><a href="index.html">INICIO</a></li>
          <li><a href="nosotros.php">NOSOTROS</a></li>
          <li><a href="acerca-del-equipo.html">ACERCA DEL EQUIPO</a></li>
          <li><a href="inscripciones.html">INSCRIPCIÓN</a></li>
          <li><a href="sistema_escolar.html" class="btn-sistema">SISTEMA ESCOLAR</a></li>
        </ul>
      </div>
    </div>
  </nav>

    <main>

        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Sign-check-icon.png/960px-Sign-check-icon.png" alt="Checked">

        <?php

            $conexion = new mysqli("localhost","root","","sistema_inc");
            if($conexion->connect_error){
                die("Error: ". $conexion->connect_error);
            }

            #insertar los datos del usuario
            $nombre_alumno = $_POST['nombre_alumno'];
            $apellido_alumno = $_POST['apellido_alumno'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $curp = $_POST['curp'];
            $nombre_padre = $_POST['nombre_padre'];
            $apellido_padre = $_POST['apellido_padre'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $grado = $_POST['grado'];

            //datos de los archivos
            $carpeta = "documentos/";

            $certificado_file = $_FILES['certificado_file']['name'];
            $curp_file = $_FILES['curp_file']['name'];
            $cartilla_file = $_FILES['cartilla_file']['name'];
            $acta_file = $_FILES['acta_file']['name'];

            $ruta_certificado = $carpeta . $certificado_file;
            $ruta_curp = $carpeta . $curp_file;
            $ruta_cartilla = $carpeta . $cartilla_file;
            $ruta_acta = $carpeta . $acta_file;

            //para guardarla en el servidor
            move_uploaded_file($_FILES['certificado_file']['tmp_name'], $carpeta . $certificado_file);
            move_uploaded_file($_FILES['curp_file']['tmp_name'], $carpeta . $curp_file);
            move_uploaded_file($_FILES['cartilla_file']['tmp_name'], $carpeta . $cartilla_file);
            move_uploaded_file($_FILES['acta_file']['tmp_name'], $carpeta . $acta_file);

            //iniciar transiccion
            $conexion -> begin_transaction();

            try{

                //insertar alumno
                $conexion -> query("INSERT INTO usuarios(nombre, apellido, fk_rol, estado) VALUES('$nombre_alumno', '$apellido_alumno', 6, 'Activo')");
                $pk_alumno = $conexion -> insert_id;

                //datos del alumno
                $conexion -> query("INSERT INTO alumno_datos(curp, fecha_nacimiento, fk_usuarios, fk_grado) VALUES('$curp', '$fecha_nacimiento', '$pk_alumno', '$grado')");
                $pk_alumno_datos = $conexion -> insert_id;

                //datos del padre
                $conexion -> query("INSERT INTO usuarios(nombre, apellido, telefono, email, fk_rol) VALUES('$nombre_padre', '$apellido_padre', '$telefono', '$email', 3 )");
                $pk_padre = $conexion -> insert_id;

                //datos de los archivos
                $conexion -> query("INSERT INTO tipo_documento(nombre, ruta_doc) VALUES('Certificado de kinder', '$ruta_certificado'), ('CURP', '$ruta_curp'), ('cartilla de vacunación', '$ruta_cartilla'), ('Acta de nacimiento', '$ruta_acta') ");
                $pk_padre = $conexion -> insert_id;

                $conexion -> commit();

                echo "<p>Inscrito exitosamente</p>";

            }catch(Exception $e){
                $conexion -> rollback();
                echo "Error: ". $e -> getMessage() ."";
            }

        ?>

        <a href="index.html" id="regresar_btn">Regresar
        </a>

    </main>
    
</body>
</html>


