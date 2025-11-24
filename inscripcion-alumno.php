<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripcion del alumno</title>
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

    #ficha{
        width: 90%;
        height: auto;
        margin: auto;
        border: none;
        padding: 20px;
        background-color: #fff;
        border-radius: 25px;
        text-align: center;
    }

    img{
        object-fit: cover;
        width: 15%;
        height: 15%;
        margin-top: 3%;
        margin-left: 15%;
    }

    .dib{
        display: flex;
        flex-direction: wrap;
        justify-content: center;
        margin-left: 24%;
    }

    h1{
        text-align: center;
        margin-bottom: 10px;
        color: #4d3030ff;
        font-size: 3.5rem;
    }

    h2{
        font-weight: 400;
    }

    hr{
        background: #c4c4c4ff;
        border: none;
        margin-left: -1.2%;
        height: 55px;
        width: 1705px;
    }

    #datos_alumno{
        font-size: 2.3rem;
        background: #E2CFCF;
        padding: 20px;
        border-radius: 40px;
        border: none;
        font-weight: 600;
        width: 50%;
        margin: 30px;
        color: #4d3030ff;
    }

</style>

<main>

    <!-- Aquí va el contenido de la ficha de inscripción, que sera como una hoja -->
    <div id="ficha">

        <div class="dib">
            <h1>Ficha de inscripción</h1>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fc/SEP_Logo_2019.svg/1200px-SEP_Logo_2019.svg.png" alt="logo de la escuela">
        </div>

        <h2>Escuela primaria <br>
        Rosalinda Guerrero Gamboa</h2>

        <hr>

        <button id="datos_alumno">Datos del alumno</button>

        <!-- aqui se muestran los datos del alumno -->
         <?php
            $conexion = new mysqli("localhost", "root", "", "sistema_inc");
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                //los datos del alumno
                $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 1";
                $resultado = $conexion->query($sql_verificar);

                
         ?>

    </div>

</main>
    
</body>
</html>