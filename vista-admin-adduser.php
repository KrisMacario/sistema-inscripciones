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
    echo "<p>Archivo recibido: " . $_FILES['foto']['name'] . "</p>";
    echo "<p>Error de subida: " . $_FILES['foto']['error'] . "</p>";

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




    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //insertar user
        $sql = "INSERT INTO usuarios(nombre, apellido, telefono, telefonoFijo, email, contraseña, fk_rol, estado, foto_perfil) VALUES('$nombre_admin', '$apellido_admin', '$telefono_personal', '$telefono_fijo', '$email_admin', '$contra_admin', 1, 'Activo', '$foto')";
        $conexion -> query($sql);
        $pk_usuario = $conexion -> insert_id;

        $conexion -> commit();

        echo "Agregado exitosamente";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }

?>