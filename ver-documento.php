<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver documento</title>
</head>
<body>

<style>

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        line-height: 1.6;
        color: #333;
        background: #f7f1c9ff;
        margin: 0;
    }

    main{
        margin: 0px;
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

    /*estilo del main*/
    img{
        width: 300px;
        height: 300px;
        margin-left: 42%;
        margin-top: 5%;
    }

    a{
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
        border: none;
        cursor: pointer;
        text-decoration: none;
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

<!--por si no se mando ningún documento-->

<img src="imagenes/informacion.png" alt="no se ha enviado ningún documento">

<h2 style="text-align: center; margin-top: 30px; font-size: 1.8rem;">No se ha enviado ningún documento para visualizar</h2>

<p style="text-align: center; margin-top: 10px; font-size: 1.2rem;">Parece que el usuario no envió ningún documento.</p>

<a href="inscripcion-alumno.php?pk_usuario='. htmlspecialchars($row['pk_usuario']) . '">Regresar</a>

<!-- Código PHP para mostrar el documento -->

    <?php
        $conexion = new mysqli("localhost", "root", "", "sistema_inc");
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        if (isset($_GET['doc'])) {
            $ruta_doc = $_GET['doc'];

            // Validar y sanitizar la ruta del documento
            $ruta_doc = realpath($ruta_doc);
            $directorio_permitido = realpath('documentos/'); // Ajusta esto según tu estructura de directorios

            if (strpos($ruta_doc, $directorio_permitido) === 0 && file_exists($ruta_doc)) {
                $tipo_mime = mime_content_type($ruta_doc);
                header('Content-Type: ' . $tipo_mime);
                header('Content-Disposition: inline; filename="' . basename($ruta_doc) . '"');
                readfile($ruta_doc);
                exit;
            } else {
                echo "<p>Documento no encontrado o acceso no permitido.</p>";
            }
        } else {
            echo "<p>No se especificó ningún documento.</p>";
        }

    ?>

</main>
    
</body>
</html>