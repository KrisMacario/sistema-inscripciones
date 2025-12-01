<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha validada</title>
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

    /*boton regresar*/
    .bak{
        margin-top: 50px;
        margin-left: 38%;
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