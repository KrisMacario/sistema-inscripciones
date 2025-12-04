<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link href="css/GlobalStyle.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/vista-director-edituser.css">
</head>
<body>

<nav id="inicio">
  <div class="container">
    <div class="nav-container">
      <a href="index.html">  
      <div class="nav-brand">  
        ROSALINDA<br>
        GUERRERO<br>
        GAMBOA
      </div>
      </a>
      <input type="checkbox" class="menu" id="menu">
      <label for="menu" class="burger">☰</label>
      <ul class="nav-menu">
        <li><a href="vista-director-inicio.php">INICIO</a></li>
        <li><a href="vista-director-inscripciones.php">INSCRIPCIONES</a></li>
        <li><a href="pruebaVerUsuarios-director.php">USUARIOS</a></li>
        <li><a href="sistema_escolar.html">CERRAR SESIÓN</a></li>
      </ul>
    </div>
  </div>
  </nav>

    <div id="cerrar">
            <button onclick="window.location.href='pruebaVerUsuarios-director.php'"><</button>
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
                $stmt = $conexion->prepare("SELECT usuarios.pk_usuario, usuarios.telefono, usuarios.email, usuarios.nombre, usuarios.apellido, usuarios.estado, usuarios.telefonoFijo, rol.nombre_rol, usuarios.foto_perfil FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE usuarios.pk_usuario=?");
                $stmt->bind_param("i", $pk_usuario);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc(); //obtener datos del usuario


                    
                    echo "<form action='confirmar-editar-usuario.php?pk_usuario=".$pk_usuario."' method='post' enctype='multipart/form-data'>".
                        "<label for='foto' id='fotop'>Foto de perfil:</label>".
                        "<div class='foto-preview'>".
                            "<img src='fotos_perfil/" . htmlspecialchars($row["foto_perfil"]) . "' alt='Foto de perfil' id='preview-img'>".
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
                                '<label>Teléfono personal</label>'.
                                '<input type="text" name="telefono_personal" placeholder="'. $row['telefono'].'" maxlength="10">'.
                            '</div>'.
                            '<div class="form-group">'.
                                '<label>Teléfono fijo</label>'.
                                '<input type="tel" name="telefono_fijo" placeholder="'. $row['telefonoFijo'].'" maxlength="10">'.
                            '</div>'.
                        '</div>'.

                        '<div class="form-group">'.
                            '<label>E-mail</label>'.
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