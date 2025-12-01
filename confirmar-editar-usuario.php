<?php

    $conexion = mysqli_connect("localhost","root","","sistema_inc");

    if($conexion->connect_error){
        die("Error de conexion: ". $conexion->connect_error);
    }

    #datos ingresados
    $nombre_admin = $_POST['nombre_admin'];
    $apellido_admin = $_POST['apellido_admin'];
    $telefono_personal = $_POST['telefono_personal'];
    $telefono_fijo = $_POST['telefono_fijo'];
    $email_admin = $_POST['email_admin'];
    $foto = 'icon-7797704_640.png'; // Imagen por defecto

if (isset($_FILES['foto'])) {
    echo "<p>Archivo recibido: " . $_FILES['foto']['name'] . "</p>";
    

    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $fotoNombre = uniqid() . "_" . basename($_FILES['foto']['name']);
        $destino = __DIR__ . "/fotos_perfil/" . $fotoNombre;
        echo "<p>Error de subida: " . $_FILES['foto']['error'] . "</p>";
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



// hacer comparativa
    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //update
<<<<<<< HEAD:confirmar-editar-usuario.php
        $sql = "UPDATE usuarios SET nombre='$nombre_admin', apellido='$apellido_admin', telefono='$telefono_personal', telefonoFijo='$telefono_fijo', email='$email_admin', foto_perfil='$foto' WHERE pk_usuario=?";
        $conexion -> query($sql);
        $pk_usuario = $conexion -> insert_id;
=======
        $sql = $conexion->prepare("UPDATE usuarios SET nombre='$nombre_admin', apellido='$apellido_admin', telefono='$telefono_personal', telefonoFijo='$telefono_fijo', email='$email_admin', foto_perfil='$foto' WHERE usuarios.pk_usuario = ?");
        if (!$stmt) {
            throw new Exception("Error en prepare: " . $conexion->error);
        }
>>>>>>> 550822c04f12bd76ed36265f42d839d8257be246:confirmar editar usuario.php

        $stmt->bind_param("ssssssi", $nombre_admin, $apellido_admin, $telefono_personal, $telefono_fijo, $email_admin, $foto, $pk_usuario);

        if (!$stmt->execute()) {
            throw new Exception("Error en execute: " . $stmt->error);
        }

        $conexion->commit();
        echo "Actualizado exitosamente";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }
  
?>