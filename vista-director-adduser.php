<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario agregado</title>
    <link rel="stylesheet" href="css/GlobalStyle.css"/>
    <link rel="stylesheet" href="css/vista-director-adduser.css"/>
</head>
<body>

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
        <input type="checkbox" class="menu" id="menu">
        <label for="menu" class="burger">☰</label>
        <ul class="nav-menu">
          <li><a href="vista-director-inicio.php">INICIO</a></li>
          <li><a href="vista-director-inscripciones.php">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios-director.php">USUARIOS</a></li>
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
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

    #insertar los datos del usuario
    $nombre_admin = $_POST['nombre_admin'];
    $apellido_admin = $_POST['apellido_admin'];
    $telefono_personal = $_POST['telefono_personal'];
    $telefono_fijo = $_POST['telefono_fijo'];
    $email_admin = $_POST['email_admin'];
    $contra_admin = $_POST['contra_admin'];
    
    $foto = 'icon-7797704_640.png'; // Imagen por defecto

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


$sql_check = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
$stmt_check = $conexion->prepare($sql_check);
$stmt_check->bind_param("s", $email_admin);
$stmt_check->execute();
$stmt_check->bind_result($count);
$stmt_check->fetch();
$stmt_check->close();

if ($count > 0) {
    echo "<script>
      alert('⚠️ Este correo ya está registrado. Usa otro.');
      window.location.href='vista-director-adduser.html';
    </script>";
    exit;
}


    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //insertar user
        $sql = "INSERT INTO usuarios(nombre, apellido, telefono, telefonoFijo, email, contraseña, fk_rol, estado, foto_perfil) VALUES('$nombre_admin', '$apellido_admin', '$telefono_personal', '$telefono_fijo', '$email_admin', '$contra_admin', 1, 'Activo', '$foto')";
        $conexion -> query($sql);
        $pk_usuario = $conexion -> insert_id;

        $conexion -> commit();

        echo "<h1>Usuario agregado con éxito</h1>
        <button onclick=\"window.location.href='vista-director-perfil-usuario.php?pk_usuario=" . $pk_usuario . "'\">Ver perfil del usuario</button>";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }

?>

<button onclick="window.location.href='vista-director-adduser.php'">Agregar otro usuario</button>

<button onclick="window.location.href='pruebaVerUsuarios-director.php'">Volver a la lista de usuarios</button>

</main>
    
</body>
</html>

