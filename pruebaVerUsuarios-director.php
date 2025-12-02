<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de usuarios</title>
    <link href="css/GlobalStyle.css" rel="stylesheet">
    <style>

        #sistema-escolar .container {
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Estilos del contenedor principal */
        main {
            display: grid;
            gap: 50px;
            margin: 30px -40px; /* Centrar y margen superior/inferior */
            grid-template-columns: repeat(3, 1fr);
            
        }

        @media (max-width: 900px) {
            main {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            main {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }


        .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        }

        h3{
            margin-top: -20px;
            color: black;

        }

        #sistema-escolar .container h1 {
            text-align: center;
            margin-top: 20px;
            font-size: 2.5rem;
            
        }

        /* Estilos de la tarjeta de usuario */
        .card-container-user {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f0f0f0;
            transition: transform 0.3s ease;
        }

        .card-container-user:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .card-container-user img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .card-container-user h2 {
            font-size: 1.8rem;
            margin: 5px 0;
            color: #4A90A4;
        }

        .card-container-user h3 {
            font-size: 1.2rem;
            margin: 0 0 15px 0;
            color: #555;
        }

        .group-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .group-buttons a {
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        #consultar {
            background-color: #4A90A4;
        }

        #consultar:hover {
            background-color: #3d798a;
        }

        #editar {
            background-color: #FFA500; /* Naranja */
        }

        #editar:hover {
            background-color: #cc8400;
        }

        #eliminar {
            background-color: #E74C3C; /* Rojo */
        }

        #eliminar:hover {
            background-color: #c0392b;
        }

        /* Estilos para la tarjeta de agregar usuario */
        #card-add-user {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #4A90A4;
            background-color: #eaf6ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%; /* Asegura que ocupe el espacio de una tarjeta normal */
            min-height: 200px; /* Altura mínima para que se vea bien */
            transition: background-color 0.2s ease;
        }

        #card-add-user:hover {
            background-color: #d8ecff;
        }

        #card-add-user #plus {
            width: 50px;
            height: 50px;
            opacity: 0.7;
            margin-bottom: 10px;
        }

        #card-add-user h3 {
            color: #4A90A4;
            font-weight: 700;
        }

        #link-add-user {
            text-decoration: none;
        }

        /* --- ESTILOS DEL MODAL DE CONFIRMACIÓN --- */
        
        .modal-overlay {
            display: none; /* Oculto por defecto */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 2000;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .modal-content h2 {
            margin-top: 0;
            color: #E74C3C;
        }

        .modal-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }

        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s;
        }

        #btn-confirmar {
            background-color: #E74C3C;
            color: white;
        }

        #btn-confirmar:hover {
            background-color: #c0392b;
        }

        #btn-cancelar {
            background-color: #ccc;
            color: #333;
        }

        #btn-cancelar:hover {
            background-color: #bbb;
        }

    </style>
</head>
<body>

    <!-- Navegación y otros elementos HTML (asumimos que están incluidos por GlobalStyle.css) -->

    <section id="sistema-escolar">
        <div class="container">
            <h1>Usuarios del Sistema</h1>
            <main>
                <?php
                // Archivo de conexión a la base de datos (asegúrate de que "conexion.php" sea tu archivo de conexión real)
                $conexion = new mysqli("localhost", "root", "", "sistema_inc");

                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Consulta SQL: Obtener todos los usuarios y su rol, excluyendo al rol con fk_rol = 1 (Admin)
                // Se asume que el rol 1 es el administrador principal y no debe listarse.
                $sql = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.foto_perfil, rol.nombre_rol 
                        FROM usuarios 
                        JOIN rol ON usuarios.fk_rol = rol.pk_rol
                        WHERE usuarios.fk_rol != 1
                        ORDER BY usuarios.pk_usuario ASC";

                $resultado = $conexion->query($sql);

                while ($row = $resultado->fetch_assoc()) {
                    // Determinar la ruta de la imagen
                    $rutaBase = "fotos_perfil/"; 
                    $nombreArchivo = $row["foto_perfil"];
                    
                    // Si el nombre del archivo está vacío o es nulo, usamos un placeholder.
                    if (empty($nombreArchivo) || $nombreArchivo == 'null') {
                        $rutaWeb = "https://cdn-icons-png.flaticon.com/512/3177/3177440.png"; // Placeholder
                    } else {
                        // Construye la ruta web si la imagen existe
                        // Nota: La ruta real puede depender de la configuración de tu servidor web
                        $rutaWeb = $rutaBase . htmlspecialchars($nombreArchivo);
                    }

                    // Generar la tarjeta de usuario
                    echo '<div class="card-container-user">';
                    echo '<img src="' . htmlspecialchars($rutaWeb) . '" alt="usuario">';
                    echo '<h2>' . htmlspecialchars($row["nombre"]) . ' ' . htmlspecialchars($row["apellido"]) . '</h2>';
                    echo '<h3>' . htmlspecialchars($row["nombre_rol"]) . '</h3>';
                    echo '<div class="group-buttons">';
                    
                    // Enlaces de acción
                    echo '<a id="consultar" href="vista-director-perfil-usuario.php?pk_usuario=' . $row["pk_usuario"] . '">Ver Perfil</a>';
                    echo '<a id="editar" href="vista-director-edituser.php?pk_usuario=' . $row["pk_usuario"] . '">Editar</a>';
                    
                    // Llama a la función de confirmación con modal
                    echo '<a id="eliminar" href="#" onclick="mostrarModalEliminar(' . $row['pk_usuario'] . '); return false;">Eliminar</a>';
                    
                    echo '</div>';
                    echo '</div>';
                }

                $conexion->close();
                ?>
                
                <a href="vista-director-adduser.html" id="link-add-user">
                    <div id="card-add-user">
                        <img src="https://cdn-icons-png.flaticon.com/512/7794/7794550.png" alt="plus" id="plus">
                        <h3 class="kk">Agregar usuario</h3>
                    </div>
                </a>

            </main>
        </div>
    </section>

    <!-- Modal de Confirmación Personalizado -->
    <div id="delete-modal" class="modal-overlay">
        <div class="modal-content">
            <h2>Confirmar Eliminación</h2>
            <p>¿Estás **seguro** de que deseas eliminar a este usuario del sistema? Esta acción es irreversible.</p>
            <div class="modal-buttons">
                <button id="btn-cancelar">Cancelar</button>
                <button id="btn-confirmar" data-user-id="">Eliminar</button>
            </div>
        </div>
    </div>


    <script>
        // Variable global para almacenar el ID del usuario a eliminar
        let userIdToDelete = null;
        const deleteModal = document.getElementById('delete-modal');
        const btnConfirmar = document.getElementById('btn-confirmar');
        const btnCancelar = document.getElementById('btn-cancelar');

        // 1. Mostrar el Modal
        function mostrarModalEliminar(id) {
            userIdToDelete = id; // Guarda el ID
            deleteModal.style.display = 'flex'; // Muestra el modal
        }

        // 2. Cerrar el Modal
        function cerrarModal() {
            deleteModal.style.display = 'none';
            userIdToDelete = null; // Limpia el ID
        }

        // Evento para cerrar el modal al hacer clic en Cancelar
        btnCancelar.addEventListener('click', cerrarModal);

        // Evento para cerrar el modal haciendo clic en el overlay (fondo)
        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                cerrarModal();
            }
        });

        // 3. Función para ejecutar la eliminación
        btnConfirmar.addEventListener('click', () => {
            if (userIdToDelete !== null) {
                // Ejecutar la solicitud de eliminación
                fetch("eliminar_usuario.php?id=" + userIdToDelete)
                    .then(response => response.text())
                    .then(data => {
                        // Una vez eliminado, recarga la página para ver la lista actualizada
                        // En un entorno de producción, sería mejor actualizar la lista sin recargar.
                        alert('Usuario eliminado exitosamente. Recargando lista...');
                        window.location.reload(); 
                    })
                    .catch(error => {
                        console.error("Error al eliminar el usuario:", error);
                        alert('Hubo un error al eliminar el usuario.');
                        cerrarModal(); // Cierra el modal en caso de error
                    });
            }
            cerrarModal(); // Cierra el modal inmediatamente después de iniciar la petición
        });

    </script>
</body>
</html>