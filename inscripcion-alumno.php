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
        box-shadow: 0 10px 8px rgba(0, 0, 0, 0.3);
        margin-bottom: 5%;
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

    #separator{
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

    h3{
        font-size: 1.5rem;
    }


    #nombre{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1330px;
        border-radius: 10px;
        margin-left: 0%;
        font-weight: 300;
        color: #666161ff;
    }

    #curpp{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1465px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #fecha{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 130px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #gradop{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 110px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #direccionp{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 605px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #nom{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 1335px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #parentezco{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 250px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #emaill{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 985px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #tel-personal{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 550px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #tel-fijo{
        display: inline-block;
        padding: 0 25px;
        font-size: 1.5rem;
        background: #D9D9D9;
        width: 550px;
        border-radius: 10px;
        font-weight: 300;
        color: #666161ff;
    }

    #group1{
        text-align: justify;
        padding: 0 25px;
    }

    #group2{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    #group3{
        text-align: justify;
        padding: 0 25px;
    }

    #group4{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    #group5{
        text-align: left;
        padding: 0 25px;;
        display: flex;
        gap: 15px;
        align-items: center;
        margin-bottom: 30px;
    }

    #black{
        margin-top: 2%;
        width: 90%;
    }

    #datos_padre{
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

    /* parte de los documentos requeridos */
    .certificado{
        background: #ebe3abff;
        width: 85%;
        height: auto;
        margin: auto;
        border: none;
        padding: 40px;
        border-radius: 25px;
        text-align: center;
        margin-top: 5%;
    }

    .grupo{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    h4{
        font-size: 2.5rem;
        font-weight: 400;
        margin-right: 30%;
    }

    .ver-doc{
        background: #A2BFF5;
        border: none;
        padding: 40px;
        font-size: 1.5rem;
        border-radius: 25px;
        margin-left: 20%;
        cursor: pointer;
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

        <hr id="separator">

        <button id="datos_alumno">Datos del alumno</button>

        <!-- aqui se muestran los datos del alumno -->
         <?php
            $conexion = new mysqli("localhost", "root", "", "sistema_inc");
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            //como es un usuario individual, verificamos el pk_usuario
            if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];
                    
                //consultas preparadas
                //en la cinsulta hacemos un join con el usuario, rol y alumno para obtener todos los datos necesarios
                //el ? es un marcador de posición para el pk_usuario que se pasará más adelante
                $stmt = $conexion->prepare("SELECT alumno.pk_usuario, alumno.nombre AS alumno_nombre, alumno.apellido AS alumno_apellido, padre.nombre AS padre_nombre, padre.apellido AS padre_apellido, padre.pk_usuario AS pk_padre, padre.telefono AS padre_telefono, padre.telefonoFijo AS telefono_fijo, padre.parentezco AS parentezco, padre.email AS padre_email, alumno.direccion AS alumno_direccion, alumno.estado AS alumno_estado, alumno_datos.fecha_nacimiento, alumno_datos.CURP, alumno_datos.fk_grado, alumno_datos.fk_usuarios FROM usuarios AS alumno JOIN rol ON alumno.fk_rol = rol.pk_rol JOIN alumno_datos ON alumno.pk_usuario = alumno_datos.fk_usuarios LEFT JOIN padre_alumno ON padre_alumno.fk_alumno = alumno.pk_usuario LEFT JOIN usuarios AS padre ON padre.pk_usuario = padre_alumno.fk_padre WHERE alumno.pk_usuario = ?");
                $stmt->bind_param("i", $pk_usuario); // "i" indica que el parámetro es un entero. y el parametro representa el pk_usuario
                $stmt->execute(); // Ejecuta la consulta
                $resultado = $stmt->get_result(); // Obtiene el resultado de la consulta

                if($resultado->num_rows > 0) { //si el resultado tiene filas
                    $row = $resultado->fetch_assoc(); //obtiene los datos del usuario
                    //mostrar los datos del alumno en la ficha de inscripción
                    echo "<div id='group1'>";
                    echo "<h3>Nombre completo:     ". "<label id='nombre'>". $row['alumno_nombre'] . " " . $row['alumno_apellido'] . "</label>" . "</h3>";
                    echo "<h3>CURP:    ". "<label id='curpp'>". $row['CURP']. "</label>" . "</h3>";
                    echo "</div>";

                    echo "<div id='group2'>";
                    echo "<h3>Fecha nacimiento:    </h3>". "<label id='fecha'>". $row['fecha_nacimiento'] . "</label>";
                    echo "<h3>Grado a inscribir:   </h3>". "<label id='gradop'>". $row['fk_grado'] . "er grado </label>";
                    echo "<h3>Direccion:</h3>". "<label id='direccionp'>". $row['alumno_direccion'] . " </label>";
                    echo "</div>";

                    echo "<hr id='black'>";

                    echo "<button id='datos_padre'>Datos del padre o tutor</button>";

                    echo "<div id='group3'>";
                    echo "<h3>Nombre completo:   ". "<label id='nom'>". $row['padre_nombre']. " ". $row['padre_apellido']. "</label>"."</h3>";
                    echo "</div>";
                    echo "<div id='group4'>";
                    echo "<h3>Parentezco:    </h3>". "<label id='parentezco'>". $row['parentezco'] . "</label>";
                    echo "<h3>Correo:   </h3>". "<label id='emaill'>". $row['padre_email'] . "</label>";
                    echo "</div>";
                    echo "<div id='group5'>";
                    echo "<h3>Teléfono personal:    </h3>". "<label id='tel-personal'>". $row['padre_telefono'] . "</label>";
                    echo "<h3>Teléfono fijo:   </h3>". "<label id='tel-fijo'>". $row['telefono_fijo'] . "</label>";
                    echo "</div>";
                }

            } else {
                die("No se proporcionó un usuario válido.");
            }

                
        ?>

    </div>

    <h1>Documentos requeridos</h1>

    <div class="certificado">
        <div class="grupo">
            <h4>Certificado de preescolar</h4>
            <button class="ver-doc">Ver documento</button>
        </div>
    </div>

    <div class="certificado">
        <div class="grupo">
            <h4>CURP</h4>
            <button class="ver-doc">Ver documento</button>
        </div>
    </div>

    <div class="certificado">
        <div class="grupo">
            <h4>Acta de nacimiento</h4>
            <button class="ver-doc">Ver documento</button>
        </div>
    </div>

    <div class="certificado">
        <div class="grupo">
            <h4>Cartilla de vacunación</h4>
            <button class="ver-doc">Ver documento</button>
        </div>
    </div>

</main>
    
</body>
</html>