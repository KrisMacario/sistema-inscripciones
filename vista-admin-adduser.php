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

    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //insertar alumno
        $conexion -> query("INSERT INTO usuarios(nombre, apellido, telefono, telefonoFijo, email, contraseña, fk_rol, estado) VALUES('$nombre_admin', '$apellido_admin', '$telefono_personal', '$telefono_fijo', '$email_admin', 'abcde', 1, 'Activo')");
        $pk_usuario = $conexion -> insert_id;

        $conexion -> commit();

        echo "Agregado exitosamente";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }

?>