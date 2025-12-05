<!-- PHP para manejar la búsqueda -->
<?php
$resultado_busqueda = null;
$buscar = "";
$mostrar_todos = true;
$resultado_a_mostrar = null; // Inicializamos la variable principal para mostrar resultados

$conexion = new mysqli("localhost", "root", "", "sistema_inc");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['buscar']) && !empty(trim($_POST['buscar']))) {
    $buscar = trim($_POST['buscar']);
    $mostrar_todos = false;

    // Consulta SQL para buscar usuarios por nombre o apellido
    $sql_buscar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE (usuarios.nombre LIKE ? OR usuarios.apellido LIKE ?) AND rol.pk_rol = 1";
    
    $stmt = $conexion->prepare($sql_buscar);
    $like_buscar = "%" . $buscar . "%";
    $stmt->bind_param("ss", $like_buscar, $like_buscar);
    $stmt->execute();
    $resultado_busqueda = $stmt->get_result();
    $stmt->close();
    
    // Si se hizo búsqueda, $resultado_a_mostrar es el resultado de la búsqueda
    $resultado_a_mostrar = $resultado_busqueda;

} else {
    // Si NO se hizo búsqueda (o se cargó por primera vez), obtenemos TODOS
    $sql_todos = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol WHERE rol.pk_rol = 1";
    $resultado_todos = $conexion->query($sql_todos);
    
    // Si no se hizo búsqueda, $resultado_a_mostrar es el resultado de todos
    $resultado_a_mostrar = $resultado_todos;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de usuarios</title>
<link href="css/GlobalStyle.css" rel="stylesheet">
<link rel="stylesheet" href="css/pruebaVerUsuarios-director.css">
<script src="https://kit.fontawesome.com/13cae7644c.js" crossorigin="anonymous"></script>
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

<section id="sistema-escolar" class="sistema-escolar">
<div class="container">
    <h1>Usuarios</h1>

    <!--el buscador-->
    <form action="" method="POST">
      <input type="search" name="buscar" id="buscar" placeholder="Buscar usuario..." value="<?php echo htmlspecialchars($buscar); ?>">
      <button type="submit" id="buscar-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <main>

      <!-- Mostrar resultados de búsqueda si existen -->
       <?php

        // 1. Verifica si hay resultados para mostrar Y si el objeto no es nulo
        if ($resultado_a_mostrar && $resultado_a_mostrar->num_rows > 0) {
            
            
            // La condición while es para recorrer todas las filas del resultado y mostrarlas
            while ($row = $resultado_a_mostrar->fetch_assoc()) {
                echo '<div class="card-container-user">';
                
                // Verificar si el archivo existe
                $foto = !empty($row["foto_perfil"]) ? $row["foto_perfil"] : "icon-7797704_640.png";
                $rutaWeb = "fotos_perfil/" . $foto;

                // Mostrar imagen
                echo '<img src="' . htmlspecialchars($rutaWeb) . '" alt="usuario">';

                // Asegúrate de incluir el apellido que ahora estás seleccionando
                echo '<h2>' . htmlspecialchars($row["nombre"]) .'</h2>'; 
                echo '<h3 class="roli">' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
                
                // Bloque de botones
                echo '<div class="group-buttons">';
                echo '<a id="consultar" href="vista-director-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';
                echo '<a id="editar" href="vista-director-edituser.php?pk_usuario=' . $row["pk_usuario"] . '">Editar</a>';

                // Modal de eliminación
                $nombreCompleto = addslashes($row["nombre"] . ' ' . $row["apellido"]);
                echo '<a id="eliminar" href="javascript:void(0);" onclick="eliminarUsuarioModal(' . $row['pk_usuario'] . ', \'' . $nombreCompleto . '\'); return false;">Eliminar</a>';
                echo '</div>';
                echo '</div>';
            }
            
        } elseif (!$mostrar_todos) {
            // Caso: Se buscó, pero no se encontró nada
            echo '<p style="text-align: center; width: 100%;">No se encontraron usuarios que coincidan con "' . htmlspecialchars($buscar) . '".</p>';
        } else {
            // Caso: No se hizo búsqueda y $resultado_a_mostrar no tenía filas (la tabla está vacía)
            echo '<p style="text-align: center; width: 100%;">No hay usuarios registrados en este momento.</p>';
        }
      ?>

      <?php

      if($mostrar_todos){
      
      ?>

      <a href="vista-director-adduser.html" id="link-add-user">
      <div id="card-add-user">
      <h3 id="plus">+</h3>
      <h3 class="kk">Agregar usuario</h3>
      </div>
      </a>

      <?php
      }
      ?>

    </main>
  </div>
    </section>

    <!-- Modal de confirmación -->
    <div id="eliminarUsuarioModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modal-text">¿Estás seguro de eliminar este usuario?</p>
        <div class="modal-buttons">
          <button id="btn-confirmar">Sí, eliminar</button>
          <button id="btn-cancelar">Cancelar</button>
        </div>
      </div>
    </div>

    <script>
      let usuarioAEliminar = null; //variable global para almacenar el id del usuario a eliminar
      const modal = document.getElementById("eliminarUsuarioModal");
      const modalText = document.getElementById("modal-text");
      
      // Mostrar el modal
      function eliminarUsuarioModal(pk_usuario, nombre) {
          usuarioAEliminar = pk_usuario; //almacenar el id del usuario a eliminar
          modalText.textContent = `¿Estás seguro de eliminar al usuario ${nombre}?`;
          modal.classList.add("show"); // Usar 'flex' para centrar si el CSS lo permite
      }

      function cerrarModal() {
          modal.classList.remove("show");
          usuarioAEliminar = null; // Limpiar el ID
      }
      
      function confirmarEliminacion() {
          if (usuarioAEliminar !== null) {
              fetch(`eliminar_usuario.php?pk_usuario=${usuarioAEliminar}`)
                  .then(response => {
                      if (response.ok) {
                          // Si es exitoso (respuesta 200-299), recarga
                          location.reload(); 
                      } else {
                          // Si hay error en el lado del servidor
                          alert("Error del servidor al eliminar el usuario.");
                          cerrarModal();
                      }
                  })
                  .catch(error => {
                      // Si hay error de conexión/red
                      alert("Error de conexión al intentar eliminar: " + error);
                      cerrarModal();
                  });
          }
      }

      document.addEventListener('DOMContentLoaded', () => {
          const spanClose = document.getElementsByClassName("close")[0];
          const confirmarBtn = document.getElementById("btn-confirmar");
          const cancelarBtn = document.getElementById("btn-cancelar");

          // Botones dentro del modal
          if (confirmarBtn) confirmarBtn.onclick = confirmarEliminacion;
          if (cancelarBtn) cancelarBtn.onclick = cerrarModal;
          if (spanClose) spanClose.onclick = cerrarModal;

          // Event listener para cerrar el modal al hacer clic fuera de él
          window.onclick = function(event) {
              if (event.target == modal) {
                  cerrarModal();
              }
          }
      });

    </script>
  <?php
$conexion->close();
?>

</body>