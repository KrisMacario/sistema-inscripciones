<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha validada</title>
    <link rel="stylesheet" href="css/GlobalStyle.css"/>
    <link rel="stylesheet" href="css/validar-ficha.css"/>
</head>
<body>


<!--navegación-->
<nav id="inicio">
    <div class="container">
      <div class="nav-container">
        <div class="nav-brand">
          ROSALINDA<br>
          GUERRERO<br>
          GAMBOA
        </div>
        <input type="checkbox" class="menu" id="menu">
        <label for="menu" class="burger">☰</label>
        <ul class="nav-menu">
          <li><a href="vista-admin-inicio.php">INICIO</a></li>
          <li><a href="vista-admin-inscripciones.php">INSCRIPCIONES</a></li>
          <li><a href="pruebaVerUsuarios.php">USUARIOS</a></li>
          <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
        </ul>
      </div>
    </div>
</nav>

<main>

    <img src="imagenes/simbolo-correcto.png" alt="Validado" height="150">

    <h1 style="text-align: center; margin-top: 20px;">Ficha validada correctamente</h1>

    <!--aqui empieza el codigo php para enviar la validación al correo del padre-->
    <?php

    //recibir los datos del formulario
    $pk_usuario_alumno = $_POST['pk_usuario_alumno'];
    $pk_padre = $_POST['pk_padre'];
    $padre_email = $_POST['padre_email'];
    $accion = $_POST['accion'];

    //conectar a la base de datos
    $conexion = new mysqli("localhost", "root", "", "sistema_inc");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    if ($accion === 'aceptar') { //si el admin acepta la ficha
        //actualizar el estado de la ficha en la base de datos
        $sql = "UPDATE usuarios SET estado = 'aceptado' WHERE pk_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $pk_usuario_alumno);
        $stmt->execute();



        //enviar correo al padre notificando la validación
        $to = $padre_email;
        $subject = "Ficha de inscripción validada";
        $message = "Estimado padre/madre,\n\nSu ficha de inscripción ha sido validada correctamente.\n\nSaludos cordiales,\nSistema Escolar";
        $headers = "From: no-reply@sistemaescolar.com";

        mail($to, $subject, $message, $headers);

        echo "<p style='text-align: center; margin-top: 40px; margin-bottom: 40px; font-size: 1.2rem;'>Se le ha enviado un correo de validación a: $padre_email</p>";
    }

    ?>

    <a class="bak" onclick="window.location.href='vista-admin-inscripciones.php'">Regresar a la página de inscripciones</a>

</main>
    
</body>
</html>