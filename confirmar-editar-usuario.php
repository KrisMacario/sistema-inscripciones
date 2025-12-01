<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizado exitosamente</title>
</head>
<body>

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f7f1c9ff;
            text-align: center;
            margin: 0;
        }

        h1{
            text-align: center;
            margin-top: 20px;
        }

        main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
            margin-top: 5%;
        }

        img{
            object-fit: cover;
            width: 150px;
            border-radius: 20%;
            margin-left: 20px;
        }

        button{
            margin-top: 2%;
            background-color: #4A90A4;
            padding: 10px;
            width: 20%;
            text-align: center;
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }

        /*estilo de la barra de navegación*/

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1rem;
    }

    nav {
      background: #4A90A4;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
    }

    .nav-brand {
      color: #fff;
      font-weight: 700;
      font-size: 1.25rem;
      line-height: 1.3;
    }

    .nav-menu {
      display: flex;
      gap: 2rem;
      align-items: center;
      list-style: none;
    }

    .nav-menu a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .nav-menu a:hover {
      color: #F4E4A6;
    }

    .btn-sistema {
      background: #F4E4A6;
      color: #2c3E50;
      padding: 0.5rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s;
    }

    .btn-sistema:hover {
      background: #e8d890;
    }

    /*estilo dentro del main*/
    main img{
        display: block;
        margin: auto;
        margin-top: 5%;
        text-align: center
    }

    a{
        text-decoration: none;
    }

    </style>

    <!--navigation bar-->
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

  <main>
    <img src="imagenes/simbolo-correcto.png" alt="Estudiantes de primaria" height="150">



    <?php

    $conexion = mysqli_connect("localhost","root","","sistema_inc");

    if($conexion->connect_error){
        die("Error de conexion: ". $conexion->connect_error);
    }
    
    #datos ingresados en el formulario
    $nombre_admin = $_POST['nombre_admin'];
    $apellido_admin = $_POST['apellido_admin'];
    $telefono_personal = $_POST['telefono_personal'];
    $telefono_fijo = $_POST['telefono_fijo'];
    $email_admin = $_POST['email_admin'];
    $foto = 'icon-7797704_640.png'; // Imagen por defecto
    
    #datos que ya existian en el sistema
    $Legacy_nombre_admin = null;
    $Legacy_apellido_admin = null;
    $Legacy_telefono_personal = null;
    $Legacy_telefono_fijo = null;
    $Legacy_email_admin = null;
    $Legacy_foto = null;

    if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];

                //consultas preparadas
                $stmt = $conexion->prepare("SELECT nombre, apellido, telefono, telefonoFijo, email, foto_perfil  FROM usuarios  WHERE pk_usuario=?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario
                    $Legacy_nombre_admin = $row['nombre'];
                    $Legacy_apellido_admin = $row['apellido'];
                    $Legacy_telefono_personal = $row['telefono'];
                    $Legacy_telefono_fijo = $row['telefonoFijo'];
                    $Legacy_email_admin = $row['email'];
                    $Legacy_foto = $row['foto_perfil'];
                } 
                echo "";
            } else {
                echo "ID de usuario no proporcionado.";
                exit;
            }

if (isset($_FILES['foto'])) {
    

    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoNombre = uniqid() . "_" . basename($_FILES['foto']['name']);
        $destino = __DIR__ . "/fotos_perfil/" . $fotoNombre;
        if (move_uploaded_file($fotoTmp, $destino)) {
            $foto = $fotoNombre;
        }

        // Verificación de escritura
        $test = __DIR__ . "/fotos_perfil/test.txt";
        if (file_put_contents($test, "Prueba de escritura")) {
           echo "";
        } else {
            echo "";
        }
    } else {
        echo "";
    }
}

// hacer comparativa (si la persona no rellena nada, se le da el valor que ya tenia)

    if ($nombre_admin == null) $nombre_admin = $Legacy_nombre_admin;
    if ($apellido_admin == null) $apellido_admin = $Legacy_apellido_admin;
    if ($telefono_personal == null) $telefono_personal = $Legacy_telefono_personal;
    if ($telefono_fijo == null) $telefono_fijo = $Legacy_telefono_fijo;
    if ($email_admin == null) $email_admin = $Legacy_email_admin;
    if ($foto == null) $foto = $Legacy_foto;

    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //update
        $sql = "UPDATE usuarios SET nombre='$nombre_admin', apellido='$apellido_admin', telefono='$telefono_personal', telefonoFijo='$telefono_fijo', email='$email_admin', foto_perfil='$foto' WHERE pk_usuario='$pk_usuario'";
        $conexion -> query($sql);
        $pk_usuario = $conexion -> insert_id;
        $conexion->commit();
        echo "<h1>Perfil actualizado exitosamente</h1>";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }
  
?>

<button onclick="window.location.href='pruebaVerUsuarios-director.php'">Volver a la lista de usuarios</button>

    
</main>
    
</body>
</html>

