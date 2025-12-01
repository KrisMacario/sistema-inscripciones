<?php

    $conexion = mysqli_connect("localhost","root","","sistema_inc");

    if($conexion->connect_error){
        die("Error de conexion: ". $conexion->connect_error);
    }
    
    #datos ingresados en el formulario
    $nombre_admin = $_POST['nombre_admin'];
    $apellido_admin = $_POST['apellido_admin'];
    $telefono_personal = $_POST['telefono_personal'];
    $telefono_fijo = $_POST['telefono_fijo'];
    $email_admin = $_POST['email_admin'];
    $foto = 'icon-7797704_640.png'; // Imagen por defecto
    
    #datos que ya existian en el sistema
    $Legacy_nombre_admin = null;
    $Legacy_apellido_admin = null;
    $Legacy_telefono_personal = null;
    $Legacy_telefono_fijo = null;
    $Legacy_email_admin = null;
    $Legacy_foto = null;

    if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];

                //consultas preparadas
                $stmt = $conexion->prepare("SELECT nombre, apellido, telefono, telefonoFijo, email, foto_perfil  FROM usuarios  WHERE pk_usuario=?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario
                    $Legacy_nombre_admin = $row['nombre'];
                    $Legacy_apellido_admin = $row['apellido'];
                    $Legacy_telefono_personal = $row['telefono'];
                    $Legacy_telefono_fijo = $row['telefonoFijo'];
                    $Legacy_email_admin = $row['email'];
                    $Legacy_foto = $row['foto_perfil'];
                } 
                echo "chido";
            } else {
                echo "ID de usuario no proporcionado.";
                exit;
            }

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

// hacer comparativa (si la persona no rellena nada, se le da el valor que ya tenia)

    if ($nombre_admin == null) $nombre_admin = $Legacy_nombre_admin;
    if ($apellido_admin == null) $apellido_admin = $Legacy_apellido_admin;
    if ($telefono_personal == null) $telefono_personal = $Legacy_telefono_personal;
    if ($telefono_fijo == null) $telefono_fijo = $Legacy_telefono_fijo;
    if ($email_admin == null) $email_admin = $Legacy_email_admin;
    if ($foto == null) $foto = $Legacy_foto;

    //iniciar transiccion
    $conexion -> begin_transaction();

    try{

        //update
        $sql = "UPDATE usuarios SET nombre='$nombre_admin', apellido='$apellido_admin', telefono='$telefono_personal', telefonoFijo='$telefono_fijo', email='$email_admin', foto_perfil='$foto' WHERE pk_usuario='$pk_usuario'";
        $conexion -> query($sql);
        $pk_usuario = $conexion -> insert_id;
        $conexion->commit();
        echo "Actualizado exitosamente";

    }catch(Exception $e){
        $conexion -> rollback();
        echo "Error: ". $e -> getMessage() ."";
    }
  
?>