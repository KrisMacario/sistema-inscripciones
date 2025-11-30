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

        #subtitle{
            margin-top: 1%;
            font-size: 1.8rem;
            font-weight: 700;
        }

        #paragraph{
          margin-top: 1%;
          font-size: 1.5rem;
        }

        #regresar_btn{
            margin-top: 2%;
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
            // Validar archivos requeridos
            $requiredFiles = [
                "certificado_file" => "Certificado de preescolar",
                "curp_file"        => "CURP",
                "cartilla_file"    => "Cartilla de vacunación",
                "acta_file"        => "Acta de nacimiento"
            ];

            $errors = [];

            foreach ($requiredFiles as $field => $label) {
                if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
                    $errors[] = "Falta subir el archivo: $label.";
                } elseif ($_FILES[$field]['type'] !== "application/pdf") {
                    $errors[] = "El archivo $label debe estar en formato PDF.";
                }
            }

            // Mostrar errores si hay
            if (!empty($errors)) {
                echo "<h3>❌ No se pudo completar la inscripción:</h3><ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                exit;
            }
        ?>


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
            $domicilio = $_POST['domicilio'];
            $nombre_padre = $_POST['nombre_padre'];
            $apellido_padre = $_POST['apellido_padre'];
            $telefono = $_POST['telefono'];
            $telefono_fijo = $_POST['telefono_fijo'];
            $email = $_POST['email'];
            $grado = $_POST['grado'];
            $parentezco = $_POST['parentezco'];

            //datos de los archivos
            $carpeta = __DIR__ . "/documentos/";

            function limpiarNombreArchivo($nombre) {
              $nombre = iconv('UTF-8', 'ASCII//TRANSLIT', $nombre); // quita acentos
              $nombre = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $nombre); // reemplaza todo lo raro
              return $nombre;
            }

            $certificado_file = limpiarNombreArchivo($_FILES['certificado_file']['name']);
            $curp_file = limpiarNombreArchivo($_FILES['curp_file']['name']);
            $cartilla_file = limpiarNombreArchivo($_FILES['cartilla_file']['name']);
            $acta_file = limpiarNombreArchivo($_FILES['acta_file']['name']);

            $ruta_certificado = $carpeta . $certificado_file;
            $ruta_curp = $carpeta . $curp_file;
            $ruta_cartilla = $carpeta . $cartilla_file;
            $ruta_acta = $carpeta . $acta_file;

            function guardarArchivo($campo, $ruta) {
            if (is_uploaded_file($_FILES[$campo]['tmp_name'])) {
                if (move_uploaded_file($_FILES[$campo]['tmp_name'], $ruta)) {
                    echo "";
                } else {
                    echo "";
                }
            } else {
                echo "";
            }
        }

        guardarArchivo('certificado_file', $ruta_certificado);
        guardarArchivo('curp_file', $ruta_curp);
        guardarArchivo('cartilla_file', $ruta_cartilla);
        guardarArchivo('acta_file', $ruta_acta);

            //iniciar transiccion
            $conexion -> begin_transaction();

            try{

                //insertar alumno
                $conexion -> query("INSERT INTO usuarios(nombre, apellido, direccion, fk_rol, estado) VALUES('$nombre_alumno', '$apellido_alumno', '$domicilio', 6, 'En proceso')");
                $pk_alumno = $conexion -> insert_id;

                //datos del alumno
                $conexion -> query("INSERT INTO alumno_datos(curp, fecha_nacimiento, fk_usuarios, fk_grado) VALUES('$curp', '$fecha_nacimiento', '$pk_alumno', '$grado')");
                $pk_alumno_datos = $conexion -> insert_id;

                //datos del padre
                $conexion -> query("INSERT INTO usuarios(nombre, apellido, telefono, email, fk_rol, telefonoFijo, parentezco) VALUES('$nombre_padre', '$apellido_padre', '$telefono', '$email', 3, '$telefono_fijo', '$parentezco')");
                $pk_padre = $conexion -> insert_id;

                //insertar el padre_alumno
                $conexion -> query("INSERT INTO padre_alumno(fk_padre, fk_alumno) VALUES('$pk_padre', '$pk_alumno')");
                $pk_padre_alumno = $conexion -> insert_id;

                //datos de los archivos
                $conexion -> query("INSERT INTO tipo_documento(nombre, ruta_doc, fk_alumno) VALUES ('Certificado de kinder', 'documentos/$certificado_file', '$pk_alumno_datos'), ('CURP', 'documentos/$curp_file', '$pk_alumno_datos'), ('Cartilla de vacunación', 'documentos/$cartilla_file', '$pk_alumno_datos'), ('Acta de nacimiento', 'documentos/$acta_file', '$pk_alumno_datos')");

                $pk_tipo_doc = $conexion -> insert_id;
                $conexion -> commit();

                echo "<p id='subtitle'>El alumno fue inscrito exitosanente</p>".
                 "<p id='paragraph'>Le enviaremos un correo <br>
                 electronico para notificar su estado.</p>";

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


