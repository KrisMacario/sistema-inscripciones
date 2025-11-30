<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha rechazada</title>
</head>
<body>

<style>

    body{
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f7f1c9ff;
        margin: auto;
    }

    main{
        margin: 20px;
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

    /*form*/
    form{
        text-align: center;
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 30px;
    }

    .enviar{
        margin-top: 10px;
        background-color: #4A90A4;
        padding: 10px 20px;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 1.2rem;
        cursor: pointer;
    }

    label{
        font-size: 1.2rem;
        margin-bottom: 2%;
    }

    textarea{
        margin-top: 10px;
        padding: 10px;
        font-size: 1rem;
        border-radius: 10px;
        border: 1px solid #ccc;
        width: 40%;
        margin-bottom: 1%;
        resize: vertical;
    }

    /*boton regresar*/
    .bak{
        margin-top: 50px;
        margin-left: 42%;
        background-color: #4A90A4;
        padding: 10px;
        width: 15%;
        text-align: center;
        color: #fff;
        text-decoration: none;
        font-size: 1.5rem;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        justify-content: center;
        text-decoration: none
    }
    

</style>

<!--navegación-->
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

<main>

    <img src="imagenes/Screenshot_20251129_183328-removebg-preview.png" alt="Rechazada" height="180">
    <h1 style="text-align: center; margin-top: 20px;">Ficha rechazada</h1>

    <!--mensaje del admin para el padre del alumno-->
    <form action="" method="post">
        <label for="mensaje_rechazo">Escriba el mensaje del motivo del rechazo, sera enviado al correo del padre:</label>
        <textarea id="mensaje_rechazo" name="mensaje_rechazo" rows="5" cols="60"></textarea>
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