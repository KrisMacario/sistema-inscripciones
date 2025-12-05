<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha rechazada</title>
    <link rel="stylesheet" href="css/GlobalStyle.css"/>
    <link rel="stylesheet" href="css/rechazar-ficha.css"/>
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

    <img src="imagenes/Screenshot_20251129_183328-removebg-preview.png" alt="Rechazada" height="180">
    <h1 style="text-align: center; margin-top: 20px;">Ficha rechazada</h1>

    <!--mensaje del admin para el padre del alumno-->
    <form action="" method="post">
        <label for="mensaje_rechazo">Escriba el mensaje del motivo del rechazo, sera enviado al correo del padre:</label>
        <textarea id="mensaje_rechazo" name="mensaje_rechazo" rows="5" cols="60" required></textarea>
        <br>
        <input type="hidden" name="pk_usuario_alumno" value="<?php echo htmlspecialchars($pk_usuario_alumno); ?>">
        <input type="hidden" name="pk_padre" value="<?php echo htmlspecialchars($pk_padre); ?>">
        <input type="hidden" name="padre_email" value="<?php echo htmlspecialchars($padre_email); ?>">
        <button type="submit" name="enviar_mensaje" class="enviar">Enviar mensaje</button>
    </form>

    <!--aqui empieza el php-->
    <?php

    //recibir los datos del formulario
    $pk_usuario_alumno = $_POST['pk_usuario_alumno'];
    $pk_padre = $_POST['pk_padre'];
    $padre_email = $_POST['padre_email'];
    $accion = $_POST['accion'];

    //conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "sistema_inc");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    if($accion === "rechazar"){
        //actualizar el estado de la ficha a rechazado
        $sql = "UPDATE usuarios SET estado = 'rechazado' WHERE pk_usuario = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $pk_usuario_alumno);
        $stmt->execute();
        $stmt->close();

    }
    //procesar el envío del mensaje de rechazo
    if (isset($_POST['enviar_mensaje'])) {
        $mensaje_rechazo = $_POST['mensaje_rechazo'];

        //enviar correo al padre notificando el rechazo
        $to = $padre_email;
        $subject = "Notificación de rechazo de ficha de inscripción";
        $message = "Estimado padre/madre,\n\nLamentamos informarle que la ficha de inscripción de su hijo(a) ha sido rechazada por el siguiente motivo:\n\n" . $mensaje_rechazo . "\n\nPor favor, póngase en contacto con la administración para más detalles.\n\nSaludos cordiales,\nSistema Escolar";
        $headers = "From: no-reply@sistemaescolar.com\r\n";

        mail($to, $subject, $message, $headers);

        echo "<p style='text-align: center; color: red; font-weight: bold; margin-top: 20px;'>El mensaje de rechazo ha sido enviado al correo del padre $padre_email</p>";


    }

    ?>
    
    <a class="bak" href="vista-admin-inscripciones.php">Regresar a Inscripciones</a>

</main>
    
</body>
</html>