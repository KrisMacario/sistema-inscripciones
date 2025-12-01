<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
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

        main{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        main form{
            text-align: center;
            background: rgb(252, 251, 245);
            width: 50%;
            height: 100%;
            padding: 60px;
            border-radius: 20px;
        }

        /* Inscripción Section */


    .form-container {
      max-width: 700px;
      margin: 0 auto;
      background: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 3rem;
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
      
    }

    .form-group label {
      display: block;
      color: #4b5563;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: 0.5rem;
      font-size: 1rem;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #4A90A4;
      box-shadow: 0 0 0 3px rgba(74, 144, 164, 0.1);
    }

        .grupo label{
      display: block;
      text-align: center;
      color: #4b5563;
      font-weight: 600;
      margin-bottom: 20px;
    }

    /*boton d salir*/
    #cerrar{
        margin-right: 100%;
    }

    #cerrar button{
        font-size: 20px;
        padding: 5px 15px;
        border: none;
        border-radius: 100%;
        background-color: #ff4d4d;
        color: white;
        cursor: pointer;
    }

    .foto-preview {
      text-align: center;
      margin-bottom: 15px;
    }

    .foto-preview img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 2px solid #ccc;
      margin-top: 3%;
    }

    #fotop{
      display: block;
      text-align: center;
      color: #4b5563;
      font-weight: bold;
    }

    .custom-file-upload {
  text-align: center;
  margin-bottom: 15px;
}

.upload-label {
  display: inline-block;
  padding: 10px 20px;
  background-color: #4A90A4;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.upload-label:hover {
  background-color: #496a74;
}

input[type="file"] {
  display: none;
}

    #agregar-user{
        background-color: #4A90A4;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    #agregar-user:hover{
        background-color: #496a74;
    }


    </style>

    <div id="cerrar">
            <button onclick="window.location.href='pruebaVerUsuarios.php'">X</button>
    </div>

    <main>

        <h1>Editar usuario</h1>

        <?php

            //identificar el usuario cuyo perfil se quiere ver
            

            $conexion = new mysqli("localhost", "root", "", "sistema_inc");

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            //verificar datos del usuario
            if(isset($_GET['pk_usuario'])) {

                $pk_usuario = $_GET['pk_usuario'];

                //consultas preparadas
                $stmt = $conexion->prepare("SELECT usuarios.pk_usuario, usuarios.telefono, usuarios.email, usuarios.nombre, usuarios.apellido, usuarios.estado, usuarios.telefonoFijo, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE usuarios.pk_usuario=?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario

                    
                    echo "<form action='confirmar-editar-usuario.php' method='post' enctype='multipart/form-data'>".
                        "<label for='foto' id='fotop'>Foto de perfil:</label>".
                        "<div class='foto-preview'>".
                            "<img src='https://cdn.pixabay.com/photo/2023/02/18/11/00/icon-7797704_640.png' alt='Foto de perfil' id='preview-img'>".
                        "</div>".
                        "<div class='custom-file-upload'>".
                            "<label for='foto' class='upload-label'>Subir imagen</label>".
                            "<input type='file' name='foto' id='foto' accept='image/*'>".
                        "</div>".

                        '<div class="form-grid">'.
                            '<div class="form-group">'.
                                '<label>Nombre</label>'.
                                '<input type="text" name="nombre_admin" placeholder="'. $row['nombre'].'">'.
                            '</div>'.
                            '<div class="form-group">'.
                                '<label>Apellidos</label>'.
                                '<input type="text" name="apellido_admin" placeholder="'. $row['apellido'].'">'.
                            '</div>'.
                        '</div>'.

                        '<div class="form-grid">'.
                            '<div class="form-group">'.
                                '<label>Teléfono</label>'.
                                '<input type="text" name="telefono_personal" placeholder="'. $row['telefono'].'" maxlength="10">'.
                            '</div>'.
                            '<div class="form-group">'.
                                '<label>Apellidos</label>'.
                                '<input type="tel" name="telefono_fijo" placeholder="'. $row['telefonoFijo'].'" maxlength="10">'.
                            '</div>'.
                        '</div>'.

                        '<div class="form-group">'.
                            '<label>Teléfono fijo</label>'.
                            '<input type="email" name="email_admin" placeholder="'. $row['email'].'">'.
                        '</div>'.

                        '<button type="submit" class="upload-label" id="edit-user">Confirmar cambios</button>'.
                    "</form>";
                } 

            } else {
                echo "ID de usuario no proporcionado.";
                exit;
            }
                
        ?>
        
            
        
    </main>
    
    <!-- Script para vista previa de la foto de perfil -->
    <script>
      const inputFoto = document.querySelector('input[name="foto"]');
      const previewImg = document.getElementById('preview-img');

      inputFoto.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            previewImg.src = e.target.result;
          }
          reader.readAsDataURL(file);
        }
      });
    </script>


</body>
</html>